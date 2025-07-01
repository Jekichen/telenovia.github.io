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

// Jika pengguna memilih diagnosa ulang, HAPUS hanya detail diagnosa
if (isset($_GET['ulang']) && $_GET['ulang'] === 'true') {
    $deleteQuery = "DELETE FROM tbl_detail_diagnosa 
                    WHERE id_diagnosa IN (
                        SELECT id_diagnosa FROM tbl_diagnosa 
                        WHERE no_regdiagnosa = '$no_regdiagnosa' AND id_akun = '$id_akun'
                    )";
    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: diagnosa.php?status=ulang");
        exit();
    } else {
        echo "Gagal menghapus data diagnosa: " . mysqli_error($conn);
        exit();
    }
}

$highestPercentage = 0;
$idPenyakitTerbesar = null;
$gambarPenyakit = "";

$data = mysqli_query($conn, "SELECT * FROM tbl_penyakit ORDER BY id_penyakit");
if (!$data) {
    die("Error pada query penyakit: " . mysqli_error($conn));
}

while ($a = mysqli_fetch_array($data)) {
    $sql1 = mysqli_query($conn, "SELECT g.id_gejala, g.nama_gejala, g.nilai_gejala, d.nilai_user, b.id_penyakit 
                                 FROM tbl_gejala g
                                 JOIN tbl_basis_pengetahuan b ON g.id_gejala = b.id_gejala
                                 JOIN tbl_detail_diagnosa d ON d.id_gejala = g.id_gejala
                                 JOIN tbl_diagnosa diag ON diag.id_diagnosa = d.id_diagnosa
                                 WHERE b.id_penyakit = '$a[id_penyakit]' 
                                 AND diag.no_regdiagnosa = '$no_regdiagnosa' 
                                 AND diag.id_akun = '$id_akun'");
    if (!$sql1) {
        die("Error pada query gejala: " . mysqli_error($conn));
    }

    $jml_data = mysqli_num_rows($sql1);
    $cflama = 0;
    $lastPercentage = 0;

    while ($result = mysqli_fetch_array($sql1)) {
        $cfhe = $result['nilai_gejala'] * $result['nilai_user'];
        if ($jml_data > 0) {
            $cf1 = $cflama;
            $cf2 = $cfhe;
            $cfcombine = $cf1 + $cf2 * (1 - $cf1);
            $cflama = $cfcombine;

            if ($result['id_penyakit'] == $a['id_penyakit']) {
                $percentage = $cfcombine * 100;
                $lastPercentage = number_format($percentage, 2);
            }
        }
    }

    if ($lastPercentage > $highestPercentage) {
        $highestPercentage = $lastPercentage;
        $idPenyakitTerbesar = $a['id_penyakit'];
        $gambarPenyakit = $a['gambar'];
    }
}

$_SESSION['gambar_penyakit'] = $gambarPenyakit;

// Simpan ke tbl_hasil jika tombol simpan ditekan
if (isset($_POST['simpan_hasil']) && $highestPercentage > 0 && $idPenyakitTerbesar) {
    // Cek apakah sudah pernah disimpan
    $cek = mysqli_query($conn, "SELECT * FROM tbl_hasil WHERE no_regdiagnosa = '$no_regdiagnosa' AND id_akun = '$id_akun'");
    if (mysqli_num_rows($cek) == 0) {
        $tgl_diagnosa = date('Y-m-d H:i:s');
        $query = "INSERT INTO tbl_hasil (id_akun, no_regdiagnosa, tgl_diagnosa, id_penyakit, nilai_cf, status_simpan) 
                  VALUES ('$id_akun', '$no_regdiagnosa', '$tgl_diagnosa', '$idPenyakitTerbesar', '$highestPercentage', 1)";
        if (mysqli_query($conn, $query)) {
            header("Location: history.php?status=sukses");
            exit();
        } else {
            echo "Gagal menyimpan hasil diagnosa: " . mysqli_error($conn);
        }
    } else {
        header("Location: history.php?status=terduplikasi");
        exit();
    }
}

$page = 'hasil-content.php';
include 'index.php';
?>
