<?php
session_start();
require "koneksi.php"; // Koneksi ke database

// Cek apakah ID pesanan tersimpan dalam session
if (!isset($_SESSION['id_pesanan'])) {
    echo "<div class='container text-center mt-5'><h2 class='text-danger'>Pesanan tidak ditemukan.</h2><a href='index.php' class='btn btn-primary mt-3'>Kembali ke Beranda</a></div>";
    exit();
}

$id_pesanan = $_SESSION['id_pesanan'];

// Ambil data pesanan dari database
$query = "SELECT * FROM pesanan WHERE id_pesanan = '$id_pesanan'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $pesanan = mysqli_fetch_assoc($result);
} else {
    echo "<div class='container text-center mt-5'><h2 class='text-danger'>Pesanan tidak ditemukan.</h2><a href='index.php' class='btn btn-primary mt-3'>Kembali ke Beranda</a></div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Sukses</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container text-center mt-5">
        <h1 class="text-success">Checkout Berhasil!</h1>
        <p class="fs-5">Terima kasih telah berbelanja. Berikut adalah detail pesanan Anda :</p>

        <table class="table table-bordered">
            <tr>
                <th>Nama Pelanggan</th>
                <td><?php echo htmlspecialchars($pesanan['nama_pelanggan']); ?></td>
            </tr>
            <tr>
                <th>Alamat Pengiriman</th>
                <td><?php echo htmlspecialchars($pesanan['alamat']); ?></td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td><?php echo htmlspecialchars($pesanan['telepon']); ?></td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td>Rp. <?php echo number_format($pesanan['total_harga'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Metode Pembayaran</th>
                <td><?php echo htmlspecialchars($pesanan['metode_pembayaran']); ?></td>
            </tr>

            <!-- Cek dan tampilkan data sesuai metode pembayaran -->
            <?php if ($pesanan['metode_pembayaran'] == 'cod') { ?>
                <tr>
                    <th>Lokasi COD</th>
                    <td><?php echo htmlspecialchars($pesanan['lokasi_cod']); ?></td>
                </tr>
            <?php } elseif ($pesanan['metode_pembayaran'] == 'transfer_bank') { ?>
                <tr>
                    <th>Nomor Rekening</th>
                    <td><?php echo htmlspecialchars($pesanan['nomor_rekening']); ?></td>
                </tr>
            <?php } elseif ($pesanan['metode_pembayaran'] == 'e_wallet') { ?>
                <tr>
                    <th>Nomor E-Wallet</th>
                    <td><?php echo htmlspecialchars($pesanan['nomor_wallet']); ?></td>
                </tr>
            <?php } ?>
        </table>

        <a href="home.php" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
