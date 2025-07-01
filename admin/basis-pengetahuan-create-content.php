<div class="container">
    <div class="card shadow p-4 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-dark">Tambah Data</h5>
        </div>
        <hr>

        <div class="card-body">
            <form action="basis-pengetahuan-create.php?aksi=create" method="POST">
                <div class="form-group">
                    <label>Penyakit</label>
                    <select name="id_penyakit" class="form-control" required>
                        <option disabled selected>Pilih</option> <!-- Menambahkan opsi "Pilih" yang tidak bisa diklik -->
                        <?php
                        $penyakit = mysqli_query($conn, "SELECT * FROM tbl_penyakit ORDER BY id_penyakit");
                        while ($dtP = mysqli_fetch_array($penyakit)) {
                            echo "<option value='" . htmlspecialchars($dtP['id_penyakit']) . "'>" . htmlspecialchars($dtP['nama_penyakit']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Gejala</label>
                    <select name="id_gejala" class="form-control" required>
                        <option disabled selected>Pilih</option> <!-- Menambahkan opsi "Pilih" yang tidak bisa diklik -->
                        <?php
                        $gejala = mysqli_query($conn, "SELECT * FROM tbl_gejala ORDER BY id_gejala");
                        while ($dtG = mysqli_fetch_array($gejala)) {
                            echo "<option value='" . htmlspecialchars($dtG['id_gejala']) . "'>" . htmlspecialchars($dtG['nama_gejala']) . " - " . $dtG['nilai_gejala'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <a href="basis-pengetahuan.php" class="btn btn-secondary">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-success">
            </form>
        </div>
    </div>
</div>