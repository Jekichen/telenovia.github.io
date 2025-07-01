<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sapi - Certainty Factor</title>

    <link rel="stylesheet" href="assets/vendor/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="assets/lib/animate/animate.min.css">
    
    <style>
        body {
            background-image: url('assets/image/background.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        /* Flexbox Footer */
        html, body {
            height: 100%;
        }
        .wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }
        .content-wrapper {
            flex: 1;
        }

        .follow-us .btn {
            margin: 0 10px;
            color: #fff;
            border-radius: 50px;
            font-size: 21px;
            border: none;
        }

        .btn-github:hover {
            background-color: #444 !important;
        }

        .btn-instagram:hover {
            background-color: #e1306c !important;
        }

        .btn-facebook {
            background-color: transparent !important;
        }
        
        .btn-facebook:hover {
            background-color: #3b5998 !important;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <nav class="navbar navbar-light bg-dark shadow py-3">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand font-weight-bold text-light animated slideInDown" disabled>Sistem Pakar Diagnosa Penyakit Sapi</a>
                <div class="d-flex animated slideInDown">
                    <a href="login.php" class="btn btn-light mr-2">Login</a>
                    <a href="daftar.php" class="btn btn-light">Daftar</a>
                </div>
            </div>
        </nav>


        <div class="content-wrapper">
            <div class="container my-5">
                <div class="text-center mb-4">
                    <h1 class="h4 text-dark animated slideInDown" style="font-weight: bold;">Selamat Datang</h1>
                    <br>
                    <p class="text-muted animated slideInDown">Sistem Pakar Untuk Diagnosa Penyakit Sapi Menggunakan Metode Certainty Factor.</p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="bg-dark card py-3">
                            <div class="card-body text-center">
                                <p class="text-light animated fadeIn">Ingin Mendiagnosa Sapimu?, Ayo Lakukan.</p>
                                <br>
                                <a href="login.php" class="btn btn-light btn-lg animated fadeIn">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="follow-us text-center">
                <a href="https://github.com/Jekichen" target="_blank" class="btn btn-github animated slideInUp">
                    <i class="fab fa-github"></i>
                </a>
                <a href="https://instagram.com/ur.egao/" target="_blank" class="btn btn-instagram animated slideInUp">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://facebook.com/jackk.935713" target="_blank" class="btn btn-facebook animated slideInUp">
                    <i class="fab fa-facebook"></i>
                </a>
            </div>
        </div>

        <footer class="bg-dark py-4 shadow mt-5">
            <div class="container text-center">
                <span class="text-light">© 2024 Copyright'an | Punya <a href="https://github.com/Jekichen" class="text-info" target="_blank" rel="noopener noreferrer">Jekichen</a></span>
            </div>
        </footer>
    </div>

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>
</body>
</html>