<?php
require '../connection.php';

$queryCheck = $conn->query("SELECT COUNT(*) as count FROM user");
$rowCheck = $queryCheck->fetch_assoc();
if ($rowCheck['count'] > 0) {
    $conn->query("TRUNCATE TABLE user");
    $conn->query("ALTER TABLE user AUTO_INCREMENT = 1");
}

// Data yang akan dimasukkan ke dalam tabel user
$users = [
    ['username' => 'admin', 'email' => 'admin@example.com', 'password' => password_hash('admin123', PASSWORD_DEFAULT), 'role' => 'admin'],
    ['username' => 'user1', 'email' => 'user1@example.com', 'password' => password_hash('user123', PASSWORD_DEFAULT), 'role' => 'user'],
    ['username' => 'user2', 'email' => 'user2@example.com', 'password' => password_hash('user456', PASSWORD_DEFAULT), 'role' => 'user']
];

// Loop untuk memasukkan data ke dalam tabel
foreach ($users as $user) {
    $username = $user['username'];
    $email = $user['email'];
    $password = $user['password'];
    $role = $user['role'];

    // Insert data menggunakan prepared statement
    $stmt = $conn->prepare("INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $role);
    $stmt->execute();
}

echo "Data berhasil dimasukkan!";