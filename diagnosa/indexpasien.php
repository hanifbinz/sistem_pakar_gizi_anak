<?php 
include_once('headerpasien.php');
require_once "../config/config.php";
/** @var mysqli $con */
$id_pasien = isset($_SESSION['id_pasien']) ? $_SESSION['id_pasien'] : 0;
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Halaman Diagnosa</h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 mx-auto">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom">
                        <h4 class="text-primary"><i class="fas fa-stethoscope mr-2"></i>Mulai Diagnosa Gizi Buruk</h4>
                    </div>
                    <div class="card-body">
                        <form action="hasildiagnosapasien.php" method="POST">
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Pasien</label>
                                <select class="custom-select form-control" name="namapasien" required>
                                    <?php
                                    $sql2 = mysqli_query($con, "SELECT * FROM pasien WHERE id_pasien = '$id_pasien'");
                                    if(mysqli_num_rows($sql2) > 0) {
                                        $row2 = mysqli_fetch_array($sql2);
                                        echo "<option value='{$row2['nama_pasien']}' selected>{$row2['nama_pasien']}</option>";
                                    } else {
                                        echo "<option value='' disabled selected>Data Pasien Tidak Ditemukan</option>";
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
                                <label class="font-weight-bold">Pilih Gejala Yang Dialami Anak</label>
                                <div class="border p-3 rounded bg-light" style="max-height: 300px; overflow-y: auto;">
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM gejala");
                                    if(mysqli_num_rows($sql) > 0){
                                        while ($data = mysqli_fetch_array($sql)) {
                                    ?>
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" class="custom-control-input" id="gejala_<?= $data['id_gejala'] ?>" name="gejala[]" value="<?= $data['id_gejala'] ?>">
                                                <label class="custom-control-label" style="cursor:pointer; line-height: 24px;" for="gejala_<?= $data['id_gejala'] ?>">
                                                    <?= $data['nama_gejala'] ?>
                                                </label>
                                            </div>
                                    <?php
                                        }
                                    } else {
                                        echo "<span class='text-danger'>Data gejala belum tersedia.</span>";
                                    }
                                    ?>
                                </div>
                                <small class="text-muted italic">* Centang gejala yang sesuai dengan kondisi anak.</small>
                            </div>
                            
                            <div class="text-right mt-4">
                                <button class="btn btn-primary btn-lg px-4" type="submit" name="submit">
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