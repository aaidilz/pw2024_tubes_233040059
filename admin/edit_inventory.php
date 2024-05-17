<?php
require '../config/protected.php';
require '../app/controller/InventoryController.php';
require '../layout/admin/header.php';


$controller = new InventoryController($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars($_POST['id']);
    $nama = htmlspecialchars($_POST['nama']);
    $kuantitas = htmlspecialchars($_POST['kuantitas']);
    $harga = htmlspecialchars($_POST['harga']);
    $gambar = $_FILES['gambar'];
    $kategori_id = htmlspecialchars($_POST['kategori_id']);

    if ($controller->updateInventory($id, $nama, $kuantitas, $harga, $gambar, $kategori_id)) {
        header("Location: inventory.php");
        exit();
    } else {
        $error = "Gagal mengedit inventory.";
    }
} else {
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    if ($id == 0 || !($get_id = $controller->getInventoryById($id))) {
        $_SESSION['error_message'] = 'Inventory tidak ditemukan';
        header("Location: inventory.php");
        exit();
    }
    $inventories = $controller->getAllInventory();
    $categories = $controller->getAllCategories();
}
?>

<div class="container mt-4">
    <div class="card w-75 mx-auto">
        <div class="card-header">
            <h1>Edit Inventory</h1>
        </div>
        <div class="card-body">
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="edit_inventory.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $get_id['id']; ?>">
                <div class="form-group mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $get_id['nama']; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="kuantitas">Kuantitas</label>
                    <input type="number" name="kuantitas" id="kuantitas" class="form-control" value="<?php echo $get_id['kuantitas']; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" value="<?php echo $get_id['harga']; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="kategori_id">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $get_id['kategori_id'] ? 'selected' : ''; ?>><?php echo $category['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>