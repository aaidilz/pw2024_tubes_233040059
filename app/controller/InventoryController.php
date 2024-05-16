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
}