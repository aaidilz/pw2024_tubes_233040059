<?php
require '../../database/koneksi.php';
require '../controller/authController.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php include '../../layout/admin/header.php'; ?>
<body>
    <?php include '../../layout/admin/navbar.php'; ?>
    <div class="container-fluid">
        <?php include '../../view/admin/add-user-page.php'; ?>
    </div>
</body>

</html>