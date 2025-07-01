<?php
include '../assets/conn/config.php';

// Memeriksa apakah ada aksi untuk mengedit
if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit') {
    // Mengambil data dari form yang dikirim melalui POST
    $id_user = $_POST['id_user'];
    $id_akun = $_POST['id_akun'];
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $nomor_telepon = mysqli_real_escape_string($conn, $_POST['nomor_telepon']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Periksa apakah password diubah
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Update data di tbl_akun dengan password
        $query_akun = "UPDATE tbl_akun SET username = '$username', password = '$hashed_password', nama_lengkap = '$nama_lengkap' WHERE id_akun = '$id_akun'";
    } else {
        // Jika password tidak diubah, hanya update username dan nama_lengkap
        $query_akun = "UPDATE tbl_akun SET username = '$username', nama_lengkap = '$nama_lengkap' WHERE id_akun = '$id_akun'";
    }

    // Jalankan query update tbl_akun
    if (!mysqli_query($conn, $query_akun)) {
        echo "Error updating tbl_akun: " . mysqli_error($conn);
        exit();
    }

    // Update data di tbl_user
    $query_user = "UPDATE tbl_user SET nama_lengkap = '$nama_lengkap', nomor_telepon = '$nomor_telepon' WHERE id_user = '$id_user'";
    if (!mysqli_query($conn, $query_user)) {
        echo "Error updating tbl_user: " . mysqli_error($conn);
        exit();
    }

    // Arahkan kembali ke halaman user.php setelah data berhasil diupdate
    header("Location: user.php?pesan=edit_sukses");
    exit();
}

// Ambil id_user dari URL untuk menampilkan data yang akan diedit
if (isset($_GET['id_user'])) {
    $id_user = mysqli_real_escape_string($conn, $_GET['id_user']);
    
    // Query untuk mengambil data user berdasarkan id_user
    $query = "SELECT * FROM tbl_user JOIN tbl_akun ON tbl_user.id_akun = tbl_akun.id_akun WHERE tbl_user.id_user = '$id_user'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    // Jika data tidak ditemukan
    if (!$data) {
        echo "User tidak ditemukan!";
        exit();
    }

    // Menyimpan data yang diambil untuk ditampilkan di form
    $nama_lengkap = $data['nama_lengkap'];
    $nomor_telepon = $data['nomor_telepon'];
    $username = $data['username'];
    $id_akun = $data['id_akun'];
}

$page = 'user-edit-content.php';
include 'index.php';
?>