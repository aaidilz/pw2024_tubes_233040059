<?php
require '../database/koneksi.php'; // Sesuaikan dengan path yang sesuai

// Cek apakah tabel category sudah memiliki data
$queryCheck = $connection->query("SELECT COUNT(*) as count FROM category");
$rowCheck = $queryCheck->fetch_assoc();
if ($rowCheck['count'] > 0) {
    // Kosongkan tabel category
    $connection->query("TRUNCATE TABLE category");
    // Set auto-increment ke nilai awal
    $connection->query("ALTER TABLE category AUTO_INCREMENT = 1");
}

// Data yang akan dimasukkan ke dalam tabel category
$categories = [
    ['name' => 'Category 1', 'description' => 'Deskripsi kategori 1'],
    ['name' => 'Category 2', 'description' => 'Deskripsi kategori 2'],
    ['name' => 'Category 3', 'description' => 'Deskripsi kategori 3']
];

// Loop untuk memasukkan data ke dalam tabel
foreach ($categories as $category) {
    $name = $category['name'];
    $description = $category['description'];

    // Insert data menggunakan prepared statement
    $stmt = $connection->prepare("INSERT INTO category (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $description);
    $stmt->execute();
}

echo "Data berhasil dimasukkan ke dalam tabel category.";
?>
