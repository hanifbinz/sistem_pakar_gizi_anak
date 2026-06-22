<?php
require_once "../config/config.php";
/** @var mysqli $con */
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>/asset/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
    <title>Hapus Pasien</title>
</head>

<body>
    <?php
    $id = @$_GET['id'];
    $del1 = mysqli_query($con, "DELETE FROM pasien WHERE id_pasien='$id'");

    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data pasien telah dihapus.',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.replace('index.php');
        });
    </script>";
    ?>
</body>
</html>