<?php

require '../../database/koneksi.php';

$query = $connection->query("SELECT * FROM category");

$categories = [];

while ($row = $query->fetch_assoc()) {
    $categories[] = $row;
}