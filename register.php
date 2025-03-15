<?php
    session_start();
    require 'koneksi.php'; // Pastikan koneksi ke database sudah benar

    if (isset($_POST['registerbtn'])) {
        // Ambil input dari form dan sanitasi
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];
        $conf_password = $_POST['conf_password'];

        // Validasi jika password dan konfirmasi password tidak sama
        if ($password !== $conf_password) {
            echo '<div class="alert alert-danger" role="alert">Password dan konfirmasi password tidak cocok!</div>';
        } else {
            // Menyiapkan query untuk mencari apakah username sudah terdaftar
            $query = $con->prepare("SELECT * FROM users WHERE username = ?");
            $query->bind_param("s", $username);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {
                // Username sudah terdaftar
                echo '<div class="alert alert-danger" role="alert">Username sudah terdaftar!</div>';
            } else {
                // Enkripsi password dan simpan data pengguna
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert = $con->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                $insert->bind_param("ss", $username, $hashed_password);

                if ($insert->execute()) {
                    echo '<div class="alert alert-success" role="alert">Pendaftaran berhasil! <a href="login.php">Login</a></div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Pendaftaran gagal, coba lagi!</div>';
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <!-- CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main-css.css">
    <!-- Bootstrap Icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <!-- From Register -->
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card p-4" style="width: 400px;">
                <h3 class="text-center fw-bold mb-4"><i class="bi bi-person-circle"></i> Registrasi</h3>
                <form action="" method="post" autocomplete="off">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username :</label>
                        <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-person-circle"></i></div>
                        <input type="text" placeholder="Masukan username" class="form-control" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password :</label>
                        <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-lock"></i></div>
                        <input type="password" placeholder="Masukan password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="conf_password" class="form-label">Konfirmasi Password :</label>
                        <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                        <input type="password" placeholder="Konfirmasi password" class="form-control" id="conf_password" name="conf_password" required>   
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="login.php" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-outline-primary " name="registerbtn">
                            <i class="bi bi-person-check-fill"></i> Daftar
                        </button>

                    </div>
                </form>
                <div class="text-center mt-3">
                    <p>Sudah memiliki akun? <a href="login.php">Login di sini</a></p>
                </div>
            </div>
        </div>

    <!-- Script -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
