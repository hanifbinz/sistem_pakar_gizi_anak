<?php 
include_once('header.php');
require_once "../config/config.php";
/** @var mysqli $con */
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Halaman Diagnosa</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 mx-auto">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom">
                        <h4 class="text-primary"><i class="fas fa-stethoscope mr-2"></i>Form Diagnosa Gizi Buruk</h4>
                    </div>
                    <div class="card-body">
                        <form action="hasildiagnosa.php" method="POST">
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Pasien</label>
                                <select class="custom-select form-control" name="namapasien" required>
                                    <option value="" disabled selected>-- Pilih Pasien --</option>
                                    <?php
                                    $sql2 = mysqli_query($con, "SELECT * FROM pasien");
                                    while ($row2 = mysqli_fetch_array($sql2)) {
                                        echo "<option value='{$row2['nama_pasien']}'>{$row2['nama_pasien']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jenis Kelamin</label>
                                <select class="custom-select form-control" name="jk" required>
                                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Pilih Gejala Yang Dialami</label>
                                <div class="border p-3 rounded" style="max-height: 300px; overflow-y: auto;">
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM gejala");
                                    if(mysqli_num_rows($sql) > 0){
                                        while ($data = mysqli_fetch_array($sql)) {
                                    ?>
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" id="gejala_<?= $data['id_gejala'] ?>" name="gejala[]" value="<?= $data['nama_gejala'] ?>">
                                            <label class="custom-control-label" style="line-height: 24px;" for="gejala_<?= $data['id_gejala'] ?>"><?= $data['nama_gejala'] ?></label>
                                        </div>
                                    <?php
                                        }
                                    } else {
                                        echo "<span class='text-danger'>Data gejala belum tersedia.</span>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="text-right mt-4">
                                <button class="btn btn-primary btn-lg" type="submit" name="submit">
                                    <i class="fas fa-search-plus mr-1"></i> Proses Diagnosa
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once('footer.php'); ?>