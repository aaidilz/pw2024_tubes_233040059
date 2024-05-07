
<div class="container-fluid">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Welcome to Your User Page</h1>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($users as $user) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $user['username']; ?></td>
                                <td><?= $user['email']; ?></td>
                                <td>
                                    <a href="edit-user.php?id=<?= $user['id']; ?>" class="btn btn-warning">Edit</a>
                                    <a href="../controller/userController.php?action=delete&id=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="#" class="btn btn-primary">Tambah User</a>
            </div>
        </div>
    </div>
</div>