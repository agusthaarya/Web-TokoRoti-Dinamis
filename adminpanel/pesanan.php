<?php
  // Koneksi ke database
  require "../koneksi.php";

  // Query untuk mengambil daftar pesanan dan nama status
  $queryPesanan = "SELECT pesanan.id_pesanan, pesanan.nama_pelanggan, pesanan.total_harga, pesanan.id_status, pesanan.metode_pembayaran, status.status_name
  FROM pesanan LEFT JOIN status ON pesanan.id_status = status.id_status";
                  
  $resultPesanan = mysqli_query($con, $queryPesanan);

  // Cek jika ada pesanan
  $jumlahPesanan = mysqli_num_rows($resultPesanan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Pesanan</title>
  <!-- CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<!-- Style CSS -->
  <style>
    body{
      overflow:scroll;
    }
  </style>

<body>
    <!-- Navbar -->
      <?php require "navbar.php";?>

    <!-- Breadcrumb -->
      <div class="container mt-4">
          <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-light p-3 rounded">
              <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-dark"><i class="bi bi-house-door"></i> Home</a></li>
              <li class="breadcrumb-item active text-primary" aria-current="page">Pesanan</li>
          </ol>
          </nav>
      </div>

    <!-- List Pesanan -->
      <div class="container mt-5">
        <h2><i class="bi bi-truck"></i> Daftar Pesanan</h2>
        <div class="table-responsive mt-1">
          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <tr>
                <th>No.</th>
                <th>ID Pesanan</th>
                <th>Nama Pelanggan</th>
                <th>Total Harga</th>
                <th>Metode Pembayaran</th>
                <th>Status Pengiriman</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- PHP Menampilkan Data Pesanan -->
              <?php
              if ($jumlahPesanan == 0) {
                ?>
                <tr>
                  <td colspan="7" class="text-center">Data Pesanan Tidak Tersedia</td>
                </tr>
                <?php
              } else {
                $no = 1;
                while ($pesanan = mysqli_fetch_assoc($resultPesanan)) {
                  ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo htmlspecialchars($pesanan['id_pesanan']); ?></td>
                    <td><?php echo htmlspecialchars($pesanan['nama_pelanggan']); ?></td>
                    <td>Rp. <?php echo number_format($pesanan['total_harga'], 0, ',', '.'); ?></td>
                    <td>
                      <?php 
                        echo isset($pesanan['metode_pembayaran']) ? htmlspecialchars($pesanan['metode_pembayaran']) : 'Metode Pembayaran Tidak Tersedia';
                      ?>
                    </td>
                    <td>
                      <?php 
                        // Menampilkan nama status yang sesuai dengan id_status
                        echo isset($pesanan['status_name']) ? htmlspecialchars($pesanan['status_name']) : 'Status Tidak Tersedia';
                      ?>
                    </td>
                    <td>
                      <a href="pesanan_detail.php?id=<?php echo $pesanan['id_pesanan']; ?>" class="btn btn-info">
                        <i class="bi bi-search"></i> Detail
                      </a>
                      <a href="ubah_status.php?id=<?php echo $pesanan['id_pesanan']; ?>" class="btn btn-warning">Ubah Status</a>
                    </td>
                  </tr>
                  <?php
                  $no++;
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

    <!-- Script -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
