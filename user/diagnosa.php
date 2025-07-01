<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Asia/Jakarta');
include '../assets/conn/config.php';

function generateRandomString($length) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

$panjangString = 10;
$ulang = isset($_GET['ulang']) && $_GET['ulang'] == 'true';

if (isset($_GET['aksi']) && $_GET['aksi'] == 'diagnosa' && !$ulang) {
    $no_regdiagnosa = generateRandomString($panjangString);
    $tgl_diagnosa = date('Y-m-d');
    $id_akun = $_SESSION['id_akun'];

    // Simpan ke tbl_diagnosa
    $query_diagnosa = "INSERT INTO tbl_diagnosa (no_regdiagnosa, tgl_diagnosa, id_akun) VALUES (?, ?, ?)";
    if ($stmt_diagnosa = mysqli_prepare($conn, $query_diagnosa)) {
        mysqli_stmt_bind_param($stmt_diagnosa, "ssi", $no_regdiagnosa, $tgl_diagnosa, $id_akun);
        mysqli_stmt_execute($stmt_diagnosa);
        $id_diagnosa = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt_diagnosa);
    }

    // Simpan detail ke tbl_detail_diagnosa
    $query_detail = "INSERT INTO tbl_detail_diagnosa (id_diagnosa, id_gejala, nilai_user) VALUES (?, ?, ?)";
    if ($stmt_detail = mysqli_prepare($conn, $query_detail)) {
        foreach ($_POST['kondisi'] as $id_gejala => $nilai_user) {
            if ($nilai_user !== '') {
                $id_gejala = (int) $id_gejala;
                $nilai_user = (float) $nilai_user;
                mysqli_stmt_bind_param($stmt_detail, "iid", $id_diagnosa, $id_gejala, $nilai_user);
                mysqli_stmt_execute($stmt_detail);
            }
        }
        mysqli_stmt_close($stmt_detail);
    }

    header("Location: hasil.php?no_regdiagnosa=$no_regdiagnosa");
    exit();
}

$page = 'diagnosa-content.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];
$pas = mysqli_query($conn, "SELECT * FROM tbl_akun WHERE username = '$username'");
$p = mysqli_fetch_array($pas);
$id_akun = $p['id_akun'];

include 'index.php';
?>