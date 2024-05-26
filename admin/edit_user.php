<?php
require '../config/protected.php';
require '../layout/admin/header.php';
require '../app/controller/UserController.php';

$controller = new UserController($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars($_POST['id']);
    $username = htmlspecialchars($_POST['username']);
    $role = htmlspecialchars($_POST['role']);

    if ($controller->updateUser($id, $username, $role)) {
        header("Location: users.php");
        exit();
    } else {
        $error = "Gagal mengedit pengguna.";
    }
} else {
    $id = $_GET['id'];
    $user = $controller->getUserById($id);
}
?>

<div class="container mt-4 w-50">
    <div class="card">
        <div class="card-header">
            <h1>Edit Pengguna</h1>
        </div>
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="edit_user.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo $user['username']; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
                <a href="users.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>


<!-- end_isi -->
<?php
require '../layout/admin/footer.php';
?>