<?php
include '../../includes/header.php';
include '../../config/koneksi.php';
?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h1 class="h4 mb-0"><i class="fas fa-plus-circle"></i> Tambah Transaksi Baru</h1>
    </div>
    <div class="card-body">
        <form action="aksi_transaksi.php?aksi=tambah" method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_pelanggan" class="form-label">Pilih Pelanggan</label>
                    <select class="form-select" id="id_pelanggan" name="id_pelanggan" required>
                        <option value="" selected disabled>-- Pilih Pelanggan --</option>
                        <?php
                        $sql_pelanggan = "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC";
                        $result_pelanggan = $koneksi->query($sql_pelanggan);
                        while($row_pelanggan = $result_pelanggan->fetch_assoc()) {
                            echo "<option value='" . $row_pelanggan['id_pelanggan'] . "'>" . htmlspecialchars($row_pelanggan['nama_pelanggan']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="id_layanan" class="form-label">Pilih Layanan</label>
                    <select class="form-select" id="id_layanan" name="id_layanan" required>
                        <option value="" selected disabled>-- Pilih Layanan --</option>
                        <?php
                        $sql_layanan = "SELECT * FROM layanan ORDER BY nama_layanan ASC";
                        $result_layanan = $koneksi->query($sql_layanan);
                        while($row_layanan = $result_layanan->fetch_assoc()) {
                            echo "<option value='" . $row_layanan['id_layanan'] . "' data-harga='" . $row_layanan['harga_per_kg'] . "'>" . htmlspecialchars($row_layanan['nama_layanan']) . " (Rp " . number_format($row_layanan['harga_per_kg']) . "/kg)</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="total_berat" class="form-label">Total Berat (kg)</label>
                    <input type="number" step="0.1" class="form-control" id="total_berat" name="total_berat" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="total_biaya" class="form-label">Total Biaya (Rp)</label>
                    <input type="number" class="form-control" id="total_biaya" name="total_biaya" readonly required>
                </div>
            </div>
            <div class="mb-3">
                <label for="catatan_keluhan" class="form-label">Catatan / Keluhan Pelanggan (Opsional)</label>
                <textarea class="form-control" id="catatan_keluhan" name="catatan_keluhan" rows="3"></textarea>
            </div>
            
            <a href="data_transaksi.php" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">Simpan Transaksi</button>
        </form>
    </div>
</div>

<!-- JavaScript untuk menghitung total biaya otomatis -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const layananSelect = document.getElementById('id_layanan');
    const beratInput = document.getElementById('total_berat');
    const biayaInput = document.getElementById('total_biaya');

    function hitungBiaya() {
        const selectedLayanan = layananSelect.options[layananSelect.selectedIndex];
        const hargaPerKg = selectedLayanan.getAttribute('data-harga');
        const berat = beratInput.value;

        if (hargaPerKg && berat) {
            const totalBiaya = parseFloat(berat) * parseInt(hargaPerKg);
            biayaInput.value = Math.round(totalBiaya);
        } else {
            biayaInput.value = '';
        }
    }

    layananSelect.addEventListener('change', hitungBiaya);
    beratInput.addEventListener('input', hitungBiaya);
});
</script>

<?php
include '../../includes/footer.php';
?>