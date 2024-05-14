<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("location: 404.php");
    exit();
}
require '../layout/admin/header.php';
?>

<!-- isi -->

<?php
require '../layout/admin/footer.php';
?>