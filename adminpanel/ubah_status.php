<?php
    session_start();
    require "../koneksi.php"; // Pastikan koneksi ke database sudah benar

    // Ambil ID pesanan dari URL
    if (!isset($_GET['id'])) {
        echo "ID pesanan tidak ditemukan.";
        exit();
    }
    $id_pesanan = $_GET['id'];

    // Ambil data pesanan
    $queryPesanan = "SELECT * FROM pesanan WHERE id_pesanan = '$id_pesanan'";
    $resultPesanan = mysqli_query($con, $queryPesanan);
    $pesanan = mysqli_fetch_assoc($resultPesanan);

    // Ambil daftar status dari tabel status
    $queryStatus = "SELECT * FROM status";
    $resultStatus = mysqli_query($con, $queryStatus);

    // Proses jika form disubmit untuk mengubah status
    if (isset($_POST['submit'])) {
        $id_status = $_POST['id_status']; // Ambil ID status yang dipilih

        // Debugging: Tampilkan data POST untuk memastikan data terkirim dengan benar
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";

        // Update status pesanan
        $queryUpdate = "UPDATE pesanan SET id_status = '$id_status' WHERE id_pesanan = '$id_pesanan'";
        $resultUpdate = mysqli_query($con, $queryUpdate);

        if ($resultUpdate) {
            echo "Status pesanan berhasil diubah.";
            header("Location: pesanan.php"); // Redirect ke daftar pesanan setelah sukses
            exit();
        } else {
            echo "Gagal mengubah status: " . mysqli_error($con); // Menampilkan error SQL
        }
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Status Pesanan</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<!-- Style -->
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
                <li class="breadcrumb-item"><a href="pesanan.php" class="text-decoration-none text-dark">Pesanan</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">Ubah Status</li>
            </ol>
            </nav>
        </div>

    <!-- From Ubah Status -->
        <div class="container mt-5">
            <h2><i class="bi bi-truck"></i> Ubah Status Pesanan No.<?php echo $pesanan['id_pesanan']; ?></h2>

            <form method="POST">
                <div class="mb-3">
                    <label for="status" class="form-label">Pilih Status Pengiriman</label>
                    <select name="id_status" id="status" class="form-select">
                        <?php while ($status = mysqli_fetch_assoc($resultStatus)) { ?>
                            <option value="<?php echo $status['id_status']; ?>" <?php echo ($pesanan['id_status'] == $status['id_status']) ? 'selected' : ''; ?>>
                                <?php echo $status['status_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>            
                <a href="pesanan.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" name="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Ubah Status
                </button>
            </form>
        </div>
    
    <!-- Script -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
