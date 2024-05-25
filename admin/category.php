<?php
require '../config/protected.php';
require '../layout/admin/header.php';
require '../app/controller/CategoryController.php';

$controller = new CategoryController($conn);
$categories = $controller->getAllCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $controller->createCategory($nama);
}

?>
<div class="container mt-4 mb-3">
    <div class="card w-75 mx-auto">
        <div class="card-header">
            <h1>Kategori</h1>
        </div>
        <div class="card-body">
            <!-- get session error message -->
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['error_message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>

            <!-- get session success message -->
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success_message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $index => $category): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $category['nama']; ?></td>
                            <td>
                                <a href="edit_category.php?id=<?php echo $category['id']; ?>"
                                    class="btn btn-warning">Edit</a>
                                <a href="delete_category.php?id=<?php echo $category['id']; ?>" class="btn btn-danger"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus kategori ini?')">Hapus</a>
                            </td>
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
            <form action="category.php" method="POST">
                <div class="form-group mb-3">
                    <label for="nama">nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <a href="inventory.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>

<?php
require '../layout/admin/footer.php';
?>