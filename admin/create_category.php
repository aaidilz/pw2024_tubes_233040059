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

    $controller = new InventoryController($conn);
    if ($controller->createCategory($name)) {
        header("Location: inventorys.php");
        exit();
    } else {
        $error = "Gagal menambah kategori.";
    }
}
?>

    <!-- isi -->
    <div class="container mt-4">
        <div class="card w-75 mx-auto">
            <div class="card-header">
                <h1>Tambah Kategori Baru</h1>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form action="create_category.php" method="POST">
                    <div class="form-group mb-3">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>