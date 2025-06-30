<?php
// Mulai sesi untuk menyimpan pesan notifikasi
session_start();

// Memanggil file koneksi ke database
include '../../config/koneksi.php';

// Mengambil nilai 'aksi' dari URL
$aksi = $_GET['aksi'];

// =================================================================
// PROSES TAMBAH DATA (VERSI AMAN)
// =================================================================
if ($aksi == 'tambah') {
    // Mengambil data dari form
    $nama = $_POST['nama_pelanggan'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    // Query menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $koneksi->prepare("INSERT INTO pelanggan (nama_pelanggan, no_hp, alamat) VALUES (?, ?, ?)");
    // 'sss' berarti ketiga variabel adalah string
    $stmt->bind_param("sss", $nama, $no_hp, $alamat);

    if ($stmt->execute()) {
        $_SESSION['pesan'] = "Data pelanggan baru berhasil ditambahkan.";
    } else {
        $_SESSION['error'] = "Gagal menambahkan data: " . $stmt->error;
    }
    $stmt->close();
    header("Location: data_pelanggan.php");
} 
// =================================================================
// PROSES EDIT DATA (VERSI AMAN)
// =================================================================
else if ($aksi == 'edit') {
    // Mengambil data dari form
    $id = $_POST['id_pelanggan'];
    $nama = $_POST['nama_pelanggan'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $stmt = $koneksi->prepare("UPDATE pelanggan SET nama_pelanggan=?, no_hp=?, alamat=? WHERE id_pelanggan=?");
    // 'sssi' berarti string, string, string, integer
    $stmt->bind_param("sssi", $nama, $no_hp, $alamat, $id);

    if ($stmt->execute()) {
        $_SESSION['pesan'] = "Data pelanggan berhasil diperbarui.";
    } else {
        $_SESSION['error'] = "Gagal memperbarui data: " . $stmt->error;
    }
    $stmt->close();
    header("Location: data_pelanggan.php");
}
// =================================================================
// PROSES HAPUS DATA (VERSI AMAN)
// =================================================================
else if ($aksi == 'hapus') {
    $id = $_GET['id'];

    $stmt = $koneksi->prepare("DELETE FROM pelanggan WHERE id_pelanggan=?");
    // 'i' berarti variabel adalah integer
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['pesan'] = "Data pelanggan berhasil dihapus.";
    } else {
        $_SESSION['error'] = "Gagal menghapus data: " . $stmt->error;
    }
    $stmt->close();
    header("Location: data_pelanggan.php");
}

$koneksi->close();
?>