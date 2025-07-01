<?php
include '../assets/conn/config.php';

// Proses penghapusan data jika ada aksi 'delete'
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'delete') {
        $id_basis_pengetahuan = $_GET['id_basis_pengetahuan'];
        mysqli_query($conn, "DELETE FROM tbl_basis_pengetahuan WHERE id_basis_pengetahuan = $id_basis_pengetahuan");
        header("location: basis-pengetahuan.php?pesan=hapus_sukses");
    }
}

$page = 'basis-pengetahuan-content.php';
include 'index.php';
?>