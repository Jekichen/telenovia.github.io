<?php
include '../assets/conn/config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_akun = $_SESSION['id_akun'] ?? null;
if (!$id_akun) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'delete' && isset($_GET['no_regdiagnosa'])) {
        $no_regdiagnosa = mysqli_real_escape_string($conn, $_GET['no_regdiagnosa']);

        // Pastikan data yang akan dihapus milik akun yang sedang login
        $checkQuery = mysqli_query($conn, "SELECT * FROM tbl_hasil WHERE no_regdiagnosa = '$no_regdiagnosa' AND id_akun = '$id_akun'");
        if (mysqli_num_rows($checkQuery) > 0) {
            // Hapus data dari tabel terkait
            mysqli_query($conn, "DELETE FROM tbl_detail_diagnosa WHERE id_diagnosa IN (
                SELECT id_diagnosa FROM tbl_diagnosa WHERE no_regdiagnosa = '$no_regdiagnosa'
            )");
            mysqli_query($conn, "DELETE FROM tbl_diagnosa WHERE no_regdiagnosa = '$no_regdiagnosa'");
            mysqli_query($conn, "DELETE FROM tbl_hasil WHERE no_regdiagnosa = '$no_regdiagnosa'");

            header("Location: history.php?status=deleted");
            exit();
        } else {
            header("Location: history.php?status=unauthorized");
            exit();
        }
    }
}

$page = 'history-content.php';
include 'index.php';
?>