<?php
require '../config/protected.php';
require '../layout/admin/header.php';
require '../app/controller/InventoryController.php';

$controller = new InventoryController($conn);
// Ambil parameter pencarian dari URL
$keyword = $_GET['keyword'] ?? '';

// Memanggil fungsi pencarian inventory
$inventories = $controller->searchInventory($keyword);
?>

<!-- isi -->
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h1>Manajemen Inventory</h1>
        </div>
        <div class="card-body">
            <form action="inventory.php" method="get">
                <div class="input-group mb-3 w-25">
                    <input type="text" class="form-control" placeholder="Cari inventory" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
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
                    <?php if (empty($inventories)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($inventories as $inventory): ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
                                <td><img src="../uploads/<?php echo $inventory['gambar']; ?>" alt="" style="width: 100px;"></td>
                                <td><?php echo $inventory['nama']; ?></td>
                                <td><?php echo $inventory['kuantitas']; ?></td>
                                <td><?php echo $inventory['harga']; ?></td>
                                <td><?php echo $inventory['kategori_nama']; ?></td>
                                <td>
                                    <a href="edit_inventory.php?id=<?php echo $inventory['id']; ?>" class="btn btn-warning">Edit</a>
                                    <a href="delete_inventory.php?id=<?php echo $inventory['id']; ?>" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </table>
        </div>
        <div class="card-footer">
            <a href="create_inventory.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Kategori</a>
            <a href="category.php" class="btn btn-secondary"><i class="fa fa-database"></i> Manage Kategori</a>
        </div>
    </div>
</div>

<?php require '../layout/admin/footer.php'; ?>
