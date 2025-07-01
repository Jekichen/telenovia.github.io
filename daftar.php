<?php
session_start();
include 'assets/conn/config.php';

if (isset($_GET['aksi']) && $_GET['aksi'] == 'daftar') {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 'user';
    $dibuat = date('Y-m-d H:i:s');

    $query = "SELECT * FROM tbl_akun WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        header("location:daftar.php?pesan=gagal");
        exit();
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_akun = "INSERT INTO tbl_akun (nama_lengkap, username, password, role, dibuat) VALUES ('$nama_lengkap', '$username', '$hashed_password', '$role', '$dibuat')";
        if (mysqli_query($conn, $insert_akun)) {
            
            $id_akun = mysqli_insert_id($conn);
            $insert_user = "INSERT INTO tbl_user (id_akun, nama_lengkap, nomor_telepon, dibuat) VALUES ('$id_akun', '$nama_lengkap', '$nomor_telepon', '$dibuat')";
            if (mysqli_query($conn, $insert_user)) {
                
                header("location:login.php?pesan=berhasil");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    
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
                                        <h2 class="text-dark fw-bold animated slideInDown">Daftar</h2>
                                        <br>
                                        <?php
                                        if (isset($_GET['pesan'])) {
                                            if ($_GET['pesan'] == 'gagal') {
                                                echo "<div class='alert alert-danger'>
                                                        <span class='fas fa-times'></span>&nbsp; Username sudah terdaftar!
                                                    </div>";
                                            }
                                        }
                                        ?>
                                        <form method="POST" action="daftar.php?aksi=daftar">
                                            <div class="form-group text-center">
                                                <label for="nama_lengkap" class="text-dark animated fadeIn">Nama Lengkap:</label>
                                                <input type="text" name="nama_lengkap" class="form-control mx-auto" style="width: 80%;" required>
                                            </div>
                                            <div class="form-group text-center">
                                                <label for="nomor_telepon" class="text-dark animated fadeIn">Nomor Telepon:</label>
                                                <input type="text" name="nomor_telepon" class="form-control mx-auto" style="width: 80%;" required>
                                            </div>
                                            <div class="form-group text-center">
                                                <label for="username" class="text-dark animated fadeIn">Username:</label>
                                                <input type="text" name="username" class="form-control mx-auto" style="width: 80%;" required>
                                            </div>
                                            <div class="form-group text-center">
                                                <label for="password" class="text-dark animated fadeIn">Password:</label>
                                                <input type="password" name="password" class="form-control mx-auto" style="width: 80%;" required>
                                            </div>
                                            <button type="submit" class="btn btn-dark animated slideInUp">Daftar</button>
                                        </form>
                                        <hr>
                                        <p class="text-dark animated slideInUp">Sudah punya akun? <a href="login.php" class="text-primary">Login di sini</a></p>
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