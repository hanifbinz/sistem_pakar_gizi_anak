<?php include_once('header.php');
require_once "../config/config.php";
/** @var mysqli $con */
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data kriteria</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="../admin/adminindex.php">Data Kriteria</a></div>
                <div class="breadcrumb-item"><a href="../admin/adminindex.php">Kelola Data Kriteria</a></div>
                <div class="breadcrumb-item active">Updhate Data Kriteria</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Updahte Data Kriteria</h4>
                        <div class="card-body" style="text-align: right;">
                            <a class="btn btn-warning btn-action mr-1" href="index.php" data-toggle="tooltip" title="Kembali"><span>Kembali</span></a>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="card-body">
                                    <?php
                                    $id = @$_GET['id'];
                                    $sql_kriteria = mysqli_query($con, "SELECT * FROM kriteria WHERE id_kriteria = '$id'") or die(mysqli_error($con));
                                    $data = mysqli_fetch_array($sql_kriteria)
                                    ?>
                                    <form action="" enctype="multipart/form-data" method="post">
                                        <div class="form-group">
                                            <div class="section-title mt-0">Id Kriteria</div>
                                            <div class="input-group mb-2">
                                                <input type="text" name="idkriteria" class="form-control" value="<?= $data['id_kriteria'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Nama Kriteria</div>
                                            <div class="input-group mb-2">
                                                <input type="text" name="namakriteria" required autofocus class="form-control" value="<?= $data['nama_kriteria'] ?>">
                                            </div>
                                        </div>

                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary mr-1" type="submit" name="submit">Submit</button>
                                            <button class="btn btn-danger" type="reset">Reset</button>
                                        </div>
                                        </from>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <?php
    if (isset($_POST['submit'])) {
        $idkriteria = $_POST['idkriteria'];
        $namakriteria = $_POST['namakriteria'];

        $update1 = mysqli_query($con, "UPDATE kriteria set nama_kriteria='$namakriteria' WHERE id_kriteria = '$idkriteria'") or die(mysqli_error($con));

        echo "<script type='text/javascript'>
            setTimeout(function () { 
                swal({ 
                    title: 'Suksess', 
                    text: 'Data Berhasil Di Updahte', 
                    type: 'success',
                     timer: 3000,
                      showConfirmButton: false });
            },10);  
            window.setTimeout(function(){ 
              window.location.replace('index.php');
            } ,3000); 
            </script>";
    }




    ?>
    <?php include_once('footer.php'); ?>