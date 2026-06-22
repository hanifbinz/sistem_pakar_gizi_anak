<?php include_once('header.php');
require_once "../config/config.php";
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Warga</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="../admin/adminindex.php">Data Warga</a></div>
                <div class="breadcrumb-item"><a href="../admin/adminindex.php">Kelola Data Warga</a></div>
                <div class="breadcrumb-item active">Tambah Data</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Data Warga</h4>
                        <div class="card-body" style="text-align: right;">
                            <a class="btn btn-warning btn-action mr-1" href="index.php" data-toggle="tooltip" title="Kembali"><span>Kembali</span></a>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="card-body">

                                    <form action="" enctype="multipart/form-data" method="post">
                                        <?php
                                        // mengambil data barang dengan kode paling besar
                                        $query = mysqli_query($con, "SELECT max(kd_warga) as maxKode FROM dt_warga");
                                        $data = mysqli_fetch_array($query);
                                        $kd_warga = $data['maxKode'];

                                        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
                                        // dan diubah ke integer dengan (int)
                                        $urutan = (int) substr($kd_warga, 3, 3);

                                        $urutan++;
                                        $huruf = "A";
                                        $kd_warga = $huruf . sprintf("%03s", $urutan);
                                        ?>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Kode Warga</div>
                                            <div class="input-group mb-2">
                                                <input type="text" name="kd_warga" class="form-control" readonly value="<?php echo $kd_warga ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">NIK</div>
                                            <div class="input-group mb-2">
                                                <input type="text" name="nik" required autofocus class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Nama</div>
                                            <div class="input-group mb-2">
                                                <input type="text" name="nama" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jeniskelamin">
                                                <div class="section-title mt-0"> Jenis Kelamin </div>
                                            </label>

                                            <select class="custom-select" id="jeniskelamin" name="jeniskelamin">
                                                <option selected>Pilih</option>
                                                <option value="1">Laki-Laki</option>
                                                <option value="2">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Alamat</div>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="alamat" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Desa</div>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="desa" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Tanggal Lahir</div>
                                            <div class="input-group mb-2">
                                                <input type="date" class="form-control datetimepicker" name="tgllahir">
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">No Hp</div>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" name="nohp" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Pekerjaan</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="pekerjaan" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="bg-keluarga">
                                                    <div class="section-title mt-0"> Bagian Keluarga </div>
                                                </label>

                                                <select class="custom-select" id="bg-keluarga" name="bg-keluarga">
                                                    <option selected>Pilih</option>
                                                    <option value="Kepala Rumah Tangga">Kepala Rumah Tangga</option>
                                                    <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                                    <option value="Anak">Anak</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <div class="section-title">Foto</div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="customFile" id="customFile">
                                                    <label class="custom-file-label" for="customFile">PiLih Gambar</label>
                                                </div>
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
        $tempdir = "../asset/assets/img/fotowarga/";

        $kdwarga = $_POST['kd_warga'];
        $desa = $_POST['desa'];
        $tgllahir = $_POST['tgllahir'];
        $NIK = $_POST['nik'];
        $nama = $_POST['nama'];
        $jk = $_POST['jeniskelamin'];
        $alamat = $_POST['alamat'];
        $nohp = $_POST['nohp'];
        $pekerjaan = $_POST['pekerjaan'];
        $bgkeluarga = $_POST['bg-keluarga'];

        $file_name = $_FILES['customFile']['name'];

        if ($file_name == '') {
            echo "<script type='text/javascript'>
                            setTimeout(function () { 
                                swal({ 
                                    title: 'Warning', 
                                    text: 'HARAP UPLOAD FOTO TERLEBIH DAHULU', 
                                    type: 'warning',
                                     timer: 3000,
                                      showConfirmButton: false });
                            },10);  
                            window.setTimeout(function(){ 
                              window.location.replace('#');
                            } ,3000); 
                            </script>";
        } else {
            $file_name = $_FILES['customFile']['name'];
            $file_size = $_FILES['customFile']['size'];
            $file_type = $_FILES['customFile']['type'];

            $image   = addslashes(file_get_contents($_FILES['customFile']['tmp_name']));

            $tmp_name = $_FILES['customFile']['tmp_name'];
            move_uploaded_file($tmp_name, "../asset/assets/img/fotowarga/" . $file_name);

            if ($file_size < 2048000 and ($file_type == 'image/jpeg' or $file_type == 'image/png' or $file_type == 'image/jpg')) {
                $save = mysqli_query($con, "INSERT INTO dt_warga VALUES ('$kdwarga','$NIK', '$nama', '$jk', '$alamat', '$desa', '$tgllahir', '$nohp', '$pekerjaan', '$bgkeluarga','$file_name' )") or die(mysqli_error($con));

                echo "<script type='text/javascript'>
                                setTimeout(function () { 
                                    swal({ 
                                        title: 'Suksess', 
                                        text: 'Data Berhasil Disimpan $nama', 
                                        type: 'success',
                                         timer: 3000,
                                          showConfirmButton: false });
                                },10);  
                                window.setTimeout(function(){ 
                                  window.location.replace('index.php');
                                } ,3000); 
                                </script>";
            } else {
                echo "<script type='text/javascript'>
                                setTimeout(function () { 
                                    swal({ 
                                        title: 'Warning', 
                                        text: 'File Melebihi Ukuran atau Tidak Sesuai', 
                                        type: 'warning',
                                         timer: 3000,
                                          showConfirmButton: false });
                                },10);  
                                window.setTimeout(function(){ 
                                  window.location.replace('add.php');
                                } ,3000); 
                                </script>";
            }
        }
    }


    ?>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>





    <?php include_once('footer.php'); ?>