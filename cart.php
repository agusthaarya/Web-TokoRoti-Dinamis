<?php
    // Start session
    session_start();

    // Pastikan session cart sudah ada
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // **🔹 Menambahkan produk ke keranjang**
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
        // Pastikan data produk ada di form
        $nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '';
        $harga = isset($_POST['harga']) ? (float)$_POST['harga'] : 0;
        $foto = isset($_POST['foto']) ? htmlspecialchars($_POST['foto']) : '';
        $qty = isset($_POST['qty']) ? (int)$_POST['qty'] : 1; // Default 1 jika tidak ada

        // Validasi input produk
        if ($nama && $harga > 0 && $foto) {
            // Buat array produk yang akan disimpan ke dalam session
            $produk = [
                'nama'  => $nama,
                'harga' => $harga,
                'foto'  => $foto,
                'qty'   => $qty,
            ];

            // Periksa apakah produk sudah ada di cart
            $found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['nama'] == $nama) {
                    $item['qty'] += $qty; // Jika sudah ada, tambahkan jumlahnya
                    $found = true;
                    break;
                }
            }

            // Jika belum ada, tambahkan ke session cart
            if (!$found) {
                $_SESSION['cart'][] = $produk;
            }

            // Redirect kembali ke halaman keranjang
            header("Location: cart.php");
            exit();
        } else {
            // Bisa menambahkan pesan error disini jika ada input yang tidak valid
            echo "Data produk tidak lengkap atau tidak valid.";
        }
    }

    // **🔹 Update jumlah produk di keranjang**
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_cart'])) {
        if (isset($_POST['qty'])) {
            foreach ($_SESSION['cart'] as $index => &$item) {
                // Validasi qty yang baru
                $new_qty = isset($_POST['qty'][$index]) ? (int)$_POST['qty'][$index] : 1;
                if ($new_qty > 0) {
                    $_SESSION['cart'][$index]['qty'] = $new_qty; // Update qty
                }
            }
        }
        header("Location: cart.php");
        exit();
    }

    // **🔹 Hapus Produk dari Keranjang**
    if (isset($_GET['hapus']) && is_numeric($_GET['hapus'])) {
        $index = (int)$_GET['hapus'];
        if (isset($_SESSION['cart'][$index])) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reset array index
        }
        header("Location: cart.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang Belanja</title>
    <!-- CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/cart.css">
        <link rel="stylesheet" href="css/main-css.css">

    <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
</head>
<body class="body-font bg-light">
    <!-- Navbar -->
        <?php require "navbar.php" ?>
    <!-- Keranjang Belanja -->
        <div class="container mt-5">
            <h2 class="pt-5 pb-1"><i class="bi bi-cart"></i> Keranjang Belanja</h2>
            <table class="table table-bordered text-center align-middle shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalHarga = 0;
                    $cartEmpty = empty($_SESSION['cart']);
                    if (!$cartEmpty) {
                        foreach ($_SESSION['cart'] as $index => $item) {
                            $subtotal = $item['harga'] * $item['qty'];
                            $totalHarga += $subtotal;
                    ?>
                            <tr>
                                <td><img src="images/<?php echo $item['foto']; ?>" width="80" height="80" style="object-fit: cover; border-radius: 5px;"></td>
                                <td><?php echo $item['nama']; ?></td>
                                <td>Rp. <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                                <td>
                                    <form action="update_cart.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                                        <input type="hidden" name="action" value="minus">
                                        <button type="submit" class="btn btn-danger btn-sm">-</button>
                                    </form>

                                    <span class="mx-2"><?php echo $item['qty']; ?></span>

                                    <form action="update_cart.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                                        <input type="hidden" name="action" value="plus">
                                        <button type="submit" class="btn btn-success btn-sm">+</button>
                                    </form>
                                </td>
                                <td>Rp. <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                                <td>
                                    <a href="cart.php?hapus=<?php echo $index; ?>" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                    <?php }
                    } else { ?>
                        <tr>
                            <td colspan="6" class="text-center">Keranjang Kosong</td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Total Bayar:</strong></td>
                        <td><strong>Rp. <?php echo number_format($totalHarga, 0, ',', '.'); ?></strong></td>
                        <td>
                            <?php if (!$cartEmpty) { ?>
                                <form action="update_cart.php" method="POST">
                                    <input type="hidden" name="action" value="clear">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus Semua
                                    </button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <a href="produk.php" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Lanjut Belanja</a>

            <!-- Checkout button logic -->
            <?php if ($cartEmpty) { ?>
                <button class="btn btn-outline-success" disabled><i class="bi bi-bag-check"></i> Checkout</button>
                <!-- Warning message -->
                <div class="alert alert-warning mt-2" role="alert">
                    <strong>Warning!</strong> Keranjang Anda kosong. Silakan tambahkan produk sebelum melanjutkan checkout.
                </div>
            <?php } else { ?>
                <a href="checkout.php" class="btn btn-outline-success"><i class="bi bi-bag-check"></i> Checkout</a>
            <?php } ?>
        </div>

    <!-- script -->
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/main-script.js"></script>
      <script src="js/counterUp.js"></script>
      <script>
        AOS.init();
      </script>
</body>
</html>
