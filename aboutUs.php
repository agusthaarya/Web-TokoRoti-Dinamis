<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <!-- Bootstrap & Custom CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/aboutUs.css" />
    <link rel="stylesheet" href="css/main-css.css">
  <!-- AOS (Animate on Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
</head>
<body>
  <!-- Navbar -->
  <?php require 'navbar.php'?>
  <!-- Banner  -->
        <div class="mb-5">
          <div class="my-5 pt-2 banner">
          <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
              <h1 class="display-5 fw-bolder pt-5">Tentang Kami</h1>
              <div class="col-8 offset-md-2">
              </div>
            </div>
          </div>
          </div>
        </div>
  
  <!-- Tentang Kami -->
    <div class="container-fluid py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 col-md-12 px-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
            <p class="text-warning fs-5 fw-medium">// Tentang Kami</p>
            <h1 class="fw-bold display-5">
              Kami Memanggang Setiap Roti Dari Inti Hati Kami
            </h1>
            <p class="text-secondary">
              Selamat datang di <strong>ROLLIN</strong>, tempat di mana cita rasa dan kualitas menjadi prioritas utama! 
              Kami adalah usaha yang berdedikasi dalam menyajikan aneka roti, kue, dan pastry dengan bahan-bahan terbaik serta proses pembuatan yang higienis.
            </p>
            <p class="text-secondary">
              Dengan pengalaman dan kecintaan dalam dunia kuliner, kami berkomitmen untuk menghadirkan produk yang tidak hanya lezat tetapi juga sehat dan berkualitas. 
              Setiap roti dan kue kami dibuat dengan cita rasa khas yang cocok untuk menemani momen spesial Anda, baik untuk sarapan, camilan, atau perayaan istimewa.
            </p>
            <!-- List Keunggulan -->
            <div class="row row-cols-2 g-3">
                <div class="col d-flex align-items-center">
                    <i class="bi bi-star-fill fs-3 text-warning me-2"></i>
                    <span class="fs-5">Kualitas Produk</span>
                </div>
                <div class="col d-flex align-items-center">
                    <i class="bi bi-palette fs-3 text-warning me-2"></i>
                    <span class="fs-5">Kostum Produk</span>
                </div>
                <div class="col d-flex align-items-center">
                    <i class="bi bi-truck fs-3 text-warning me-2"></i>
                    <span class="fs-5">Pengiriman Kerumah</span>
                </div>
                <div class="col d-flex align-items-center">
                    <i class="bi bi-cart-check fs-3 text-warning me-2"></i>
                    <span class="fs-5">Pemesanan Online</span>
                </div>
            </div>
            <!-- Tombol Read More -->
            <div class="mt-4">
              <a href="aboutUs.php" class="btn btn-warning zoom-transition text-white rounded-5 fs-5">Read More<i class="bi bi-arrow-right ms-2"></i></a>
            </div>
          </div>
          <!-- Bagian Gambar -->
          <div class="col-lg-5 col-md-12 text-center" data-aos="fade-up" data-aos-duration="1300">
            <img class="img-fluid rounded-4 mt-4 mt-lg-0" src="asset/about.PNG" style="max-height: 70vh;" alt="Tentang Kami">
          </div>
        </div>
      </div>
    </div>
  <!-- footer -->
  <?php require 'footer.php' ?>
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