<?php
  require "koneksi.php";

  $nama = htmlspecialchars($_GET['nama']);
  $queryProduk = mysqli_query($con, "SELECT * FROM product WHERE nama='$nama'");
  $produk = mysqli_fetch_array($queryProduk);

  $queryRekomendasiProduk = mysqli_query($con, "SELECT * FROM product WHERE kategori_id='$produk[kategori_id]
  'AND id!='$produk[id]' LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Bootstrap Icons -->
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
    rel="stylesheet"
    />
  <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main-css.css">
    <link rel="stylesheet" href="css/produk.css" />
</head>

<!-- Style CSS -->
  <style>
    .product-img {
            height: 350px;
            object-fit: cover;
            border-radius: 10px;
        }
    .quantity-input {
            width: 60px;
            text-align: center;
        }
    .card:hover {
            transform: scale(1.05);
            transition: 0.3s;
        }
    .card-img-top {
            height: 200px;
            object-fit: cover;
        }
  </style>

<body class="body-font bg-light">
    <!-- Navbar-->
      <?php require "navbar.php"?>
  
    <!-- Detail Produk -->
      <div class="container-fluid py-5" style="margin-top:30px;">
          <!-- Breadcrumb -->
          <div class="container">
            <nav aria-label="breadcrumb" class="pt-5">
              <ol class="breadcrumb">
                <li class="breadcrumb-item fs-5"><a href="produk.php" class="text-decoration-none text-dark textWarning-animation"><i class="bi bi-cart fs-5 mx-2"></i>Menu</a></li>
                <li class="breadcrumb-item text-warning fs-5" aria-current="page">Detail Produk</li>
              </ol>
            </nav>
          </div>
        <!-- Produk -->
        <div class="container">
          <div class="row "> 
            <div class="col-md-5">
            <img class="card-img-top fixed-size rounded" 
                src="images/<?php echo $produk['foto']; ?>" 
                alt="Produk <?php echo htmlspecialchars($produk['nama'], ENT_QUOTES, 'UTF-8'); ?>" 
                style="width: 100%; height: 50vh;" />
            </div>
            <div class="col-md-6 offset-md-1">
              <h1><?php echo $produk['nama']?></h1>
              <p class="fs-4 text-warning">Rp. <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
              <p class="fs-5"><?php echo $produk['detail']?></p>
              <p class="fs-5">Stok : <strong><?php echo $produk['stok']?></p>
              <form action="cart.php" method="POST">
                  <input type="hidden" name="nama" value="<?php echo $produk['nama']; ?>">
                  <input type="hidden" name="harga" value="<?php echo $produk['harga']; ?>">
                  <input type="hidden" name="foto" value="<?php echo $produk['foto']; ?>">
                  <a href="produk.php" class="btn btn-primary btn-sm fs-5">
                  <i class="bi bi-arrow-left"></i> Kembali
                  </a>
                  <button type="submit" name="add_to_cart" class="btn btn-outline-success btn-sm fs-5">
                      <i class="bi bi-cart-plus fs-5"></i> Tambah
                  </button>
              </form>
            </div>
          </div>
        </div>
      </div>

    <!-- Produk Terkait -->
      <div class="container py-5 bg-light">
        <h2 class="text-center mb-5"><i class="bi bi-heart-fill text-danger"></i> Produk Terkait</h2>
        <div class="row">
          <?php while ($data = mysqli_fetch_array($queryRekomendasiProduk)) { ?>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card border-0 shadow-sm">
                <img src="images/<?php echo $data['foto']; ?>" alt="Produk <?php echo htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8'); ?>" 
                    class="card-img-top rounded">
                <div class="card-body text-center">
                  <h5 class="fw-bold"><?php echo $data['nama']; ?></h5>
                  <p class="text-danger fw-bold">Rp. <?php echo number_format($data['harga'], 0, ',', '.'); ?></p>
                  <a href="produkDetail.php?nama=<?php echo $data['nama']; ?>" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye"></i> Lihat Detail
                  </a>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>

    <!-- footer -->
      <?php require "footer.php"?>

    <!-- script -->
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/main-script.js"></script>
      <script>
      AOS.init();
      </script>
</body>
</html>