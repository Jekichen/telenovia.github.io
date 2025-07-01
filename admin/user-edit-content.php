<div class="container">
    <div class="card shadow p-4 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Edit Data User</h5>
        </div>
        <hr>

        <?php
        // Ambil id_user dari URL
        if (isset($_GET['id_user'])) {
            $id_user = $_GET['id_user'];

            // Query untuk mengambil data user berdasarkan id_user
            $query = "SELECT * FROM tbl_user JOIN tbl_akun ON tbl_user.id_akun = tbl_akun.id_akun WHERE tbl_user.id_user = '$id_user'";
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_assoc($result);

            // Jika data tidak ditemukan
            if (!$data) {
                echo "User tidak ditemukan!";
                exit;
            }

            // Menyimpan data yang diambil untuk ditampilkan di form
            $nama_lengkap = $data['nama_lengkap'];
            $nomor_telepon = $data['nomor_telepon'];
            $username = $data['username'];
            $id_akun = $data['id_akun'];
        }
        ?>

        <div class="card-body">
            <form action="user-edit.php?aksi=edit" method="POST">
                <input type="hidden" name="id_user" value="<?= $id_user ?>">
                <input type="hidden" name="id_akun" value="<?= $id_akun ?>">

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= $nama_lengkap ?>" required>
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" class="form-control" value="<?= $nomor_telepon ?>" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $username ?>" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti password</small>
                </div>

                <a href="user.php" class="btn btn-secondary">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-success">
            </form>
        </div>
    </div>
</div>