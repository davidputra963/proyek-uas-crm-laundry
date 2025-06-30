<?php
include '../../includes/header.php';
include '../../config/koneksi.php';

// Ambil ID dari URL
$id_transaksi = $_GET['id'];

// Query untuk mengambil data transaksi
$sql = "SELECT transaksi.*, pelanggan.nama_pelanggan FROM transaksi 
        JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan 
        WHERE id_transaksi = $id_transaksi";
$result = $koneksi->query($sql);
$data = $result->fetch_assoc();
?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h1 class="h4 mb-0"><i class="fas fa-edit"></i> Edit Transaksi: TRX-<?php echo str_pad($data['id_transaksi'], 4, '0', STR_PAD_LEFT); ?></h1>
    </div>
    <div class="card-body">
        <form action="aksi_transaksi.php?aksi=edit" method="POST">
            <input type="hidden" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>">
            
            <p><strong>Nama Pelanggan:</strong> <?php echo htmlspecialchars($data['nama_pelanggan']); ?></p>
            
            <div class="mb-3">
                <label for="status" class="form-label">Ubah Status Transaksi</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Baru" <?php if($data['status'] == 'Baru') echo 'selected'; ?>>Baru</option>
                    <option value="Diproses" <?php if($data['status'] == 'Diproses') echo 'selected'; ?>>Diproses</option>
                    <option value="Siap Diambil" <?php if($data['status'] == 'Siap Diambil') echo 'selected'; ?>>Siap Diambil</option>
                    <option value="Selesai" <?php if($data['status'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="catatan_keluhan" class="form-label">Catatan / Keluhan Pelanggan</label>
                <textarea class="form-control" id="catatan_keluhan" name="catatan_keluhan" rows="3"><?php echo htmlspecialchars($data['catatan_keluhan']); ?></textarea>
            </div>

            <a href="data_transaksi.php" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">Update Transaksi</button>
        </form>
    </div>
</div>

<?php
include '../../includes/footer.php';
?>
