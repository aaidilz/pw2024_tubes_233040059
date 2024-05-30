<?php

require '../config/protected.php';
require '../app/controller/OrderController.php';
require '../layout/admin/header.php';

?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h1>Manajemen Order</h1>
        </div>
        <div class="card-body">
            <div class="container d-flex">
                <div class="input-group mb-3 w-75">
                    <input type="text" class="form-control" id="search" placeholder="Cari Order">
                </div>
                <div class="input-group mb-3 w-25">
                    <select class="form-control" id="orderColumn">
                        <option value="user_name">User Name</option>
                        <option value="inventory_name">Inventory Name</option>
                        <option value="total_price">Total Price</option>
                        <option value="status">Status</option>
                    </select>
                </div>
                <div class="input-group mb-3 w-25">
                    <select class="form-control" id="orderDirection">
                        <option value="ASC">Ascending</option>
                        <option value="DESC">Descending</option>
                    </select>
                </div>
            </div>
            <table class="table table-bordered" id="orderTable">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Inventory Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be loaded via AJAX -->
                </tbody>
            </table>
            <!-- Pagination -->
            <nav>
                <ul class="pagination justify-content-center" id="pagination">
                    <!-- Pagination links will be loaded via AJAX -->
                </ul>
            </nav>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        // Initial load
        loadOrders(1, "", "user_name", "ASC");

        // Function to load orders with pagination, search, and sorting
        function loadOrders(page, query, column, direction) {
            $.ajax({
                url: "../app/controller/GetOrderController.php",
                method: "POST",
                data: {
                    page: page,
                    query: query,
                    column: column,
                    direction: direction
                },
                success: function (data) {
                    var parsedData = JSON.parse(data);
                    $("#orderTable tbody").html(parsedData.table_data);
                    $("#pagination").html(parsedData.pagination);
                }
            });
        }

        // Event listener for search input
        $("#search").on("keyup", function () {
            var query = $(this).val();
            loadOrders(1, query, $("#orderColumn").val(), $("#orderDirection").val());
        });

        // Event listeners for sorting options
        $("#orderColumn, #orderDirection").on("change", function () {
            var query = $("#search").val();
            loadOrders(1, query, $("#orderColumn").val(), $("#orderDirection").val());
        });

        // Event listener for pagination
        $(document).on('click', '.page-link', function (e) {
            e.preventDefault();
            var page = $(this).data('page_number');
            var query = $("#search").val();
            loadOrders(page, query, $("#orderColumn").val(), $("#orderDirection").val());
        });
    });
</script>

<!-- end_isi -->
<?php
require '../layout/admin/footer.php';
?>
