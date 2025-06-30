<?php
// Arahkan path ke file header dan koneksi
include '../../includes/header.php';
include '../../config/koneksi.php';

// Ambil ID pelanggan dari URL
$id = $_GET['id'];

// Query untuk mengambil data pelanggan berdasarkan ID
$sql = "SELECT * FROM pelanggan WHERE id_pelanggan = $id";
$result = $koneksi->query($sql);
$row = $result->fetch_assoc();
?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h1 class="h4 mb-0"><i class="fas fa-edit"></i> Edit Data Pelanggan</h1>
    </div>
    <div class="card-body">
        <form action="aksi_pelanggan.php?aksi=edit" method="POST">
            <!-- Input tersembunyi untuk menyimpan ID pelanggan -->
            <input type="hidden" name="id_pelanggan" value="<?php echo $row['id_pelanggan']; ?>">

            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo htmlspecialchars($row['nama_pelanggan']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">Nomor HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($row['no_hp']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($row['alamat']); ?></textarea>
            </div>
            <a href="data_pelanggan.php" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">Update Data</button>
        </form>
    </div>
</div>

<?php
// Arahkan path ke file footer
include '../../includes/footer.php';
?>
