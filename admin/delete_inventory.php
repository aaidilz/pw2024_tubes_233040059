<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: 404.php");
    exit();
}

require '../app/controller/InventoryController.php';

$inventoryController = new InventoryController($conn);

if (isset($_GET['inventory_id'])) {
    $inventory_id = $_GET['inventory_id'];
        $inventoryController->deleteInventory($inventory_id);
} else {
    $_SESSION['error_message'] = "Inventory ID not provided!";
    header('Location: inventorys.php');
    exit();
}