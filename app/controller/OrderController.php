<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database/connection.php';

class OrderController{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }
    
    // get inventory by id
    public function getInventoryById($id){
        $sql = "SELECT * FROM inventory WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // get user by id session
    public function getUserById($id){
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // add to order
    public function addToCart($user_id, $inventory_id, $quantity, $total_price, $name, $email, $address, $paymentMethod) {
        $sql = "INSERT INTO orders (user_id, inventory_id, quantity, total_price, name, email, address, paymentMethod) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iiidsdss', $user_id, $inventory_id, $quantity, $total_price, $name, $email, $address, $paymentMethod);
        return $stmt->execute();
    }
    
}