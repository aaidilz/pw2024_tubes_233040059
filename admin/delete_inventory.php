<?php
require '../config/protected.php';
require '../app/controller/InventoryController.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    $controller = new InventoryController($conn);
    $controller->deleteInventory($id);

    header('Location: inventory.php');
}
