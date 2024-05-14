<?php

$hostname = 'localhost';
$username = 'root';
$password = 'Password_12345';
$db_name = 'pw2024_tubes_233040059'; // <=== ganti ini jika berubah

$conn = new mysqli($hostname, $username, $password, $db_name);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}