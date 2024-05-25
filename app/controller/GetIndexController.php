<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database/connection.php';

if (isset($_POST['query']) || isset($_POST['column']) || isset($_POST['categoryId'])) {
    $query = $conn->real_escape_string($_POST['query']);
    $column = $conn->real_escape_string($_POST['column']);
    $categoryId = isset($_POST['categoryId']) ? $conn->real_escape_string($_POST['categoryId']) : '';

    if (!empty($query)) {
        $sql = "SELECT inventory.*, kategori.nama AS kategori_nama 
                FROM inventory 
                LEFT JOIN kategori ON inventory.kategori_id = kategori.id 
                WHERE inventory.nama LIKE '%$query%' 
                ORDER BY $column";
    } elseif (!empty($categoryId)) {
        $sql = "SELECT inventory.*, kategori.nama AS kategori_nama 
                FROM inventory 
                LEFT JOIN kategori ON inventory.kategori_id = kategori.id 
                WHERE inventory.kategori_id = '$categoryId' 
                ORDER BY $column";
    } else {
        $sql = "SELECT inventory.*, kategori.nama AS kategori_nama 
                FROM inventory 
                LEFT JOIN kategori ON inventory.kategori_id = kategori.id";
    }
} else {
    $sql = "SELECT inventory.*, kategori.nama AS kategori_nama 
            FROM inventory 
            LEFT JOIN kategori ON inventory.kategori_id = kategori.id";
}

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $counter = 1;
    while ($inventory = $result->fetch_assoc()) {
        echo "
          <div class='col-lg-4 col-md-6 mb-4'>
            <div class='card rounded shadow-sm border-0'>
              <div class='card-body p-4'>
                <div class='card-img-wrapper'>
                  <img src='uploads/{$inventory['gambar']}' alt='' class='img-fluid d-block mx-auto mb-3'>
                </div>
                <h5>
                  <a href='orders.php?id={$inventory['id']}' class='text-dark'>{$inventory['nama']}</a>
                </h5>
                <p class='small text-muted font-italic'>Stock: {$inventory['kuantitas']}</p>
                <h4>Rp{$inventory['harga']}</h4>
              </div>
            </div>
          </div>
        ";
    }
} else {
    echo "<tr><td colspan='7' class='text-center'>Tidak ada data</td></tr>";
}