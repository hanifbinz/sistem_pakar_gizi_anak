<?php 
include_once('header.php');
require_once "../config/config.php";
/** @var mysqli $con */

$id = @$_GET['id'];

if (isset($_POST['submit'])) {
    $namapasien = mysqli_real_escape_string($con, $_POST['namapasien']);
    $usia = mysqli_real_escape_string($con, $_POST['usia']);
    $jk = mysqli_real_escape_string($con, $_POST['jk']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $username = mysqli_real_escape_string($con, $_POST['username']);

    $update1 = mysqli_query($con, "UPDATE pasien set nama_pasien ='$namapasien', usernameuser='$username', jk='$jk', usia='$usia', password_user='$password' WHERE id_pasien = '$id'") or die(mysqli_error($con));

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data pasien berhasil diupdate.', showConfirmButton: false, timer: 1500 })
            .then(() => { window.location.replace('index.php'); });
        });
    </script>";
}
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Data Pasien</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center bg-light">
                        <h4 class="mb-0 text-primary">Edit Data Pasien</h4>
                        <a class="btn btn-outline-secondary btn-sm" href="index.php" title="Kembali"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                    </div>
                    
                    <div class="card-body">
                        <?php
                        $sql_user = mysqli_query($con, "SELECT * FROM pasien WHERE id_pasien = '$id'") or die(mysqli_error($con));
                        $row = mysqli_fetch_array($sql_user);
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Lengkap</label>
                                <input type="text" class="form-control" name="namapasien" required value="<?= htmlspecialchars($row['nama_pasien']) ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jenis Kelamin</label>
                                <select class="form-control custom-select" name="jk" required>
                                    <option value="<?= $row['jk'] ?>" selected hidden><?= $row['jk'] ?></option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Usia</label>
                                <input type="text" class="form-control" name="usia" required value="<?= htmlspecialchars($row['usia']) ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Username Akun</label>
                                <input type="text" class="form-control" name="username" required value="<?= htmlspecialchars($row['usernameuser']) ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Password Akun</label>
                                <input type="text" class="form-control" name="password" required value="<?= htmlspecialchars($row['password_user']) ?>">
                            </div>
                            <div class="text-right mt-4 pt-3 border-top">
                                <button class="btn btn-secondary mr-1" type="reset">Reset</button>
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