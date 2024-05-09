<div class="container">
    <h4>Configure Application</h4>
</div>
<div class="container-fluid">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Category</h1>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($categories as $category) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $category['name']; ?></td>
                                <td><?= $category['description']; ?></td>
                                <td>
                                    <a href="edit-category.php?id=<?= $category['id']; ?>" class="btn btn-warning">Edit</a>
                                    <a href="../controller/categoryController.php?action=delete&id=<?php echo $category['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini? ini sangat berpengaruh pada relasi antar barang?')">Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                </table>
                <a href="add-category.php" class="btn btn-primary">Tambah User</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="container mt-5"></div>
</div>