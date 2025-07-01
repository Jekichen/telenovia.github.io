<div class="container">
    <div class="card shadow p-5 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Hasil Diagnosa</h5>
        </div>
        <div class="card-body">
            <!-- Informasi Pengguna -->
            <?php
            // Validasi no_regdiagnosa dari URL
            $no_regdiagnosa = isset($_GET['no_regdiagnosa']) ? mysqli_real_escape_string($conn, $_GET['no_regdiagnosa']) : null;

            // Ambil informasi pengguna berdasarkan id_akun yang terkait dengan tbl_hasil
            $userQuery = mysqli_query($conn, "SELECT u.nama_lengkap, u.nomor_telepon, h.tgl_diagnosa 
                                              FROM tbl_user u
                                              JOIN tbl_hasil h ON u.id_akun = h.id_akun
                                              WHERE h.no_regdiagnosa = '$no_regdiagnosa'");
            $userData = mysqli_fetch_array($userQuery);

            if (!$userData) {
                echo "<p class='text-danger'>Data tidak ditemukan.</p>";
                exit();
            }
            ?>
            <h6><strong>Informasi Pengguna</strong></h6>
            <br>
            <div class="info">
                <p><strong>Nama :</strong> <?= htmlspecialchars($userData['nama_lengkap']); ?></p>
                <p><strong>Nomor Telepon :</strong> <?= htmlspecialchars($userData['nomor_telepon'] ?? 'Nomor telepon tidak tersedia'); ?></p>
                <p><strong>No. Diagnosa :</strong> <?= htmlspecialchars($no_regdiagnosa); ?></p>
                <p><strong>Tanggal Diagnosa :</strong> <?= date('d-m-Y', strtotime($userData['tgl_diagnosa'])); ?></p>
            </div>
            <!-- Tabel hasil diagnosa -->
            <h5 class="font-weight-bold text-dark text-center">Rule</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Penyakit</th>
                        <th class="text-center">Gejala</th>
                        <th class="text-center">CF Pakar</th>
                        <th class="text-center">CF User</th>
                        <th class="text-center">Nilai CF</th>
                    </tr>
                    <?php
                    // Ambil data detail diagnosa dari tabel terkait
                    $sql = mysqli_query($conn, "SELECT p.nama_penyakit, g.nama_gejala, g.nilai_gejala, d.nilai_user 
                        FROM tbl_penyakit p
                        JOIN tbl_basis_pengetahuan b ON p.id_penyakit = b.id_penyakit
                        JOIN tbl_gejala g ON b.id_gejala = g.id_gejala
                        JOIN tbl_detail_diagnosa d ON g.id_gejala = d.id_gejala
                        JOIN tbl_diagnosa diag ON diag.id_diagnosa = d.id_diagnosa
                        WHERE diag.no_regdiagnosa = '$no_regdiagnosa'
                        ORDER BY p.id_penyakit, g.id_gejala");

                    if (!$sql) {
                        die("Error pada query rule: " . mysqli_error($conn));
                    }

                    $i = 0;
                    while ($r = mysqli_fetch_array($sql)) {
                        $nilai_cf = $r['nilai_gejala'] * $r['nilai_user'];
                        $i++;
                        echo "
                        <tr>
                            <td class='text-center'>$i</td>
                            <td class='text-center'>{$r['nama_penyakit']}</td>
                            <td class='text-center'>{$r['nama_gejala']}</td>
                            <td class='text-center'>{$r['nilai_gejala']}</td>
                            <td class='text-center'>{$r['nilai_user']}</td>
                            <td class='text-center'>" . number_format($nilai_cf, 2) . "</td>
                        </tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="border p-3">
            <div class="card-body">
                <h5 class="font-weight-bold text-dark text-center">Detail Perhitungan</h5>
                <br>
                <?php
                $highestPercentage = 0;
                $idPenyakitTerbesar = null;
                $data = mysqli_query($conn, "SELECT * FROM tbl_penyakit ORDER BY id_penyakit");
                if (!$data) {
                    die("Error pada query penyakit: " . mysqli_error($conn));
                }

                while ($a = mysqli_fetch_array($data)) {
                    $sql1 = mysqli_query($conn, "SELECT g.nilai_gejala, d.nilai_user 
                        FROM tbl_gejala g
                        JOIN tbl_basis_pengetahuan b ON g.id_gejala = b.id_gejala
                        JOIN tbl_detail_diagnosa d ON g.id_gejala = d.id_gejala
                        JOIN tbl_diagnosa diag ON diag.id_diagnosa = d.id_diagnosa
                        WHERE b.id_penyakit = '$a[id_penyakit]' AND diag.no_regdiagnosa = '$no_regdiagnosa'");
                    
                    if (!$sql1) {
                        die("Error pada query gejala: " . mysqli_error($conn));
                    }

                    $jml_data = mysqli_num_rows($sql1);

                    $cflama = 0;
                    $lastPercentage = 0;
                    while ($result = mysqli_fetch_array($sql1)) {
                        $cfhe = $result['nilai_gejala'] * $result['nilai_user'];

                        if ($jml_data > 0) {
                            $cf1 = $cflama;
                            $cf2 = $cfhe;

                            $cfcombine = $cf1 + $cf2 * (1 - $cf1);
                            $cflama = $cfcombine;
                            
                            echo "<div class='text-justify'>
                            CFCombine = " . $cf1 . " + " . $cf2 . " x (1-" . $cf1 . ") = " . $cfcombine . "<br>
                            </div>";

                            $percentage = $cfcombine * 100;
                            $lastPercentage = number_format($percentage, 2);
                        }
                    }

                    if ($jml_data > 0) {
                        echo "<p><b>Persentase Combine pada penyakit (" . $a['nama_penyakit'] . ") : " . $lastPercentage . "%</b></p>";
                        if ($lastPercentage > $highestPercentage) {
                            $highestPercentage = $lastPercentage;
                            $idPenyakitTerbesar = $a['id_penyakit'];
                        }
                    }
                }

                // Ambil nama penyakit dan gambar berdasarkan id_penyakit terbesar
                $penyakitData = mysqli_query($conn, "SELECT * FROM tbl_penyakit WHERE id_penyakit = '$idPenyakitTerbesar'");
                if ($penyakitData) {
                    $penyakitInfo = mysqli_fetch_array($penyakitData);
                    $penyakitTerbesar = $penyakitInfo['nama_penyakit'];
                    $gambarPenyakit = $penyakitInfo['gambar'];

                    echo "
                    <b class='text-info'>Nilai Terbesar " . $highestPercentage . "%<br></b>
                    <b class='text-info'>Penyakit Dengan Nilai Terbesar : " . $penyakitTerbesar . "<br></b>";
                }
                ?>
            </div>
        </div>
        <div class="border p-3">
            <h5 class="font-weight-bold text-dark text-center">Kesimpulan</h5>
            <div class="card-body">
                <?php
                echo "<div class='text-justify'>
                Berdasarkan hasil dari perhitungan dengan Metode <b class='text-info'>Certainty Factor</b>, dapat disimpulkan bahwa <b class='text-info'>Sapi</b> Anda kemungkinan besar menderita penyakit <b class='text-info'>$penyakitTerbesar</b> dengan tingkat kepercayaan <b class='text-info'>$highestPercentage%</b>.
                </div>";
                ?>
            </div>
        </div>
        <?php if (!empty($gambarPenyakit)): ?>
            <div class="border p-3 mt-4">
                <h5 class="font-weight-bold text-dark text-center">Gambar Penyakit</h5>
                <div class="text-center">
                    <img src="../assets/image/penyakit/<?= htmlspecialchars($gambarPenyakit); ?>" alt="<?= htmlspecialchars($penyakitTerbesar); ?>" class="img-fluid mt-3" style="max-width: 400px; border-radius: 8px;">
                </div>
            </div>
        <?php endif; ?>
        <div class="border p-3">
            <h5 class="font-weight-bold text-dark text-center">Keterangan</h5>
            <div class="card-body">
                <?php
                $penyakitQuery = mysqli_query($conn, "SELECT keterangan FROM tbl_penyakit WHERE nama_penyakit = '$penyakitTerbesar'");
                if (!$penyakitQuery) {
                    die("Error pada query keterangan: " . mysqli_error($conn));
                }
                $penyakitInfo = mysqli_fetch_array($penyakitQuery);
                echo "<div class='text-justify'>{$penyakitInfo['keterangan']}</div>";
                ?>
            </div>
        </div>
        <div class="border p-3">
            <h5 class="font-weight-bold text-dark text-center">Solusi</h5>
            <div class="card-body">
                <?php
                $penyakitQuery = mysqli_query($conn, "SELECT solusi FROM tbl_penyakit WHERE nama_penyakit = '$penyakitTerbesar'");
                if (!$penyakitQuery) {
                    die("Error pada query solusi: " . mysqli_error($conn));
                }
                $penyakitInfo = mysqli_fetch_array($penyakitQuery);
                echo "<div class='text-justify' style='white-space: pre-line;'>{$penyakitInfo['solusi']}</div>";
                ?>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="history.php" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>