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
    public function addToCart($user_id, $inventory_id, $quantity, $total_price, $name, $email, $address, $paymentMethod, $status = 'pending') {
        $sql = "INSERT INTO orders (user_id, inventory_id, quantity, total_price, name, email, address, paymentMethod, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iiidsdsss', $user_id, $inventory_id, $quantity, $total_price, $name, $email, $address, $paymentMethod, $status);
        return $stmt->execute();
    }
    
    // get all orders
    public function getAllOrders(){
        $sql = "SELECT orders.*, user.username as user_name, inventory.nama as inventory_name, user.email
                FROM orders
                JOIN user ON orders.user_id = user.id
                JOIN inventory ON orders.inventory_id = inventory.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }
    
    // get order by id
    public function getOrderById($id){
        $sql = "SELECT orders.*, user.username as user_name, inventory.nama as inventory_name, user.email
                FROM orders
                JOIN user ON orders.user_id = user.id
                JOIN inventory ON orders.inventory_id = inventory.id
                WHERE orders.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // update order
    public function updateOrder($id, $status){
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $status, $id);
        return $stmt->execute();
    }
}