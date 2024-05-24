<?php 
    require_once __DIR__ . '/../../app/controller/OrderController.php';

    $controller = new OrderController($conn);
    $user = $controller->getUserById($_SESSION['user_id']);
    $inventory = $controller->getInventoryById($_GET['id']);

    // get inventory data
    $product_name = $inventory['nama'];
    $harga = $inventory['harga'];
    $gambar = $inventory['gambar'];
    $kuantitas = $inventory['kuantitas'];
    ?>

<section>
        <div class="container bg-dark text-white">
            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Your cart</span>
                        <span class="badge bg-primary rounded-pill">1</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Product name</h6>
                                <small class="text-body-secondary">Brief description</small>
                            </div>
                            <span class="text-body-secondary">$12</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>$20</strong>
                        </li>
                        <?php
                        echo $product_name;
                        echo '<br>';
                        echo $harga;
                        echo '<br>';
                        echo '<br>';
                        echo $gambar;
                        echo '<br>';
                        echo $kuantitas;

                        ?>
                    </ul>
                </div>
                <div class="col-md-7 col-lg-8">
                    <!-- checkout card -->
                    <h4 class="mb-3">Checkout</h4>
                    <hr class="my-4">

                    <h4 class="mb-3">Billing address</h4>
                    <form class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="firstName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email <span
                                        class="text-body-secondary">(Optional)</span></label>
                                <input type="email" class="form-control" id="email" placeholder="you@example.com">
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="1234 Main St"
                                    required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3">Payment</h4>

                        <div class="my-3">
                            <div class="form-check">
                                <input id="qris" name="paymentMethod" type="radio" class="form-check-input" checked
                                    required>
                                <label class="form-check-label" for="qris">QRIS</label>
                            </div>
                            <div class="form-check">
                                <input id="ovo" name="paymentMethod" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="ovo">OVO</label>
                            </div>
                            <div class="form-check">
                                <input id="dana" name="paymentMethod" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="dana">DANA</label>
                            </div>
                        </div>

                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                    </form>
                </div>
            </div>
    </section>