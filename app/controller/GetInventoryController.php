<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database/connection.php';

$record_per_page = 5;
$page = '';
$output = '';
if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $record_per_page;

$query = "";
$column = "nama";
$direction = "ASC";

if (isset($_POST['query']) && isset($_POST['column']) && isset($_POST['direction'])) {
    $query = $conn->real_escape_string($_POST['query']);
    $column = $conn->real_escape_string($_POST['column']);
    $direction = $conn->real_escape_string($_POST['direction']);
}

$sql = "SELECT inventory.*, kategori.nama AS kategori_nama 
        FROM inventory 
        LEFT JOIN kategori ON inventory.kategori_id = kategori.id 
        WHERE inventory.nama LIKE '%$query%' 
        ORDER BY $column $direction 
        LIMIT $start_from, $record_per_page";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $counter = $start_from + 1;
    while ($inventory = $result->fetch_assoc()) {
        $output .= "<tr>
                        <td>{$counter}</td>
                        <td><img src='../uploads/{$inventory['gambar']}' alt='' style='width: 100px;'></td>
                        <td>{$inventory['nama']}</td>
                        <td>{$inventory['kuantitas']}</td>
                        <td>Rp{$inventory['harga']}</td>
                        <td>{$inventory['kategori_nama']}</td>
                        <td>
                            <a href='edit_inventory.php?id={$inventory['id']}' class='btn btn-warning'>Edit</a>
                            <a href='delete_inventory.php?id={$inventory['id']}' class='btn btn-danger'>Hapus</a>
                        </td>
                    </tr>";
        $counter++;
    }
} else {
    $output .= "<tr><td colspan='7' class='text-center'>Tidak ada data</td></tr>";
}

// Pagination logic
$page_query = "SELECT * FROM inventory WHERE nama LIKE '%$query%'";
$page_result = $conn->query($page_query);
$total_records = $page_result->num_rows;
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