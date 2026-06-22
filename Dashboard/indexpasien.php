<?php 
include_once('headerpasien.php');
require_once "../config/config.php";
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Beranda</h1>
        </div>
        
        <div class="row">
            <div class="col-12 mb-4">
                <div class="hero bg-primary text-white text-center rounded">
                    <div class="hero-inner">
                        <h2>Selamat Datang, <?= $_SESSION['usernamepasien']; ?>!</h2>
                        <p class="lead">Di Aplikasi Sistem Pakar Diagnosa Gizi Buruk Pada Balita Metode Naive Bayes.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-child"></i> 
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4 class="text-primary">GIZI BURUK</h4>
                        </div>
                        <div class="card-body mt-2 mb-3" style="font-size: 13px; line-height: 1.6; font-weight: 500;">
                            Gizi buruk adalah keadaan kekurangan konsumsi zat gizi yang disebabkan oleh rendahnya konsumsi energi protein dalam makanan sehari-hari, ditandai dengan berat dan tinggi badan tidak sesuai umur.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-brain"></i> 
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4 class="text-primary">NAIVE BAYES</h4>
                        </div>
                        <div class="card-body mt-2 mb-3" style="font-size: 13px; line-height: 1.6; font-weight: 500;">
                            Naive Bayes classifier merupakan salah satu metode pembelajaran mesin yang memanfaatkan perhitungan probabilitas dan statistik yang dikemukakan oleh ilmuwan Inggris Thomas Bayes.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-notes-medical"></i> 
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4 class="text-primary">DATA GEJALA</h4>
                        </div>
                        <div class="card-body mt-2 mb-3" style="font-size: 13px; line-height: 1.6; font-weight: 500;">
                            Gejala yang sering dialami pasien akan diproses di dalam sistem ini untuk mendeteksi dan mengetahui diagnosa tingkat gizi buruk apa yang dialami secara akurat.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-info-circle"></i> 
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4 class="text-primary">TENTANG SISTEM</h4>
                        </div>
                        <div class="card-body mt-2 mb-3" style="font-size: 13px; line-height: 1.6; font-weight: 500;">
                            Aplikasi ini dikembangkan untuk membantu tenaga medis maupun orang tua mendeteksi dini penyakit gizi buruk pada balita dengan menggunakan algoritma probabilitas pakar.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once('footer.php'); ?>