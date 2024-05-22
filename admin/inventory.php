<?php
require '../config/protected.php';
require '../layout/admin/header.php';
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h1>Manajemen Inventory</h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="inventoryTable">
                <div class="input-group mb-3 w-25">
                    <input type="text" class="form-control" id="search" placeholder="Cari Nama Inventory">
                    <select class="form-control ml-2" id="orderColumn">
                        <option value="nama">Nama</option>
                        <option value="kuantitas">Kuantitas</option>
                        <option value="harga">Harga</option>
                        <option value="kategori_nama">Kategori</option>
                    </select>
                    <select class="form-control ml-2" id="orderDirection">
                        <option value="ASC">Ascending</option>
                        <option value="DESC">Descending</option>
                    </select>
                </div>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kuantitas</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($inventories)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($inventories as $inventory): ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
                                <td><img src="../uploads/<?php echo $inventory['gambar']; ?>" alt="" style="width: 100px;"></td>
                                <td><?php echo $inventory['nama']; ?></td>
                                <td><?php echo $inventory['kuantitas']; ?></td>
                                <td><?php echo $inventory['harga']; ?></td>
                                <td><?php echo $inventory['kategori_nama']; ?></td>
                                <td>
                                    <a href="edit_inventory.php?id=<?php echo $inventory['id']; ?>"
                                        class="btn btn-warning">Edit</a>
                                    <a href="delete_inventory.php?id=<?php echo $inventory['id']; ?>"
                                        class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </table>
        </div>
        <div class="card-footer">
            <a href="create_inventory.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Kategori</a>
            <a href="category.php" class="btn btn-secondary"><i class="fa fa-database"></i> Manage Kategori</a>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        // Pencarian pertama kali halaman dimuat
        searchInventory("", "nama", "ASC");

        // Fungsi untuk melakukan pencarian
        function searchInventory(query, column, direction) {
            $.ajax({
                url: "../../app/controller/GetInventoryController.php",
                method: "POST",
                data: {
                    query: query,
                    column: column,
                    direction: direction
                },
                success: function (data) {
                    $("#inventoryTable tbody").html(data);
                }
            });
        }

        // Event listener untuk memicu pencarian saat pengguna mengetik
        $("#search").on("keyup", function () {
            var query = $(this).val();
            searchInventory(query, $("#orderColumn").val(), $("#orderDirection").val());
        });

        // Event listener untuk memicu pengurutan saat pengguna memilih kolom dan arah
        $("#orderColumn, #orderDirection").on("change", function () {
            var query = $("#search").val();
            searchInventory(query, $("#orderColumn").val(), $("#orderDirection").val());
        });
    });
</script>

<?php
require '../layout/admin/footer.php';
?>