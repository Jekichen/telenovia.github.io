<?php
include '../assets/conn/config.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi']=='delete') {
        $id_penyakit = $_GET['id_penyakit'];
        
        if (mysqli_query($conn, "DELETE FROM tbl_penyakit WHERE id_penyakit = $id_penyakit")) {
            header("location: penyakit.php?pesan=hapus_sukses");
        } else {
            header("location: penyakit.php?pesan=hapus_gagal");
        }        
    }
}

$page = 'penyakit-content.php';
include 'index.php';
?>