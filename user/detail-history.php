<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../assets/conn/config.php';

if (!isset($_SESSION['id_akun'])) {
    header("Location: ../login.php");
    exit();
}

$id_akun = $_SESSION['id_akun'];
$no_regdiagnosa = $_GET['no_regdiagnosa'] ?? null;

if (!$no_regdiagnosa) {
    echo "Data diagnosa tidak ditemukan.";
    exit();
}

$highestPercentage = 0;
$penyakitTerbesar = "";
$gambarPenyakit = "";

// Ambil data penyakit dan hitung CF
$data = mysqli_query($conn, "SELECT * FROM tbl_penyakit ORDER BY id_penyakit");
if (!$data) {
    die("Error pada query penyakit: " . mysqli_error($conn));
}

while ($a = mysqli_fetch_array($data)) {
    $sql1 = mysqli_query($conn, "SELECT g.nilai_gejala, d.nilai_user 
        FROM tbl_gejala g
        JOIN tbl_basis_pengetahuan b ON g.id_gejala = b.id_gejala
        JOIN tbl_detail_diagnosa d ON g.id_gejala = d.id_gejala
        JOIN tbl_diagnosa diag ON diag.id_diagnosa = d.id_diagnosa
        WHERE b.id_penyakit = '$a[id_penyakit]' 
        AND diag.id_akun = '$id_akun' 
        AND diag.no_regdiagnosa = '$no_regdiagnosa'");
    
    if (!$sql1) {
        die("Error pada query gejala: " . mysqli_error($conn));
    }

    $cflama = 0;
    while ($result = mysqli_fetch_array($sql1)) {
        $cfhe = $result['nilai_gejala'] * $result['nilai_user'];
        $cfcombine = $cflama + $cfhe * (1 - $cflama);
        $cflama = $cfcombine;
    }

    $percentage = $cflama * 100;
    if ($percentage > $highestPercentage) {
        $highestPercentage = number_format($percentage, 2);
        $penyakitTerbesar = $a['nama_penyakit'];
        $gambarPenyakit = $a['gambar'];
    }
}

// Simpan gambar penyakit ke sesi
$_SESSION['gambar_penyakit'] = $gambarPenyakit;

// Redirect ke halaman detail-history-content.php
$page = 'detail-history-content.php';
include 'index.php';
?>