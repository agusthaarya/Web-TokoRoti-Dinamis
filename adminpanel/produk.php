<?php
    require "session.php";
    require "../koneksi.php";

    $limit = 10; // Jumlah produk per halaman
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $filterQuery = "";
    if(isset($_GET['filterKategori']) && $_GET['filterKategori'] != '') {
        $kategori_id = $_GET['filterKategori'];
        $filterQuery = "WHERE product.kategori_id = '$kategori_id'";
    }

    $dataProduk = mysqli_query($con, 
    "SELECT product.id, product.nama, kategori.nama AS kategori_nama, product.harga, product.stok 
        FROM product 
        JOIN kategori ON product.kategori_id = kategori.id 
        $filterQuery 
        LIMIT $start, $limit");
    $jumlahProduk = mysqli_num_rows($dataProduk);

    $totalProduk = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM product $filterQuery"))['total'];
    $totalPages = ceil($totalProduk / $limit);

    $dataKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($dataKategori);

    function generateRandomString($length = 20) {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
  <!-- CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <!-- Navbar -->
        <?php require "navbar.php"; ?>
    
    <!-- Breadcrumb -->
        <div class="container mt-4">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-dark"><i class="bi bi-house-door"></i> Home</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">Produk</li>
            </ol>
            </nav>
        </div>

    <!-- Validasi PHP Tambah Produk -->
        <?php
        if (isset($_POST['simpanProduk'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $kategori = htmlspecialchars($_POST['kategori']);
            $harga = htmlspecialchars($_POST['harga']);
            $detail = htmlspecialchars($_POST['detail']);
            $stok = htmlspecialchars($_POST['stok']);
            
            $target_dir = "../images/";
            $nama_file = basename($_FILES["foto"]["name"]);
            $imageFileType = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
            $image_size = $_FILES["foto"]["size"];
            $random_name = generateRandomString(20);
            $new_name = $random_name . "." . $imageFileType;
            $target_file = $target_dir . $new_name;

            if ($nama_file != '' && ($imageFileType == 'jpg' || $imageFileType == 'png' || $imageFileType == 'gif') && $image_size <= 500000) {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    $fotoQuery = "'$new_name'";
                } else {
                    echo '<div class="alert alert-danger mt-3">Gagal mengupload gambar</div>';
                    exit;
                }
            } else {
                $fotoQuery = "NULL";
            }

            $queryTambah = mysqli_query($con, "INSERT INTO product (kategori_id, nama, harga, foto, detail, stok) VALUES ('$kategori', '$nama', '$harga', $fotoQuery, '$detail', '$stok')");

            if ($queryTambah) {
                echo '<div class="container alert alert-success mt-3">Produk berhasil ditambahkan</div>';
                echo '<meta http-equiv="refresh" content="1; url=produk.php"/>';
            } else {
                echo '<div class="container alert alert-danger mt-3">Gagal menambahkan produk</div>';
            }
        }
        ?>
    <!-- From Tambah Produk -->
        <div class="container my-5">
            <div class="col-lg-6">
                <h3><i class="bi bi-basket"></i> Tambah Produk</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama produk" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <?php while ($data = mysqli_fetch_array($dataKategori)) { ?>
                                <option value="<?php echo $data['id']; ?>"><?php echo htmlspecialchars($data['nama']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" placeholder="Masukkan harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Produk</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail Produk</label>
                        <textarea name="detail" id="detail" class="form-control" rows="4" placeholder="Deskripsi produk"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <select name="stok" id="stok" class="form-select">
                            <option value="tersedia">Tersedia</option>
                            <option value="habis">Habis</option>
                        </select>
                    </div>
                    <button type="submit" name="simpanProduk" class="btn btn-success"><i class="bi bi-plus-circle"> </i>Simpan</button>
                </form>
            </div>
        </div>

    <!-- Pencarian Kategori -->
        <div class="container mt-4">
            <div class="col-lg-6">
                <h3><i class="bi bi-search"></i> Cari Produk Berdasarkan Kategori</h3>
                <form action="produk.php" method="get">
                <select name="filterKategori" class="form-select mb-3" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <?php 
                    mysqli_data_seek($dataKategori, 0); // Reset pointer result set
                    while ($kategori = mysqli_fetch_array($dataKategori)) { ?>
                        <option value="<?php echo $kategori['id']; ?>" 
                            <?php if(isset($_GET['filterKategori']) && $_GET['filterKategori'] == $kategori['id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($kategori['nama']); ?>
                        </option>
                    <?php } ?>
                </select>
                </form>
            </div>
        </div>
    
    <!-- List Produk -->
        <div class="container mt-5">
            <h2><i class="bi bi-basket"></i> List Produk</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($jumlahProduk == 0) { ?>
                            <tr><td colspan="6" class="text-center">Data produk tidak tersedia</td></tr>
                        <?php } else { $no = $start + 1; while ($data = mysqli_fetch_array($dataProduk)) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($data['nama']); ?></td>
                                <td><?php echo htmlspecialchars($data['kategori_nama']); ?></td>
                                <td><?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($data['stok']); ?></td>
                                <td>
                                    <a href="produk_detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info"><i class="bi bi-search"></i> Detail</a>
                                </td>
                            </tr>
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
        
            <!-- Pagination -->
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php if($page <= 1) echo 'disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&filterKategori=<?php echo isset($_GET['filterKategori']) ? $_GET['filterKategori'] : ''; ?>"><span aria-hidden="true">&laquo;</span></a>
                    </li>
                    <?php for($i = 1; $i <= $totalPages; $i++) { ?>
                        <li class="page-item <?php if($page == $i) echo 'active'; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>&filterKategori=<?php echo isset($_GET['filterKategori']) ? $_GET['filterKategori'] : ''; ?>"> <?php echo $i; ?> </a>
                        </li>
                    <?php } ?>
                    <li class="page-item <?php if($page >= $totalPages) echo 'disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&filterKategori=<?php echo isset($_GET['filterKategori']) ? $_GET['filterKategori'] : ''; ?>"><span aria-hidden="true">&raquo;</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    
    <!-- Script -->
    <script src="../script/main-script.js"></script>
</body>
</html>