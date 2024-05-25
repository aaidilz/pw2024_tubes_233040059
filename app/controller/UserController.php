<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database/connection.php';

class UserController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function getAllUsers()
    {
        $sql = "SELECT * FROM user";
        $result = $this->conn->query($sql);

        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createUser($username, $password, $email, $role)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO user (username, password, email, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssss', $username, $hashedPassword, $email, $role);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'User berhasil ditambahkan';
            header('Location: users.php');
        } else {
            $_SESSION['error_message'] = 'User gagal ditambahkan';
            header('Location: users.php');
        }
    }

    public function updateUser($id, $username, $role)
    {
        $sql = "UPDATE user SET username = ?, role = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssi', $username, $role, $id);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'User berhasil diupdate';
            header('Location: users.php');
        } else {
            $_SESSION['error_message'] = 'User gagal diupdate';
            header('Location: users.php');
        }
    }

    // periksa apakah user sedang digunakan oleh orders
    public function deleteUser($id)
    {
        $totalOrders = 0;
        $sql = "SELECT COUNT(*) as total_orders FROM orders WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($totalOrders);
        $stmt->fetch();
        $stmt->close();

        if ($totalOrders > 0) {
            $_SESSION['error_message'] = 'User sedang digunakan oleh table orders';
            header('Location: users.php');
            exit;
        } else {
            $sql = "DELETE FROM user WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('i', $id);
            
            if ($stmt->execute()) {
                $_SESSION['success_message'] = 'User berhasil dihapus';
                header('Location: users.php');
            } else {
                $_SESSION['error_message'] = 'User gagal dihapus';
                header('Location: users.php');
            }
        }
        
    }

    public function getUserCount()
    {
        $sql = "SELECT COUNT(*) as total_users FROM user";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
}
