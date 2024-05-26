<?php

require '../config/protected.php';
require '../app/controller/OrderController.php';
require '../layout/admin/header.php';

$controller = new OrderController($conn);
$orders = $controller->getAllOrders();
?>


<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h1>Manajemen Order</h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
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
                    <?php
                    foreach ($orders as $order) {
                        ?>
                        <tr>
                            <td><?php echo $order['id']; ?></td>
                            <td><?php echo $order['user_name']; ?></td>
                            <td><?php echo $order['inventory_name']; ?></td>
                            <td><?php echo $order['quantity']; ?></td>
                            <td>Rp<?php echo $order['total_price']; ?></td>
                            <td><?php echo $order['email']; ?></td>
                            <td><?php echo $order['address']; ?></td>
                            <td><?php echo $order['paymentMethod']; ?></td>
                            <td><?php echo $order['status']; ?></td>

                            <!-- button edit and invoice -->
                            <td>
                                <a href="edit_order.php?id=<?php echo $order['id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="invoice.php?id=<?php echo $order['id']; ?>" class="btn btn-primary">Invoice</a>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- end_isi -->
<?php
require '../layout/admin/footer.php';
?>