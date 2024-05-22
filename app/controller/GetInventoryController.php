<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database/connection.php';

if (isset($_POST['query']) || isset($_POST['column']) || isset($_POST['direction'])) {
    $query = $conn->real_escape_string($_POST['query']);
    $column = $conn->real_escape_string($_POST['column']);
    $direction = $conn->real_escape_string($_POST['direction']);

    $sql = "SELECT inventory.*, kategori.nama AS kategori_nama 
            FROM inventory 
            LEFT JOIN kategori ON inventory.kategori_id = kategori.id 
            WHERE inventory.nama LIKE '%$query%' 
            ORDER BY $column $direction";
} else {
    $sql = "SELECT inventory.*, kategori.nama AS kategori_nama 
            FROM inventory 
            LEFT JOIN kategori ON inventory.kategori_id = kategori.id";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $counter = 1;
    while ($inventory = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$counter}</td>
                <td><img src='../uploads/{$inventory['gambar']}' alt='' style='width: 100px;'></td>
                <td>{$inventory['nama']}</td>
                <td>{$inventory['kuantitas']}</td>
                <td>{$inventory['harga']}</td>
                <td>{$inventory['kategori_nama']}</td>
                <td>
                    <a href='edit_inventory.php?id={$inventory['id']}' class='btn btn-warning'>Edit</a>
                    <a href='delete_inventory.php?id={$inventory['id']}' class='btn btn-danger'>Hapus</a>
                </td>
              </tr>";
        $counter++;
    }
} else {
    echo "<tr><td colspan='7' class='text-center'>Tidak ada data</td></tr>";
}