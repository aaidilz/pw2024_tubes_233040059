<?php

// menyambungkan ke database
$hostname = 'localhost';
$username = 'root';
$password = 'Password_12345';
$db_name = 'tubes'; // <=== ganti ini jika berubah

$connection = mysqli_connect($hostname, $username, $password);

// cek koneksi
if (!$connection) {
    die("gagal masuk :/");
}

