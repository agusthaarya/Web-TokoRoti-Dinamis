<?php
session_start();
session_unset(); // Menghapus semua session
session_destroy(); // Menghancurkan session
header('Location: home.php'); // Redirect ke halaman home setelah logout
exit();
?>