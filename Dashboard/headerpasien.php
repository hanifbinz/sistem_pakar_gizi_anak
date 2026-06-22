<?php
require_once "../config/config.php";
if (!isset($_SESSION['usernamepasien'])) {
    echo "<script>window.location='" . base_url('') . "';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Sistem Pakar - Pasien</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link rel="stylesheet" href="<?= base_url() ?>/asset/node_modules/bootstrap-social/bootstrap-social.css">
    <link href="../asset/datatable/css/datatables.css" rel="stylesheet" type="text/css">
    <link href="../asset/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?= base_url() ?>/asset/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/asset/assets/css/components.css">

    <style>
        :root { --primary: #007bff; }
        .bg-primary { background-color: #007bff !important; }
        .text-primary, .text-primary:hover { color: #007bff !important; }
        .navbar-bg { background-color: #007bff !important; height: 115px; }
        .btn-primary { background-color: #007bff !important; border-color: #007bff !important; }
        .btn-primary:hover { background-color: #0056b3 !important; border-color: #0056b3 !important; }
        
        /* Sidebar Active */
        .main-sidebar .sidebar-menu li.active a { color: #007bff !important; font-weight: 600; }
        .main-sidebar .sidebar-menu li.active a i { color: #007bff !important; }
        .main-sidebar .sidebar-menu li.active a:before { background-color: #007bff !important; }
        
        /* PERBAIKAN: Efek Hover saat kursor menunjuk ke menu Sidebar */
        .main-sidebar .sidebar-menu li a:hover {
            background-color: rgba(0, 123, 255, 0.1) !important;
            color: #007bff !important;
            border-radius: 3px;
        }
        .main-sidebar .sidebar-menu li a:hover i { color: #007bff !important; }

        .card .card-header h4 { color: #007bff !important; font-weight: bold; }
        .app-brand-text { font-size: 20px; font-weight: bold; color: white; margin-left: 15px; letter-spacing: 1px; }
        @media (max-width: 768px) { .app-brand-text { display: none; } }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            
            <div class="navbar-bg bg-primary"></div>
            
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                    <span class="app-brand-text">SISTEM PAKAR GIZI BURUK</span>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['usernamepasien']); ?>&background=ffffff&color=007bff" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Halo, <?= $_SESSION['usernamepasien']; ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Menu Akun</div>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('auth/logout.php') ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="indexpasien.php">SP GIZI BURUK</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="indexpasien.php">SP</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Menu Utama</li>
                        <li class="active"><a class="nav-link" href="../Dashboard/indexpasien.php"><i class="fas fa-home"></i> <span>Home</span></a></li>
                        <li><a class="nav-link" href="../pasien/indexpasien.php"><i class="fas fa-user"></i> <span>Profil Saya</span></a></li>
                        <li><a class="nav-link" href="../penyakit/indexpasien.php"><i class="fas fa-thermometer-half"></i> <span>Info Penyakit</span></a></li>
                        <li><a class="nav-link" href="../gejala/indexpasien.php"><i class="fas fa-notes-medical"></i> <span>Info Gejala</span></a></li>
                        <li class="menu-header">Diagnosa</li>
                        <li><a class="nav-link" href="../diagnosa/indexpasien.php"><i class="fas fa-stethoscope"></i> <span>Mulai Diagnosa</span></a></li>
                        <li><a class="nav-link" href="../hasil/indexpasien.php"><i class="fas fa-file-medical-alt"></i> <span>Riwayat Hasil</span></a></li>
                    </ul>
                </aside>
            </div>