<?php
// Detail koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_crm_laundry";

// Membuat koneksi
$koneksi = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}

// Mengatur zona waktu default
date_default_timezone_set('Asia/Jakarta');
?>
