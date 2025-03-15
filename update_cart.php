<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        if ($_POST["action"] == "clear") {
            unset($_SESSION["cart"]); // Hapus semua item dari cart
        } elseif ($_POST["action"] == "minus") {
            $index = $_POST["index"];
            if ($_SESSION["cart"][$index]["qty"] > 1) {
                $_SESSION["cart"][$index]["qty"]--;
            } else {
                unset($_SESSION["cart"][$index]);
            }
        } elseif ($_POST["action"] == "plus") {
            $index = $_POST["index"];
            $_SESSION["cart"][$index]["qty"]++;
        }
    }
}

header("Location: cart.php");
exit();
