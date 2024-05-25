<?php

require '../config/protected.php';
require '../app/controller/OrderController.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    $controller = new OrderController($conn);
    $controller->deleteOrder($id);

    header('Location: order.php');
}