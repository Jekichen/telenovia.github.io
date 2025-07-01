<?php
include '../assets/conn/config.php';

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'create') {
        $nama_penyakit = $_POST['nama_penyakit'];
        $keterangan = $_POST['keterangan'];
        $solusi = $_POST['solusi'];

        // Proses upload gambar
        $gambar = '';
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
            // Menentukan lokasi folder penyimpanan gambar
            $targetDir = "assets/image/penyakit/";
            $gambar = basename($_FILES['gambar']['name']);
            $targetFile = $targetDir . $gambar;

            // Memindahkan file gambar yang diupload ke folder yang telah ditentukan
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
                echo "Gambar berhasil di-upload.";
            } else {
                echo "Gambar gagal di-upload.";
            }
        }

        // Query untuk menyimpan data ke database
        $query = "INSERT INTO tbl_penyakit (nama_penyakit, keterangan, solusi, gambar) 
                  VALUES ('$nama_penyakit', '$keterangan', '$solusi', '$gambar')";
        
        if (mysqli_query($conn, $query)) {
            header("location: penyakit.php?pesan=tambah_sukses");
        } else {
            header("location: penyakit.php?pesan=tambah_gagal");
        }        
    }
}

$page = 'penyakit-create-content.php';
include 'index.php';
?>