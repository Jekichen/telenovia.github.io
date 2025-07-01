<?php
include '../assets/conn/config.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi']=='delete') {
        $id_gejala = $_GET['id_gejala'];
        
        if (mysqli_query($conn, "DELETE FROM tbl_gejala WHERE id_gejala = $id_gejala")) {
            header("location: gejala.php?pesan=hapus_sukses");
        } else {
            header("location: gejala.php?pesan=hapus_gagal");
        }
    }
}

$page = 'gejala-content.php';
include 'index.php';
?>