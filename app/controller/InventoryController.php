<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once __DIR__ . '/../../config/database/connection.php';

class InventoryController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function getInventory()
    {
        $sql = "SELECT inventory.inventory_id, inventory.name AS inventory_name, inventory.quantity, inventory.price, category.name AS category_name FROM inventory JOIN category ON inventory.category_id = category.category_id";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getCategories()
    {
        $sql = "SELECT * FROM category";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function createInventory($name, $quantity, $price, $category_id)
    {
        $sql = "INSERT INTO inventory (name, quantity, price, category_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sidi', $name, $quantity, $price, $category_id);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "sukses!";
        } else {
            $_SESSION['error_message'] = "gagal :(";
        }
        header('Location: inventorys.php');
        exit();
    }
    public function createCategory($name)
    {
        $sql = "INSERT INTO category (name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $name);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Category added successfully!";
        } else {
            $_SESSION['error_message'] = "Failed to add category!";
        }
        header('Location: inventorys.php');
        exit();
    }
    public function deleteInventory($inventory_id)
    {
        $sql = "DELETE FROM inventory WHERE inventory_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $inventory_id);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Inventory deleted successfully!";
        } else {
            $_SESSION['error_message'] = "Failed to delete inventory!";
        }
        header('Location: inventorys.php');
        exit();
    }
}