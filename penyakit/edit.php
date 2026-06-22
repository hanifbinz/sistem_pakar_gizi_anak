<?php 
include_once('header.php');
require_once "../config/config.php";
/** @var mysqli $con */

$id = mysqli_real_escape_string($con, @$_GET['id']);
$SqlQuery = mysqli_query($con, "SELECT * FROM penyakit WHERE id_penyakit = '$id'");
$row = mysqli_fetch_array($SqlQuery);
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Update Data Penyakit</h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 mx-auto">
                <div class="card shadow-sm border-0">
                    <div class="card-header">
                        <h4 class="mb-0 text-primary">Form Edit Penyakit</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Penyakit</label>
                                <input type="text" class="form-control" name="namapenyakit" required value="<?= $row['nama_penyakit'] ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Solusi / Penanganan</label>
                                <textarea class="form-control" name="solusi" required rows="5" style="height:100%;"><?= $row['solusi'] ?></textarea>
                            </div>
                            <div class="text-right mt-4">
                                <a href="index.php" class="btn btn-secondary mr-2">Batal</a>
                                <button class="btn btn-primary" type="submit" name="submit">Update Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (isset($_POST['submit'])) {
    $namapenyakit = mysqli_real_escape_string($con, $_POST['namapenyakit']);
    $solusi       = mysqli_real_escape_string($con, $_POST['solusi']);

    $update = mysqli_query($con, "UPDATE penyakit SET nama_penyakit='$namapenyakit', solusi='$solusi' WHERE id_penyakit = '$id'") or die(mysqli_error($con));

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data berhasil diupdate.', showConfirmButton: false, timer: 2000 })
            .then(() => { window.location.href = 'index.php'; });
        });
    </script>";
}
include_once('footer.php'); 
?>