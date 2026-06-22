<?php 
include_once('header.php');
require_once "../config/config.php";
/** @var mysqli $con */

$id = mysqli_real_escape_string($con, @$_GET['id']);
$SqlGejala = mysqli_query($con, "SELECT * FROM gejala WHERE id_gejala = '$id'");
$row = mysqli_fetch_array($SqlGejala);
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Update Data Gejala</h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 mx-auto">
                <div class="card shadow-sm border-0">
                    <div class="card-header">
                        <h4 class="mb-0 text-primary">Form Edit Gejala</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label class="font-weight-bold">Pilih Penyakit</label>
                                <select class="custom-select form-control" name="namapenyakit" required>
                                    <?php
                                    $sql2 = mysqli_query($con, "SELECT * FROM penyakit");
                                    while ($row2 = mysqli_fetch_array($sql2)) {
                                        // Pengecekan agar penyakit yang sebelumnya dipilih otomatis "Selected"
                                        $selected = ($row2['id_penyakit'] == $row['id_penyakit']) ? 'selected' : '';
                                        echo "<option value='{$row2['id_penyakit']}' $selected>{$row2['nama_penyakit']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Gejala</label>
                                <input type="text" class="form-control" name="gejala" required value="<?= $row['nama_gejala'] ?>">
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
    $gejala       = mysqli_real_escape_string($con, $_POST['gejala']);
    $id_admin     = isset($_SESSION['id_admin']) ? $_SESSION['id_admin'] : 0;

    $update = mysqli_query($con, "UPDATE gejala SET id_admin='$id_admin', id_penyakit='$namapenyakit', nama_gejala='$gejala' WHERE id_gejala = '$id'") or die(mysqli_error($con));

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data Gejala berhasil diupdate.', showConfirmButton: false, timer: 2000 })
            .then(() => { window.location.href = 'index.php'; });
        });
    </script>";
}
include_once('footer.php'); 
?>