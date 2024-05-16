<?php
require '../config/protected.php';
require '../app/controller/UserController.php';
require '../layout/admin/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $role = htmlspecialchars($_POST['role']);

    $controller = new UserController($conn);
    if ($controller->createUser($username, $password, $email, $role)) {
        header("Location: users.php");
        exit();
    } else {
        $error = "Gagal menambah pengguna.";
    }
}
?>

<!-- isi -->
<div class="container mt-4">
    <div class="card w-75 mx-auto">
        <div class="card-header">
            <h1>Tambah Pengguna Baru</h1>
        </div>
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="create_user.php" method="POST">
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>

<!-- end_isi -->
<?php
require '../layout/admin/footer.php';
?>
