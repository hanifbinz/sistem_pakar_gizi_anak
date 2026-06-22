<?php
require_once "../config/config.php";
/** @var mysqli $con */
// Redirect jika sudah login sebagai pasien
if (isset($_SESSION['usernamepasien'])) {
    echo "<script>window.location='../dashboard/indexpasien.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pasien</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Tema Stisla - Biru */
        body {
            background-color: #f4f6f9; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            position: relative;
        }
        
        /* Header Background ala Dashboard */
        .navbar-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 300px;
            background-color: #007bff; /* Warna Biru Dashboard */
            z-index: 0;
        }
        
        /* Judul Web di atas */
        .header-title {
            position: absolute;
            top: 60px;
            width: 100%;
            text-align: center;
            color: #ffffff;
            z-index: 1;
        }
        .header-title h3 {
            font-weight: 700;
            letter-spacing: 1px;
            margin: 0;
            text-transform: uppercase;
        }

        /* Kartu Login */
        .login-card {
            background: #ffffff; 
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
            padding: 40px 35px;
            width: 100%;
            max-width: 420px;
            z-index: 2;
            margin-top: 80px; /* Memberi jarak dari header */
        }
        .login-title {
            color: #007bff;
            text-align: center;
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 22px;
        }
        .login-subtitle {
            color: #6c757d;
            text-align: center;
            font-size: 14px;
            margin-bottom: 30px;
        }
        .form-group label {
            color: #34395e;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #e4e6fc;
            border-right: none;
            color: #007bff; 
        }
        .form-control {
            background-color: #fdfdff;
            border: 1px solid #e4e6fc;
            border-left: none;
            color: #495057;
            height: 48px;
        }
        .form-control:focus {
            background-color: #ffffff;
            color: #495057;
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }
        
        /* Tombol */
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            letter-spacing: 0.5px;
            height: 50px;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
            cursor: pointer;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            color: #ffffff;
            box-shadow: 0 6px 12px rgba(0, 123, 255, 0.4);
            transform: translateY(-1px);
        }
        .link-admin {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }
        .link-admin:hover {
            color: #007bff;
            text-decoration: none;
        }
        .alert-custom {
            background-color: rgba(252, 84, 75, 0.1);
            border-left: 4px solid #fc544b;
            color: #fc544b;
            border-radius: 4px;
            padding: 12px 15px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="navbar-bg"></div>

    <div class="header-title">
        <h3>Diagnosa Gizi Buruk Anak</h3>
    </div>

    <div class="login-card">
        <h2 class="login-title">LOGIN PASIEN</h2>
        <p class="login-subtitle">Silakan masuk ke akun Anda</p>

        <?php
        // Logika Login Pasien
        if (isset($_POST['login'])) {
            $pasien = trim(mysqli_real_escape_string($con, $_POST['username']));
            $pass = trim(mysqli_real_escape_string($con, $_POST['password']));
            
            $sql_pasien = mysqli_query($con, "SELECT * FROM pasien WHERE usernameuser ='$pasien' AND password_user = '$pass'") or die(mysqli_error($con));
            
            if ($row = mysqli_fetch_array($sql_pasien)) {
                $_SESSION['id_pasien'] = $row['id_pasien'];
                $_SESSION['nama_pasien'] = $row['nama_pasien'];
                $_SESSION['usernamepasien'] = $pasien;
                echo "<script>window.location='../dashboard/indexpasien.php';</script>";
            } else { 
        ?>
                <div class="alert-custom">
                    <i class="fas fa-exclamation-triangle mr-1"></i> Username atau Password salah!
                </div>
        <?php
            }
        }
        ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="username" required autofocus placeholder="Masukkan username pasien">
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" name="password" required placeholder="Masukkan password">
                </div>
            </div>

            <button type="submit" name="login" class="btn-custom">
                <i class="fas fa-sign-in-alt mr-2"></i> MASUK SEBAGAI PASIEN
            </button>
            
            <a href="login.php" class="link-admin">
                Bukan Pasien? <b style="color:#007bff;">Login sebagai Admin</b>
            </a>
        </form>
    </div>

</body>
</html>