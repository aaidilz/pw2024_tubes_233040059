<?php

$hostname = 'localhost';
$username = 'root';
$password = 'Password_12345';
$db_name = 'pw2024_tubes_233040059'; // <=== ganti ini jika berubah

$connection = new mysqli($hostname, $username, $password, $db_name);

// Periksa koneksi
if ($connection->connect_error) {
    die("Koneksi ke database gagal: " . $connection->connect_error);
}