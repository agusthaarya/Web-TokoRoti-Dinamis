<?php
require "../koneksi.php";

// Cek apakah data dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pesanan = $_POST['id_pesanan'];
    $id_status = $_POST['id_status'];

    // Update status pesanan
    $query = "UPDATE pesanan SET id_status = '$id_status' WHERE id_pesanan = '$id_pesanan'";

    if (mysqli_query($con, $query)) {
        // Redirect setelah berhasil
        header("Location: order.php");
        exit();
    } else {
        echo "Gagal mengubah status pesanan.";
    }
}
?>
