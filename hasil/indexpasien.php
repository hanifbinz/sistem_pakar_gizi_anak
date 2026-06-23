<?php 
include_once('headerpasien.php');
require_once "../config/config.php";
/** @var mysqli $con */
$username_pasien = isset($_SESSION['usernamepasien']) ? $_SESSION['usernamepasien'] : '';

// PROSES SIMPAN HASIL DIAGNOSA
if (isset($_GET['tambah'])) {
    $namapasien = mysqli_real_escape_string($con, $_GET['pasien']);
    $jk = mysqli_real_escape_string($con, $_GET['jk']);
    $penyakit = mysqli_real_escape_string($con, $_GET['penyakit']);

    $sql = mysqli_query($con, "SELECT * FROM `nilai_akhir` INNER JOIN penyakit as p ON nilai_akhir.id_penyakit=p.id_penyakit ORDER BY nilai_akhir DESC LIMIT 1");
    $row = mysqli_fetch_array($sql);
    $id = isset($row['id_penyakit']) ? $row['id_penyakit'] : 0;

    mysqli_query($con, "INSERT INTO hasil (id_penyakit, namapasien, jeniskelamin, hasildiagnosa) VALUES ('$id', '$namapasien', '$jk', '$penyakit')") or die(mysqli_error($con));

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ 
                title: 'Sukses!', 
                text: 'Riwayat Diagnosa berhasil disimpan.', 
                icon: 'success', 
                timer: 2000, 
                showConfirmButton: false 
            }).then(() => { 
                window.location.replace('indexpasien.php'); 
            });
        });
    </script>";
}
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Riwayat Diagnosa Anak</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header border-bottom">
                        <h4 class="mb-0 text-primary">Daftar Riwayat Pemeriksaan Saya</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover admin" id="admin">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Pasien</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Penyakit Terdeteksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $safe_username = mysqli_real_escape_string($con, $username_pasien);
                                    $SqlQuery = mysqli_query($con, "SELECT * FROM hasil WHERE namapasien = '$safe_username' ORDER BY id_hasil DESC");
                                    $no = 1;
                                    if (mysqli_num_rows($SqlQuery) > 0) {
                                        while ($row = mysqli_fetch_array($SqlQuery)) {
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td class="font-weight-bold text-dark"><?= htmlspecialchars($row['namapasien']) ?></td>
                                                <td><?= htmlspecialchars($row['jeniskelamin']) ?></td>
                                                <td>
                                                    <?php 
                                                    if($row['hasildiagnosa'] == 'Tidak Terjangkit' || $row['hasildiagnosa'] == 'Tidak Terdeteksi Gizi Buruk') {
                                                        echo "<span class='badge badge-success'>{$row['hasildiagnosa']}</span>";
                                                    } else {
                                                        echo "<span class='badge badge-danger'>{$row['hasildiagnosa']}</span>";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan=\"4\" align=\"center\">Belum ada riwayat diagnosa yang Anda simpan.</td></tr>";
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
        if ($('.admin').length > 0) { $('.admin').DataTable(); }
    });
</script>