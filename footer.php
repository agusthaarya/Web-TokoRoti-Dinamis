<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Footer</title>
  <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
  <!-- Style CSS -->
    <style>
      footer a {
        text-decoration: none;
        transition: color 0.3s ease-in-out;
      }
      footer a:hover {
        color: #f8d210 !important;
      }
      .social-icons a {
        font-size: 20px;
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transition: background 0.3s, transform 0.2s;
      }
      .social-icons a:hover {
        background: #f8d210;
        transform: scale(1.1);
      }
    </style>

<body>
  
  <!-- Footer -->
    <footer class="text-white" style="background-color: #2C2A24;">
      <div class="container p-4">
        <div class="row">
          
          <!-- Company Info -->
          <div class="col-md-3 col-lg-3 col-xl-3 mb-4">
            <h6 class="text-uppercase fw-bold text-warning">Rollin. | Bakery</h6>
            <p>Toko Roti Terbaik Dengan Cita Rasa Yang Kaya Dan Lezat.</p>
          </div>

          <!-- Products -->
          <div class="col-md-2 col-lg-2 col-xl-2 mb-4">
            <h6 class="text-uppercase fw-bold ">Products</h6>
            <p><a href="#" class="text-white">Kue Ultah</a></p>
            <p><a href="#" class="text-white">Kue Kering</a></p>
            <p><a href="#" class="text-white">Donat</a></p>
            <p><a href="#" class="text-white">Bolu</a></p>
          </div>

          <!-- Contact -->
          <div class="col-md-4 col-lg-3 col-xl-3 mb-4">
            <h6 class="text-uppercase fw-bold">Kontak</h6>
            <p><i class="bi bi-house-door-fill me-2"></i> Kediri, Tabanan, Bali</p>
            <p><i class="bi bi-envelope-fill me-2"></i> agusthaarya@gmail.com</p>
            <p><i class="bi bi-telephone-fill me-2"></i> +64 0853 - 3964 - 3964</p>
            <p><i class="bi bi-printer-fill me-2"></i> +64 0831 - 1563 - 6000</p>
          </div>

          <!-- Social Media -->
          <div class="col-md-3 col-lg-2 col-xl-2 mb-4">
            <h6 class="text-uppercase fw-bold">Ikuti Kami</h6>
            <div class="social-icons">
              <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
              <a href="#" class="text-white"><i class="bi bi-whatsapp"></i></a>
              <a href="#" class="text-white mt-2"><i class="bi bi-instagram"></i></a>
            </div>
          </div>

        </div>
      </div>

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2024 Copyright: <a class="text-white fw-bold" href="#">agusthaarya</a>
      </div>
    </footer>
  <!-- Footer -->

  <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
