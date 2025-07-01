<?php
include '../assets/conn/config.php';

if (isset($_GET['aksi']) && $_GET['aksi'] == 'create') {
    $id_penyakit = $_POST['id_penyakit'];
    $id_gejala = $_POST['id_gejala'];

    // Menggunakan prepared statements untuk menghindari SQL injection
    $stmt = $conn->prepare("INSERT INTO tbl_basis_pengetahuan (id_penyakit, id_gejala) VALUES (?, ?)");
    $stmt->bind_param("ii", $id_penyakit, $id_gejala); // Mengikat parameter

    if ($stmt->execute()) {
        header("location: basis-pengetahuan.php?pesan=tambah_sukses");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$page = 'basis-pengetahuan-create-content.php';
include 'index.php';
?>