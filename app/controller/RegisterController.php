<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database/connection.php';

class RegisterController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function register($username, $password, $email, $role = 'user')
    {
        // validasi username
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error_message'] = "Username sudah digunakan!";
            header('Location: ../../register.php');
            exit();
        }

        // validasi email
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error_message'] = "Email sudah digunakan!";
            header('Location: ../../register.php');
            exit();
        }

        // create new account
        $sql = "INSERT INTO user (username, password, email, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssss', $username, password_hash($password, PASSWORD_DEFAULT), $email, $role);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['success_message'] = "Registrasi berhasil!";
            header('Location: ../../login.php');
        } else {
            $_SESSION['error_message'] = "Registrasi gagal!";
            header('Location: ../../register.php');
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);


    // check password confirmation
    if ($password !== $confirm_password) {
        $_SESSION['error_message'] = "Konfirmasi password tidak sesuai!";
        header('Location: ../../register.php');
        exit();
    } else {
        $controller = new RegisterController($conn);
        $controller->register($username, $password, $email);
    }
}
