<div class="container">
	<div class="card shadow p-4 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Edit Data</h5>
        </div>
        <hr>

        <?php
        $gejala = mysqli_query ($conn, "SELECT * FROM tbl_gejala WHERE id_gejala = '$_GET[id_gejala]'");
        $a = mysqli_fetch_array ($gejala);
        ?>
        <div class="card-body">

            <form action="gejala-edit.php?aksi=edit" method="POST">
                <input type="hidden" name="id_gejala" class="form-control" value="<?= $a['id_gejala']?>">
                <div class="form-group">
                    <label>Nama Gejala</label>
                    <input type="text" name="nama_gejala" class="form-control"value="<?= $a['nama_gejala']?>">
                </div>
                <div class="form-group">
                    <label>Nilai Gejala</label>
                    <select name="nilai_gejala" class="form-control">
                        <option selected> <?= $a['nilai_gejala']?> </option>
                        <option>0.1</option>
                        <option>0.2</option>
                        <option>0.3</option>
                        <option>0.4</option>
                        <option>0.5</option>
                        <option>0.6</option>
                        <option>0.7</option>
                        <option>0.8</option>
                        <option>0.9</option>
                        <option>1.0</option>
                    </select>
                </div>
                
                <a href="gejala.php" class="btn btn-secondary">Batal</a>
                <input type="submit" value="Edit" class="btn btn-success">
            </form>
        </div>
    </div>
</div>