<?php
  session_start();
  require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<!-- CSS -->
 <style>
    .login-container {
      width: 100%;
      max-width: 400px;
      padding: 20px;
    }
    .form-control {
      height: 45px;
    }
    .input-group-text {
      background: #f0f0f0;
      border-right: 0;
    }
    .form-control:focus {
      box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
      border-color: #0d6efd;
    }
    .btn-primary {
      transition: all 0.3s;
    }
    .btn-primary:hover {
      transform: scale(1.05);
    }
  </style>
<body>
  <!-- Login Form -->
    <div class="d-flex justify-content-center align-items-center vh-100">
      <div class="login-container border rounded">
        <h3 class="text-center fw-bold"><i class="bi bi-person-circle"></i> Login Admin</h3>
        <p class="text-center text-muted">Masukkan username dan password admin</p>
        
        <form action="" method="post" autocomplete="off">
          <div class="mb-3">
            <label for="username" class="form-label">Username :</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
              <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username admin" required>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="password" class="form-label">Password :</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
              <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password admin" required>
            </div>
          </div>
          
          <button class="btn btn-primary w-100 mt-3" type="submit" name="loginbtn">
            <i class="bi bi-box-arrow-in-right"></i> Login
          </button>
        </form>

        <div class="mt-3">
          <?php
    if (isset($_POST['loginbtn'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        // Cek apakah username adalah "admin"
        if ($username === "admin" && $password === "kububali12") {
            $_SESSION['username'] = $username;
            $_SESSION['login'] = true;
            
            echo '<div class="alert alert-success text-center mt-2"><i class="bi bi-check-circle"></i> Login berhasil! Mengalihkan...</div>';
            echo '<script>setTimeout(() => { window.location.href = "index.php"; }, 1000);</script>';
            exit();
        } else {
            echo '<div class="alert alert-danger text-center mt-2"><i class="bi bi-x-circle"></i> Username atau Password Salah</div>';
        }
    }
    ?>

        </div>
    </div>

  <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
