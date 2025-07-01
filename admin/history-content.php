<div class="container">
    <div class="card shadow p-5 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">History</h5>
        </div>
        <div class="card-body">
            <?php if (isset($_GET['konfirmasi']) && $_GET['konfirmasi'] == 'hapus' && isset($_GET['no_regdiagnosa'])) : ?>
                <div class="alert alert-primary text-center">
                    <p><strong>Apakah Anda Yakin Ingin Menghapus Data Ini?</strong></p>
                    <br>
                    <a href="history.php?aksi=delete&no_regdiagnosa=<?= urlencode($_GET['no_regdiagnosa']); ?>" class="btn btn-danger">
                        <span class="fa fa-check"></span> Ya
                    </a>
                    <a href="history.php" class="btn btn-secondary">
                        <span class="fa fa-times"></span> Batal
                    </a>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['pesan'])): ?>
                <?php if ($_GET['pesan'] == 'hapus_sukses'): ?>
                    <div class="alert alert-success text-center"><i class="fa fa-check-circle"></i> Data History Berhasil Dihapus.</div>
                <?php elseif ($_GET['pesan'] == 'hapus_gagal'): ?>
                    <div class="alert alert-danger text-center"><i class="fa fa-times-circle"></i> Gagal Menghapus Data History.</div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center px-3 py-2">No</th>
                            <th class="text-center px-3 py-2">Nama Lengkap</th>
                            <th class="text-center px-3 py-2">No Regdiagnosa</th>
                            <th class="text-center px-3 py-2">Tanggal</th>
                            <th class="text-center px-3 py-2">Penyakit</th>
                            <th class="text-center px-3 py-2">Nilai CF</th>
                            <th class="text-center px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query data history
                        $query = "SELECT h.no_regdiagnosa, h.tgl_diagnosa, h.nilai_cf, 
                                         p.nama_penyakit AS penyakit_cf, 
                                         a.nama_lengkap, a.id_akun
                                  FROM tbl_hasil h
                                  JOIN tbl_akun a ON h.id_akun = a.id_akun
                                  JOIN tbl_penyakit p ON h.id_penyakit = p.id_penyakit
                                  ORDER BY h.id_hasil DESC";
                        $result = mysqli_query($conn, $query);

                        // Cek jika query gagal
                        if (!$result) {
                            die("Query error: " . mysqli_error($conn));
                        }

                        // Iterasi data
                        $no = 1;
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center"><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                                <td class="text-center"><?= htmlspecialchars($row['no_regdiagnosa']); ?></td>
                                <td class="text-center"><?= htmlspecialchars($row['tgl_diagnosa']); ?></td>
                                <td class="text-center"><?= htmlspecialchars($row['penyakit_cf']); ?></td>
                                <td class="text-center"><?= htmlspecialchars($row['nilai_cf']); ?>%</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="detail-history.php?no_regdiagnosa=<?= urlencode($row['no_regdiagnosa']); ?>&id_akun=<?= urlencode($row['id_akun']); ?>" class="btn btn-secondary btn-sm d-flex align-items-center px-3 py-1 mr-1"><i class="fa fa-eye mr-2"></i> <span>Lihat</span></a>
                                        <a href="history.php?konfirmasi=hapus&no_regdiagnosa=<?= urlencode($row['no_regdiagnosa']); ?>" class="btn btn-danger btn-sm d-flex align-items-center px-3 py-1"><i class="fa fa-trash mr-2"></i> <span>Hapus</span></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php if (mysqli_num_rows($result) === 0): ?>
            <div class="alert alert-info text-center mt-3">
                Tidak Ada Data Riwayat Diagnosa Dari Pengguna
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>