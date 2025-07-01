<?php
include '../assets/conn/config.php';
session_start();

// Pastikan admin sudah login
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

$id_akun = $_SESSION['id_akun'];

// Ambil data profil admin
$query = "SELECT * FROM tbl_akun WHERE id_akun = '$id_akun'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Proses update data profil
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah password diubah
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE tbl_akun SET username = '$username', password = '$hashed_password' WHERE id_akun = '$id_akun'");
    } else {
        mysqli_query($conn, "UPDATE tbl_akun SET username = '$username' WHERE id_akun = '$id_akun'");
    }

    // Redirect ke halaman profil setelah update
    header("Location: index.php?pesan=edit_sukses");
    exit();
}
?>

<!-- HTML Form Edit Profile -->
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h2 class="text-dark" style="font-weight: bold;">Edit Profil</h2>
                                        <br>
                                        <form method="POST" action="edit-profile.php">
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

    <!-- Scripts -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../assets/js/sb-admin-2.min.js"></script>
</body>
</html>
