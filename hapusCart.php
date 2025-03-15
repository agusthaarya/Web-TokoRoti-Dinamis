<?php
session_start();

if (isset($_GET['index'])) {
    $index = (int) $_GET['index']; // Pastikan index adalah integer

    // Periksa apakah index ada dalam session cart
    if (isset($_SESSION['cart'][$index])) {
        if ($_SESSION['cart'][$index]['qty'] > 1) {
            $_SESSION['cart'][$index]['qty']--; // Kurangi jumlah
        } else {
            unset($_SESSION['cart'][$index]); // Hapus produk jika qty = 1
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reset array index agar tetap rapih
        }
    }
}

// Redirect kembali ke cart
header("Location: cart.php");
exit();
?>
