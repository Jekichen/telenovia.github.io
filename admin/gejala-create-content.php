<div class="container">
	<div class="card shadow p-4 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Tambah Data</h5>
        </div>
        
        <div class="card-body">
            <form action="gejala-create.php?aksi=create" method="POST">
                <div class="form-group">
                    <label>Nama Gejala</label>
                    <input type="text" name="nama_gejala" class="form-control">
                </div>
                <div class="form-group">
                    <label>Nilai Gejala</label>
                    <select name="nilai_gejala" class="form-control">
                        <option selected disable>Pilih</option>
                        <option>0.1</option>
                        <option>0.2</option>
                        <option>0.3</option>
                        <option>0.4</option>
                        <option>0.5</option>
                        <option>0.6</option>
                        <option>0.7</option>
                        <option>0.8</option>
                        <option>0.9</option>
                    </select>
                </div>
                <a href="gejala.php" class="btn btn-secondary">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-success">
            </form>
        </div>
    </div>
</div>