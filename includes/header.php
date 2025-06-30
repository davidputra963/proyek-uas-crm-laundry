<?php
session_start();

// Cek apakah pengguna sudah login, jika belum, redirect ke halaman login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: /crm-laundry/login.php');
    exit;
}

// Menentukan halaman aktif untuk memberikan style pada menu navigasi
$active_page = basename($_SERVER['PHP_SELF']);
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Berkah Laundry</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- CSS Kustom -->
    <link rel="stylesheet" href="/crm-laundry/assets/css/style.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/crm-laundry/index.php"><i class="fas fa-soap"></i> Berkah Laundry CRM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($active_page == 'index.php') ? 'active' : ''; ?>" href="/crm-laundry/index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_dir == 'pelanggan') ? 'active' : ''; ?>" href="/crm-laundry/pages/pelanggan/data_pelanggan.php"><i class="fas fa-users"></i> Pelanggan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_dir == 'transaksi') ? 'active' : ''; ?>" href="/crm-laundry/pages/transaksi/data_transaksi.php"><i class="fas fa-cash-register"></i> Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_dir == 'marketing') ? 'active' : ''; ?>" href="/crm-laundry/pages/marketing/loyalitas.php"><i class="fas fa-bullhorn"></i> Loyalitas</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="/crm-laundry/logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4">