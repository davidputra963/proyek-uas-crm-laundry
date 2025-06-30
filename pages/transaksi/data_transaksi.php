<?php
include '../../includes/header.php';
include '../../config/koneksi.php';
?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h1 class="h4 mb-0"><i class="fas fa-cash-register"></i> Data Transaksi</h1>
    </div>
    <div class="card-body">
        <a href="tambah_transaksi.php" class="btn btn-success mb-3"><i class="fas fa-plus-circle"></i> Tambah Transaksi Baru</a>

        <?php if(isset($_SESSION['pesan'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['pesan']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['pesan']); ?>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>No. Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Masuk</th>
                        <th>Total Biaya</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query JOIN untuk mengambil data dari 2 tabel
                    $sql = "SELECT transaksi.*, pelanggan.nama_pelanggan 
                            FROM transaksi 
                            JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan 
                            ORDER BY transaksi.tgl_masuk DESC";
                    $result = $koneksi->query($sql);
                    $no = 1;

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            // Badge color based on status
                            $status_badge = '';
                            if($row['status'] == 'Baru') $status_badge = 'bg-primary';
                            else if($row['status'] == 'Diproses') $status_badge = 'bg-warning text-dark';
                            else if($row['status'] == 'Siap Diambil') $status_badge = 'bg-info text-dark';
                            else if($row['status'] == 'Selesai') $status_badge = 'bg-success';
                            
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>TRX-" . str_pad($row['id_transaksi'], 4, '0', STR_PAD_LEFT) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_pelanggan']) . "</td>";
                            echo "<td>" . date('d M Y, H:i', strtotime($row['tgl_masuk'])) . "</td>";
                            echo "<td>Rp " . number_format($row['total_biaya'], 0, ',', '.') . "</td>";
                            echo "<td><span class='badge " . $status_badge . "'>" . $row['status'] . "</span></td>";
                            echo "<td>
                                    <a href='detail_transaksi.php?id=" . $row['id_transaksi'] . "' class='btn btn-info btn-sm'><i class='fas fa-eye'></i> Detail</a>
                                    <a href='edit_transaksi.php?id=" . $row['id_transaksi'] . "' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Edit</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>Belum ada data transaksi.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../../includes/footer.php';
?>