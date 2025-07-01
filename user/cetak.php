<?php
// Include TCPDF library
require_once('../assets/tcpdf/tcpdf.php');
include '../assets/conn/config.php';

// Mulai session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ambil id_akun dari session
$id_akun = $_SESSION['id_akun'] ?? null;
if (!$id_akun) {
    die("User tidak terautentikasi.");
}

// Ambil no_regdiagnosa dari parameter atau session
$no_regdiagnosa = $_GET['no_regdiagnosa'] ?? $_SESSION['no_regdiagnosa'] ?? null;
if (!$no_regdiagnosa) {
    die("Nomor registrasi diagnosa tidak ditemukan.");
}

// Ambil data pengguna
$userData = mysqli_query($conn, "SELECT nama_lengkap, nomor_telepon FROM tbl_user WHERE id_akun = '$id_akun'");
if (!$userData) {
    die("Query gagal: " . mysqli_error($conn));
}
$user = mysqli_fetch_assoc($userData);
if (!$user) {
    die("Data pengguna tidak ditemukan.");
}

$namaLengkap = $user['nama_lengkap'] ?? 'Tidak diketahui';
$nomorTelepon = $user['nomor_telepon'] ?? 'Tidak diketahui';

// Ambil tanggal diagnosa dari database
$diagnosaData = mysqli_query($conn, "SELECT tgl_diagnosa FROM tbl_diagnosa WHERE no_regdiagnosa = '$no_regdiagnosa' AND id_akun = '$id_akun'");
if (!$diagnosaData) {
    die("Query gagal: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($diagnosaData);
$tanggalDiagnosa = !empty($row['tgl_diagnosa']) ? date('d-m-Y', strtotime($row['tgl_diagnosa'])) : 'Tanggal tidak tersedia';

// Inisialisasi variabel untuk menghitung penyakit terbesar dan tingkat CF
$highestPercentage = 0;
$penyakitTerbesar = "";

// Logic perhitungan untuk mendapatkan penyakit terbesar dan persentase CF
$dataPenyakit = mysqli_query($conn, "SELECT * FROM tbl_penyakit ORDER BY id_penyakit");
if (!$dataPenyakit) {
    die("Query gagal: " . mysqli_error($conn));
}

while ($penyakit = mysqli_fetch_array($dataPenyakit)) {
    $sqlGejala = mysqli_query($conn, "SELECT g.nilai_gejala, d.nilai_user 
        FROM tbl_gejala g
        JOIN tbl_basis_pengetahuan b ON g.id_gejala = b.id_gejala
        JOIN tbl_detail_diagnosa d ON g.id_gejala = d.id_gejala
        JOIN tbl_diagnosa diag ON diag.id_diagnosa = d.id_diagnosa
        WHERE b.id_penyakit = '{$penyakit['id_penyakit']}' 
        AND diag.no_regdiagnosa = '$no_regdiagnosa' 
        AND diag.id_akun = '$id_akun'");
    
    if (!$sqlGejala) {
        die("Query gagal: " . mysqli_error($conn));
    }

    $cflama = 0;
    while ($result = mysqli_fetch_array($sqlGejala)) {
        $cfhe = $result['nilai_gejala'] * $result['nilai_user'];
        $cfcombine = $cflama + $cfhe * (1 - $cflama);
        $cflama = $cfcombine;
    }

    $percentage = $cflama * 100;
    if ($percentage > $highestPercentage) {
        $highestPercentage = number_format($percentage, 2);
        $penyakitTerbesar = $penyakit['nama_penyakit'];
    }
}

// Ambil data penyakit terbesar
$data = mysqli_query($conn, "SELECT * FROM tbl_penyakit WHERE nama_penyakit = '$penyakitTerbesar'");
if (!$data) {
    die("Query gagal: " . mysqli_error($conn));
}
$penyakitData = mysqli_fetch_assoc($data);
if (!$penyakitData) {
    $penyakitData['keterangan'] = 'Data keterangan tidak tersedia.';
    $penyakitData['solusi'] = 'Data solusi tidak tersedia.';
}

// Fungsi wrapText untuk teks panjang
function wrapText($pdf, $text, $width, $lineHeight) {
    $lines = explode("\n", wordwrap($text, $width / 3, "\n"));
    foreach ($lines as $line) {
        $pdf->MultiCell(0, $lineHeight, $line, 0, 'L', 0, 1);
    }
}

// Buat instance TCPDF dengan orientasi portrait
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetMargins(10, 15, 10);
$pdf->AddPage();

// Judul
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 8, 'Hasil Diagnosa Penyakit Sapi', 0, 1, 'C');
$pdf->Ln(2);

// Tambahkan informasi pengguna
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 8, 'Informasi Pengguna', 0, 1, 'L');
$pdf->SetFont('helvetica', '', 11);
$pdf->Cell(40, 7, "Nama Lengkap", 0, 0, 'L');
$pdf->Cell(5, 7, ":", 0, 0, 'L');
$pdf->Cell(0, 7, $namaLengkap, 0, 1, 'L');

$pdf->Cell(40, 7, "Nomor Telepon", 0, 0, 'L');
$pdf->Cell(5, 7, ":", 0, 0, 'L');
$pdf->Cell(0, 7, $nomorTelepon, 0, 1, 'L');

$pdf->Cell(40, 7, "No. Diagnosa", 0, 0, 'L');
$pdf->Cell(5, 7, ":", 0, 0, 'L');
$pdf->Cell(0, 7, $no_regdiagnosa, 0, 1, 'L');

$pdf->Cell(40, 7, "Tanggal Diagnosa", 0, 0, 'L');
$pdf->Cell(5, 7, ":", 0, 0, 'L');
$pdf->Cell(0, 7, $tanggalDiagnosa, 0, 1, 'L');
$pdf->Ln(2);

// Header tabel
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(10, 7, 'No', 1, 0, 'C');
$pdf->Cell(50, 7, 'Penyakit', 1, 0, 'C');
$pdf->Cell(50, 7, 'Gejala', 1, 0, 'C');
$pdf->Cell(40, 7, 'CF Pakar', 1, 0, 'C');
$pdf->Cell(40, 7, 'CF User', 1, 1, 'C');

// Isi tabel
$pdf->SetFont('helvetica', '', 10);
$sql = mysqli_query($conn, "SELECT p.nama_penyakit, g.nama_gejala, g.nilai_gejala, d.nilai_user 
    FROM tbl_penyakit p
    JOIN tbl_basis_pengetahuan b ON p.id_penyakit = b.id_penyakit
    JOIN tbl_gejala g ON b.id_gejala = g.id_gejala
    JOIN tbl_detail_diagnosa d ON g.id_gejala = d.id_gejala
    JOIN tbl_diagnosa diag ON diag.id_diagnosa = d.id_diagnosa
    WHERE diag.no_regdiagnosa = '$no_regdiagnosa' AND diag.id_akun = '$id_akun'");

if (!$sql) {
    die("Query gagal: " . mysqli_error($conn));
}

$i = 0;
while ($r = mysqli_fetch_array($sql)) {
    $nilai_cf = $r['nilai_gejala'] * $r['nilai_user'];
    $i++;
    $pdf->Cell(10, 7, $i, 1, 0, 'C');
    $pdf->Cell(50, 7, $r['nama_penyakit'], 1, 0, 'L');
    $pdf->Cell(50, 7, $r['nama_gejala'], 1, 0, 'L');
    $pdf->Cell(40, 7, $r['nilai_gejala'], 1, 0, 'C');
    $pdf->Cell(40, 7, $r['nilai_user'], 1, 1, 'C');
}

// Kesimpulan
$pdf->Ln(6);
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 7, 'Kesimpulan:', 0, 1);
$pdf->SetFont('helvetica', '', 11);
wrapText($pdf, "Berdasarkan hasil dari perhitungan dengan Metode Certainty Factor, sapi Anda kemungkinan besar menderita penyakit $penyakitTerbesar dengan tingkat kepercayaan $highestPercentage%.", 230, 10);

// Keterangan
$pdf->Ln(6);
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 7, 'Keterangan:', 0, 1);
$pdf->SetFont('helvetica', '', 11);
wrapText($pdf, $penyakitData['keterangan'], 230, 10);

// Solusi
$pdf->Ln(6);
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 7, 'Solusi:', 0, 1);
$pdf->SetFont('helvetica', '', 11);
wrapText($pdf, $penyakitData['solusi'], 230, 10);

// Output PDF
ob_end_clean();
$pdf->Output('diagnosa_sapi.pdf', 'I');
?>