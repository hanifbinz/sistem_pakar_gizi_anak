<?php 
include_once('headerpasien.php');
require_once "../config/config.php";
/** @var mysqli $con */
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Informasi Penyakit Gizi Buruk</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header border-bottom">
                        <h4 class="mb-0 text-primary">Daftar Referensi Penyakit & Solusi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover admin" id="admin">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="30%">Nama Penyakit / Status Gizi</th>
                                        <th>Solusi Penanganan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SqlQuery = mysqli_query($con, "SELECT * FROM penyakit");
                                    $no = 1;
                                    if (mysqli_num_rows($SqlQuery) > 0) {
                                        while ($row = mysqli_fetch_array($SqlQuery)) {
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td class="font-weight-bold text-dark"><?= $row['nama_penyakit'] ?></td>
                                                <td><?= nl2br($row['solusi']) ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan=\"3\" align=\"center\">Belum ada data informasi penyakit</td></tr>";
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
    $(document).ready(function() {
        // Inisialisasi DataTable setelah dokumen siap
        if ($('.admin').length > 0) { 
            $('.admin').DataTable(); 
        }
    });
</script>