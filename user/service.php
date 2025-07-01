<?php
include '../assets/conn/config.php';
$page = 'service-content.php';

echo '<style>
    .btn-whatsapp {
        background-color: #25D366 !important; /* Warna hijau khas WhatsApp */
        border: none;
        color: white !important;
    }
    .btn-whatsapp i {
        color: white;
    }

    .btn-email {
        background-color: #007BFF !important; /* Warna biru email (umum) */
        border: none;
        color: white !important;
    }
    .btn-email i {
        color: white;
    }

    .btn-github {
        background-color: #181717 !important; /* Warna hitam khas GitHub */
        border: none;
        color: white !important;
    }
    .btn-github i {
        color: white;
    }

    .btn-instagram {
        background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888) !important; /* Gradien khas Instagram */
        border: none;
        color: white !important;
    }
    .btn-instagram i {
        color: white;
    }
    .btn-instagram:hover {
        opacity: 0.9;
    }

    .btn-facebook {
        background-color: #1877F2 !important; /* Warna biru khas Facebook */
        border: none;
        color: white !important;
    }
    .btn-facebook i {
        color: white;
    }

</style>';

include 'index.php';
?>