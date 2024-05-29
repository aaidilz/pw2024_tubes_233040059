<?php
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require __DIR__ . '/../../app/controller/CartController.php';

$controller = new CartController($conn);
$carts = $controller->getOrdersByUserId($_SESSION['user_id']);


?>


<section>
  <br>
  <br>
  <br>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="container mb-3">
                    <h1 class="text-white">My Order History</h1>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Inventory Name</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($carts as $cart) { ?>
                                <tr>
                                    <td><?php echo $cart['id']; ?></td>
                                    <td><?php echo $cart['nama']; ?></td>
                                    <td><?php echo $cart['quantity']; ?></td>
                                    <td>Rp<?php echo $cart['total_price']; ?></td>
                                    <td><?php echo $cart['email']; ?></td>
                                    <td><?php echo $cart['address']; ?></td>
                                    <td><?php echo $cart['paymentMethod']; ?></td>
                                    <td><?php echo $cart['status']; ?></td>
                                    <td>
                                        <a href="cetak_invoice.php?id=<?php echo $cart['user_id']; ?>" class="btn btn-primary">Invoice</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
