<?php
session_start();
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $metode_pembayaran = $_POST['metode_pembayaran'];

    // Default kosong untuk metode pembayaran yang tidak sesuai
    $nomor_rekening = "";
    $nomor_wallet = "";
    $lokasi_cod = "";

    // Tentukan nilai berdasarkan metode pembayaran yang dipilih
    if ($metode_pembayaran == "transfer_bank") {
        $nomor_rekening = $_POST['nomor_rekening'];
        $id_status = 2;  // Sedang Diproses
    } elseif ($metode_pembayaran == "e_wallet") {
        $nomor_wallet = $_POST['nomor_wallet'];
        $id_status = 2;  // Sedang Diproses
    } elseif ($metode_pembayaran == "cod") {
        $lokasi_cod = $_POST['lokasi_cod'];
        $id_status = 1;  // Menunggu Pembayaran
    }

    // Hitung total harga
    $total_harga = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_harga += $item['harga'] * $item['qty'];
    }

    // Simpan pesanan ke database
    $query = "INSERT INTO pesanan (nama_pelanggan, alamat, telepon, total_harga, metode_pembayaran, nomor_rekening, nomor_wallet, lokasi_cod, id_status) 
            VALUES ('$nama_pelanggan', '$alamat', '$telepon', '$total_harga', '$metode_pembayaran', '$nomor_rekening', '$nomor_wallet', '$lokasi_cod', '$id_status')";

    if (mysqli_query($con, $query)) {
        // Ambil ID pesanan yang baru saja dimasukkan
        $_SESSION['id_pesanan'] = mysqli_insert_id($con);

        // Proses detail pesanan (produk dan jumlah)
        foreach ($_SESSION['cart'] as $item) {
            $id_pesanan = $_SESSION['id_pesanan'];
            $nama_produk = $item['nama'];
            $jumlah = $item['qty'];
            $harga = $item['harga'];

            // Masukkan detail pesanan ke tabel detail_pesanan
            $query_detail = "INSERT INTO detail_pesanan (id_pesanan, nama_produk, jumlah, harga) 
                            VALUES ('$id_pesanan', '$nama_produk', '$jumlah', '$harga')";
            mysqli_query($con, $query_detail);
        }

        // Kosongkan keranjang setelah checkout berhasil
        unset($_SESSION['cart']);

        // Setelah proses sukses, alihkan ke halaman sukses
        header("Location: checkoutSuccess.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .form-control:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            border-color: #007bff;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .checkout-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="checkout-container">
        <h2 class="mb-4 text-center"><i class="bi bi-cart-check"></i> Checkout</h2>
        <form action="checkout.php" method="POST">
            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label class="form-label">Alamat Pengiriman</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
                    <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>
            </div>

            <!-- Nomor Telepon -->
            <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                    <input type="text" name="telepon" class="form-control" placeholder="Masukkan nomor telepon" required>
                </div>
            </div>

            <!-- Pilihan Metode Pembayaran -->
            <div class="mb-3">
                <label class="form-label">Metode Pembayaran</label>
                <div class="input-group">
                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required onchange="togglePaymentFields()">
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="transfer_bank">Transfer Bank</option>
                        <option value="cod">Cash On Delivery (COD)</option>
                        <option value="e_wallet">E-Wallet (GoPay, OVO, dll)</option>
                    </select>
                </div>
            </div>

            <!-- Input Tambahan Berdasarkan Metode Pembayaran -->
            <div id="transfer_bank_field" class="mb-3 payment-field" style="display: none;">
                <label class="form-label">Nomor Rekening</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-credit-card"></i></span>
                    <input type="text" name="nomor_rekening" class="form-control" placeholder="Masukkan nomor rekening">
                </div>
            </div>

            <div id="cod_field" class="mb-3 payment-field" style="display: none;">
                <label class="form-label">Lokasi COD</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-map"></i></span>
                    <input type="text" name="lokasi_cod" class="form-control" placeholder="Masukkan lokasi COD">
                </div>
            </div>

            <div id="e_wallet_field" class="mb-3 payment-field" style="display: none;">
                <label class="form-label">Nomor E-Wallet</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-wallet2"></i></span>
                    <input type="text" name="nomor_wallet" class="form-control" placeholder="Masukkan nomor E-Wallet">
                </div>
            </div>

            <!-- Ringkasan Pesanan -->
            <h4 class="mt-4"><i class="bi bi-receipt"></i> Ringkasan Pesanan</h4>
            <table class="table table-bordered mt-3">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $totalHarga = 0;
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $item) { 
                            $subtotal = $item['harga'] * $item['qty']; 
                            $totalHarga += $subtotal;
                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-center"><?php echo (int)$item['qty']; ?></td>
                                <td class="text-end">Rp. <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                                <td class="text-end">Rp. <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                            </tr>
                    <?php 
                        } 
                    } else { 
                        echo "<tr><td colspan='4' class='text-center'>Keranjang Kosong</td></tr>";
                    } 
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total Bayar:</strong></td>
                        <td class="text-end"><strong>Rp. <?php echo number_format($totalHarga, 0, ',', '.'); ?></strong></td>
                    </tr>
                </tfoot>
            </table>

            <div class="d-flex justify-content-between mt-4">
                <a href="cart.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali ke Keranjang</a>
                <button type="submit" class="btn btn-success"><i class="bi bi-bag-check-fill"></i> Proses Checkout</button>
            </div>
        </form>
    </div>
</div>

<!-- Script JavaScript untuk Menampilkan Input yang Sesuai -->
<script>
function togglePaymentFields() {
    // Ambil nilai metode pembayaran yang dipilih
    let method = document.getElementById("metode_pembayaran").value;

    // Sembunyikan semua field tambahan dulu
    document.getElementById("transfer_bank_field").style.display = "none";
    document.getElementById("cod_field").style.display = "none";
    document.getElementById("e_wallet_field").style.display = "none";

    // Tampilkan field yang sesuai
    if (method === "transfer_bank") {
        document.getElementById("transfer_bank_field").style.display = "block";
    } else if (method === "cod") {
        document.getElementById("cod_field").style.display = "block";
    } else if (method === "e_wallet") {
        document.getElementById("e_wallet_field").style.display = "block";
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
