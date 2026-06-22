<?php
require_once "../config/config.php";

// Redirect jika sudah login
if (isset($_SESSION['username'])) {
    echo "<script>window.location='../dashboard/index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Tema Terang & Ungu (Matching dengan Dashboard Stisla) */
        body {
            background-color: #f4f6f9; /* Background abu-abu muda */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }
        .login-card {
            background: #ffffff; /* Kartu warna putih */
            border-top: 5px solid #6777ef; /* Aksen garis ungu di atas */
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); /* Bayangan lembut */
            padding: 40px 35px;
            width: 100%;
            max-width: 420px;
        }
        .login-title {
            color: #6777ef; /* Teks warna ungu */
            text-align: center;
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 24px;
            letter-spacing: 1px;
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
            color: #6777ef; /* Ikon warna ungu */
        }
        .form-control {
            background-color: #fdfdff;
            border: 1px solid #e4e6fc;
            border-left: none;
            color: #495057;
            height: 48px; /* Mengatasi input box kepotong */
        }
        .form-control:focus {
            background-color: #ffffff;
            color: #495057;
            border-color: #6777ef;
            box-shadow: 0 0 8px rgba(103, 119, 239, 0.2); /* Efek fokus ungu */
        }
        .form-control::placeholder {
            color: #a1a8ae;
        }
        
        /* Tombol Ungu */
        .btn-custom {
            background-color: #6777ef;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            letter-spacing: 0.5px;
            height: 50px;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(103, 119, 239, 0.3);
            cursor: pointer;
        }
        .btn-custom:hover {
            background-color: #394eea;
            color: #ffffff;
            box-shadow: 0 6px 12px rgba(103, 119, 239, 0.4);
            transform: translateY(-1px);
        }
        .link-pasien {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }
        .link-pasien:hover {
            color: #6777ef;
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

    <div class="login-card">
        <h2 class="login-title">LOGIN ADMIN</h2>
        <p class="login-subtitle">Sistem Pakar Gizi Buruk</p>

        <?php
        // Logika Login
        if (isset($_POST['login'])) {
            $user = trim(mysqli_real_escape_string($con, $_POST['username']));
            $pass = trim(mysqli_real_escape_string($con, $_POST['password']));
            
            $sql_login = mysqli_query($con, "SELECT * FROM admin WHERE username ='$user' AND password = '$pass'") or die(mysqli_error($con));
            
            if ($row = mysqli_fetch_array($sql_login)) {
                $_SESSION['id_admin'] = $row['id_admin'];
                $_SESSION['username'] = $user;
                echo "<script>window.location='../dashboard/index.php';</script>";
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
                    <input type="text" class="form-control" name="username" required autofocus placeholder="Masukkan username">
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
                <i class="fas fa-sign-in-alt mr-2"></i> MASUK
            </button>
            
            <a href="loginpasien.php" class="link-pasien">
                Bukan Admin? <b style="color:#6777ef;">Login sebagai Pasien</b>
            </a>
        </form>
    </div>

</body>
</html>