<?php
require_once __DIR__ . '/../../app/controller/OrderController.php';

$controller = new OrderController($conn);
$user = $controller->getUserById($_SESSION['user_id']);
$inventory = $controller->getInventoryById($_GET['id']);

// get inventory data
$product_name = htmlspecialchars($inventory['nama']);
$harga = htmlspecialchars($inventory['harga']);
$gambar = htmlspecialchars($inventory['gambar']);
$kuantitas = htmlspecialchars($inventory['kuantitas']);
?>

<section>
    <div class="container bg-dark text-white">
        <div class="row g-5">
            <div class="col-md-12 col-lg-12">
                <!-- checkout card -->
                <h4 class="mb-3">Checkout</h4>
                <hr class="my-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img src="../uploads/<?php echo $gambar; ?>" class="card-img" alt="Card image">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $product_name; ?></h5>
                                            <p class="card-text">Harga: Rp<?php echo $harga; ?></p>
                                            <p class="mt-2">Barang yang Tersedia: <span><?php echo $kuantitas; ?></span>
                                            </p>

                                            <form action="checkout.php" method="POST">
                                                <div class="form-group">
                                                    <label for="quantity">Jumlah:</label>
                                                    <input type="number" class="form-control" id="quantity"
                                                        name="quantity" min="1" max="<?php echo $kuantitas; ?>"
                                                        required>
                                                </div>
                                                <input type="hidden" name="product_id"
                                                    value="<?php echo $_GET['id']; ?>">
                                                <input type="hidden" name="product_name"
                                                    value="<?php echo $product_name; ?>">
                                                <input type="hidden" name="price" value="<?php echo $harga; ?>">
                                                <input type="hidden" name="total_price"
                                                    value="<?php echo $harga * $kuantitas; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">

                <h4 class=" mb-3">Billing address</h4>
                <div class="row g-3">
                    <div class="col-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" value=""
                            required>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email <span
                                class="text-body-secondary">(Optional)</span></label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com" name="email">
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St"
                            required>
                    </div>
                </div>
                <hr class="my-4">
                <h4 class="mb-3">Payment</h4>
                <div class="my-3">
                    <div class="form-check">
                        <input id="qris" name="paymentMethod" type="radio" class="form-check-input" value="QRIS" checked
                            required>
                        <label class="form-check-label" for="qris">QRIS</label>
                    </div>
                    <div class="form-check">
                        <input id="ovo" name="paymentMethod" type="radio" class="form-check-input" value="OVO" required>
                        <label class="form-check-label" for="ovo">OVO</label>
                    </div>
                    <div class="form-check">
                        <input id="dana" name="paymentMethod" type="radio" class="form-check-input" value="DANA"
                            required>
                        <label class="form-check-label" for="dana">DANA</label>
                    </div>
                </div>

                <hr class="my-4">
                <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>
</section>