<?php 
include_once('headerpasien.php');
require_once "../config/config.php";
/** @var mysqli $con */
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Informasi Gejala Penyakit</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header border-bottom">
                        <h4 class="mb-0 text-primary">Daftar Indikasi Gejala Gizi Buruk</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover admin" id="admin">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="30%">Jenis Penyakit / Status Gizi</th>
                                        <th>Nama Gejala</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SqlQuery = mysqli_query($con, "SELECT gejala.*, penyakit.nama_penyakit FROM gejala INNER JOIN penyakit ON gejala.id_penyakit = penyakit.id_penyakit");
                                    $no = 1;
                                    if (mysqli_num_rows($SqlQuery) > 0) {
                                        while ($row = mysqli_fetch_array($SqlQuery)) {
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td class="font-weight-bold text-primary"><?= $row['nama_penyakit'] ?></td>
                                                <td><?= $row['nama_gejala'] ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan=\"3\" align=\"center\">Belum ada data informasi gejala</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once('footer.php'); ?>

<script>
    // DataTable akan berjalan otomatis karena library sudah dipanggil di footer.php
    $(document).ready(function() {
        if ($('.admin').length > 0) { 
            $('.admin').DataTable(); 
        }
    });
</script>