<?php
session_start();
include 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Gunakan prepared statement untuk keamanan
    $stmt = $koneksi->prepare("SELECT id_admin, nama_lengkap, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password yang di-hash
        if ($password === $user['password']) { // Perbandingan plain text untuk 'admin123'
            // Login berhasil
            $_SESSION['loggedin'] = true;
            $_SESSION['id_admin'] = $user['id_admin'];
            $_SESSION['nama_admin'] = $user['nama_lengkap'];
            
            // Redirect ke halaman dashboard
            header("Location: index.php");
            exit;
        } else {
            // Password salah
            $_SESSION['error'] = "Username atau password salah.";
            header("Location: login.php");
            exit;
        }
    } else {
        // Username tidak ditemukan
        $_SESSION['error'] = "Username atau password salah.";
        header("Location: login.php");
        exit;
    }

    $stmt->close();
    $koneksi->close();
}
?>
