<?php
require '../config/protected.php';
require '../layout/admin/header.php';
require '../app/controller/InventoryController.php';

$controller = new InventoryController($conn);
$categories = $controller->getAllCategories();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $kuantitas = htmlspecialchars($_POST['kuantitas']);
    $harga = htmlspecialchars($_POST['harga']);
    $kategori_id = htmlspecialchars($_POST['kategori']);
    $gambar = ($_FILES['gambar']);

    $controller->createInventory($nama, $kuantitas, $harga, $gambar, $kategori_id);
}
?>

<div class="container mt-4">
    <div class="card w-75 mx-auto">
        <div class="card-header">
            <h1>Tambah inventaris baru</h1>
        </div>
        <div class="card-body">
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>
            <form action="create_inventory.php" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="username">nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="kuantitas">kuantitas</label>
                    <input type="number" name="kuantitas" id="kuantitas" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="harga">harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="kategori">kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="gambar">gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control" required>
                </div>
                <a href="inventory.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>

<!-- end_isi -->
<?php
require '../layout/admin/footer.php';
?>