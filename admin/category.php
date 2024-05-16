<?php
require '../config/protected.php';
require '../layout/admin/header.php';
require '../app/controller/CategoryController.php';

$controller = new CategoryController($conn);
$categories = $controller->getAllCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $controller->createCategory($nama);
}

?>
<div class="container mt-4 mb-3">
    <div class="card w-75 mx-auto">
        <div class="card-header">
            <h1>Kategori</h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $index => $category ) : ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $category['nama']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="card w-75 mx-auto">
        <div class="card-header">
            <h1>Tambah Kategori Baru</h1>
        </div>
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="category.php" method="POST">
                <div class="form-group mb-3">
                    <label for="nama">nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>