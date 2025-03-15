<?php
    require "session.php";
    require "../koneksi.php";

    // Validasi ID dari GET
    $id = isset($_GET['p']) ? mysqli_real_escape_string($con, $_GET['p']) : '';

    // Ambil data produk berdasarkan ID
    $queryProduk = mysqli_query($con, 
        "SELECT a.*, b.nama AS nama_kategori FROM product a 
        JOIN kategori b ON a.kategori_id = b.id 
        WHERE a.id = '$id'"
    );
    $data = mysqli_fetch_array($queryProduk);

    // Ambil daftar kategori kecuali yang sedang dipilih
    $queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id != '{$data['kategori_id']}'");

    // Fungsi untuk membuat string acak
    function generateRandomString($length = 10) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <!-- CSS -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <!-- Navbar Section -->
        <?php require "navbar.php"; ?>

    <!-- Breadcrumb Section -->
        <div class="container mt-4">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-dark"><i class="bi bi-house-door"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="produk.php" class="text-decoration-none text-dark">Produk</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">Details Produk</li>
            </ol>
            </nav>
        </div>
        
    <!-- Validasi Delete and Update -->
        <?php
        if (isset($_POST['editBtn'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $kategori = htmlspecialchars($_POST['kategori']);
            $harga = htmlspecialchars($_POST['harga']);
            $detail = htmlspecialchars($_POST['detail']);
            $stok = htmlspecialchars($_POST['stok']);

            $updateFoto = "";
            if (!empty($_FILES["foto"]["name"])) {
                $target_dir = "../images/";
                $fileName = generateRandomString(20) . "." . strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $fileName);
                $updateFoto = ", foto='$fileName'";
            }

            $queryUpdate = mysqli_query($con, "UPDATE product SET kategori_id='$kategori', nama='$nama', harga='$harga', detail='$detail', stok='$stok' $updateFoto WHERE id='$id'");

            echo $queryUpdate ? '<div class="container alert alert-success text-center mt-3">Produk berhasil diperbarui</div>' : '<div class="container alert alert-danger text-center mt-3">Gagal memperbarui produk</div>';
            echo '<meta http-equiv="refresh" content="1; url=produk.php"/>';
        }

        if (isset($_POST['deleteBtn'])) {
            $queryDelete = mysqli_query($con, "DELETE FROM product WHERE id='$id'");
            echo $queryDelete ? '<div class="container alert alert-success text-center mt-3">Produk berhasil dihapus</div>' : '<div class="container alert alert-danger text-center mt-3">Gagal menghapus produk</div>';
            echo '<meta http-equiv="refresh" content="1; url=produk.php"/>';
        }
        ?>
    <!-- From Edit Dan Delete Section -->
        <div class="container mb-5">
            <div class="col-md-6">
                <h3>Detail Produk</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= htmlspecialchars($data['nama']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="<?= $data['kategori_id']; ?>"><?= htmlspecialchars($data['nama_kategori']); ?></option>
                            <?php while ($row = mysqli_fetch_array($queryKategori)) { ?>
                                <option value="<?= $row['id']; ?>"><?= htmlspecialchars($row['nama']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" value="<?= htmlspecialchars($data['harga']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Produk</label><br>
                        <img src="../images/<?= htmlspecialchars($data['foto']); ?>" alt="Foto Produk" class="img-thumbnail" width="200px">
                        <input type="file" name="foto" id="foto" class="form-control mt-2">
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail</label>
                        <textarea name="detail" id="detail" class="form-control" rows="4" required><?= htmlspecialchars($data['detail']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <select name="stok" id="stok" class="form-control">
                            <option value="<?= $data['stok']; ?>"><?= ucfirst($data['stok']); ?></option>
                            <option value="tersedia">Tersedia</option>
                            <option value="habis">Habis</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-start gap-1">
                        <a href="produk.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" name="editBtn" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Edit</button>
                        <button type="submit" name="deleteBtn" onclick="return confirmDelete()" class="btn btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                    </div>
                </form>
            </div>
        </div>

    <!-- Script -->
        <script src="../js/bootstrap.bundle.min.js"></script>
        <!-- Script Hapus -->
        <script>
        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus produk ini?");
        }
        </script>
</body>
</html>
