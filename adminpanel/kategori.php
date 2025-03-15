<?php
  require "session.php";
  require "../koneksi.php";

  // Query kategori
  $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

  // Pastikan variabel diinisialisasi untuk menghindari warning
  $jumlahKategori = ($queryKategori) ? mysqli_num_rows($queryKategori) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Kategori</title>
  <!-- CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.min.css">
</head>
<body>
  <!-- Navbar -->
    <?php require "navbar.php"; ?>

  <!-- Breadcrumb -->
    <div class="container mt-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-3 rounded">
          <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-dark"><i class="bi bi-house-door"></i> Home</a></li>
          <li class="breadcrumb-item active text-primary" aria-current="page">Kategori</li>
        </ol>
      </nav>
    </div>

  <!-- Validasi PHP Tambah Kategori -->
    <?php
    if (isset($_POST['simpan_kategori'])) {
      $kategori = trim($_POST['kategori']);
      if (empty($kategori)) {
        echo '<div class="alert alert-danger mt-3">Kategori tidak boleh kosong.</div>';
      } else {
        $queryExist = mysqli_prepare($con, "SELECT * FROM kategori WHERE nama = ?");
        mysqli_stmt_bind_param($queryExist, 's', $kategori);
        mysqli_stmt_execute($queryExist);
        $result = mysqli_stmt_get_result($queryExist);
        if (mysqli_num_rows($result) > 0) {
          echo '<div class="alert alert-warning mt-3">Kategori sudah ada.</div>';
        } else {
          $querySimpan = mysqli_prepare($con, "INSERT INTO kategori (nama) VALUES (?)");
          mysqli_stmt_bind_param($querySimpan, 's', $kategori);
          if (mysqli_stmt_execute($querySimpan)) {
            echo '<meta http-equiv="refresh" content="1; url=kategori.php"/>';
            echo '<div class="container alert alert-success mt-3">Kategori berhasil ditambahkan.</div>';
          } else {
            echo '<div class="container alert alert-danger mt-3">Terjadi kesalahan saat menyimpan kategori.</div>';
          }
        }
      }
    }
    ?>
  <!-- Tambah Kategori -->
    <div class="container my-4">
      <div class="col-md-6">
        <h3 class="mb-3"><i class="bi bi-list"></i> Tambah Kategori</h3>
        <form action="" method="post">
          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" id="kategori" name="kategori" class="form-control" placeholder="Tambah Kategori" autocomplete="off">
          </div>
          <button class="btn btn-success" type="submit" name="simpan_kategori"><i class="bi bi-plus-circle"></i> Simpan</button>
        </form>
      </div>
    </div>

  <!-- List Kategori -->
    <div class="container mt-4">
      <h3><i class="bi bi-list"></i> List Kategori</h3>
      <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $number = 1;
              if ($jumlahKategori == 0) {
                echo '<tr><td colspan="3" class="text-center">Tidak Ada Data Kategori</td></tr>';
              } else {
                while ($data = mysqli_fetch_array($queryKategori)) {
                  echo '<tr>';
                  echo '<td>' . $number . '</td>';
                  echo '<td>' . htmlspecialchars($data['nama']) . '</td>';
                  echo '<td><a href="kategori_detail.php?p=' . $data['id'] . '" class="btn btn-info"><i class="bi bi-search"></i>  Detail</a></td>';
                  echo '</tr>';
                  $number++;
                }
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  
  <!-- Script -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
