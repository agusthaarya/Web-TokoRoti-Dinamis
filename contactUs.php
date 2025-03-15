<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Bootstrap & Custom CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/contactUs.css" />
    <link rel="stylesheet" href="css/main-css.css">

  <!-- AOS (Animate on Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

  <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" /> 
</head>
<!-- Style CSS -->
  <style>
  .mapouter {
    position: relative;
    text-align: center;
    width: 100%; /* Membuat lebar peta mengikuti lebar layar */
    height: 500px; /* Anda bisa sesuaikan tinggi sesuai kebutuhan */
  }
  .gmap_canvas {
    overflow: hidden;
    background: none !important;
    width: 100%; /* Membuat canvas peta ikut lebar layar */
    height: 100%; /* Membuat canvas peta ikut tinggi div mapouter */
  }
  </style>

<body class="body-font bg-light">

    <!-- Navbar -->
      <?php require "navbar.php" ?>

    <!-- Banner  -->
      <div class="mb-5">
        <div class="my-5 pt-2 banner">
        <div class="container px-4 px-lg-5 my-5">
          <div class="text-center text-white">
            <h1 class="display-5 fw-bolder pt-5">Hubungi Kami</h1>
            <div class="col-8 offset-md-2">
            </div>
          </div>
        </div>
        </div>
      </div>

    <!-- Contact Us  -->
      <div class="container">
        <p class="text-center text-warning fs-5 fw-medium">// Hubungi Kami</p>
        <h1 class="text-center fw-bold display-5 mb-4">Jika Anda Memiliki Pertanyaan,<br> Silakan Hubungi Kami</h1>       
        <p class="col-8 offset-2 text-center pt-3 ">
          Kami siap membantu Anda! Jika Anda memiliki pertanyaan, masukan, atau memerlukan informasi lebih lanjut, jangan ragu untuk menghubungi kami. Tim kami akan dengan senang hati merespons setiap pertanyaan Anda secepat mungkin.
        </p>          
        <!-- Contact Form  -->
        <section class="">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <div class="contact-form p-5 shadow-sm bg-white rounded">
                  <form>
                    <div class="row g-3">
                      <!-- Name Field -->
                      <div class="col-md-6">
                        <div class="input-group">
                          <span class="input-group-text"><i class="bi bi-person"></i></span>
                          <input type="text" class="form-control" placeholder="Your Name" required>
                        </div>
                      </div>
                      
                      <!-- Email Field -->
                      <div class="col-md-6">
                        <div class="input-group">
                          <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                          <input type="email" class="form-control" placeholder="Your Email" required>
                        </div>
                      </div>

                      <!-- Subject Field -->
                      <div class="col-12">
                        <div class="input-group">
                          <span class="input-group-text"><i class="bi bi-tag"></i></span>
                          <input type="text" class="form-control" placeholder="Subject" required>
                        </div>
                      </div>

                      <!-- Message Field -->
                      <div class="col-12">
                        <div class="input-group">
                          <span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
                          <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
                        </div>
                      </div>

                      <!-- Submit Button -->
                      <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">
                          <i class="bi bi-send"></i> Send Message
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

    <!-- Section Media Sosial -->
      <section class="container text-center my-5">
        <div class="d-flex flex-wrap justify-content-center gap-3">
          <a href="https://wa.me/6281234567890" class="social-btn wa text-white text-decoration-none">
            <i class="bi bi-whatsapp"></i> WhatsApp
          </a>
          <a href="https://instagram.com/yourusername" class="social-btn ig text-white text-decoration-none">
            <i class="bi bi-instagram"></i> Instagram
          </a>
          <a href="https://facebook.com/yourusername" class="social-btn fb text-white text-decoration-none">
            <i class="bi bi-facebook"></i> Facebook
          </a>
        </div>
      </section>

    <!-- Peta -->
      <div class="mapouter mb-5 mt-5">
        <div class="gmap_canvas">
          <iframe width="100%" height="400" id="gmap_canvas" 
            src="https://maps.google.com/maps?q=br.pandak+bandung+btn+kodam&t=&z=13&ie=UTF8&iwloc=&output=embed" 
            frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
          </iframe>
        </div>
      </div>
    <!-- Footer -->
      <?php require "footer.php" ?>
    
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