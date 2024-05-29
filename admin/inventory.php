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
                <div class="container d-flex">
                    <div class="input-group mb-3 w-75">
                        <input type="text" class="form-control" id="search" placeholder="Cari Nama Inventory">
                    </div>
                    <div class="input-group mb-3 w-25">
                        <select class="form-control" id="orderColumn">
                            <option value="nama">Nama</option>
                            <option value="kuantitas">Kuantitas</option>
                            <option value="harga">Harga</option>
                            <option value="kategori_nama">Kategori</option>
                        </select>
                    </div>
                    <div class="input-group mb-3 w-25">
                        <select class="form-control" id="orderDirection">
                            <option value="ASC">Ascending</option>
                            <option value="DESC">Descending</option>
                        </select>
                    </div>
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
                    <!-- Data akan dimuat melalui AJAX -->
                </tbody>
            </table>
             <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center" id="pagination">
                <!-- Pagination links akan dimuat melalui AJAX -->
            </ul>
        </nav>
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
        loadInventory(1, "", "nama", "ASC");

        // Fungsi untuk melakukan pencarian dan memuat data dengan pagination
        function loadInventory(page, query, column, direction) {
            $.ajax({
                url: "../../app/controller/GetInventoryController.php",
                method: "POST",
                data: {
                    page: page,
                    query: query,
                    column: column,
                    direction: direction
                },
                success: function (data) {
                    var parsedData = JSON.parse(data);
                    $("#inventoryTable tbody").html(parsedData.table_data);
                    $("#pagination").html(parsedData.pagination);
                }
            });
        }

        // Event listener untuk memicu pencarian saat pengguna mengetik
        $("#search").on("keyup", function () {
            var query = $(this).val();
            loadInventory(1, query, $("#orderColumn").val(), $("#orderDirection").val());
        });

        // Event listener untuk memicu pengurutan saat pengguna memilih kolom dan arah
        $("#orderColumn, #orderDirection").on("change", function () {
            var query = $("#search").val();
            loadInventory(1, query, $("#orderColumn").val(), $("#orderDirection").val());
        });

        // Event listener untuk pagination
        $(document).on('click', '.page-link', function (e) {
            e.preventDefault();
            var page = $(this).data('page_number');
            var query = $("#search").val();
            loadInventory(page, query, $("#orderColumn").val(), $("#orderDirection").val());
        });
    });
</script>


<!-- end_isi -->
<?php
require '../layout/admin/footer.php';
?>