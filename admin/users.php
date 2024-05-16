<?php
require '../config/protected.php';
require '../app/controller/UserController.php';
require '../layout/admin/header.php';

$controller = new UserController($conn);
$users = $controller->getAllUsers();
?>

<!-- isi -->
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h1>Manajemen Pengguna</h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $counter = 1;?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['role']; ?></td>
                            <td>
                                <?php if ($user['role'] === 'admin'): ?>
                                    <a href="edit_user.php?id=<?php echo $user['id']; ?>"
                                        class="btn btn-warning btn-sm"><i class="fa fa-wrench"></i> Edit</a>
                                <?php else: ?>
                                    <a href="edit_user.php?id=<?php echo $user['id']; ?>"
                                        class="btn btn-warning btn-sm"><i class="fa fa-wrench"></i> Edit</a>
                                    <a href="delete_user.php?id=<?php echo $user['id']; ?>"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="create_user.php" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Pengguna Baru</a>
        </div>
    </div>
</div>


<!-- end_isi -->
<?php
require '../layout/admin/footer.php';
?>