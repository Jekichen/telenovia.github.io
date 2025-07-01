<?php if (isset($_GET['konfirmasi']) && $_GET['konfirmasi'] == 'logout') : ?>
    <div class="alert alert-primary text-center mt-4">
        <h5>Apakah Anda Yakin Ingin Logout?</h5>
        <br>
        <a href="../index.php?logout=true" class="btn btn-danger mr-2">
            <i class="fa fa-check"></i> Ya
        </a>
        <a href="index.php" class="btn btn-secondary">
            <i class="fa fa-times"></i> Batal
        </a>
    </div>
<?php endif; ?>
<?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'edit_sukses'): ?>
    <div class="alert alert-success text-center">
        <i class="fas fa-check-circle"></i>&nbsp; Profil berhasil diperbarui.
    </div>
<?php endif; ?>
<br>
<div class="container">
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Kolom Deskripsi -->
                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Gejala</div>
                            <?php
                            $gejala = mysqli_query($conn, "SELECT COUNT(*) as tGejala FROM tbl_gejala ORDER BY id_gejala");
                            $a = mysqli_fetch_array($gejala);
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $a['tGejala'] ?>
                            </div>
                        </div>
                        <!-- Kolom Ikon -->
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Kolom Deskripsi -->
                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Penyakit</div>
                            <?php
                            $penyakit = mysqli_query($conn, "SELECT COUNT(*) as tPenyakit FROM tbl_penyakit ORDER BY id_penyakit");
                            $a = mysqli_fetch_array($penyakit);
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $a['tPenyakit'] ?>
                            </div>
                        </div>
                        <!-- Kolom Ikon -->
                        <div class="col-auto">
                            <i class="fas fa-viruses fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Kolom Deskripsi -->
                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">User</div>
                            <?php
                            $user = mysqli_query($conn, "SELECT COUNT(*) as tUser FROM tbl_user ORDER BY id_user");
                            $a = mysqli_fetch_array($user);
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $a['tUser'] ?>
                            </div>
                        </div>
                        <!-- Kolom Ikon -->
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Kolom Deskripsi -->
                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Basis Pengetahuan</div>
                            <?php
                            $basis_pengetahuan = mysqli_query($conn, "SELECT COUNT(*) as tBasisPengetahuan FROM tbl_basis_pengetahuan ORDER BY id_basis_pengetahuan");
                            $a = mysqli_fetch_array($basis_pengetahuan);
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $a['tBasisPengetahuan'] ?>
                            </div>
                        </div>
                        <!-- Kolom Ikon -->
                        <div class="col-auto">
                            <i class="fas fa-cog fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
