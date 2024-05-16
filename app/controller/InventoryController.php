<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database/connection.php';

class InventoryController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllInventory()
    {
        $sql = "SELECT inventory.*, kategori.nama AS kategori_nama FROM inventory LEFT JOIN kategori ON inventory.kategori_id = kategori.id";
        $result = $this->conn->query($sql);

        $inventory = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $inventory[] = $row;
            }
        }
        return $inventory;
    }
    public function getAllCategories()
    {
        $sql = "SELECT * FROM kategori";
        $result = $this->conn->query($sql);

        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        return $categories;
    }

    public function createInventory($nama, $kuantitas, $harga, $gambar, $kategori_id) {
        $target_dir = __DIR__ . '/../../uploads/';
        $target_file = $target_dir . basename($gambar['name']); //anti path traversal
    
        $sql = "INSERT INTO inventory (nama, kuantitas, harga, gambar, kategori_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('siisi', $nama, $kuantitas, $harga, $gambar['name'], $kategori_id);
    
        if ($stmt->execute()) {
            if (move_uploaded_file($gambar['tmp_name'], $target_file)) {
                $_SESSION['success_message'] = 'Inventory berhasil ditambahkan';
                header('Location: inventory.php');
                exit();
            } else {
                $_SESSION['error_message'] = 'Gagal mengupload gambar';
                header('Location: create_inventory.php');
                exit();
            }
        } else {
            $_SESSION['error_message'] = 'Gagal menambahkan inventory';
            header('Location: create_inventory.php');
            exit();
        }
    }
    
}