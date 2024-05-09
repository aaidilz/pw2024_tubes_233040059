<?php

require '../../app/database/koneksi.php';

$query = $connection->query("SELECT * FROM user");

$users = [];

while ($row = $query->fetch_assoc()) {
    if ($row['role'] !== 'admin') {
        $users[] = $row;
    }
}
