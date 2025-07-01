<?php
include '../assets/conn/config.php';

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'edit') {
        $id_gejala = $_POST['id_gejala'];
        $nama_gejala = $_POST['nama_gejala'];
        $nilai_gejala = $_POST['nilai_gejala'];

        $query = "UPDATE tbl_gejala SET nama_gejala = '$nama_gejala', nilai_gejala = '$nilai_gejala' WHERE id_gejala = '$id_gejala'";

        if (mysqli_query($conn, $query)) {
            header("location: gejala.php?pesan=edit_sukses");
        } else {
            header("location: gejala.php?pesan=edit_gagal");
        }
    }
}

$page = 'gejala-edit-content.php';
include 'index.php';
?>