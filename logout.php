<?php
session_start();

// Hancurkan semua data sesi
$_SESSION = array();
session_destroy();

// Redirect ke halaman login
header("location: login.php");
exit;
?>