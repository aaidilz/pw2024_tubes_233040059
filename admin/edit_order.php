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
        header("Location: order.php");
        exit();
    } else {
        $error = "Gagal mengedit order.";
    }
}

?>

<div class="container mt-4 w-50">
    <div class="card">
        <div class="card-header">
            <h1>Edit Order</h1>
        </div>
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="edit_order.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="Sending" <?php echo $order['status'] == 'Sending' ? 'selected' : ''; ?>>Sending</option>
                        <option value="Complete" <?php echo $order['status'] == 'Complate' ? 'selected' : ''; ?>>Complete</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>