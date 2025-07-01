<div class="container">
    <div class="card shadow p-4 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Edit Data</h5>
        </div>
        <hr>
        
        <?php
        // Ambil data penyakit berdasarkan id_penyakit
        $penyakit = mysqli_query($conn, "SELECT * FROM tbl_penyakit WHERE id_penyakit = '$_GET[id_penyakit]'");
        $a = mysqli_fetch_array($penyakit);
        ?>
        <div class="card-body">
        <form action="penyakit-edit.php?aksi=edit" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_penyakit" value="<?= $a['id_penyakit'] ?>">
            <div class="form-group">
                <label>Nama Penyakit</label>
                <input type="text" name="nama_penyakit" class="form-control" value="<?= $a['nama_penyakit'] ?>">
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="3"><?= $a['keterangan'] ?></textarea>
            </div>
            <div class="form-group">
                <label>Solusi</label>
                <textarea class="form-control" name="solusi" rows="3"><?= $a['solusi'] ?></textarea>
            </div>
            <div class="form-group">
                <label>Gambar Penyakit</label>
                <!-- Menampilkan gambar yang ada saat ini -->
                <?php if (!empty($a['gambar'])): ?>
                    <br>
                    <img src="assets/image/penyakit/<?= $a['gambar'] ?>" width="100" height="100" alt="Gambar Penyakit">
                <?php endif; ?>
                <br>
                <input type="file" name="gambar" class="form-control">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
            </div>
            <a href="penyakit.php" class="btn btn-secondary">Batal</a>
            <input type="submit" value="Edit" class="btn btn-success">
        </form>
        </div>
    </div>
</div>