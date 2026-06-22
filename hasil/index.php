<?php 
include_once('header.php');
require_once "../config/config.php";
/** @var mysqli $con */
// PROSES SIMPAN HASIL DIAGNOSA
if (isset($_GET['tambah'])) {
    $namapasien = mysqli_real_escape_string($con, $_GET['pasien']);
    $jk = mysqli_real_escape_string($con, $_GET['jk']);
    $penyakit = mysqli_real_escape_string($con, $_GET['penyakit']);

    $sql = mysqli_query($con, "SELECT * FROM `nilai_akhir` INNER JOIN penyakit as p ON nilai_akhir.id_penyakit=P.id_penyakit ORDER BY nilai_akhir DESC LIMIT 1");
    $row = mysqli_fetch_array($sql);
    
    $id = isset($row['id_penyakit']) ? $row['id_penyakit'] : 0;

    $save = mysqli_query($con, "INSERT INTO hasil (id_penyakit, namapasien, jeniskelamin, hasildiagnosa) VALUES ('$id', '$namapasien', '$jk', '$penyakit' )") or die(mysqli_error($con));

    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ 
                title: 'Sukses!', 
                text: 'Data Riwayat Diagnosa atas nama $namapasien berhasil disimpan.', 
                icon: 'success',
                timer: 2000,
                showConfirmButton: false 
            }).then(() => { 
                window.location.href = 'index.php'; 
            });
        });
    </script>";
}
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Riwayat Hasil Diagnosa</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Daftar Hasil Diagnosa Pasien</h4>
                        <a href="cetak.php" target="_blank" class="btn btn-success"><i class="fas fa-print mr-1"></i> Cetak Laporan</a>
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
                                        <th width="10%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SqlQuery = mysqli_query($con, "SELECT * FROM hasil ORDER BY id_hasil DESC");
                                    $no = 1;
                                    if (mysqli_num_rows($SqlQuery) > 0) {
                                        while ($row = mysqli_fetch_array($SqlQuery)) {
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td class="font-weight-bold text-primary"><?= $row['namapasien'] ?></td>
                                                <td><?= $row['jeniskelamin'] ?></td>
                                                <td>
                                                    <?php 
                                                    if($row['hasildiagnosa'] == 'Tidak Terjangkit' || $row['hasildiagnosa'] == 'Tidak Terdeteksi Gizi Buruk') {
                                                        echo "<span class='badge badge-success'>{$row['hasildiagnosa']}</span>";
                                                    } else {
                                                        echo "<span class='badge badge-danger'>{$row['hasildiagnosa']}</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="delete.php?id=<?= $row['id_hasil'] ?>" class="btn btn-danger btn-sm delete-data" title="Hapus Data"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan=\"5\" align=\"center\">Belum ada data hasil diagnosa</td></tr>";
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        if ($('.admin').length > 0) { $('.admin').DataTable(); }

        $('.delete-data').on('click', function(e) {
            e.preventDefault();
            var getLink = $(this).attr('href');
            Swal.fire({
                title: 'Hapus Hasil Ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#cbd5e1',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) { window.location.href = getLink; }
            });
        });
    });
</script>

<?php include_once('footer.php'); ?>