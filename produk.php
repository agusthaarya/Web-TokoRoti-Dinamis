<?php
  require "koneksi.php";
  $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

  // Pagination setup
  $limit = 9;
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $start = ($page - 1) * $limit;

  // Get produk by nama produk/keyword
  if(isset($_GET['keywoard'])){
    $keywoard = mysqli_real_escape_string($con, $_GET['keywoard']);
    $queryProduk = mysqli_query($con, "SELECT * FROM product WHERE nama LIKE '%$keywoard%' LIMIT $start, $limit");
    $totalProduk = mysqli_num_rows(mysqli_query($con, "SELECT * FROM product WHERE nama LIKE '%$keywoard%'"));
  }
  // Get produk by kategori
  else if(isset($_GET['kategori'])){
    $kategori = mysqli_real_escape_string($con, $_GET['kategori']);
    $queryGetKategoriId = mysqli_query($con, "SELECT id FROM kategori WHERE nama='$kategori'");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId)['id'];
    $queryProduk = mysqli_query($con, "SELECT * FROM product WHERE kategori_id='$kategoriId' LIMIT $start, $limit");
    $totalProduk = mysqli_num_rows(mysqli_query($con, "SELECT * FROM product WHERE kategori_id='$kategoriId'"));
  }
  // Get produk default
  else{
    $queryProduk = mysqli_query($con, "SELECT * FROM product LIMIT $start, $limit");
    $totalProduk = mysqli_num_rows(mysqli_query($con, "SELECT * FROM product"));
  }

  $totalPages = ceil($totalProduk / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu</title>
    <!-- Bootstrap & Custom CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <link rel="stylesheet" href="css/produk.css" />
      <link rel="stylesheet" href="css/main-css.css">

    <!-- AOS (Animate on Scroll) -->
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
</head>
<body class="body-font bg-light">
    <!-- Navbar-->
      <?php require "navbar.php"?>
    <!-- Banner-->
      <div class="mb-5">
        <div class="my-5 pt-2 banner">
        <div class="container px-4 px-lg-5 my-5">
          <div class="text-center text-white">
            <h1 class="display-5 fw-bolder pt-5">Temukan Kelezatan dalam Setiap Gigitan</h1>
            <div class="col-8 offset-md-2">
            <form method="get" action="produk.php">
              <div class="input-group input-group-lg my-4">
                <input type="text" class="form-control" placeholder="Cari Produk" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keywoard" autocomplete="off">
                <button type="submit" class="btn btn-primary">Cari</button>
              </div>
            </form>
            </div>
          </div>
        </div>
        </div>
      </div>

    <!-- List Group  -->
      <p class="fs-5 fw-medium text-center text-warning">// Menu Kami</p>
      <div class="container py-5">
      <div class="row">
       <!-- Sidebar Kategori -->
        <div class="col-lg-3">
          <h4 class="fw-bold mb-3"><i class="bi bi-list"></i> Kategori</h4>
          <ul class="list-group">
              <!-- Tambahkan pilihan "Tampil Semua" -->
              <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center bgWarning-animation
                  <?php echo (!isset($_GET['kategori']) ? 'active' : ''); ?>" 
                  href="produk.php">
                  - Tampil Semua -
              </a>
              <?php while ($kategori = mysqli_fetch_array($queryKategori)) { 
                  $kategori_id = $kategori['id'];
                  $queryCount = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM product WHERE kategori_id = '$kategori_id'");
                  $countData = mysqli_fetch_assoc($queryCount)['jumlah'];
                  
                  // Cek apakah kategori ini yang sedang dipilih
                  $isActive = (isset($_GET['kategori']) && $_GET['kategori'] == $kategori['nama']) ? 'active' : '';
              ?>
                  <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center bgWarning-animation <?php echo $isActive; ?>"
                      href="produk.php?kategori=<?php echo urlencode($kategori['nama']); ?>">
                      <?php echo htmlspecialchars($kategori['nama'], ENT_QUOTES, 'UTF-8'); ?>
                      <span class="badge bg-primary rounded-pill"><?php echo $countData; ?></span>
                  </a>
              <?php } ?>
          </ul>
        </div>

        <!-- Produk -->
        <div class="col-lg-9">
          <h4 class="text-center fw-bold"><i class="bi bi-basket"></i> Produk Kami</h4>
          <div class="row">
            <?php 
            if ($totalProduk < 1) { 
                echo '<div class="alert alert-danger text-center mt-3" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i> Produk Tidak Tersedia
                      </div>';
            }
            ?>

            <?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <img src="images/<?php echo $produk['foto']; ?>" class="card-img-top rounded-top fix-size" 
                              alt="Produk <?php echo htmlspecialchars($produk['nama'], ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo $produk['nama']; ?></h5>
                            <p class="card-text text-muted text-truncate"><?php echo $produk['detail']; ?></p>
                            <h6 class="text-warning fw-bold">Rp. <?php echo number_format($produk['harga'], 0, ',', '.'); ?></h6>
                            <div class="d-flex justify-content-start gap-2">
                                <a href="produkDetail.php?nama=<?php echo $produk['nama']; ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <form action="cart.php" method="POST">
                                    <input type="hidden" name="nama" value="<?php echo $produk['nama']; ?>">
                                    <input type="hidden" name="harga" value="<?php echo $produk['harga']; ?>">
                                    <input type="hidden" name="foto" value="<?php echo $produk['foto']; ?>">
                                    <button type="submit" name="add_to_cart" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-cart-plus"></i> Tambah
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              <?php } ?>
          </div>
        </div>
      </div>
      </div>

    <!-- Pagination -->
      <nav class="mb-5">
        <ul class="pagination justify-content-center">
          <!-- Tombol Previous -->
          <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?php echo max(1, $page - 1); ?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>

          <!-- Nomor Halaman -->
          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
              <a class="page-link" href="?page=<?php echo $i; ?>"> <?php echo $i; ?> </a>
            </li>
          <?php endfor; ?>

          <!-- Tombol Next -->
          <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?php echo min($totalPages, $page + 1); ?>" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>

    <!-- footer -->
      <?php require "footer.php"?>

    <!-- script -->
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/main-script.js"></script>
      <script src="js/counterUp.js"></script>
      <script>
        AOS.init();
      </script>
</body>
</html>
