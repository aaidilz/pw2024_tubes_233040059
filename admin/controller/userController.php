<?php

// debug
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// delete user
if (isset($_GET['action']) && isset($_GET['id']) && !empty($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == 'delete') {
        deleteUser($id);
    }
}

function deleteUser($id)
{
    require_once '../../database/koneksi.php';
    $query = $connection->query("DELETE FROM user WHERE id = $id");

    if ($query) {
        header('Location: ../dashboard/user.php');
        exit;
    } else {
        echo 'Gagal menghapus user';
    }
}
