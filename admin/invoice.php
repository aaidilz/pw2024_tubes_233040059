<?php

require '../config/protected.php';
require '../app/controller/OrderController.php';
require '../layout/admin/header.php';

$controller = new OrderController($conn);

if (isset($_GET['id'])) {
    $order = $controller->getOrderById($_GET['id']);
    $user = $controller->getUserById($order['user_id']);
    $inventory = $controller->getInventoryById($order['inventory_id']);
}

?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header text-center">
            <h1>Invoice</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Order Date</th>
                            <td><?php echo $order['order_date']; ?></td>
                        <tr>
                            <th scope="row">Order ID</th>
                            <td><?php echo $order['id']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">User Name</th>
                            <td><?php echo $user['username']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Inventory Name</th>
                            <td><?php echo $inventory['nama']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Quantity</th>
                            <td><?php echo $order['quantity']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Total Price</th>
                            <td>Rp<?php echo $order['total_price']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td><?php echo $user['email']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Address</th>
                            <td><?php echo $order['address']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Payment Method</th>
                            <td><?php echo $order['paymentMethod']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td><?php echo $order['status']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <a href="order.php" class="btn btn-primary">Back</a>
            <a href="print_invoice.php?id=<?php echo $order['id']; ?>" class="btn btn-success">Print</a>
        </div>
    </div>
</div>
