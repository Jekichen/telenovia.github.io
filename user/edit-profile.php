<?php
include '../assets/conn/config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

$id_akun = $_SESSION['id_akun'];
$query = "SELECT * FROM tbl_akun JOIN tbl_user ON tbl_akun.id_akun = tbl_user.id_akun WHERE tbl_akun.id_akun = '$id_akun'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nomor_telepon = $_POST['nomor_telepon'];

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_akun = "UPDATE tbl_akun SET username = '$username', password = '$hashed_password', nama_lengkap = '$nama_lengkap' WHERE id_akun = '$id_akun'";
    } else {
        $update_akun = "UPDATE tbl_akun SET username = '$username', nama_lengkap = '$nama_lengkap' WHERE id_akun = '$id_akun'";
    }

    if (!mysqli_query($conn, $update_akun)) {
        echo "Error updating tbl_akun: " . mysqli_error($conn);
        exit();
    }

    $update_user = "UPDATE tbl_user SET nama_lengkap = '$nama_lengkap', nomor_telepon = '$nomor_telepon' WHERE id_akun = '$id_akun'";
    if (!mysqli_query($conn, $update_user)) {
        echo "Error updating tbl_user: " . mysqli_error($conn);
        exit();
    }

    header("Location: index.php?pesan=edit_sukses");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="../assets/vendor/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../assets/vendor/datatables/dataTables.bootstrap4.min.css">
</head>

<body class="bg-gradient-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h2 class="text-dark" style="font-weight: bold;">Edit Profil</h2>
                                        <br>
                                        <form method="POST" action="edit-profile.php">
                                            <div class="form-group text-center">
                                                <label for="nama_lengkap" class="text-dark">Nama Lengkap :</label>
                                                <input type="text" name="nama_lengkap" class="form-control mx-auto" style="width: 80%;" value="<?= $data['nama_lengkap']; ?>" required>
                                            </div>
                                            <div class="form-group text-center">
                                                <label for="nomor_telepon" class="text-dark">Nomor Telepon :</label>
                                                <input type="text" name="nomor_telepon" class="form-control mx-auto" style="width: 80%;" value="<?= $data['nomor_telepon']; ?>" required>
                                            </div>
                                            <div class="form-group text-center">
                                                <label for="username" class="text-dark">Username :</label>
                                                <input type="text" name="username" class="form-control mx-auto" style="width: 80%;" value="<?= $data['username']; ?>" required>
                                            </div>
                                            <div class="form-group text-center">
                                                <label for="password" class="text-dark">Password :</label>
                                                <input type="password" name="password" class="form-control mx-auto" style="width: 80%;">
                                                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti password</small>
                                            </div>
                                            <button type="submit" name="update" class="btn btn-dark">Simpan Perubahan</button>
                                        </form>
                                        <hr>
                                        <p class="text-dark">Kembali ke <a href="index.php" class="text-primary">Dashboard</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../assets/js/sb-admin-2.min.js"></script>
</body>
</html>