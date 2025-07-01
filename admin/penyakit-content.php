<div class="container">
    <div class="card shadow p-5 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Penyakit</h5>
        </div>

        <div class="card-body">
            <?php if (isset($_GET['konfirmasi']) && $_GET['konfirmasi'] == 'hapus' && isset($_GET['id_penyakit'])) : ?>
                <div class="alert alert-primary text-center">
                    <p><strong>Apakah Anda Yakin Ingin Menghapus Data Ini?</strong></p>
                    <br>
                    <a href="penyakit.php?aksi=delete&id_penyakit=<?= $_GET['id_penyakit']; ?>" class="btn btn-danger">
                        <span class="fa fa-check"></span> Ya
                    </a>
                    <a href="penyakit.php" class="btn btn-secondary">
                        <span class="fa fa-times"></span> Batal
                    </a>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['pesan'])): ?>
                <?php if ($_GET['pesan'] == 'tambah_sukses'): ?>
                    <div class="alert alert-success text-center"><i class="fa fa-check-circle"></i> Data Penyakit Berhasil Ditambahkan.</div>
                <?php elseif ($_GET['pesan'] == 'tambah_gagal'): ?>
                    <div class="alert alert-danger text-center"><i class="fa fa-times-circle"></i> Gagal Menambahkan Data Penyakit.</div>
                <?php elseif ($_GET['pesan'] == 'edit_sukses'): ?>
                    <div class="alert alert-success text-center"><i class="fa fa-check-circle"></i> Data Penyakit Berhasil Diedit.</div>
                <?php elseif ($_GET['pesan'] == 'edit_gagal'): ?>
                    <div class="alert alert-danger text-center"><i class="fa fa-times-circle"></i> Gagal Mengedit Data Penyakit.</div>
                <?php elseif ($_GET['pesan'] == 'hapus_sukses'): ?>
                    <div class="alert alert-success text-center"><i class="fa fa-check-circle"></i> Data Penyakit Berhasil Dihapus.</div>
                <?php elseif ($_GET['pesan'] == 'hapus_gagal'): ?>
                    <div class="alert alert-danger text-center"><i class="fa fa-times-circle"></i> Gagal Menghapus Data Penyakit.</div>
                <?php endif; ?>
            <?php endif; ?>

            <?php
                function formatSolusi($text) {
                    // Pisahkan berdasarkan pola a. b. c. dst.
                    $pattern = '/([a-z])\.\s/';
                    $parts = preg_split($pattern, $text, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

                    $output = "<ol type='a'>";
                    for ($i = 0; $i < count($parts); $i += 2) {
                        if (isset($parts[$i+1])) {
                            $output .= "<li>" . trim($parts[$i+1]) . "</li>";
                        }
                    }
                    $output .= "</ol>";
                    return $output;
                }
            ?>
            <a href="penyakit-create.php" class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp; Tambah Data</a>
            <br>
            <br>
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Penyakit</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Solusi</th>
                    <th class="text-center">Gambar</th> <!-- Kolom Gambar -->
                    <th class="text-center">Aksi</th>
                </tr>
                <?php
                $penyakit = mysqli_query($conn, "SELECT * FROM tbl_penyakit ORDER BY id_penyakit");
                $no = 1;
                while ($a = mysqli_fetch_array($penyakit)) {
                ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= $a['nama_penyakit'] ?></td>
                    <td class="text-justify"><?= $a['keterangan'] ?></td>
                    <td class="text-justify">
                        <?= nl2br(formatSolusi($a['solusi'])) ?>
                    </td>
                    <td class="text-center">
                        <?php if (!empty($a['gambar'])): ?>
                            <img src="../assets/image/penyakit/<?= $a['gambar'] ?>" alt="Gambar Penyakit" width="100" height="100">
                        <?php else: ?>
                            <span>Tidak ada gambar</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="penyakit-edit.php?id_penyakit=<?= $a['id_penyakit'] ?>" class="btn btn-secondary"><span class="fa fa-pen"></span></a>
                            <a href="penyakit.php?konfirmasi=hapus&id_penyakit=<?= $a['id_penyakit']; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>
            </div>
        </div>
    </div>
</div>