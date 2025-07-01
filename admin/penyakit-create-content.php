<div class="container">
    <div class="card shadow p-4 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Tambah Data</h5>
        </div>
        
        <div class="card-body">
            <form action="penyakit-create.php?aksi=create" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Penyakit</label>
                    <input type="text" name="nama_penyakit" class="form-control">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>Solusi</label>
                    <textarea class="form-control" name="solusi" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                </div>
                <a href="penyakit.php" class="btn btn-secondary">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-success">
            </form>
        </div>
    </div>
</div>