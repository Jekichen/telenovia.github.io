<?php
include '../assets/conn/config.php';

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'delete') {
        $id_user = mysqli_real_escape_string($conn, $_GET['id_user']);
        
        // Cari id_akun yang terkait dengan id_user
        $query = "SELECT id_akun FROM tbl_user WHERE id_user = $id_user";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);

        if ($data) {
            $id_akun = $data['id_akun'];

            // Hapus data di tbl_user
            mysqli_query($conn, "DELETE FROM tbl_user WHERE id_user = $id_user");

            // Hapus data di tbl_akun menggunakan id_akun
            mysqli_query($conn, "DELETE FROM tbl_akun WHERE id_akun = $id_akun");
        }

        // Redirect kembali ke halaman user.php setelah selesai
        header("Location: user.php?pesan=hapus_sukses");
        exit();
    }
}

$page = 'user-content.php';
include 'index.php';
?>