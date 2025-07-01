<div class="container">
    <div class="card shadow p-5 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Gejala</h5>
        </div>

        <div class="card-body">
            <?php if (isset($_GET['konfirmasi']) && $_GET['konfirmasi'] == 'hapus' && isset($_GET['id_gejala'])) : ?>
                <div class="alert alert-primary text-center">
                    <p><strong>Apakah Anda Yakin Ingin Menghapus Data Ini?</strong></p>
                    <br>
                    <a href="gejala.php?aksi=delete&id_gejala=<?= $_GET['id_gejala']; ?>" class="btn btn-danger">
                        <span class="fa fa-check"></span> Ya
                    </a>
                    <a href="gejala.php" class="btn btn-secondary">
                        <span class="fa fa-times"></span> Batal
                    </a>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['pesan'])): ?>
                <?php if ($_GET['pesan'] == 'tambah_sukses'): ?>
                    <div class="alert alert-success text-center"><i class="fa fa-check-circle"></i> Data Gejala Berhasil Ditambahkan.</div>
                <?php elseif ($_GET['pesan'] == 'tambah_gagal'): ?>
                    <div class="alert alert-danger text-center"><i class="fa fa-times-circle"></i> Gagal Menambahkan Data Gejala.</div>
                <?php elseif ($_GET['pesan'] == 'edit_sukses'): ?>
                    <div class="alert alert-success text-center"><i class="fa fa-check-circle"></i> Data Gejala Berhasil Diedit.</div>
                <?php elseif ($_GET['pesan'] == 'edit_gagal'): ?>
                    <div class="alert alert-danger text-center"><i class="fa fa-times-circle"></i> Gagal Mengedit Data Gejala.</div>
                <?php elseif ($_GET['pesan'] == 'hapus_sukses'): ?>
                    <div class="alert alert-success text-center"><i class="fa fa-check-circle"></i> Data Gejala Berhasil Dihapus.</div>
                <?php elseif ($_GET['pesan'] == 'hapus_gagal'): ?>
                    <div class="alert alert-danger text-center"><i class="fa fa-times-circle"></i> Gagal Menghapus Data Gejala.</div>
                <?php endif; ?>
            <?php endif; ?>

            <a href="gejala-create.php" class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp; Tambah Data</a>
            <br><br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Gejala</th>
                            <th class="text-center">Nilai Gejala</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $gejala = mysqli_query($conn, "SELECT * FROM tbl_gejala ORDER BY id_gejala");
                    $no = 1;
                    while($a = mysqli_fetch_array($gejala)) { ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center"><?= $a['nama_gejala']; ?></td>
                            <td class="text-center"><?= $a['nilai_gejala']; ?></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="gejala-edit.php?id_gejala=<?= $a['id_gejala']; ?>" class="btn btn-secondary"><span class="fa fa-pen"></span></a>
                                    <a href="gejala.php?konfirmasi=hapus&id_gejala=<?= $a['id_gejala']; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
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