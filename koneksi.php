<?php
// Create connection
$con = mysqli_connect("localhost", "root","", "toko_roti");

// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
