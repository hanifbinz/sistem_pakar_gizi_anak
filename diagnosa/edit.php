<?php 
include_once('header.php');
require_once "../config/config.php";
/** @var mysqli $con */

$id = mysqli_real_escape_string($con, @$_GET['id']);

// Proses Update Data
if (isset($_POST['submit'])) {
    $namakriteria = mysqli_real_escape_string($con, $_POST['namakriteria']);

    $update = mysqli_query($con, "UPDATE kriteria SET nama_kriteria='$namakriteria' WHERE id_kriteria = '$id'") or die(mysqli_error($con));

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ 
                icon: 'success', 
                title: 'Berhasil!', 
                text: 'Data Kriteria berhasil diupdate.', 
                showConfirmButton: false, 
                timer: 1500 
            }).then(() => { 
                window.location.replace('index.php'); 
            });
        });
    </script>";
}

// Ambil Data Saat Ini
$sql_kriteria = mysqli_query($con, "SELECT * FROM kriteria WHERE id_kriteria = '$id'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql_kriteria);
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Update Data Kriteria</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="index.php">Data Kriteria</a></div>
                <div class="breadcrumb-item">Update Kriteria</div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header border-bottom bg-light d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-primary">Form Edit Kriteria</h4>
                        <a href="index.php" class="btn btn-outline-secondary btn-sm" title="Kembali"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                    </div>
                    
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label class="font-weight-bold">ID Kriteria</label>
                                <input type="text" name="idkriteria" class="form-control" value="<?= htmlspecialchars($data['id_kriteria']) ?>" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Kriteria</label>
                                <input type="text" name="namakriteria" required autofocus class="form-control" value="<?= htmlspecialchars($data['nama_kriteria']) ?>">
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