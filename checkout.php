<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once __DIR__ . '/app/controller/OrderController.php';
$controller = new OrderController($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Hitung total harga yang benar di sisi server
    $total_price = $price * $quantity;

    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $paymentMethod = $_POST['paymentMethod'];

    $controller->addToCart($user_id, $product_id, $quantity, $total_price, $name, $email, $address, $paymentMethod);
    header("Location: index.php");
} else {
    echo "Data tidak ditemukan";
}