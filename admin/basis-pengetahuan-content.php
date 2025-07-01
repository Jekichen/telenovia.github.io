<div class="container">
    <div class="card shadow p-5 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Basis Pengetahuan</h5>
        </div>

        <div class="card-body">
            <?php if (isset($_GET['konfirmasi']) && $_GET['konfirmasi'] == 'hapus' && isset($_GET['id_basis_pengetahuan'])) : ?>
                <div class="alert alert-primary text-center">
                    <p><strong>Apakah Anda Yakin Ingin Menghapus Data Ini?</strong></p>
                    <br>
                    <a href="basis-pengetahuan.php?aksi=delete&id_basis_pengetahuan=<?= $_GET['id_basis_pengetahuan']; ?>" class="btn btn-danger">
                        <span class="fa fa-check"></span> Ya
                    </a>
                    <a href="basis-pengetahuan.php" class="btn btn-secondary">
                        <span class="fa fa-times"></span> Batal
                    </a>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['pesan'])): ?>
                <?php if ($_GET['pesan'] == 'tambah_sukses'): ?>
                    <div class="alert alert-success text-center">
                        <span class="fa fa-check-circle"></span>&nbsp; Data Basis Pengetahuan Berhasil Ditambahkan.
                    </div>
                <?php elseif ($_GET['pesan'] == 'edit_sukses'): ?>
                    <div class="alert alert-success text-center">
                        <span class="fa fa-check-circle"></span>&nbsp; Data Basis Pengetahuan Berhasil Diedit.
                    </div>
                <?php elseif ($_GET['pesan'] == 'hapus_sukses'): ?>
                    <div class="alert alert-success text-center">
                        <span class="fa fa-check-circle"></span>&nbsp; Data Basis Pengetahuan Berhasil Dihapus.
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <a href="basis-pengetahuan-create.php" class="btn btn-primary">
                <span class="fa fa-plus"></span>&nbsp; Tambah Data
            </a>
            <br><br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Penyakit</th>
                            <th class="text-center">Nama Gejala</th>
                            <th class="text-center">Nilai Gejala</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query untuk mengambil data dari tabel dengan join
                        $query = "
                            SELECT 
                                a.id_basis_pengetahuan, 
                                p.nama_penyakit, 
                                g.nama_gejala, 
                                g.nilai_gejala 
                            FROM tbl_basis_pengetahuan a
                            JOIN tbl_penyakit p ON a.id_penyakit = p.id_penyakit
                            JOIN tbl_gejala g ON a.id_gejala = g.id_gejala
                            ORDER BY a.id_basis_pengetahuan
                        ";
                        $aturan = mysqli_query($conn, $query);
                        $no = 1;

                        // Loop untuk menampilkan data ke dalam tabel
                        while ($row = mysqli_fetch_array($aturan)) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-justify"><?= htmlspecialchars($row['nama_penyakit']) ?></td>
                            <td class="text-justify"><?= htmlspecialchars($row['nama_gejala']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($row['nilai_gejala']) ?></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="basis-pengetahuan-edit.php?id_basis_pengetahuan=<?= $row['id_basis_pengetahuan'] ?>" class="btn btn-secondary"><span class="fa fa-pen"></span></a>
                                    <a href="basis-pengetahuan.php?konfirmasi=hapus&id_basis_pengetahuan=<?= $row['id_basis_pengetahuan']; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>