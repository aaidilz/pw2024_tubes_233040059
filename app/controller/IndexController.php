<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database/connection.php';

class IndexController
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

        $inventories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $inventories[] = $row;
            }
        }
        return $inventories;
    }

    // get all categories
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
}