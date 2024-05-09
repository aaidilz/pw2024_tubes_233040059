<?php
// debug
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require '../../app/database/koneksi.php';

// Validate input
$username = validateInput($_POST['username']);
$password = validateInput($_POST['password']);

// protect from SQL injection :D
$query = $connection->prepare("SELECT * FROM user WHERE username = ?");
$query->bind_param('s', $username);
$query->execute();
$result = $query->get_result();

$row = $result->fetch_assoc();

$verify = password_verify($password, $row['password']);

if ($verify) {
    session_start();
    $_SESSION['username'] = $username;

    if ($row['role'] == 'admin') {
        $_SESSION['role'] = 'admin';
        header("location: ../../admin/dashboard/dashboard.php");
        exit();
    } else {
        $_SESSION['role'] = 'user';
        echo 'Login berhasil sebagai user';
    }
} else {
    header("location: ../../login.php?error=wrongpassword");
    exit();
}
function validateInput($input)
{
    return htmlspecialchars((trim($input)));
}