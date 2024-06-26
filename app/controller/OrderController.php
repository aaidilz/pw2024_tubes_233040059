<?php
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
        $stmt->bind_param('iiidsssss', $user_id, $inventory_id, $quantity, $total_price, $name, $email, $address, $paymentMethod, $status);
        return $stmt->execute();

    }    
    public function reduceInventoryQuantity($product_id, $quantity) {
        $sql = "UPDATE inventory SET kuantitas = kuantitas - ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $quantity, $product_id);
        $stmt->execute();
        $stmt->close();
    }
    
    // get all orders
    public function getAllOrders(){
        $sql = "SELECT orders.*, user.username as user_name, inventory.nama as inventory_name, orders.email
                FROM orders
                JOIN user ON orders.user_id = user.id
                JOIN inventory ON orders.inventory_id = inventory.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }
    
    // get order by id
    public function getOrderById($id){
        $sql = "SELECT orders.*, user.username as user_name, inventory.nama as inventory_name, orders.email
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

    // delete order
    public function deleteOrder($id){
        $sql = "DELETE FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function getOrderDetailsByUserId($user_id) {
        $sql = "SELECT orders.*, user.username as user_name, inventory.nama as inventory_name, inventory.harga, orders.email
        FROM orders
        JOIN user ON orders.user_id = user.id
        JOIN inventory ON orders.inventory_id = inventory.id
        WHERE orders.user_id = ?";

    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $orderDetails = array();
    
        while ($row = $result->fetch_assoc()) {
            $orderDetails[] = $row;
        }
    
        return $orderDetails;
    }

    public function getOrderCount() {
        $sql = "SELECT COUNT(*) as total_orders FROM orders";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function getTotalSales() {
        $sql = "SELECT SUM(total_price) as total_sales FROM orders";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function getTotalStatus() {
        $sql = "SELECT status, COUNT(*) as total_status FROM orders GROUP BY status";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $totalStatus = array();
    
        while ($row = $result->fetch_assoc()) {
            $totalStatus[] = $row;
        }
    
        return $totalStatus;
    }
    public function getTotalInventory() {
        $sql = "SELECT COUNT(*) as total_inventory FROM inventory";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}