<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar</title>
  <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<!-- Style -->
  <style>
    /* Warna teks menu aktif */
    .active-page {
      color: #ffc107 !important; /* Kuning */
      font-weight: bold;
    }
  </style>
<body>
  <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3">
      <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
            <li class="nav-item">
              <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active-page' : ''; ?>" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo ($current_page == 'kategori.php') ? 'active-page' : ''; ?>" href="kategori.php">Kategori</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo ($current_page == 'produk.php') ? 'active-page' : ''; ?>" href="produk.php">Produk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo ($current_page == 'pesanan.php') ? 'active-page' : ''; ?>" href="pesanan.php">Pesanan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger <?php echo ($current_page == 'logout.php') ? 'active-page' : ''; ?>" href="logout.php" onclick="return confirmLogout()">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

  <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Script -->
    <script>
      function confirmLogout() {
        // Menampilkan dialog konfirmasi
        var result = confirm("Apakah Anda yakin ingin logout?");
        if (result) {
          // Jika pengguna klik "OK", lanjutkan ke halaman logout.php
          window.location.href = "logout.php";
        } else {
          // Jika pengguna klik "Cancel", batalkan dan tetap di halaman ini
          return false;
        }
      }
    </script>
</body>
</html>