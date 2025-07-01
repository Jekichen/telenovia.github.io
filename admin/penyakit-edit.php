<?php
include '../assets/conn/config.php';

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'edit') {
        $id_penyakit = $_POST['id_penyakit'];
        $nama_penyakit = $_POST['nama_penyakit'];
        $keterangan = $_POST['keterangan'];
        $solusi = $_POST['solusi'];

        // Menangani upload gambar
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
            $gambar = $_FILES['gambar']['name'];
            $gambar_tmp = $_FILES['gambar']['tmp_name'];
            $gambar_path = '../assets/image/penyakit/' . $gambar;

            // Pindahkan gambar ke folder tujuan
            if (move_uploaded_file($gambar_tmp, $gambar_path)) {
                $query = "UPDATE tbl_penyakit SET nama_penyakit = '$nama_penyakit', keterangan = '$keterangan', solusi = '$solusi', gambar = '$gambar'
                          WHERE id_penyakit = '$id_penyakit'";
                if (mysqli_query($conn, $query)) {
                    header("location: penyakit.php?pesan=edit_sukses");
                } else {
                    header("location: penyakit.php?pesan=edit_gagal");
                }
            } else {
                // Jika gagal memindahkan gambar
                header("location: penyakit.php?pesan=upload_gagal");
            }
        } else {
            // Jika tidak ada gambar yang diupload, hanya update data lain
            $query = "UPDATE tbl_penyakit SET nama_penyakit = '$nama_penyakit', keterangan = '$keterangan', solusi = '$solusi'
                      WHERE id_penyakit = '$id_penyakit'";
            if (mysqli_query($conn, $query)) {
                header("location: penyakit.php?pesan=edit_sukses");
            } else {
                header("location: penyakit.php?pesan=edit_gagal");
            }
        }
    }
}

$page = 'penyakit-edit-content.php';
include 'index.php';
?>