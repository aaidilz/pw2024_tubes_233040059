<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: 404.php");
    exit();
}

require '../app/controller/InventoryController.php';

$id = $_GET['id'];
$controller = new InventoryController($conn);
if ($controller->deleteInventory($inventory_id)) {
    header("Location: inventorys.php");
    exit();
} else {
    echo "Gagal menghapus inventaris.";
}