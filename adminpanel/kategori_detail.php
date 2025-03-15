<?php
    require "session.php";
    require "../koneksi.php";

    $id = $_GET['p'] ?? '';
    if (!$id) {
        die("ID kategori tidak ditemukan.");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <!-- CSS -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<!-- Style CSS -->
    <style>
    body{
        overflow:scroll;
    }
    </style>

<body>
    <!-- Navbar -->
        <?php require "navbar.php"; ?>

    <!-- Breadcrumb -->
        <div class="container mt-4">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-dark"><i class="bi bi-house-door"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="kategori.php" class="text-decoration-none text-dark">Kategori</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">Details Kategori</li>
            </ol>
            </nav>
        </div>
    <!-- Validasi PHP Hapus dan Edit Kategori -->
        <?php
        // Menggunakan prepared statement untuk keamanan
        $stmt = mysqli_prepare($con, "SELECT * FROM kategori WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_array($result);

        if (!$data) {
            die("Kategori tidak ditemukan.");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['editBtn'])) {
                $kategori = trim($_POST['kategori']);

                if (!empty($kategori)) {
                    $stmtCheck = mysqli_prepare($con, "SELECT * FROM kategori WHERE nama = ? AND id != ?");
                    mysqli_stmt_bind_param($stmtCheck, "si", $kategori, $id);
                    mysqli_stmt_execute($stmtCheck);
                    $checkResult = mysqli_stmt_get_result($stmtCheck);
                    
                    if (mysqli_num_rows($checkResult) > 0) {
                        $msg = "Kategori sudah ada.";
                        $alertClass = "alert-warning";
                    } else {
                        $stmtUpdate = mysqli_prepare($con, "UPDATE kategori SET nama = ? WHERE id = ?");
                        mysqli_stmt_bind_param($stmtUpdate, "si", $kategori, $id);
                        if (mysqli_stmt_execute($stmtUpdate)) {
                            $msg = "Kategori berhasil diperbarui.";
                            $alertClass = "alert-success";
                            echo '<meta http-equiv="refresh" content="1; url=kategori.php"/>';
                        } else {
                            $msg = "Gagal memperbarui kategori.";
                            $alertClass = "alert-danger";
                        }
                    }
                }
            }

            if (isset($_POST['deleteBtn'])) {
                $stmtCheckProd = mysqli_prepare($con, "SELECT * FROM product WHERE kategori_id = ?");
                mysqli_stmt_bind_param($stmtCheckProd, "i", $id);
                mysqli_stmt_execute($stmtCheckProd);
                $prodResult = mysqli_stmt_get_result($stmtCheckProd);

                if (mysqli_num_rows($prodResult) > 0) {
                    $msg = "Kategori tidak bisa dihapus karena digunakan di produk.";
                    $alertClass = "alert-danger";
                } else {
                    $stmtDelete = mysqli_prepare($con, "DELETE FROM kategori WHERE id = ?");
                    mysqli_stmt_bind_param($stmtDelete, "i", $id);
                    if (mysqli_stmt_execute($stmtDelete)) {
                        $msg = "Kategori berhasil dihapus.";
                        $alertClass = "alert-success";
                        echo '<meta http-equiv="refresh" content="1; url=kategori.php"/>';
                    } else {
                        $msg = "Gagal menghapus kategori.";
                        $alertClass = "alert-danger";
                    }
                }
            }
        }
        ?>
    <!-- Kategori -->
        <div class="container mt-3">
            <div class="col-md-6">
                <h3>Detail Kategori</h3>
                <?php if (!empty($msg)) : ?>
                    <div class="alert <?php echo $alertClass; ?>" role="alert">
                        <?php echo $msg; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>">
                    </div>
                    <div class="d-flex justify-content-start gap-1">
                        <a href="kategori.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" name="editBtn" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Edit</button>
                        <button type="submit" name="deleteBtn" onclick="return confirmDelete()" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</button>
                    </div>
                </form>
            </div>
        </div>

    <!-- Script -->
        <script src="../js/bootstrap.bundle.min.js"></script>
            <!-- Script Hapus -->
            <script>
            function confirmDelete() {
                return confirm("Apakah Anda yakin ingin menghapus Kategori ini?");
            }
            </script>
</body>
</html>