<?php
    require "session.php";
    require "../koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);

    $queryProduct = mysqli_query($con, "SELECT * FROM product");
    $jumlahProduct = mysqli_num_rows($queryProduct);

    $queryPesanan = mysqli_query($con, "SELECT * FROM pesanan");
    if (!$queryPesanan) {
        die("Query Error: " . mysqli_error($con));
    }
    $jumlahPesanan = mysqli_num_rows($queryPesanan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    
</head>
<!-- Style CSS -->
    <style>
    body{
        overflow:scroll;
    }

    .card:hover {
        transform: scale(1.05);
        transition: 0.3s ease-in-out;
    }
    </style>
<body>
    <!-- Navbar -->
        <?php require "navbar.php"; ?>

    <!-- Breadcrumb -->
        <div class="container mt-4">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-primary"><i class="bi bi-house-door"></i> Home</a></li>
            </ol>
            </nav>
        </div>
    <!-- Sumary -->
        <div class="container mt-5">
            <div class="row g-4">
                <!-- Kategori -->
                <div class="col-md-4">
                    <div class="card border-0 shadow bg-light">
                        <div class="card-body text-center">
                            <i class="bi bi-list display-4 text-info"></i>
                            <h5 class="card-title mt-2">Kategori</h5>
                            <p class="card-text"><?php echo $jumlahKategori; ?> Kategori</p>
                            <a href="kategori.php" class="btn btn-outline-info btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <!-- Produk -->
                <div class="col-md-4">
                    <div class="card border-0 shadow bg-light">
                        <div class="card-body text-center">
                            <i class="bi bi-basket display-4 text-warning"></i>
                            <h5 class="card-title mt-2">Produk</h5>
                            <p class="card-text"><?php echo $jumlahProduct; ?> Produk</p>
                            <a href="produk.php" class="btn btn-outline-warning btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <!-- Pesanan -->
                <div class="col-md-4">
                    <div class="card border-0 shadow bg-light">
                        <div class="card-body text-center">
                            <i class="bi bi-truck display-4 text-danger"></i>
                            <h5 class="card-title mt-2">Pesanan</h5>
                            <p class="card-text"><?php echo $jumlahPesanan; ?> Pesanan</p>
                            <a href="pesanan.php" class="btn btn-outline-danger btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Script -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>