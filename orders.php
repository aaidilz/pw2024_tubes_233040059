<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

?>


<?php include 'layout/home/header.php'; ?>

<body>

    <!-- navbar -->
    <?php include 'layout/home/navbar.php'; ?>

    <!-- page-content -->
    <section>
        <br>
        <br>
        <br>
        <br>
        <br>
    </section>

   <?php include 'layout/home/order-page.php'; ?>

</body>