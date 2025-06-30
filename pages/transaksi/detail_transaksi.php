<?php
include '../../includes/header.php';
include '../../config/koneksi.php';

// Ambil ID dari URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: data_transaksi.php");
    exit();
}
$id_transaksi = $_GET['id'];

// Query JOIN untuk mengambil detail lengkap transaksi
$sql = "SELECT t.*, p.nama_pelanggan, p.no_hp, p.alamat, a.nama_lengkap as nama_admin
        FROM transaksi t
        JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
        JOIN admin a ON t.id_admin = a.id_admin
        WHERE t.id_transaksi = ?";

$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id_transaksi);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Data transaksi tidak ditemukan.";
    exit();
}
$data = $result->fetch_assoc();
?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h1 class="h4 mb-0"><i class="fas fa-eye"></i> Detail Transaksi: TRX-<?php echo str_pad($data['id_transaksi'], 4, '0', STR_PAD_LEFT); ?></h1>
        <a href="data_transaksi.php" class="btn btn-light btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Kolom Detail Transaksi -->
            <div class="col-md-6">
                <h4>Detail Pesanan</h4>
                <hr>
                <table class="table table-borderless table-sm">
                    <tr>
                        <th style="width: 150px;">Status</th>
                        <td>: <span class="badge bg-success"><?php echo htmlspecialchars($data['status']); ?></span></td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td>: <?php echo date('d M Y, H:i', strtotime($data['tgl_masuk'])); ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Selesai</th>
                        <td>: <?php echo $data['tgl_selesai'] ? date('d M Y, H:i', strtotime($data['tgl_selesai'])) : '-'; ?></td>
                    </tr>
                    <tr>
                        <th>Total Berat</th>
                        <td>: <?php echo htmlspecialchars($data['total_berat']); ?> kg</td>
                    </tr>
                    <tr>
                        <th>Total Biaya</th>
                        <td>: Rp <?php echo number_format($data['total_biaya'], 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Dikelola Oleh</th>
                        <td>: <?php echo htmlspecialchars($data['nama_admin']); ?></td>
                    </tr>
                </table>
            </div>

            <!-- Kolom Detail Pelanggan -->
            <div class="col-md-6">
                <h4>Detail Pelanggan</h4>
                <hr>
                <table class="table table-borderless table-sm">
                    <tr>
                        <th style="width: 150px;">Nama Pelanggan</th>
                        <td>: <?php echo htmlspecialchars($data['nama_pelanggan']); ?></td>
                    </tr>
                    <tr>
                        <th>Nomor HP</th>
                        <td>: <?php echo htmlspecialchars($data['no_hp']); ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>: <?php echo htmlspecialchars($data['alamat']); ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Bagian Catatan/Keluhan -->
        <div class="mt-4">
            <h4>Catatan / Keluhan dari Pelanggan</h4>
            <hr>
            <div class="p-3 bg-light rounded">
                <p class="mb-0"><?php echo !empty($data['catatan_keluhan']) ? htmlspecialchars($data['catatan_keluhan']) : '<em>Tidak ada catatan atau keluhan.</em>'; ?></p>
            </div>
        </div>
    </div>
</div>

<?php
include '../../includes/footer.php';
$stmt->close();
$koneksi->close();
?>