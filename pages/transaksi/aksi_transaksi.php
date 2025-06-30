<?php
session_start();
include '../../config/koneksi.php';

$aksi = $_GET['aksi'];

// =================================================================
// PROSES TAMBAH DATA (VERSI AMAN)
// =================================================================
if ($aksi == 'tambah') {
    $id_pelanggan = $_POST['id_pelanggan'];
    $total_berat = $_POST['total_berat'];
    $total_biaya = $_POST['total_biaya'];
    $catatan_keluhan = $_POST['catatan_keluhan'];
    
    $id_admin = 1; // Asumsi admin ID 1
    $status = 'Baru';

    $stmt = $koneksi->prepare("INSERT INTO transaksi (id_pelanggan, id_admin, total_berat, total_biaya, status, catatan_keluhan) VALUES (?, ?, ?, ?, ?, ?)");
    // 'iidiss' berarti integer, integer, double, integer, string, string
    $stmt->bind_param("iidiss", $id_pelanggan, $id_admin, $total_berat, $total_biaya, $status, $catatan_keluhan);

    if ($stmt->execute()) {
        $_SESSION['pesan'] = "Transaksi baru berhasil ditambahkan.";
    } else {
        $_SESSION['error'] = "Gagal menambahkan transaksi: " . $stmt->error;
    }
    $stmt->close();
    header("Location: data_transaksi.php");
}
// =================================================================
// PROSES EDIT DATA (VERSI AMAN)
// =================================================================
else if ($aksi == 'edit') {
    $id_transaksi = $_POST['id_transaksi'];
    $status = $_POST['status'];
    $catatan_keluhan = $_POST['catatan_keluhan'];
    
    // Jika status diubah menjadi 'Selesai', catat tanggal selesai
    if ($status == 'Selesai') {
        $tgl_selesai = date('Y-m-d H:i:s');
        $stmt = $koneksi->prepare("UPDATE transaksi SET status=?, catatan_keluhan=?, tgl_selesai=? WHERE id_transaksi=?");
        // 'sssi' berarti string, string, string (untuk tanggal), integer
        $stmt->bind_param("sssi", $status, $catatan_keluhan, $tgl_selesai, $id_transaksi);
    } else {
        $stmt = $koneksi->prepare("UPDATE transaksi SET status=?, catatan_keluhan=? WHERE id_transaksi=?");
        // 'ssi' berarti string, string, integer
        $stmt->bind_param("ssi", $status, $catatan_keluhan, $id_transaksi);
    }

    if ($stmt->execute()) {
        $_SESSION['pesan'] = "Data transaksi berhasil diperbarui.";
    } else {
        $_SESSION['error'] = "Gagal memperbarui data: " . $stmt->error;
    }
    $stmt->close();
    header("Location: data_transaksi.php");
}

$koneksi->close();
?>
