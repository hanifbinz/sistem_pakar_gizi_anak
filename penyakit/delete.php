<?php
require_once "../config/config.php";
/** @var mysqli $con */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Penyakit</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style> body { background-color: #f4f6f9; } </style>
</head>
<body>
    <?php
    $id = mysqli_real_escape_string($con, @$_GET['id']);
    if ($id) {
        mysqli_query($con, "DELETE FROM penyakit WHERE id_penyakit='$id'");
    }
    
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data penyakit telah dihapus.',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.replace('index.php');
        });
    </script>";
    ?>
</body>
</html>