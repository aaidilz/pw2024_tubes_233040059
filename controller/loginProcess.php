<?php

require '../database/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = $connection->query("SELECT * FROM user WHERE username = '$username' AND password = '$password'");

if ($query->num_rows > 0) {
    session_start();
    $_SESSION['username'] = $username;

    while ($row = $query->fetch_assoc()) {
        if ($row['role'] == 'admin') {
            header("location: ../admin/dashboard/dashboard.php");
        } else {
            echo 'login berhasil';
        }
    }
} else {
    header("location: ../login.php");
}
