<?php 
include_once('header.php');
require_once "../config/config.php";
/** @var mysqli $con */
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Data Penyakit</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Daftar Penyakit (Gizi Buruk)</h4>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus mr-1"></i> Tambah Penyakit</button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover admin" id="admin">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="30%">Nama Penyakit</th>
                                        <th>Solusi Penanganan</th>
                                        <th width="15%" class="text-center">Aksi</th>
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
                                                <td><?= $row['solusi'] ?></td>
                                                <td class="text-center">
                                                    <a href="edit.php?id=<?= $row['id_penyakit'] ?>" class="btn btn-primary btn-sm mr-1" title="Edit Data">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="delete.php?id=<?= $row['id_penyakit'] ?>" class="btn btn-danger btn-sm delete-data" title="Hapus Data">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan=\"4\" align=\"center\">Belum ada data penyakit terdaftar</td></tr>";
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
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title text-primary"><i class="fas fa-plus-circle mr-2"></i>Tambah Data Penyakit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body pb-0">
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Penyakit / Status Gizi</label>
                        <input type="text" class="form-control" name="namapenyakit" required placeholder="Contoh: Marasmus">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Solusi / Penanganan</label>
                        <textarea class="form-control" name="solusi" required rows="4" placeholder="Masukkan solusi penanganan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit" name="submit">Simpan Data</button>
                </div>
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
if (isset($_POST['submit'])) {
    $namapenyakit = mysqli_real_escape_string($con, $_POST['namapenyakit']);
    $solusi       = mysqli_real_escape_string($con, $_POST['solusi']);
    
    $sql = mysqli_query($con, "SELECT * FROM penyakit WHERE nama_penyakit ='$namapenyakit'");
    if (mysqli_num_rows($sql) > 0) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({ icon: 'warning', title: 'Maaf!', text: 'Data penyakit sudah ada.', showConfirmButton: false, timer: 3000 })
                .then(() => { window.location.href = window.location.href; });
            });
        </script>";
    } else {
        mysqli_query($con, "INSERT INTO penyakit (nama_penyakit, solusi) VALUES ('$namapenyakit', '$solusi')") or die(mysqli_error($con));
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data penyakit berhasil disimpan.', showConfirmButton: false, timer: 2000 })
                .then(() => { window.location.href = window.location.href; });
            });
        </script>";
    }
}
include_once('footer.php'); 
?>

<script>
    $(document).ready(function() {
        if ($('.admin').length > 0) { $('.admin').DataTable(); }

        $('.delete-data').on('click', function(e) {
            e.preventDefault();
            var getLink = $(this).attr('href');
            Swal.fire({
                title: 'Hapus Penyakit Ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#cbd5e1',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) { window.location.href = getLink; }
            })
        });
    });
</script>