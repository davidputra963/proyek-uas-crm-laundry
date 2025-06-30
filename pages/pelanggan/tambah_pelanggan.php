<?php
// Arahkan path ke file header
include '../../includes/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h1 class="h4 mb-0"><i class="fas fa-plus-circle"></i> Tambah Pelanggan Baru</h1>
    </div>
    <div class="card-body">
        <form action="aksi_pelanggan.php?aksi=tambah" method="POST">
            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">Nomor HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <a href="data_pelanggan.php" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>
    </div>
</div>

<?php
// Arahkan path ke file footer
include '../../includes/footer.php';
?>
