<?php
// Arahkan path ke file header dan koneksi
include '../../includes/header.php';
include '../../config/koneksi.php';
?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h1 class="h4 mb-0"><i class="fas fa-users"></i> Data Pelanggan</h1>
    </div>
    <div class="card-body">
        
        <!-- Tombol Tambah Pelanggan -->
        <a href="tambah_pelanggan.php" class="btn btn-success mb-3"><i class="fas fa-plus-circle"></i> Tambah Pelanggan Baru</a>

        <!-- Pesan Notifikasi (jika ada) -->
        <?php if(isset($_SESSION['pesan'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['pesan']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['pesan']); // Hapus pesan dari session setelah ditampilkan ?>
        <?php endif; ?>

        <!-- Tabel Data Pelanggan -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Nomor HP</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Tanggal Daftar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mengambil semua data pelanggan
                    $sql = "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC";
                    $result = $koneksi->query($sql);

                    if ($result->num_rows > 0) {
                        $no = 1;
                        // Loop untuk setiap baris data
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $no++ . "</th>";
                            echo "<td>" . htmlspecialchars($row['nama_pelanggan']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['no_hp']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                            echo "<td>" . date('d M Y', strtotime($row['tgl_daftar'])) . "</td>";
                            echo "<td>
                                    <a href='edit_pelanggan.php?id=" . $row['id_pelanggan'] . "' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Edit</a>
                                    <a href='aksi_pelanggan.php?aksi=hapus&id=" . $row['id_pelanggan'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'><i class='fas fa-trash'></i> Hapus</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>Tidak ada data pelanggan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// Arahkan path ke file footer
include '../../includes/footer.php';
?>