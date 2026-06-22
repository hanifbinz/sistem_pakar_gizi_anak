<?php
require_once "config/config.php";
if (isset($_SESSION['username']) && !isset($_SESSION['usernamepasien'])) {
    echo "<script>window.location='" . base_url('dashboard/index.php') . "';</script>";
} else {
    echo "<script>window.location='" . base_url('auth/login.php') . "';</script>";
}
