<?php
require '../config/protected.php';
require '../app/controller/CategoryController.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    $controller = new CategoryController($conn);
    $controller->deleteCategory($id);

    header('Location: category.php');
}