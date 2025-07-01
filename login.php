<?php
include 'assets/conn/config.php';

if (isset($_GET['aksi']) && $_GET['aksi'] == 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM tbl_akun WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $a = mysqli_fetch_assoc($result);

        if (password_verify($password, $a['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $a['role'];
            $_SESSION['id_akun'] = $a['id_akun'];

            if ($a['role'] == 'admin') {
                header("Location: admin/index.php");
            } elseif ($a['role'] == 'user') {
                header("Location: user/index.php");
            }
            exit();
        } else {
            header("Location: login.php?pesan=gagal");
            exit();
        }
    } else {
        header("Location: login.php?pesan=gagal");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="assets/vendor/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="assets/vendor/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/lib/animate/animate.min.css">
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
                                        <h2 class="text-dark animated slideInDown" style="font-weight: bold;">Login</h2>
                                        <br>
                                        <?php
                                        if (isset($_GET['pesan'])) {
                                            if ($_GET['pesan'] == 'gagal') {
                                                echo "<div class='alert alert-danger'>
                                                        <span class='fas fa-times'></span>&nbsp; Login Gagal! Username/Password Salah
                                                    </div>";
                                            } elseif ($_GET['pesan'] == 'berhasil') {
                                                echo "<div class='alert alert-success'>
                                                        <span class='fas fa-check'></span>&nbsp; Pendaftaran Berhasil! Silakan login.
                                                    </div>";
                                            }
                                        }
                                        ?>
                                        <form method="POST" action="login.php?aksi=login">
                                            <div class="form-group text-center">
                                                <label for="username" class="text-dark animated fadeIn">Username:</label>
                                                <input type="text" name="username" class="form-control mx-auto" style="width: 80%;" required>
                                            </div>
                                            <div class="form-group text-center">
                                                <label for="password" class="text-dark animated fadeIn">Password:</label>
                                                <input type="password" name="password" class="form-control mx-auto" style="width: 80%;" required>
                                            </div>
                                            <button type="submit" class="btn btn-dark animated fadeIn">Login</button>
                                            <br>
                                            <br>
                                            <a href="index.php" class="btn btn-dark animated fadeIn">Kembali</a>
                                        </form>
                                        <hr>
                                        <p class="text-dark animated slideInUp">Belum punya akun? <a href="daftar.php" class="text-primary">Daftar di sini</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>
</body>
</html>