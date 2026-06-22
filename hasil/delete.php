<?php
require_once "../config/config.php";
/** @var mysqli $con */
$id = mysqli_real_escape_string($con, @$_GET['id']);

if($id) {
    mysqli_query($con, "DELETE FROM hasil WHERE id_hasil='$id'");
}
header("Location: index.php");
exit;
?>