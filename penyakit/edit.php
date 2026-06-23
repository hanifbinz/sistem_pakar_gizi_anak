<?php 
include_once('header.php');
require_once "../config/config.php";
/** @var mysqli $con */

$id = mysqli_real_escape_string($con, @$_GET['id']);

if (isset($_POST['submit'])) {
    $namapenyakit = mysqli_real_escape_string($con, $_POST['namapenyakit']);
    $solusi       = mysqli_real_escape_string($con, $_POST['solusi']);

    $update = mysqli_query($con, "UPDATE penyakit SET nama_penyakit='$namapenyakit', solusi='$solusi' WHERE id_penyakit = '$id'") or die(mysqli_error($con));

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data penyakit berhasil diupdate.', showConfirmButton: false, timer: 1500 })
            .then(() => { window.location.replace('index.php'); });
        });
    </script>";
}

$SqlQuery = mysqli_query($con, "SELECT * FROM penyakit WHERE id_penyakit = '$id'");
$row = mysqli_fetch_array($SqlQuery);
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Update Data Penyakit</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header border-bottom bg-light d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-primary">Form Edit Penyakit</h4>
                        <a href="index.php" class="btn btn-outline-secondary btn-sm" title="Kembali"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Penyakit / Status Gizi</label>
                                <input type="text" class="form-control" name="namapenyakit" required value="<?= htmlspecialchars($row['nama_penyakit']) ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Solusi / Penanganan</label>
                                <textarea class="form-control" name="solusi" required rows="6" style="height:100%;"><?= htmlspecialchars($row['solusi']) ?></textarea>
                            </div>
                            <div class="text-right mt-4 pt-3 border-top">
                                <button class="btn btn-secondary mr-2" type="reset">Reset</button>
                                <button class="btn btn-primary px-4" type="submit" name="submit">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once('footer.php'); ?>