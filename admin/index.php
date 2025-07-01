<?php
include '../assets/conn/config.php';
session_start(); // Memulai session di awal halaman

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit();
}
// Pastikan user sudah login dan memiliki role 'admin'
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sapi - Certainty Factor</title>
    
    <link rel="stylesheet" href="../assets/vendor/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../assets/vendor/datatables/dataTables.bootstrap4.min.css">
    
    <style>
        .content-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content-main {
            flex: 1;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #f8f9fc;
        }

        /* Sticky sidebar */
        #accordionSidebar {
            position: -webkit-sticky; /* Untuk Safari */
            position: sticky;
            top: 0;
            z-index: 1050; /* Agar di atas konten lainnya */
            height: 100vh; /* Agar sidebar memiliki tinggi penuh */
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include 'sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'topbar.php'; ?>

                <div class="container-fluid content-main">
                    <?php
                    // Pastikan konten hanya muncul di dashboard
                    if (!isset($page)) {
                        include 'dashboard-content.php';
                    } elseif (file_exists($page)) {
                        include $page;
                    }
                    ?>
                </div>
            </div>
            
            <footer class="text-center mt-5">
                <p>© 2024 Copyright'an | Punya <a href="https://github.com/Jekichen" target="_blank" rel="noopener noreferrer">Jekichen</a></p>
            </footer>
        </div>
    </div>

    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../assets/js/sb-admin-2.min.js"></script>
</body>
</html>
