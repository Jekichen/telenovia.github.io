<div class="container">
    <div class="card shadow p-5 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Data User</h5>
        </div>

        <div class="card-body">
            <?php if (isset($_GET['konfirmasi']) && $_GET['konfirmasi'] == 'hapus' && isset($_GET['id_user'])) : ?>
                <div class="alert alert-primary text-center">
                    <p><strong>Apakah Anda Yakin Ingin Menghapus Data Ini?</strong></p>
                    <br>
                    <a href="user.php?aksi=delete&id_user=<?= $_GET['id_user']; ?>" class="btn btn-danger">
                        <span class="fa fa-check"></span> Ya
                    </a>
                    <a href="user.php" class="btn btn-secondary">
                        <span class="fa fa-times"></span> Batal
                    </a>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['pesan'])): ?>
                <?php if ($_GET['pesan'] == 'tambah_sukses'): ?>
                    <div class="alert alert-success text-center">
                        <span class="fa fa-check-circle"></span>&nbsp; Data User Berhasil Ditambahkan.
                    </div>
                <?php elseif ($_GET['pesan'] == 'edit_sukses'): ?>
                    <div class="alert alert-success text-center">
                        <span class="fa fa-check-circle"></span>&nbsp; Data User Berhasil Diedit.
                    </div>
                <?php elseif ($_GET['pesan'] == 'hapus_sukses'): ?>
                    <div class="alert alert-success text-center">
                        <span class="fa fa-check-circle"></span>&nbsp; Data User Berhasil Dihapus.
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <a href="user-create.php" class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp; Tambah Data</a>
            <br><br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Nomor Telepon</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $user = mysqli_query($conn, "SELECT * FROM tbl_user ORDER BY id_user");
                    $no = 1;
                    while ($a = mysqli_fetch_array($user)) { ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center"><?= $a['nama_lengkap']; ?></td>
                            <td class="text-center"><?= $a['nomor_telepon']; ?></td>
                            <td class="text-center">
                                <a href="user-edit.php?id_user=<?= $a['id_user']; ?>" class="btn btn-secondary"><span class="fa fa-pen"></span></a>
                                <a href="user.php?konfirmasi=hapus&id_user=<?= $a['id_user']; ?>" class="btn btn-danger">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
