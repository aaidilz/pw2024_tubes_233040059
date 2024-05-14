<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include 'layout/home/header.php'; ?>

<body>

    <!-- navbar -->
    <?php include 'layout/home/navbar.php'; ?>

    <!-- page-content -->
    <?php include 'layout/home/page-content.php'; ?>

    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3, // Tampilkan 3 gambar secara default
            spaceBetween: 15, // Spasi antara gambar
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</body>

</html>