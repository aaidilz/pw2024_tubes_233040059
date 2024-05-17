<?php
// Koneksi ke database dan query pencarian data
require '../config/database/connection.php'; // Sesuaikan dengan path file connection.php Anda


if(isset($_GET['query'])){
    $query = $_GET['query'];
    $sql = "SELECT * FROM inventory WHERE nama LIKE '%$query%'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<li>" . $row['nama'] . "</li>"; // Mengambil data dari kolom 'nama'
        }
    } else {
        echo "<li>Tidak ada hasil ditemukan</li>";
    }
}
?>
