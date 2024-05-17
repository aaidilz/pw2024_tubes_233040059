<?php

require '../config/protected.php';
require '../layout/admin/header.php';
require '../app/controller/InventoryController.php';

$controller = new InventoryController($conn);
$inventories = $controller->getAllInventory();
?>

<!-- isi -->
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h1>Manajemen Inventory</h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kuantitas</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1; ?>
                    <?php foreach ($inventories as $inventory) : ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><img src="../uploads/<?php echo $inventory['gambar']; ?>" alt="" style="width: 100px;"></td>
                            <td><?php echo $inventory['nama']; ?></td>
                            <td><?php echo $inventory['kuantitas']; ?></td>
                            <td><?php echo $inventory['harga']; ?></td>
                            <td><?php echo $inventory['kategori_nama']; ?></td>
                            <td>
                                <a href="edit-inventory.php?id=<?php echo $inventory['id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="delete_inventory.php?id=<?php echo $inventory['id']; ?>" class="btn btn-danger">Hapus</a>
                        </tr>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
            </table>
        </div>
        <div class="card-footer">
            <a href="create_inventory.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Kategori</a>
            <a href="category.php" class="btn btn-secondary"><i class="fa fa-database"></i> Manage Kategori</a>
        </div>
    </div>
</div>

<?php
require '../layout/admin/footer.php';
?>