<?php
require_once "../config/config.php";
if (!isset($_SESSION['username'])) {
    echo "<script>window.location='" . base_url('') . "';</script>";
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>Sistem Pakar</title>

        <!-- General CSS Files -->
        <link rel="stylesheet" href="<?= base_url() ?>/asset/node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>/asset/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
        <!-- CSS Libraries -->
        <link rel="stylesheet" href="<?= base_url() ?>/asset/node_modules/bootstrap-social/bootstrap-social.css">

        <!-- Template CSS -->
        <link href="../asset/datatable/css/datatables.css" rel="stylesheet" type="text/css">
        <link href="../asset/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?= base_url() ?>/asset/assets/css/style.css">
        <link rel="stylesheet" href="<?= base_url() ?>/asset/assets/css/components.css">
    </head>

    <body>
        <div id="app">
            <div class="main-wrapper  main-wrapper-1">
                <div class="navbar-bg bg-primary">
                    <center>
                        <div class="mt-3 text-white text-center">
                            <h4>Diagnosa Gizi Buruk</h4>
                        </div>
                    </center>


                </div>
                <nav class="navbar navbar-expand-lg main-navbar">
                    <form class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>

                        </ul>


                    </form>
                    <ul class="navbar-nav navbar-right">

                        <li class="dropdown dropdown-list-toggle">
                        </li>
                        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img alt="image" src="<?= base_url() ?>/asset/assets/img/avatar_0.png" class="rounded-circle mr-1">

                                <div class="d-sm-none d-lg-inline-block">Selamat Datang, <?= $_SESSION['username']; ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">


                                <div class="dropdown-divider"></div>
                                <a href="<?= base_url('auth/logout.php') ?>" class="dropdown-item has-icon text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="main-sidebar">

                    <aside id="sidebar-wrapper">
                        <!-- <div class="sidebar-brand">
                            <a href="index.html">SPK BANTUAN WARGA</a>
                        </div> -->
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="index.php">SP</a>
                        </div>
                        <ul class="sidebar-menu">
                            <li>
                                <div class="sidebar-brand">

                                    <a href="index.php">Sistem Pakar</a>
                                </div>

                            </li>
                            <li><a class="nav-link" href="../Dashboard/index.php"><i class="fas fa-home"></i> <span>Home</span></a></li>
                            </li>
                            <li><a class="nav-link" href="../pasien/index.php"><i class="fas fa-procedures"></i><span>Pasien</span></a></li>

                            <li class="active"><a class="nav-link" href="../penyakit/index.php"><i class="fa fa-thermometer-empty" aria-hidden="true"></i><span>Penyakit</span></a></li>
                            <li><a class="nav-link" href="../gejala/index.php"><i class="fas fa-procedures"></i><span>Gejala</span></a></li>
                            <li><a class="nav-link" href="../diagnosa/index.php"><i class="fas fa-stethoscope"></i><span>Diagnosa</span></a></li>
                            <li><a class="nav-link" href="../hasil/index.php"><i class="fas fa-notes-medical"></i></i><span>Hasil</span></a></li>
                            <li><a class="nav-link" href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i></i><span>Keluar</span></a></li>

                    </aside>
                </div>



                <!-- General JS Scripts -->
                <script src="<?= base_url() ?>/asset/node_modules/jquery/dist/jquery.min.js"></script>
                <script src="<?= base_url() ?>/asset/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
                <script src="<?= base_url() ?>/asset/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
                <script src="<?= base_url() ?>/asset/assets/js/stisla.js"></script>

                <!-- Template JS File -->
                <script src="../asset/datatable/js/datatables.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
                <script src="../asset/sweetalert/sweetalert.min.js"></script>
                <script src="<?= base_url() ?>/asset/assets/js/scripts.js"></script>
                <script src="<?= base_url() ?>/asset/assets/js/custom.js"></script>

                <script type="text/javascript" src="<?= base_url() ?>/asset/assets/chartjs/Chart.js"></script>
                <!-- Page Specific JS File -->

    </html>
<?php
}
