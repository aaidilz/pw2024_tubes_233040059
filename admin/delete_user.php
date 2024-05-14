<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: 404.php");
    exit();
}

require '../app/controller/UserController.php';

$id = $_GET['id'];
$controller = new UserController($conn);
if ($controller->deleteUser($id)) {
    header("Location: users.php");
    exit();
} else {
    echo "Gagal menghapus pengguna.";
}