<?php
session_start();
require '../../config/database/connection.php';

class LoginController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login($username, $password)
    {
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header('Location: ../../admin/dashboard.php');
            } else {
                echo "hello user!";
            }
            exit();

        } else {
            $_SESSION['error_message'] = "Username atau password salah!";
            header('Location: ../../login.php');
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $controller = new LoginController($conn);
    $controller->login($username, $password);
}

