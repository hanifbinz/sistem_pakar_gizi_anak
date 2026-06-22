<?php
require_once "../config/config.php";
/** @var mysqli $con */
$id = mysqli_real_escape_string($con, @$_GET['id']);

if($id) {
    mysqli_query($con, "DELETE FROM penyakit WHERE id_penyakit='$id'");
}
// Langsung kembalikan ke index.php, karena popup konfirmasinya sudah ada di klik tombol Hapus di index.php
header("Location: index.php");
exit;
?>