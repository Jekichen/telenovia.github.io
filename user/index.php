<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
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
        /* Wrapper */
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

        /* Sticky Sidebar */
        #accordionSidebar {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            z-index: 1050;
            height: 100vh;
        }

        /* Carousel */
        #carouselExample {
        margin-top: 20px;
        z-index: 1;
        }

        .carousel-inner img {
            width: 100%;
            max-height: calc(100vh - 160px);
            object-fit: cover;
        }

        .carousel-caption h5, .carousel-caption p {
            color: white;
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