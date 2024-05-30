<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database/connection.php';

$record_per_page = 5;
$page = isset($_POST["page"]) ? $_POST["page"] : 1;
$start_from = ($page - 1) * $record_per_page;

$query = "";
$column = "user_name";
$direction = "ASC";

if (isset($_POST['query']) && isset($_POST['column']) && isset($_POST['direction'])) {
    $query = $conn->real_escape_string($_POST['query']);
    $column = $conn->real_escape_string($_POST['column']);
    $direction = $conn->real_escape_string($_POST['direction']);
}

$sql = "SELECT orders.*, user.username AS user_name, inventory.nama AS inventory_name 
        FROM orders 
        LEFT JOIN user ON orders.user_id = user.id 
        LEFT JOIN inventory ON orders.inventory_id = inventory.id 
        WHERE user.username LIKE ? OR inventory.nama LIKE ? 
        ORDER BY $column $direction 
        LIMIT $start_from, $record_per_page";

$stmt = $conn->prepare($sql);
$search_query = '%' . $query . '%';
$stmt->bind_param('ss', $search_query, $search_query);
$stmt->execute();
$result = $stmt->get_result();

$output = '';
if ($result->num_rows > 0) {
    while ($order = $result->fetch_assoc()) {
        $output .= "<tr>
                        <td>{$order['id']}</td>
                        <td>{$order['user_name']}</td>
                        <td>{$order['inventory_name']}</td>
                        <td>{$order['quantity']}</td>
                        <td>Rp{$order['total_price']}</td>
                        <td>{$order['email']}</td>
                        <td>{$order['address']}</td>
                        <td>{$order['paymentMethod']}</td>
                        <td>{$order['status']}</td>
                        <td>
                            <a href='edit_order.php?id={$order['id']}' class='btn btn-warning'><i class='fa fa-wrench'></i> Edit</a>
                            <a href='invoice.php?id={$order['id']}' class='btn btn-primary'><i class='fa fa-file-invoice'></i> Invoice</a>
                        </td>
                    </tr>";
    }
} else {
    $output .= "<tr><td colspan='10' class='text-center'>Tidak ada data</td></tr>";
}

// Pagination logic
$page_query = "SELECT COUNT(*) AS total_records 
               FROM orders 
               LEFT JOIN user ON orders.user_id = user.id 
               LEFT JOIN inventory ON orders.inventory_id = inventory.id 
               WHERE user.username LIKE ? OR inventory.nama LIKE ?";

$stmt = $conn->prepare($page_query);
$stmt->bind_param('ss', $search_query, $search_query);
$stmt->execute();
$page_result = $stmt->get_result();
$row = $page_result->fetch_assoc();
$total_records = $row['total_records'];
$total_pages = ceil($total_records / $record_per_page);

$pagination = '<nav><ul class="pagination justify-content-center">';
for ($i = 1; $i <= $total_pages; $i++) {
    $pagination .= "<li class='page-item'><a class='page-link' href='#' data-page_number='{$i}'>{$i}</a></li>";
}
$pagination .= '</ul></nav>';

$response = array(
    'table_data' => $output,
    'pagination' => $pagination
);

echo json_encode($response);

