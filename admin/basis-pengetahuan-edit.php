<?php
include '../assets/conn/config.php';

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'edit') {
        $id_basis_pengetahuan = $_POST['id_basis_pengetahuan'];
        $id_penyakit = $_POST['id_penyakit'];
        $id_gejala = $_POST['id_gejala'];

        mysqli_query($conn, "UPDATE tbl_basis_pengetahuan SET id_penyakit = '$id_penyakit', id_gejala = '$id_gejala' WHERE id_basis_pengetahuan = '$id_basis_pengetahuan'");
        header("location: basis-pengetahuan.php?pesan=edit_sukses");
    }
}

$page = 'basis-pengetahuan-edit-content.php';
include 'index.php';
?>