<?php
  session_start(); // Pastikan session dimulai di semua halaman

  // Hitung total item dalam keranjang
  $totalItem = 0;
  if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
      foreach ($_SESSION['cart'] as $item) {
          $totalItem += $item['qty']; // Menjumlahkan semua qty
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
<?php 
  $currentPage = basename($_SERVER['PHP_SELF']); // Mendapatkan nama file halaman saat ini
?>
  <!-- Navbar -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
      <div class="container-fluid">
        <h2 class="text-warning fw-bolder mx-3 my-3 logo-navbar"><i class="bi bi-shop px-2"></i>ROLLIN.</h2>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link navbar-brand textWarning-animation <?php echo ($currentPage == 'home.php') ? 'text-warning' : ''; ?>" 
                href="home.php">Home</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link navbar-brand textWarning-animation <?php echo ($currentPage == 'aboutUs.php') ? 'text-warning' : ''; ?>" 
                href="aboutUs.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link navbar-brand textWarning-animation <?php echo ($currentPage == 'produk.php') ? 'text-warning' : ''; ?>" 
                href="produk.php">Product</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link navbar-brand textWarning-animation <?php echo ($currentPage == 'contactUs.php') ? 'text-warning' : ''; ?>" 
                href="contactUs.php">Contact Us</a>
            </li>
            <li class="nav-item position-relative">
                <a href="cart.php" class="text-decoration-none <?php echo ($currentPage == 'cart.php') ? 'text-warning' : ''; ?>">
                    <!-- Ikon Cart dengan animasi dan warna aktif -->
                    <i class="bi bi-cart-fill textWarning-animation fs-4 <?php echo ($currentPage == 'cart.php') ? 'text-warning' : 'text-white'; ?>"></i>
                    <!-- Badge untuk menampilkan jumlah item dalam keranjang -->
                    <?php if ($totalItem > 0): ?>
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                            <?php echo $totalItem; ?>
                        </span>
                    <?php endif; ?>
                </a>
            </li>

            <!-- Navbar untuk pengguna yang sudah login -->
            <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
              <li class="nav-item mx-3">
                <a href="logout.php" class="nav-link navbar-brand text-white textDanger-animation" onclick="return confirmLogout()">
                  <i class="bi bi-box-arrow-right"></i> Logout
                </a>
              </li>
            <?php else: ?>
              <!-- Navbar untuk pengguna yang belum login -->
              <li class="nav-item mx-3">
                <a href="login.php" class="nav-link navbar-brand text-white textWarning-animation">
                  <i class="bi bi-person-fill"></i> Login
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  <!-- Navbar -->
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
