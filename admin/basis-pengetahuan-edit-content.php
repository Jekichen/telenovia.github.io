<div class="container">
    <div class="card shadow p-4 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Edit Data</h5>
        </div>
        <hr>
        
        <?php
        $data = mysqli_query($conn, "SELECT * FROM tbl_basis_pengetahuan WHERE id_basis_pengetahuan = '$_GET[id_basis_pengetahuan]'");
        $a = mysqli_fetch_array($data);
        ?>
        <div class="card-body">
            <form action="basis-pengetahuan-edit.php?aksi=edit" method="POST">
                <input type="hidden" name="id_basis_pengetahuan" value="<?= $a['id_basis_pengetahuan'] ?>">
                
                <div class="form-group">
                    <label>Penyakit</label>
                    <select name="id_penyakit" class="form-control">
                        <?php
                        // Ambil semua penyakit
                        $penyakit = mysqli_query($conn, "SELECT * FROM tbl_penyakit ORDER BY id_penyakit");
                        while ($dtP = mysqli_fetch_array($penyakit)) {
                            // Cek apakah penyakit ini yang dipilih
                            $selected = ($dtP['id_penyakit'] == $a['id_penyakit']) ? 'selected' : '';
                            echo "<option value='" . $dtP['id_penyakit'] . "' $selected>" . $dtP['nama_penyakit'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Gejala</label>
                    <select name="id_gejala" class="form-control">
                        <?php
                        // Ambil semua gejala
                        $gejala = mysqli_query($conn, "SELECT * FROM tbl_gejala ORDER BY id_gejala");
                        while ($dtG = mysqli_fetch_array($gejala)) {
                            // Cek apakah gejala ini yang dipilih
                            $selected = ($dtG['id_gejala'] == $a['id_gejala']) ? 'selected' : '';
                            echo "<option value='" . $dtG['id_gejala'] . "' $selected>" . $dtG['nama_gejala'] . " - " . $dtG['nilai_gejala'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <a href="basis-pengetahuan.php" class="btn btn-secondary">Batal</a>
                <input type="submit" value="Edit" class="btn btn-success">
            </form>
        </div>
    </div>
</div>