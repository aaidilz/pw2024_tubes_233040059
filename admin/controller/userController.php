<?php

// debug
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// HANDLE -----------------------------
// get add user
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    try {
        if ($action == 'add') {
            addUser();
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
// delete user
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    try {
        if ($action == 'delete') {
            deleteUser($id);
        } else {
            throw new Exception('Aksi tidak valid');
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
// HANDLE -----------------------------

// Add user function
function addUser()
{
    require_once '../../app/database/koneksi.php';

    // Validate input
    $username = validateInput($_POST['username']);
    $email = validateInput($_POST['email']);
    $password = password_hash(validateInput($_POST['password']), PASSWORD_DEFAULT);

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // protect from SQL injection :D
    $query = $connection->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
    $query->bind_param('sss', $username, $email, $hashed);

    if ($query->execute()) {
        header('Location: ../dashboard/user.php');
        exit;
    } else {
        throw new Exception('Gagal menambahkan user');
    }
}
// delete user function
function deleteUser($id)
{
    require_once '../../app/database/koneksi.php';

    // Validate ID
    if (!is_numeric($id) || $id <= 0) {
        throw new Exception('ID pengguna tidak valid');
    }

    // protect from SQL injection :D
    $query = $connection->prepare("DELETE FROM user WHERE id = ?");
    $query->bind_param("i", $id);

    if ($query->execute()) {
        header('Location: ../dashboard/user.php');
        exit;
    } else {
        throw new Exception('Gagal menghapus user');
    }
}
// Validate input function
function validateInput($input)
{
    return htmlspecialchars(trim($input));
}