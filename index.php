<?php
// Memanggil file header
include 'includes/header.php';
// Memanggil file koneksi
include 'config/koneksi.php';

// Query untuk mengambil data ringkasan
// 1. Jumlah Pelanggan
$query_pelanggan = "SELECT COUNT(id_pelanggan) as total_pelanggan FROM pelanggan";
$result_pelanggan = $koneksi->query($query_pelanggan);
$total_pelanggan = $result_pelanggan->fetch_assoc()['total_pelanggan'];

// 2. Jumlah Transaksi Bulan Ini
$bulan_ini = date('m');
$tahun_ini = date('Y');
$query_transaksi = "SELECT COUNT(id_transaksi) as total_transaksi FROM transaksi WHERE MONTH(tgl_masuk) = $bulan_ini AND YEAR(tgl_masuk) = $tahun_ini";
$result_transaksi = $koneksi->query($query_transaksi);
$total_transaksi_bulan_ini = $result_transaksi->fetch_assoc()['total_transaksi'];

// 3. Transaksi Baru (yang statusnya 'Baru')
$query_baru = "SELECT COUNT(id_transaksi) as total_baru FROM transaksi WHERE status = 'Baru'";
$result_baru = $koneksi->query($query_baru);
$total_baru = $result_baru->fetch_assoc()['total_baru'];

?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h1 class="h4 mb-0"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
    </div>
    <div class="card-body">
        <p class="lead">Selamat Datang, Admin!</p>
        <p>Ini adalah halaman utama sistem CRM Berkah Laundry. Gunakan menu navigasi di atas untuk mengelola data.</p>
        <hr>

        <!-- Kartu Ringkasan Data -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title"><?php echo $total_pelanggan; ?></h5>
                            <p class="card-text">Total Pelanggan</p>
                        </div>
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-info">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title"><?php echo $total_transaksi_bulan_ini; ?></h5>
                            <p class="card-text">Transaksi Bulan Ini</p>
                        </div>
                        <i class="fas fa-cash-register fa-3x"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-warning">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title"><?php echo $total_baru; ?></h5>
                            <p class="card-text">Order Baru</p>
                        </div>
                        <i class="fas fa-tshirt fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
// Memanggil file footer
include 'includes/footer.php';
?>
