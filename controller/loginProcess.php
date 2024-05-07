<?php

require '../database/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = $connection->query("SELECT * FROM admin WHERE username = '$username' AND password = '$password'");

if ($query->num_rows > 0) {
    session_start();
    $_SESSION['username'] = $username;
    header('location:../dashboard.php');
} else {
    header('location:../login.php');
}