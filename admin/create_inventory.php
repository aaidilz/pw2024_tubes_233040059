<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: 404.php");
    exit();
}

require '../app/controller/InventoryController.php';
require '../layout/admin/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    $controller = new InventoryController($conn);
    if ($controller->createInventory($name, $quantity, $price, $category_id)) {
        header("Location: inventorys.php");
        exit();
    } else {
        $error = "Gagal menambah barang.";
    }
}
?>
<!-- isi -->

<div class="container mt-4">
    <div class="card w-75 mx-auto">
        <div class="card-header">
            <h1>Tambah Barang Baru</h1>
        </div>
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="create_inventory.php" method="POST">
                <div class="form-group mb-3">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="price">Harga</label>
                    <input type="number" name="price" id="price" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="category_id">Kategori</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="1">Makanan</option>
                        <option value="2">Minuman</option>
                        <option value="3">Peralatan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>

    </div>
</div>
</div>