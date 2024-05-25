<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: index.php');
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