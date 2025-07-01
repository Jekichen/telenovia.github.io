<?php
include '../assets/conn/config.php';

// Hapus data diagnosa jika ada aksi delete
if (isset($_GET['aksi']) && $_GET['aksi'] == 'delete' && isset($_GET['no_regdiagnosa'])) {
    $no_regdiagnosa = mysqli_real_escape_string($conn, $_GET['no_regdiagnosa']);
    
    // Hapus data dari tabel tbl_hasil
    $delete_hasil = mysqli_query($conn, "DELETE FROM tbl_hasil WHERE no_regdiagnosa = '$no_regdiagnosa'");
    
    // Hapus data dari tabel tbl_diagnosa
    $delete_diagnosa = mysqli_query($conn, "DELETE FROM tbl_diagnosa WHERE no_regdiagnosa = '$no_regdiagnosa'");
    
    // Redirect dengan pesan sukses atau gagal
    if ($delete_hasil && $delete_diagnosa) {
        header("Location: history.php?pesan=hapus_sukses");
    } else {
        header("Location: history.php?pesan=hapus_gagal");
    }
    exit();
}

// Menyertakan file konten history
$page = 'history-content.php';
include 'index.php';
?>