<?php
require '../config/protected.php';
require '../layout/admin/header.php';
require '../app/controller/OrderController.php';

$controller = new OrderController($conn);

$id = $_GET['id'];
$order = $controller->getOrderById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars($_POST['id']);
    $status = htmlspecialchars($_POST['status']);

    if ($controller->updateOrder($id, $status)) {
        header('Location: order.php');
    } else {
        $error_message = "Gagal mengedit order.";
    }
}

?>

<div class="container mt-4 w-50">
    <div class="card">
        <div class="card-header">
            <h1>Edit Order</h1>
        </div>
        <div class="card-body">
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form action="edit_order.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="sending" <?php echo $order['status'] == 'sending' ? 'selected' : ''; ?>>Sending</option>
                        <option value="complete" <?php echo $order['status'] == 'complate' ? 'selected' : ''; ?>>Complete</option>
                    </select>
                </div>
                <div class="card-footer">
                    <a href="order.php" class="btn btn-secondary">Kembali</a>
                    <a href="delete_order.php?id=<?php echo $order['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus invoice ini?')">Hapus</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- end_isi -->
<?php
require '../layout/admin/footer.php';
?>