<?php
require '../config/protected.php';
require '../layout/admin/header.php';
require '../app/controller/CategoryController.php';

$controller = new CategoryController($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars($_POST['id']);
    $nama = htmlspecialchars($_POST['nama']);

    if ($controller->updateCategory($id, $nama)) {
        header("Location: category.php");
        exit();
    } else {
        $error = "Gagal mengedit kategori.";
    }
} else {
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    if ($id == 0 || !($get_id = $controller->getCategoryById($id))) {
        $_SESSION['error_message'] = 'Kategori tidak ditemukan';
        header("Location: category.php");
        exit();
    }
}
?>

<div class="container mt-4">
    <div class="card w-75 mx-auto">
        <div class="card-header">
            <h1>Edit Category</h1>
        </div>
        <div class="card-body">
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="edit_category.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $get_id['id']; ?>">
                <div class="form-group mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $get_id['nama']; ?>" required>
                </div>
                <a href="category.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>

<!-- end_isi -->
<?php
require '../layout/admin/footer.php';
?>