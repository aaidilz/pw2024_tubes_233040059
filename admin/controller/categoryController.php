<?php

// debug
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// HANDLE -----------------------------
// get add category
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    try {
        if ($action == 'add') {
            addCategory();
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
// delete category
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    try {
        if ($action == 'delete') {
            deleteCategory($id);
        } else {
            throw new Exception('Aksi tidak valid');
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
// HANDLE -----------------------------

// Add category function
function addCategory()
{
    require_once '../../database/koneksi.php';

    // Validate input
    $name = validateInput($_POST['name']);
    $description = validateInput($_POST['description']);

    // protect from SQL injection :D
    $query = $connection->prepare("INSERT INTO category (name, description) VALUES (?, ?)");
    $query->bind_param('ss', $name, $description);

    if ($query->execute()) {
        header('Location: ../dashboard/application.php');
        exit;
    } else {
        throw new Exception('Gagal menambahkan kategori');
    }
}

// delete category function

function deleteCategory($id)
{
    require_once '../../database/koneksi.php';

    // protect from SQL injection :D
    $query = $connection->prepare("DELETE FROM category WHERE id = ?");
    $query->bind_param('i', $id);

    if ($query->execute()) {
        header('Location: ../dashboard/application.php');
        exit;
    } else {
        throw new Exception('Gagal menghapus kategori');
    }
}

// Validate input

function validateInput($input)
{
    return htmlspecialchars(trim($input));
}