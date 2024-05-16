<?php
require '../config/protected.php';
require '../app/controller/UserController.php';

$id = $_GET['id'];
$controller = new UserController($conn);
if ($controller->deleteUser($id)) {
    header("Location: users.php");
    exit();
} else {
    echo "Gagal menghapus pengguna.";
}