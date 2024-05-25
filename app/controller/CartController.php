<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database/connection.php';

class CartController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getOrdersByUserId($user_id)
    {
        $sql = "SELECT orders.*, inventory.nama
        FROM orders
        JOIN inventory ON orders.inventory_id = inventory.id
        WHERE orders.user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $orders = array();
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        $stmt->close();
        return $orders;
    }

    
}