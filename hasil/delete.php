<?php
require_once "../config/config.php";
/** @var mysqli $con */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Riwayat Diagnosa</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style> body { background-color: #f4f6f9; } </style>
</head>
<body>
    <?php
    $id = mysqli_real_escape_string($con, @$_GET['id']);
    if ($id) {
        mysqli_query($con, "DELETE FROM hasil WHERE id_hasil='$id'");
    }
    
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data riwayat diagnosa telah dihapus.',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.replace('index.php');
        });
    </script>";
    ?>
</body>
</html>