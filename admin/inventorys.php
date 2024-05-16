<?php
require '../config/protected.php';
require '../app/controller/InventoryController.php';
require '../layout/admin/header.php';

$controller = new InventoryController($conn);
$inventories = $controller->getInventory();

?>
<!-- isi -->
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h1>Manajemen Inventaris</h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php foreach ($inventories as $item): ?>
                    <tr>
                        <td><?php echo $item['inventory_name']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo $item['price']; ?></td>
                        <td><?php echo $item['category_name']; ?></td>
                        <td>
                            <a href="edit_inventory.php?id=<?php echo $item['inventory_id']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                            <a href="delete_inventory.php?id=<?php echo $item['inventory_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tbody>
            </table>
            <a href="create_inventory.php" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Barang</a>
            <a href="create_category.php" class="btn btn-secondary mb-3"><i class="fa fa-database"></i> Tambah Kategori</a>
        </div>
    </div>
</div>