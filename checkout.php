<?php
if (!isset($_POST['product_name'], $_POST['price'], $_POST['quantity'], $_POST['name'], $_POST['email'], $_POST['address'], $_POST['paymentMethod'])) {
    die('Data tidak lengkap');
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/controller/OrderController.php';

$controller = new OrderController($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SESSION['user_id'])) {
        die('User not logged in');
    }
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    $total_price = $price * $quantity;

    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $paymentMethod = $_POST['paymentMethod'];

    $_SESSION['product_id'] = $product_id;

    $controller->addToCart($user_id, $product_id, $quantity, $total_price, $name, $email, $address, $paymentMethod);
    $controller->reduceInventoryQuantity($product_id, $quantity);
    // Include header file
    include 'layout/home/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <!-- Include any required CSS files here -->
</head>
<body>
    <!-- Navbar -->
    <?php include 'layout/home/navbar.php'; ?>

    <!-- Page content -->
    <section>
        <br>
        <br>
        <br>
        <br>
        <br>
    </section>

    <section>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Terima Kasih!</h3>
                </div>
                <div class="card-body">
                    <p>Pesanan Anda telah diterima. Detail pesanan telah dikirimkan ke email Anda.</p>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <a href="cetak_invoice.php?id=<?php echo $user_id ?>" class="btn btn-primary">Cetak Invoice</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

<?php
} else {
    echo "Data tidak ditemukan";
}
?>
