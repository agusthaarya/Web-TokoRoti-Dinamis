<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main-css.css">
  <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
  <!-- From Login -->
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
      <div class="card p-4" style="width: 400px;">
        <h3 class="text-center fw-bold"><i class="bi bi-person-circle"></i> Login</h3>
        <p class="text-center text-muted">Masukkan username dan password</p>
        <form action="" method="post" autocomplete="off">
              <div class="mb-3">
                <label for="username" class="form-label">Username :</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                  <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required>
                </div>
              </div>
              
              <div class="mb-3">
                <label for="password" class="form-label">Password :</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                </div>
              </div>
              <div class="text-center">
              <a href="home.php" class="btn btn-primary">
              <i class="bi bi-arrow-left"></i> Kembali
              </a>
              <button class="btn btn-outline-primary" type="submit" name="loginbtn">
                <i class="bi bi-box-arrow-in-right"></i> Login
              </button>
              </div>
          </form>


        <div class="mt-3 text-center">
          <!-- Display errors -->
          <?php
          require "koneksi.php";

          if (isset($_POST['loginbtn'])) {
              // Fetch and sanitize form data
              $username = htmlspecialchars($_POST['username']);
              $password = htmlspecialchars($_POST['password']);

              // Query to find user by username
              $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
              
              if ($query) {
                  $countdata = mysqli_num_rows($query);

                  if ($countdata > 0) {
                      // Fetch user data
                      $data = mysqli_fetch_array($query);
                      // Verify password
                      if (password_verify($password, $data['password'])) {
                          // Set session if login is successful
                          $_SESSION['username'] = $data['username'];
                          $_SESSION['login'] = true;
                          header('location: home.php'); // Redirect to home.php after successful login
                          exit();
                      } else {
                          // Password is incorrect
                          echo '<div class="alert alert-danger mt-3" role="alert"><i class="bi bi-x-circle"></i> Password Salah</div>';
                      }
                  } else {
                      // Username not found
                      echo '<div class="alert alert-danger mt-3" role="alert"><i class="bi bi-x-circle"></i> Akun Tidak Tersedia</div>';
                  }
              } else {
                  // Query error
                  echo '<div class="alert alert-danger mt-3" role="alert"><i class="bi bi-x-circle"></i> Terjadi Kesalahan dalam Pengambilan Data</div>';
              }
          }
          ?>
        </div>

        <!-- Register Button -->
        <div class="text-center mt-3">
          <p>Belum punya akun? <a href="register.php" class="btn btn-link">
          <i class="bi bi-person-plus"></i> Daftar Sekarang
          </a></p>
        </div>
      </div>
    </div>

  <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
