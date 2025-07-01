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
<div class="container-fluid">
    <div id="carouselExample" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../assets/image/carousel/carousel-1.jpg" class="d-block w-100" alt="Slide 1">
                <div class="carousel-caption d-none d-md-block">
                    <a href="penyakit.php" class="text-decoration-none">
                        <h5>Sapi</h5>
                    </a>
                    <p>Sapi, Jawi atau Lembu adalah hewan ternak anggota famili Bovidae dan subfamili Bovinae.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../assets/image/carousel/carousel-2.jpg" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block">
                    <a href="penyakit.php" class="text-decoration-none">
                        <h5>Penyakit Sapi</h5>
                    </a>
                    <p>Penyakit sapi adalah gangguan kesehatan yang menyerang ternak sapi, baik yang disebabkan oleh virus, bakteri, parasit, maupun faktor lingkungan.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../assets/image/carousel/carousel-3.jpg" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Diagnosa</h5>
                    <p>Maka Dari Itu Periksakan Gejala<a href="penyakit.php" class="text-decoration-none"> Penyakitnya </a>Dan Segera Diagnosa Sapi-mu</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>