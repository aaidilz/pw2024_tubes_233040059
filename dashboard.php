<?php

// proteksi halaman dengan session
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'layout/dashboard/header.php'; ?>
<body>
    <?php include 'layout/dashboard/navbar.php'; ?>
    <div class="container-fluid">
        <?php include 'view/admin/main-page.php'; ?>
    </div>
</body>

</html>