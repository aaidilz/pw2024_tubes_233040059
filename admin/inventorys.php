<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: 404.php");
    exit();
}

require '../app/controller/InventoryController.php';
require '../layout/admin/header.php';

$controller = new InventoryController($conn);
$inventorys = $controller->getAllInventorys();
$categories = $controller->getAllCategories();
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
                        <th>NO</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $counter = 1;?>
                    <?php foreach ($inventorys as $inventory): ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><?php echo $categories[$inventory['category_id']]['name']; ?></td>
                            <td><?php echo $inventory['name']; ?></td>
                            <td><?php echo $inventory['quantity']; ?></td>
                            <td><?php echo $inventory['price']; ?></td>
                            <td>
                                <a href="edit_inventory.php?id=<?php echo $inventory['inventory_id']; ?>"
                                    class="btn btn-warning btn-sm"><i class="fa fa-wrench"></i> Edit</a>
                                <a href="delete_inventory.php?id=<?php echo $inventory['inventory_id']; ?>"
                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                        <?php $counter++; ?>
                    <?php endforeach; ?>

                <tbody>
            </table>
            <a href="create_inventory.php" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Barang</a>
            <a href="create_category.php" class="btn btn-secondary mb-3"><i class="fa fa-database"></i> Tambah
                Kategory</a>
        </div>
    </div>
</div>