<?php
$page = '';
include '../assets/conn/config.php';

if (isset($_GET['aksi']) && $_GET['aksi'] == 'create') {
    // Ambil data dari form
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $nomor_telepon = mysqli_real_escape_string($conn, $_POST['nomor_telepon']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password
    $role = mysqli_real_escape_string($conn, $_POST['role']); // Ambil role dari dropdown

    // Debug: Cek apakah nama_lengkap ada
    if (empty($nama_lengkap)) {
        echo "Nama lengkap tidak boleh kosong!";
        exit();
    }
    
    $akun_query = "INSERT INTO tbl_akun (nama_lengkap, username, password, role, dibuat) 
                VALUES ('$nama_lengkap', '$username', '$password', '$role', NOW())";

    if (mysqli_query($conn, $akun_query)) {
        // Ambil id_akun yang baru saja dimasukkan
        $id_akun = mysqli_insert_id($conn);

        // Insert ke tabel tbl_user menggunakan id_akun
        $user_query = "INSERT INTO tbl_user (id_akun, nama_lengkap, nomor_telepon, dibuat) 
                    VALUES ('$id_akun', '$nama_lengkap', '$nomor_telepon', NOW())";

        if (mysqli_query($conn, $user_query)) {
            // Redirect ke halaman user.php setelah berhasil
            header("Location: user.php?pesan=tambah_sukses");
            exit();
        } else {
            echo "Error inserting into tbl_user: " . mysqli_error($conn);
            exit();
        }
    } else {
        echo "Error inserting into tbl_akun: " . mysqli_error($conn);
        exit();
    }
}
$page = 'user-create-content.php';
include 'index.php';
?>