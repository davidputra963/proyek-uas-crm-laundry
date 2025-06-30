<?php
include '../../includes/header.php';
include '../../config/koneksi.php';
?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h1 class="h4 mb-0"><i class="fas fa-bullhorn"></i> Program Loyalitas Pelanggan</h1>
    </div>
    <div class="card-body">
        <p class="mb-4">Halaman ini menampilkan peringkat pelanggan berdasarkan total berat cucian yang telah selesai. Gunakan data ini untuk memberikan penghargaan atau promosi kepada pelanggan paling setia Anda.</p>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Peringkat</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Jumlah Transaksi Selesai</th>
                        <th scope="col">Total Berat Cucian (kg)</th>
                        <th scope="col">Progress Menuju Hadiah (20 kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk menghitung total berat cucian per pelanggan untuk transaksi yang sudah 'Selesai'
                    $sql = "SELECT 
                                p.nama_pelanggan, 
                                SUM(t.total_berat) as total_cucian, 
                                COUNT(t.id_transaksi) as jumlah_transaksi 
                            FROM transaksi t 
                            JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan 
                            WHERE t.status = 'Selesai' 
                            GROUP BY t.id_pelanggan 
                            ORDER BY total_cucian DESC";
                    
                    $result = $koneksi->query($sql);
                    $peringkat = 1;
                    $target_hadiah = 20; // Target dalam kg

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $total_berat = $row['total_cucian'];
                            $persentase = ($total_berat / $target_hadiah) * 100;
                            if ($persentase > 100) {
                                $persentase = 100;
                            }

                            echo "<tr>";
                            echo "<th scope='row'>" . $peringkat++ . "</th>";
                            echo "<td>" . htmlspecialchars($row['nama_pelanggan']) . "</td>";
                            echo "<td>" . $row['jumlah_transaksi'] . " kali</td>";
                            echo "<td>" . number_format($total_berat, 2, ',', '.') . " kg</td>";
                            echo "<td>
                                    <div class='progress' style='height: 25px;'>
                                        <div class='progress-bar bg-success' role='progressbar' style='width: " . $persentase . "%;' aria-valuenow='" . $persentase . "' aria-valuemin='0' aria-valuemax='100'>" . number_format($persentase, 0) . "%</div>
                                    </div>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>Belum ada data transaksi yang selesai.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../../includes/footer.php';
$koneksi->close();
?>