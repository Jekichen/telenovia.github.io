<?php
include '../assets/conn/config.php';

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'create') {
        $nama_gejala = $_POST['nama_gejala'];
        $nilai_gejala = $_POST['nilai_gejala'];

        $query = "INSERT INTO tbl_gejala (nama_gejala, nilai_gejala) VALUES ('$nama_gejala', '$nilai_gejala')";

        if (mysqli_query($conn, $query)) {
            header("location: gejala.php?pesan=create_sukses");
        } else {
            header("location: gejala.php?pesan=create_gagal");
        }
    }
}

$page = 'gejala-create-content.php';
include 'index.php';
?>