<?php 
include_once('headerpasien.php');
require_once "../config/config.php";
/** @var mysqli $con */

// Validasi jika gejala kosong
if (isset($_POST['submit']) && empty($_POST['gejala'])) {
    echo "<script>alert('Harap pilih minimal satu gejala!'); window.location.replace('indexpasien.php');</script>";
    exit;
}

if (isset($_POST['submit'])) {
    // Kosongkan tabel perhitungan sementara
    mysqli_query($con, "DELETE FROM nilai");
    mysqli_query($con, "DELETE FROM nilai_akhir");

    // Rumus probabilitas awal
    $Sqlpenyakit = mysqli_query($con, "SELECT * FROM penyakit");
    $rowpenyakit = mysqli_num_rows($Sqlpenyakit);
    $p = ($rowpenyakit > 0) ? (1 / $rowpenyakit) : 0;
    $hasilp = round($p, 6);

    $m = 24; 
    $rumus = $m * $hasilp;

    $SqlQuery = mysqli_query($con, "SELECT * FROM penyakit");
    while ($row = mysqli_fetch_array($SqlQuery)) {
        $id = $row['id_penyakit'];
        
        foreach ($_POST['gejala'] as $id_gejala_dipilih) {
            $nilaigejala = 0;
            $Sqlpenyakit1 = mysqli_query($con, "SELECT gejala.id_gejala FROM gejala INNER JOIN penyakit p ON gejala.id_penyakit=p.id_penyakit WHERE p.id_penyakit='$id'");
            while ($rowgejala = mysqli_fetch_array($Sqlpenyakit1)) {
                // PERBAIKAN PENTING: Mencocokkan berdasarkan ID Gejala
                if ($id_gejala_dipilih == $rowgejala['id_gejala']) {
                    $nilaigejala = 1;
                    break;
                }
            }
            $rumusgejala1 = round($rumus) + $nilaigejala;
            $rumusgejala = $m + 1;
            $hasiladagejala = $rumusgejala1 / $rumusgejala;

            mysqli_query($con, "INSERT INTO nilai (id_penyakit, nilai) VALUES ('$id', '$hasiladagejala')") or die(mysqli_error($con));
        }

        $Sqlnilai = mysqli_query($con, "SELECT * FROM nilai WHERE id_penyakit='$id'");
        $kali = 1;
        if(mysqli_num_rows($Sqlnilai) > 0){
            while ($rowgejala = mysqli_fetch_array($Sqlnilai)) {
                $kali *= $rowgejala['nilai'];
            }
        } else {
            $kali = 0;
        }
        $hasilakhir = $kali * 0.333333; 
        mysqli_query($con, "INSERT INTO nilai_akhir (id_penyakit, nilai_akhir) VALUES ('$id', '$hasilakhir')") or die(mysqli_error($con));
    }
}
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Hasil Diagnosa Anak Anda</h1>
        </div>

        <div class="row">
            <?php
            $SqlFinal = mysqli_query($con, "SELECT p.nama_penyakit, p.solusi, n.nilai_akhir FROM nilai_akhir n INNER JOIN penyakit p ON n.id_penyakit = p.id_penyakit ORDER BY n.nilai_akhir DESC LIMIT 1");
            $rowFinal = mysqli_fetch_array($SqlFinal);
            $penyakitTerdeteksi = !empty($rowFinal['nilai_akhir']) ? $rowFinal['nama_penyakit'] : "Tidak Terdeteksi Gizi Buruk";
            $solusiTerdeteksi = !empty($rowFinal['nilai_akhir']) ? $rowFinal['solusi'] : "Jaga pola makan dan selalu konsultasi ke dokter jika ada keluhan.";
            $nilaiAkhir = !empty($rowFinal['nilai_akhir']) ? $rowFinal['nilai_akhir'] : "0";
            
            $namapasien = mysqli_real_escape_string($con, $_POST['namapasien']);
            $jk = mysqli_real_escape_string($con, $_POST['jk']);
            ?>
            <div class="col-12">
                <div class="card bg-primary text-white text-center shadow-sm">
                    <div class="card-body">
                        <h5>Kemungkinan Terbesar Anak Anda Mengalami:</h5>
                        <h2 class="font-weight-bold text-warning"><?= htmlspecialchars($penyakitTerdeteksi) ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header border-bottom">
                        <h4 class="text-primary">Detail Data Diagnosa</h4>
                    </div>
                    <div class="card-body">
                        <form action="../hasil/indexpasien.php" method="GET">
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Pasien</label>
                                <input type="text" class="form-control" name="pasien" value="<?= htmlspecialchars($namapasien) ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jenis Kelamin</label>
                                <input type="text" class="form-control" name="jk" value="<?= htmlspecialchars($jk) ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Hasil Nilai Kalkulasi</label>
                                <input type="text" class="form-control" name="nilai_akhir" value="<?= htmlspecialchars($nilaiAkhir) ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Penyakit Terdeteksi</label>
                                <input type="text" class="form-control" name="penyakit" value="<?= htmlspecialchars($penyakitTerdeteksi) ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Gejala yang Dipilih</label>
                                <div class="bg-light p-3 rounded border">
                                    <?php
                                    $no = 1;
                                    foreach ($_POST['gejala'] as $id_gejala) {
                                        // QUERY UNTUK MENGAMBIL NAMA GEJALA BERDASARKAN ID
                                        $id_gejala_safe = mysqli_real_escape_string($con, $id_gejala);
                                        $q_nama = mysqli_query($con, "SELECT nama_gejala FROM gejala WHERE id_gejala = '$id_gejala_safe'");
                                        if($d_nama = mysqli_fetch_array($q_nama)){
                                            echo "<div class='mb-1'>{$no}. {$d_nama['nama_gejala']}</div>";
                                            $no++;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="text-right mt-4">
                                <button class="btn btn-success btn-lg" type="submit" name="tambah"><i class="fas fa-save mr-1"></i> Simpan ke Riwayat Saya</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header border-bottom">
                        <h4 class="text-primary">Informasi Penanganan & Solusi</h4>
                    </div>
                    <div class="card-body text-center">
                        <?php if ($penyakitTerdeteksi == 'Kwarshiorkor') { ?>
                            <img class="img-fluid rounded shadow-sm mb-3" src="<?= base_url() ?>/img/slide2.jpg" style="max-height: 250px; object-fit:cover;">
                        <?php } else if ($penyakitTerdeteksi == 'Marasmik-Kwarshiorkor') { ?>
                            <img class="img-fluid rounded shadow-sm mb-3" src="<?= base_url() ?>/img/slide3.jpg" style="max-height: 250px; object-fit:cover;">
                        <?php } else if (!empty($rowFinal['nilai_akhir'])) { ?>
                            <img class="img-fluid rounded shadow-sm mb-3" src="<?= base_url() ?>/img/slide1.jpg" style="max-height: 250px; object-fit:cover;">
                        <?php } ?>
                        
                        <div class="alert alert-warning text-left mt-3">
                            <strong>Solusi Medis:</strong><br>
                            <?= nl2br(htmlspecialchars($solusiTerdeteksi)) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once('footer.php'); ?>