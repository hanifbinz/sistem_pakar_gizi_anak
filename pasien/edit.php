<?php include_once('header.php');
require_once "../config/config.php";
/** @var mysqli $con */
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Halaman Pasien</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-primary">Update Data Pasien</h4>
                        <a class="btn btn-light border btn-sm" href="index.php" title="Kembali"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                    </div>
                    
                    <div class="card-body">
                        <?php
                        $id = @$_GET['id'];
                        $sql_user = mysqli_query($con, "SELECT * FROM pasien WHERE id_pasien = '$id'") or die(mysqli_error($con));
                        $row = mysqli_fetch_array($sql_user);
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Pasien</label>
                                <input type="text" class="form-control" name="namapasien" required value="<?= $row['nama_pasien'] ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jenis Kelamin</label>
                                <select class="custom-select form-control" name="jk" required>
                                    <option value="<?= $row['jk'] ?>" selected hidden><?= $row['jk'] ?></option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Usia</label>
                                <input type="text" class="form-control" name="usia" required value="<?= $row['usia'] ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Username</label>
                                <input type="text" class="form-control" name="username" required value="<?= $row['usernameuser'] ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Password User</label>
                                <input type="text" class="form-control" name="password" required value="<?= $row['password_user'] ?>">
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

<?php
if (isset($_POST['submit'])) {
    $namapasien = $_POST['namapasien'];
    $usia = $_POST['usia'];
    $jk = $_POST['jk'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    $update1 = mysqli_query($con, "UPDATE pasien set nama_pasien ='$namapasien', usernameuser='$username', jk='$jk', usia='$usia', password_user='$password' WHERE id_pasien = '$id'") or die(mysqli_error($con));

    echo "<script>
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data pasien berhasil diupdate.', showConfirmButton: false, timer: 2000 })
        .then(() => { window.location.replace('index.php'); });
    </script>";
}
?>

<?php include_once('footer.php'); ?>