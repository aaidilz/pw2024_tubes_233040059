<?php
require '../config/protected.php';
require '../layout/admin/header.php';
require '../app/controller/OrderController.php';
require '../app/controller/UserController.php';

$controller_order = new OrderController($conn);
$controller_user = new UserController($conn);

$orders = $controller_order->getOrderCount();
$total_sales = $controller_order->getTotalSales();
$total_status = $controller_order->getTotalStatus();
$total_users = $controller_user->getUserCount();
$total_inventory = $controller_order->getTotalInventory();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
            <div class="card text-white bg-primary" style="max-width: 18rem;">
                <div class="card-header">Total Orders</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $orders['total_orders'] ?></h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
            <div class="card text-white bg-success" style="max-width: 18rem;">
                <div class="card-header">Total Sales</div>
                <div class="card-body">
                    <h5 class="card-title">
                        Rp
                        <?php echo ($total_sales['total_sales'] == 0) ? '0' : number_format($total_sales['total_sales'], 0, ',', '.'); ?>
                    </h5>
                </div>
            </div>
        </div>

        <!-- total inventory -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
            <div class="card text-white bg-warning" style="max-width: 18rem;">
                <div class="card-header">Total Inventory</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $total_inventory['total_inventory'] ?></h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
            <div class="card text-white bg-danger" style="max-width: 18rem;">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $total_users['total_users'] ?></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h1>Order Status</h1>
            <hr>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($total_status as $status): ?>
                                <tr>
                                    <td><?php echo $status['status'] ?></td>
                                    <td><?php echo $status['total_status'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>