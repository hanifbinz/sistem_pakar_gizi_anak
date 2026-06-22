<?php 
// 1. Panggil header hanya SEKALI
include_once('header.php');
require_once "../config/config.php";
/** @var mysqli $con */
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Data Pasien</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Daftar Akun Pasien</h4>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus mr-1"></i> Tambah Pasien</button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover admin" id="admin">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Pasien</th>
                                        <th>Username</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Usia (Tahun)</th>
                                        <th width="15%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SqlQuery = mysqli_query($con, "SELECT * From pasien");
                                    $no = 1;
                                    if (mysqli_num_rows($SqlQuery) > 0) {
                                        while ($row = mysqli_fetch_array($SqlQuery)) {
                                            ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td class='font-weight-bold text-dark'><?= $row['nama_pasien'] ?></td>
                                                <td><span class='badge badge-light border'><?= $row['usernameuser'] ?></span></td>
                                                <td><?= $row['jk'] ?></td>
                                                <td><?= $row['usia'] ?></td>
                                                <td class='text-center'>
                                                    <a href='edit.php?id=<?= $row['id_pasien'] ?>' class='btn btn-primary btn-sm mr-1'><i class='fas fa-pencil-alt'></i></a>
                                                    <a href='delete.php?id=<?= $row['id_pasien'] ?>' class='btn btn-danger btn-sm delete-data'><i class='fas fa-trash'></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' align='center'>Belum ada data pasien terdaftar</td></tr>";
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header"><h5 class="modal-title">Tambah Data Pasien</h5></div>
                <div class="modal-body">
                    <div class="form-group"><label>Nama Pasien</label><input type="text" class="form-control" name="namapasien" required></div>
                    <div class="form-group"><label>Jenis Kelamin</label>
                        <select class="form-control" name="jk" required>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Usia (Tahun)</label><input type="number" class="form-control" name="usia" required></div>
                    <div class="form-group"><label>Username</label><input type="text" class="form-control" name="username" required></div>
                    <div class="form-group"><label>Password</label><input type="password" class="form-control" name="password" required></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button><button class="btn btn-primary" type="submit" name="submit">Simpan</button></div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<?php
// Proses Input
if (isset($_POST['submit'])) {
    $namapasien = mysqli_real_escape_string($con, $_POST['namapasien']);
    $idadmin    = $_SESSION['id_admin'] ?? 0;
    $usia       = mysqli_real_escape_string($con, $_POST['usia']);
    $jk         = mysqli_real_escape_string($con, $_POST['jk']);
    $password   = mysqli_real_escape_string($con, $_POST['password']);
    $username   = mysqli_real_escape_string($con, $_POST['username']);
    
    $check = mysqli_query($con, "SELECT * FROM pasien WHERE nama_pasien = '$namapasien'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({ icon: 'warning', title: 'Maaf!', text: 'Data pasien sudah ada.' });
            });
        </script>";
    } else {
        mysqli_query($con, "INSERT INTO pasien VALUES ('', '$idadmin', '$namapasien', '$username', '$jk', '$usia Tahun', '$password')");
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data pasien berhasil disimpan.' })
                .then(() => { window.location.href = window.location.href; });
            });
        </script>";
    }
}

// 2. Panggil footer SEKALI di akhir
include_once('footer.php'); 
?>

<script>
    $(document).ready(function() {
        if ($('.admin').length > 0) { $('.admin').DataTable(); }

        $('.delete-data').on('click', function(e) {
            e.preventDefault();
            var getLink = $(this).attr('href');
            Swal.fire({
                title: 'Hapus Pasien Ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) { window.location.href = getLink; }
            })
        });
    });
</script>