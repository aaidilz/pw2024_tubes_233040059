<?php
require 'init.php';
?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include $path . '/layout/home/header.php'; ?>

<body class="bg-black">

    <!-- navbar -->
    <?php include $path . '/layout/home/navbar.php'; ?>

    <!-- page-content -->
    <?php include $path . '/layout/home/page-content.php'; ?>

    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3, // Tampilkan 3 gambar secara default
            spaceBetween: 30, // Spasi antara gambar
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</body>

</html>