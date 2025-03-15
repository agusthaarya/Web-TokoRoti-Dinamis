<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ROLLIN. | BAKERY</title>
    <!-- Bootstrap & Custom CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/home.css" />
      <link rel="stylesheet" href="css/main-css.css">
    <!-- AOS (Animate on Scroll) -->
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
</head>
<body class="body-font">

    <!-- Navbar-->
      <?php require "navbar.php" ?>

    <!-- Banner -->
      <div class="container-fluid banner">
          <div class="container my-5 banner-content d-flex align-items-center">
              <div class="text-start mx-5 col-lg-6 col-sm-12">
                  <h1 class="fw-bolder text-warning" data-aos="fade-down" data-aos-duration="1500">
                  <i class="bi bi-shop mx-2"></i>ROLLIN. | BAKERY
                  </h1>
                  <p class="d-none d-md-block">
                      Rollin Bakery adalah tempat yang menyajikan berbagai roti dan kue segar dengan bahan pilihan. Menyediakan beragam jenis roti, kue manis, dan pilihan diet khusus, Rollin Bakery selalu menjaga kualitas dan rasa untuk memberikan pengalaman yang memuaskan bagi pelanggan.
                  </p>
                  <div>
                      <button type="button" class="btn btn-light rounded-4 mx-2 fs-5 zoom-transition">
                      <a href="cart.php" class="text-decoration-none text-black"><i class="bi bi-cart"></i> Pesan</a>
                      </button>
                      <button type="button" class="btn btn-outline-warning rounded-4 mx-2 fs-5 zoom-transition">
                      <a href="produk.php" class="text-decoration-none text-white"><i class="bi bi-list"></i> Menu</a>
                      </button>
                  </div>
              </div>
              <div class="col-lg-6 col-sm-12">
                  <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-inner">
                          <div class="carousel-item active">
                              <img src="asset/Banner-item-1.png" class="d-block w-100" alt="Banner 1" />
                          </div>
                          <div class="carousel-item">
                              <img src="asset/banner-item-3.png" class="d-block w-100" alt="Banner 2" />
                          </div>
                          <div class="carousel-item">
                              <img src="asset/banner-item-4.png" class="d-block w-100" alt="Banner 3" />
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

    <!-- Rating -->
      <div class="container pt-5 pb-5">
        <div class="row text-center g-4">
          <!-- Experience -->
          <div class="col-lg-3 col-md-6">
            <div class="rounded-4 p-4 rating-section " data-aos="zoom-in" data-aos-duration="1000">
              <div class="text-warning">
                <i class="bi bi-award-fill" style="font-size: 65px"></i>
              </div>
              <p class="fs-5 fw-bold mt-3">Pengalaman</p>
              <div class="fs-4 fw-bold text-secondary rating-section-number" data-target="20">0 Tahun+</div>
            </div>
          </div>
          <!-- Professionals -->
          <div class="col-lg-3 col-md-6">
            <div class="rounded-4 p-4 rating-section" data-aos="zoom-in" data-aos-duration="1500">
              <div class="text-warning">
                <i class="bi bi-people-fill" style="font-size: 65px"></i>
              </div>
              <p class="fs-5 fw-bold mt-3">Professionals</p>
              <div class="fs-4 fw-bold text-secondary rating-section-number" data-target="165">0 +</div>
            </div>
          </div>
          <!-- Products -->
          <div class="col-lg-3 col-md-6">
            <div class="rounded-4 p-4 rating-section" data-aos="zoom-in" data-aos-duration="2000">
              <div class="text-warning">
                <i class="bi bi-box-fill" style="font-size: 65px"></i>
              </div>
              <p class="fs-5 fw-bold mt-3">Produk</p>
              <div class="fs-4 fw-bold text-secondary rating-section-number" data-target="135">0 +</div>
            </div>
          </div>
          <!-- Order Everyday -->
          <div class="col-lg-3 col-md-6">
            <div class="rounded-4 p-4 rating-section" data-aos="zoom-in" data-aos-duration="2500">
              <div class="text-warning">
                <i class="bi bi-cart-check-fill" style="font-size: 65px"></i>
              </div>
              <p class="fs-5 fw-bold mt-3">Pesanan</p>
              <div class="fs-4 fw-bold text-secondary rating-section-number" data-target="1682">0 +</div>
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

    <!-- Social Media dan Kategori -->
      <div class="container-fluid" style="margin-top: 150px; background-color: #fdf4eb">
        <!-- Social Media -->
          <div class="container mb-5" style="color: rgb(255, 255, 255)" data-aos="fade-up" data-aos-duration="1000">
            <div class="container">
              <div class="row social-media rounded-bottom-4">
                <h1 class="col-8 fw-bolder py-3 px-5" style="font-size: 60px">
                  Temukan Toko Roti Terbaik Di Kota Anda
                </h1>
                <div class="col-4 social-media-item">
                  <div class="row">
                    <p class="col-12 fs-1 text-center py-3 ">Hubungi Kami</p>
                    <div class="d-flex justify-content-evenly">
                    <a class=" text-decoration-none text-white textDanger-emphasis-animation" href=""><i class="bi bi-instagram fs-1"></i></a>
                    <a class=" text-decoration-none text-white textSuccess-animation" href=""><i class="bi bi-whatsapp fs-1"></i></a>
                    <a class=" text-decoration-none text-white textPrimary-animation" href=""><i class="bi bi-facebook fs-1"></i></a>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- Social Media -->

        <!-- Kategori -->
        <div class="container py-5">
          <div data-aos="fade-up" data-aos-duration="1000">
            <p class="text-center fs-5 text-warning">// Bakery Produk</p>
            <h1 class="text-center fs-1 fw-bold mb-5">
              Jelajahi Kategori <br />
              Produk Roti Kami
            </h1>
          </div>
          <div class="col-12">
            <div class="row">
              <!-- Card Kategori 1 -->
              <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="1000">
                <div class="card border-0 shadow-sm">
                  <img src="images/xScPUQ40e6KoIbGvnWaR.jpg" class="card-img-top fix-size" alt="Roti Tawar">
                  <div class="card-body text-center">
                    <h5 class="card-title text-warning">Pastry</h5>
                    <p class="card-text text-secondary">Nikmati roti berlapis gurih setiap hari!</p>
                    <a href="produk.php?kategori=Pastry" class="btn btn-warning zoom-transition">Lihat Produk</a>
                  </div>
                </div>
              </div>

              <!-- Card Kategori 2 -->
              <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="1300">
                <div class="card border-0 shadow-sm">
                  <img src="images/T3IUPXxNCodJFmcqRBOs.jpg" class="card-img-top fix-size" alt="Roti Manis">
                  <div class="card-body text-center">
                    <h5 class="card-title text-warning">Brownies</h5>
                    <p class="card-text text-secondary">Brownies yang lembut dan lumer dimulut!</p>
                    <a href="produk.php?kategori=Brownies"  class="btn btn-warning zoom-transition">Lihat Produk</a>
                  </div>
                </div>
              </div>

              <!-- Card Kategori 3 -->
              <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="1600">
                <div class="card border-0 shadow-sm">
                  <img src="images/Rk4NH9qF5CJOh2TvZQoL.jpg" class="card-img-top fix-size" alt="Roti Isi">
                  <div class="card-body text-center">
                    <h5 class="card-title text-warning">Cookies</h5>
                    <p class="card-text text-secondary">Rasakan cookie dengan rasa gurih!</p>
                    <a href="produk.php?kategori=Cookies" class="btn btn-warning zoom-transition">Lihat Produk</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Kategori -->

      </div>

    <!-- Service -->
      <div class="container-fluid service py-5 my-5">
        <div class="col-12 container">
          <div class="row">
            <div class="col-5 service-img mx-auto pt-5 rounded-3" data-aos="fade-up" data-aos-duration="1000">
              <img src="asset/Service.PNG" alt="" style="height: 63vh" />
            </div>
            <div class="col-6" data-aos="fade-up" data-aos-duration="1000">
              <p class="fs-5 fw-medium text-center text-warning">
                // Layanan kami
              </p>
              <p class="fs-1 fw-bold text-center" data-aos="fade-up" data-aos-duration="1000">
                Apa yang Kami Tawarkan Untuk Anda?
              </p>
              <div class="accordion" id="accordionExample">
                <div class="accordion-item" data-aos="fade-up" data-aos-duration="1000">
                  <h2 class="accordion-header">
                    <button class="accordion-button fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <i class="bi bi-award-fill me-2 text-warning"></i>Kualitas Terbaik di ROLLIN
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-secondary">
                      Di <strong>ROLLIN</strong>, kami menghadirkan roti, kue, dan pastry berkualitas tinggi dengan bahan pilihan,
                      proses higienis, dan cita rasa autentik.
                    </div>
                  </div>
                </div>
                <div class="accordion-item" data-aos="fade-up" data-aos-duration="1200">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <i class="bi bi-heart-fill me-2 text-danger"></i>Nikmati Kelezatan Autentik di ROLLIN  
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-secondary">
                      Setiap gigitan roti, kue, dan pastry di <strong>ROLLIN</strong> menghadirkan perpaduan rasa yang lembut,
                      manis, dan gurih.
                    </div>
                  </div>
                </div>
                <div class="accordion-item" data-aos="fade-up" data-aos-duration="1400">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      <i class="bi bi-cash-stack me-2 text-success"></i>Harga Terjangkau, Kualitas Tetap Premium
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-secondary">
                      Di <strong>ROLLIN</strong>, Anda bisa menikmati bakery berkualitas tinggi dengan harga yang ramah di kantong.
                      Lezat, fresh, dan tetap hemat!
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <!-- Team -->
      <div class="container py-5">
        <div data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
          <p class="text-center fs-5 text-warning">// Tim Kami</p>
          <h1 class="text-center fs-1 fw-bold mb-5">Kami Super Profesional<br />Sesuai Keahlian Kami</h1>
        </div>
        
        <div class="row g-4">
          <!-- Team Member 1 -->
          <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="1000">
            <div class="card border-0 rounded-3 overflow-hidden">
              <img src="asset/tim-1.jpg" class="card-img-top fixSize-Foto" alt="ajus" />
              <div class="card-body text-center">
                <h5 class="card-title fs-2 fw-bold">Ajus</h5>
                <p class="fs-4 text-muted"><i class="bi bi-basket2-fill text-warning"></i> Beker</p>
              </div>
            </div>
          </div>
          
          <!-- Team Member 2 -->
          <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="1200">
            <div class="card border-0 rounded-3 overflow-hidden">
              <img src="asset/tim-2.jpg" class="card-img-top fixSize-Foto" alt="Putra" />
              <div class="card-body text-center">
                <h5 class="card-title fs-2 fw-bold">Putra</h5>
                <p class="fs-4 text-muted"><i class="bi bi-basket2-fill text-warning"></i> Beker</p>
              </div>
            </div>
          </div>
          
          <!-- Team Member 3 -->
          <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="1400">
            <div class="card border-0 rounded-3 overflow-hidden">
              <img src="asset/tim-3.jpg" class="card-img-top fixSize-Foto" alt="Suyasa" />
              <div class="card-body text-center">
                <h5 class="card-title fs-2 fw-bold">Suyasa</h5>
                <p class="fs-4 text-muted"><i class="bi bi-cup-hot-fill text-danger"></i> Pâtissier</p>
              </div>
            </div>
          </div>
          
          <!-- Team Member 4 -->
          <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="1600">
            <div class="card border-0 rounded-3 overflow-hidden">
              <img src="asset/tim-4.jpg" class="card-img-top fixSize-Foto" alt="Suyasa" />
              <div class="card-body text-center">
                <h5 class="card-title fs-2 fw-bold">Angga</h5>
                <p class="fs-4 text-muted"><i class="bi bi-cup-hot-fill text-success"></i> Pastry</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    <!-- Ulasan Pelanggan dan Subscribe -->
      <div class="container-fluid py-5" style=" background-color: #fdf4eb">
        <!-- Ulasan Pelanggan -->
        <div class="container py-5">
          <div data-aos="fade-up" data-aos-duration="1000">
            <p class="fs-5 text-warning text-center">// Ulasan Klien</p>
            <h1 class="text-center fw-bold mb-5 ">
              Lebih dari 20.000+ <br />Pelanggan Mempercayai Kami
            </h1>
          </div>
          <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1300">
              <div id="testimonialCarousel" class="carousel slide rounded-4 shadow-sm p-4 bg-white" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div class="text-center position-relative p-4">
                      <i class="bi bi-quote display-4 text-warning position-absolute top-0 start-0 ms-3 mt-3"></i>
                      <img src="https://randomuser.me/api/portraits/women/32.jpg" class="rounded-circle mb-3" width="80" height="80" alt="Avatar" />
                      <h5>Mike Tyson</h5>
                      <p class="text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                      </p>
                      <p class="lead">"Enak Banget Buat Nemening Ngopi 😆"</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="text-center position-relative p-4">
                      <i class="bi bi-quote display-4 text-warning position-absolute top-0 start-0 ms-3 mt-3"></i>
                      <img src="https://randomuser.me/api/portraits/men/47.jpg" class="rounded-circle mb-3" width="80" height="80" alt="Avatar" />
                      <h5>John Cena</h5>
                      <p class="text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                      </p>
                      <p class="lead">"Rasa Rotinya Bikin Nostalgia Waktu Kecil 🥰"</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="text-center position-relative p-4">
                      <i class="bi bi-quote display-4 text-warning position-absolute top-0 start-0 ms-3 mt-3"></i>
                      <img src="https://randomuser.me/api/portraits/women/65.jpg" class="rounded-circle mb-3" width="80" height="80" alt="Avatar" />
                      <h5>Prabowo</h5>
                      <p class="text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                      </p>
                      <p class="lead">"Roti-nya Enak Banget, Lumer Dimulut 🤤"</p>
                    </div>
                  </div>
                </div>
                <!-- Tombol Navigasi -->
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                  <i class="bi bi-arrow-left-circle-fill display-4 text-dark"></i>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                  <i class="bi bi-arrow-right-circle-fill display-4 text-dark"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- Ulasan Pelanggan End -->


        <!-- Subscribe -->
          <div class="container py-5 text-white text-center rounded-4" data-aos="fade-up" data-aos-duration="1000" style="background-color: #eaa637 !important;">
            <h1 class="fw-bolder">Berlangganan Buletin Kami</h1>
            <p class="lead">Dapatkan update terbaru dan promo menarik langsung ke email Anda.</p>
            <div class="row justify-content-center">
              <div class="col-md-6">
                <form>
                  <div class="input-group">
                    <input type="email" class="form-control" placeholder="Masukkan Email Anda" required />
                    <button class="btn btn-warning text-white" type="submit">Sign Up</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <!-- Subscribe End -->
      </div>

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
