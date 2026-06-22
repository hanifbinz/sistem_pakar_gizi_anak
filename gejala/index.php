<?php 
include_once('header.php');
require_once "../config/config.php";
/** @var mysqli $con */
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Data Gejala</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-primary">Daftar Gejala Penyakit</h4>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus mr-1"></i> Tambah Gejala</button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover admin" id="admin">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="30%">Nama Penyakit</th>
                                        <th>Nama Gejala</th>
                                        <th width="15%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SqlQuery = mysqli_query($con, "SELECT gejala.*, penyakit.nama_penyakit FROM gejala INNER JOIN penyakit ON gejala.id_penyakit = penyakit.id_penyakit");
                                    $no = 1;
                                    while ($row = mysqli_fetch_array($SqlQuery)) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td class="font-weight-bold text-primary"><?= $row['nama_penyakit'] ?></td>
                                            <td><?= $row['nama_gejala'] ?></td>
                                            <td class="text-center">
                                                <a href="edit.php?id=<?= $row['id_gejala'] ?>" class="btn btn-primary btn-sm mr-1" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                <a href="delete.php?id=<?= $row['id_gejala'] ?>" class="btn btn-danger btn-sm delete-data" title="Hapus Data"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
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
            <div class="modal-header border-bottom"><h5 class="modal-title text-primary">Tambah Data Gejala</h5></div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Penyakit</label>
                        <select class="custom-select" name="namapenyakit" required>
                            <option value="">-- Pilih Penyakit --</option>
                            <?php
                            $sqlP = mysqli_query($con, "SELECT * FROM penyakit");
                            while ($p = mysqli_fetch_array($sqlP)) {
                                echo "<option value='{$p['id_penyakit']}'>{$p['nama_penyakit']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Gejala</label>
                        <input type="text" class="form-control" name="gejala" required>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
if (isset($_POST['submit'])) {
    $penyakit = $_POST['namapenyakit'];
    $gejala = mysqli_real_escape_string($con, $_POST['gejala']);
    $id_admin = $_SESSION['id_admin'] ?? 0;
    mysqli_query($con, "INSERT INTO gejala (id_admin, id_penyakit, nama_gejala) VALUES ('$id_admin', '$penyakit', '$gejala')");
    echo "<script>window.location.replace('index.php');</script>";
}
include_once('footer.php'); 
?>

<script>
    $(document).ready(function() { $('.admin').DataTable(); });
    $('.delete-data').on('click', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        Swal.fire({ title: 'Hapus Gejala?', icon: 'warning', showCancelButton: true, confirmButtonColor: '#dc3545', confirmButtonText: 'Ya, Hapus!' })
        .then((result) => { if (result.isConfirmed) window.location.href = link; });
    });
</script>