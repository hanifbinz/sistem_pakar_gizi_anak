<?php
require_once "../config/config.php";
/** @var mysqli $con */
$id = mysqli_real_escape_string($con, @$_GET['id']);

if($id) {
    mysqli_query($con, "DELETE FROM gejala WHERE id_gejala='$id'");
}
// Langsung kembalikan ke index.php
header("Location: index.php");
exit;
?>