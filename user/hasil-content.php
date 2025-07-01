<div class="container">
    <div class="card shadow p-5 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Hasil Diagnosa</h5>
        </div>
        <div class="card-body">
        <?php if (isset($_GET['konfirmasi']) && $_GET['konfirmasi'] == 'ulang' && isset($_GET['no_regdiagnosa'])): ?>
            <div class="alert alert-primary text-center">
                <p><strong>Apakah Anda Yakin Ingin Melakukan Diagnosa Ulang?</strong></p>
                <br>
                <a href="hasil.php?no_regdiagnosa=<?= urlencode($_GET['no_regdiagnosa']); ?>&ulang=true" class="btn btn-danger">
                    <span class="fa fa-check"></span> Ya
                </a>
                <a href="hasil.php?no_regdiagnosa=<?= urlencode($_GET['no_regdiagnosa']); ?>" class="btn btn-secondary">
                    <span class="fa fa-times"></span> Batal
                </a>
            </div>
        <?php endif; ?>

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
                    $sql = mysqli_query($conn, "SELECT p.nama_penyakit, g.nama_gejala, g.nilai_gejala, d.nilai_user 
                        FROM tbl_penyakit p
                        JOIN tbl_basis_pengetahuan b ON p.id_penyakit = b.id_penyakit
                        JOIN tbl_gejala g ON b.id_gejala = g.id_gejala
                        JOIN tbl_detail_diagnosa d ON g.id_gejala = d.id_gejala
                        JOIN tbl_diagnosa diag ON diag.id_diagnosa = d.id_diagnosa
                        WHERE diag.id_akun = '$id_akun' AND diag.no_regdiagnosa = '$no_regdiagnosa'
                        ORDER BY p.id_penyakit, g.id_gejala");
                    
                    if (!$sql) {
                        die("Error pada query: " . mysqli_error($conn));
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
                            <td class='text-center'>$nilai_cf</td>
                        </tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <br>
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
                        WHERE b.id_penyakit = '$a[id_penyakit]' AND diag.id_akun = '$id_akun' AND diag.no_regdiagnosa = '$no_regdiagnosa'");
                    
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
        <?php if (!empty($gambarPenyakit)): ?>
            <div class="border p-3 mt-4">
                <h5 class="font-weight-bold text-dark text-center">Gambar Penyakit</h5>
                <div class="text-center">
                    <img src="../assets/image/penyakit/<?= htmlspecialchars($gambarPenyakit); ?>" alt="<?= htmlspecialchars($penyakitTerbesar); ?>" class="img-fluid mt-3" style="max-width: 400px; border-radius: 8px;">
                </div>
            </div>
        <?php endif; ?>
        <div class="border p-3">
            <div class="card-header">
                <h5 class="font-weight-bold text-dark text-center">Kesimpulan</h5>
            </div>
            <div class="card-body">
                <?php
                echo "<div class='text-justify'>
                Berdasarkan hasil dari perhitungan dengan Metode <b class='text-info'>Certainty Factor</b> diatas, dapat disimpulkan bahwa <b class='text-info'>Sapi</b> anda kemungkinan besar menderita penyakit <b class='text-info'>$penyakitTerbesar</b> dengan tingkat kepercayaan <b class='text-info'>$highestPercentage%.</b>
                </div>";
                ?>
            </div>
        </div>
        <br>
        <div class="border p-3">
            <div class="card-header">
                <h5 class="font-weight-bold text-dark text-center">Keterangan</h5>
            </div>
            <div class="card-body">
                <?php
                echo "<div class='text-justify'>
                {$penyakitInfo['keterangan']}
                </div>";
                ?>
            </div>
        </div>
        <br>
        <div class="border p-3">
            <div class="card-header">
                <h5 class="font-weight-bold text-dark text-center">Solusi</h5>
            </div>
            <div class="card-body">
                <?php
                echo "<div class='text-justify' style='white-space: pre-line;'>{$penyakitInfo['solusi']}</div>";
                ?>
            </div>
        </div>
        <br>
        <div class="text-center mt-4">
            <a href="hasil.php?no_regdiagnosa=<?= $no_regdiagnosa; ?>&konfirmasi=ulang" class="btn btn-warning">
                <span class="fa fa-redo"></span> Diagnosa Ulang
            </a>            
            <form method="post" style="display: inline;">
                <button type="submit" name="simpan_hasil" class="btn btn-success">
                    <span class="fa fa-save"></span> Simpan Hasil Diagnosa
                </button>
            </form>
        </div>
    </div>
    <?php
        // Cek jika hasil belum disimpan dan belum ulang, maka sidebar dikunci
        $cek_hasil = mysqli_query($conn, "SELECT * FROM tbl_hasil WHERE no_regdiagnosa = '$no_regdiagnosa'");
        if (mysqli_num_rows($cek_hasil) == 0 && !isset($_GET['ulang'])):
        ?>
        <script>
        // Nonaktifkan sidebar (contoh: class .nav-item)
        document.querySelectorAll('.nav-item').forEach(function(el) {
            el.classList.add('disabled-sidebar');
        });
        </script>

        <style>
        /* Gaya untuk sidebar yang dinonaktifkan */
        .disabled-sidebar {
            pointer-events: none !important;
            opacity: 0.6;
        }
        </style>
    <?php endif; ?>
</div>