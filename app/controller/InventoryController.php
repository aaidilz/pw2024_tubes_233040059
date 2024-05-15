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
    // inventory ========================
    public function getAllInventorys()
    {
        $sql = "SELECT * FROM inventory";
        $result = $this->conn->query($sql);

        $inventorys = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $inventorys[] = $row;
            }
        }
        return $inventorys;
    }

    public function getInventoryById($id)
    {
        $sql = "SELECT * FROM inventory WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createInventory($name, $quantity, $price, $category_id)
    {
        $sql = "INSERT INTO inventory (name, quantity, price, category_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('siii', $name, $quantity, $price, $category_id);
        return $stmt->execute();
    }
    public function updateInventory($id, $name, $quantity, $price, $category_id)
    {
        $sql = "UPDATE inventory SET name = ?, quantity = ?, price = ?, category_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('siiii', $name, $quantity, $price, $category_id, $id);
        return $stmt->execute();
    }
    // category ========================
    public function getAllCategories()
    {
        $sql = "SELECT * FROM category";
        $result = $this->conn->query($sql);

        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        return $categories;
    }
    public function deleteInventory($id)
    {
        $sql = "DELETE FROM inventory WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function createCategory($name)
    {
        $sql = "INSERT INTO category (name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $name);
        return $stmt->execute();
    }
    public function deleteCategory($id)
    {
        $sql = "DELETE FROM category WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

}