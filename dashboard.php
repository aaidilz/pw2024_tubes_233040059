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

<body style="overflow: hidden;">
    <?php include 'layout/dashboard/navbar.php'; ?>
    <div class="row">
        <div class="col-md-3">
            <?php include 'layout/dashboard/sidebar.php'; ?>
        </div>
        <div class="col-md-9">
            <?php include 'layout/dashboard/page-content.php'; ?>
        </div>
    </div>
</body> 

</html>