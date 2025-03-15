<?php
session_start();
require "koneksi.php"; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan sanitasi input
    $nama_pelanggan = mysqli_real_escape_string($con, $_POST['nama_pelanggan']);
    $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($con, $_POST['telepon']);
    $metode_pembayaran = mysqli_real_escape_string($con, $_POST['metode_pembayaran']);

    // Variabel untuk metode pembayaran tambahan
    $nomor_rekening = $nomor_wallet = $lokasi_cod = "";

    // Tentukan status berdasarkan metode pembayaran yang dipilih
    if ($metode_pembayaran == "transfer_bank" || $metode_pembayaran == "e_wallet") {
        $id_status = 2;  // "Sedang Diproses"
        if ($metode_pembayaran == "transfer_bank") {
            $nomor_rekening = mysqli_real_escape_string($con, $_POST['nomor_rekening']);
        } elseif ($metode_pembayaran == "e_wallet") {
            $nomor_wallet = mysqli_real_escape_string($con, $_POST['nomor_wallet']);
        }
    } elseif ($metode_pembayaran == "cod") {
        $id_status = 1;  // "Menunggu Pembayaran"
        $lokasi_cod = mysqli_real_escape_string($con, $_POST['lokasi_cod']);
    }

    // Hitung total harga pesanan dari session cart
    $total_harga = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_harga += $item['harga'] * $item['qty'];
    }

    // Biaya pengiriman (misalnya tetap Rp 10.000, bisa disesuaikan)
    $biaya_pengiriman = 10000;
    $total_bayar = $total_harga + $biaya_pengiriman;

    // Simpan data pesanan ke tabel pesanan
    $query = "INSERT INTO pesanan (nama_pelanggan, alamat, telepon, total_harga, metode_pembayaran, nomor_rekening, nomor_wallet, lokasi_cod, id_status) 
              VALUES ('$nama_pelanggan', '$alamat', '$telepon', '$total_harga', '$metode_pembayaran', '$nomor_rekening', '$nomor_wallet', '$lokasi_cod', '$id_status')";

    if (mysqli_query($con, $query)) {
        $id_pesanan = mysqli_insert_id($con); // Ambil ID pesanan yang baru dimasukkan

        // Simpan detail pesanan ke dalam tabel detail_pesanan
        foreach ($_SESSION['cart'] as $item) {
            $nama_produk = mysqli_real_escape_string($con, $item['nama']);
            $jumlah = (int) $item['qty'];
            $harga = (int) $item['harga'];

            $query_detail = "INSERT INTO detail_pesanan (id_pesanan, nama_produk, jumlah, harga) 
                             VALUES ('$id_pesanan', '$nama_produk', '$jumlah', '$harga')";
            mysqli_query($con, $query_detail);
        }

        // Kosongkan keranjang setelah checkout berhasil
        unset($_SESSION['cart']);

        // Redirect ke halaman sukses
        header("Location: checkoutSuccess.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
