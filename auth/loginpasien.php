<?php
require_once "../config/config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; ADMIN</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/asset/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/asset/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/asset/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/asset/assets/css/components.css">
</head>

<body class="bodybackground">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 ">LOGIN Pasien</h1>


                                    </div>

                                    <form method="POST" action="#" class="needs-validation" novalidate="">
                                        <?php
                                        if (isset($_POST['login'])) {
                                            $pasien = trim(mysqli_real_escape_string($con, $_POST['username']));
                                            $pass = trim(mysqli_real_escape_string($con, $_POST['password']));
                                            $sql_pasien = mysqli_query($con, "SELECT * FROM pasien WHERE usernameuser ='$pasien' AND password_user = '$pass'") or die(mysqli_error($con));
                                            if ($row = mysqli_fetch_array($sql_pasien)) {
                                                $_SESSION['id_pasien'] = $row['id_pasien'];
                                                $_SESSION['nama_pasien'] = $row['nama_pasien'];
                                                $_SESSION['usernamepasien'] = $pasien;

                                                echo "<script>window.location='" . base_url('dashboard/indexpasien.php') . "';</script>";
                                            } else { ?>
                                                <div class="mt-3">
                                                    <div class="alert alert-danger alert-dismissable" role="alert">
                                                        <center>
                                                            <strong>Login Gagal</strong> <br>
                                                            Username Dan Password salah
                                                        </center>
                                                    </div>
                                                </div>

                                        <?php
                                            }
                                        }

                                        ?>
                                        <div class="form-group">

                                            <label for="username">Username</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i> </span>
                                                </div>
                                                <input id="text" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                                                <div class="invalid-feedback">
                                                    Masukan Username terlebih dahulu
                                                </div>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label for="username">Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                                    </div>
                                                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                                    <div class="invalid-feedback">
                                                        Masukan Password terlebih dahulu
                                                    </div>
                                                </div>

                                                <div class="form-group mt-3">


                                                    <div class="form-group">
                                                        <button type="submit" name="login" class="btn btn-success btn-lg btn-block" tabindex="4">
                                                            Login
                                                        </button>
                                                    </div>
                                                    <div class="form-group">
                                                        <a href="login.php" class="mb-4 text-center">Login Ke Admin</a>
                                                    </div>
                                    </form>

                                    <!-- <div class="mt-5 text-muted text-center">
                                        Don't have an account? <a href="auth-register.html">Create One</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="simple-footer">
            Copyright &copy; 2022
        </div>
    </div>
    </div>
    </div>
    </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url('/asset/node_modules/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('/asset/node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>


    <script src="<?= base_url() ?>/asset/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/asset/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/asset/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>