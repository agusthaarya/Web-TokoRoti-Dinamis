<?php
session_start();
require "../koneksi.php"; // Koneksi ke database

// Cek jika ID pesanan ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID Pesanan tidak ditemukan.";
    exit();
}

$id_pesanan = $_GET['id'];

// Ambil detail pesanan dan status pesanan
$queryPesanan = "SELECT p.*, s.status_name, p.nomor_rekening FROM pesanan p
                 JOIN status s ON p.id_status = s.id_status
                 WHERE p.id_pesanan = '$id_pesanan'";
$resultPesanan = mysqli_query($con, $queryPesanan);

// Cek jika query berhasil dijalankan
if (!$resultPesanan) {
    die('Query gagal: ' . mysqli_error($con)); // Menampilkan pesan error jika query gagal
}

// Cek jika pesanan ditemukan
if (mysqli_num_rows($resultPesanan) > 0) {
    $pesanan = mysqli_fetch_assoc($resultPesanan);
} else {
    echo "Pesanan tidak ditemukan.";
    exit();
}

// Ambil detail produk
$queryDetail = "SELECT * FROM detail_pesanan WHERE id_pesanan = '$id_pesanan'";
$resultDetail = mysqli_query($con, $queryDetail);

// Cek jika query detail produk berhasil dijalankan
if (!$resultDetail) {
    die('Query gagal: ' . mysqli_error($con)); // Menampilkan pesan error jika query gagal
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Pesanan</title>
  <!-- CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
  <!-- Navbar -->
  <?php require "navbar.php"; ?>
  
  <!-- Breadcrumb -->
  <div class="container mt-4">
      <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-light p-3 rounded">
          <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-dark"><i class="bi bi-house-door"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="pesanan.php" class="text-decoration-none text-dark">Pesanan</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Detail Pesanan</li>
      </ol>
      </nav>
  </div>

  

  <!-- // Validasi PHP untuk Hapus Pesanan -->
    <?php
    if (isset($_POST['hapus'])) {
        // Hapus detail pesanan terlebih dahulu
        $queryDeleteDetail = "DELETE FROM detail_pesanan WHERE id_pesanan = '$id_pesanan'";
        mysqli_query($con, $queryDeleteDetail);

        // Hapus pesanan dari tabel pesanan
        $queryDeletePesanan = "DELETE FROM pesanan WHERE id_pesanan = '$id_pesanan'";
        $result = mysqli_query($con, $queryDeletePesanan);

        if ($result) {
            echo '<div class="container alert alert-success text-center mt-3">Pesanan berhasil dihapus</div>';
            echo '<meta http-equiv="refresh" content="1; url=pesanan.php"/>';
        } else {
            echo '<div class="container alert alert-danger text-center mt-3">Pesanan gagal dihapus</div>';
            exit();
        }
    }
    ?>

  <!-- Detail Pesanan -->
  <div class="container my-5">
    <h2><i class="bi bi-truck"></i> Detail Pesanan No.<?php echo htmlspecialchars($pesanan['id_pesanan']); ?> (' <?php echo htmlspecialchars($pesanan['nama_pelanggan']); ?> ')</h2>
    <table class="table">
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
      <tr>
        <th>Status Pesanan</th>
        <td><?php echo htmlspecialchars($pesanan['status_name']); ?></td>
      </tr>
      <!-- Menambahkan informasi tambahan berdasarkan metode pembayaran -->
      <?php if ($pesanan['metode_pembayaran'] == 'cod') { ?>
        <tr>
          <th>Alamat Penerima</th>
          <td><?php echo htmlspecialchars($pesanan['lokasi_cod']); ?></td>
        </tr>
        <tr>
          <th>Lokasi COD</th>
          <td><?php echo htmlspecialchars($pesanan['alamat']); ?></td>
        </tr>
      <?php } ?>
      <?php if ($pesanan['metode_pembayaran'] == 'transfer_bank') { ?>
          <tr>
              <th>Nomor Rekening</th>
              <td><?php echo htmlspecialchars($pesanan['nomor_rekening']); ?></td>
          </tr>
      <?php } ?>
      <?php if ($pesanan['metode_pembayaran'] == 'e_wallet') { ?>
          <tr>
              <th>Nomor E Wallet</th>
              <td><?php echo htmlspecialchars($pesanan['nomor_wallet']); ?></td>
          </tr>
      <?php } ?>

    </table>

    <h4>Detail Produk</h4>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Nama Produk</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($detail = mysqli_fetch_assoc($resultDetail)): ?>
          <tr>
            <td><?php echo htmlspecialchars($detail['nama_produk']); ?></td>
            <td class="text-center"><?php echo (int)$detail['jumlah']; ?></td>
            <td class="text-end">Rp. <?php echo number_format($detail['harga'], 0, ',', '.'); ?></td>
            <td class="text-end">Rp. <?php echo number_format($detail['harga'] * $detail['jumlah'], 0, ',', '.'); ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <!-- Tombol Kembali dan Hapus Pesanan -->
    <div class="d-flex justify-content-start gap-1">
      <a href="pesanan.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>

      <!-- Tombol Hapus Pesanan -->
      <form method="POST" id="deleteForm" class="">
        <button type="button" onclick="confirmDelete()" class="btn btn-danger">
          <i class="bi bi-trash"></i> Hapus Pesanan
        </button>
        <input type="hidden" name="hapus">
      </form>
    </div>
  </div>

  <!-- Script Konfirmasi Hapus -->
  <script>
  function confirmDelete() {
    if (confirm("Apakah Anda yakin ingin menghapus pesanan ini?")) {
      document.getElementById("deleteForm").submit();
    }
  }
  </script>
</body>
</html>
