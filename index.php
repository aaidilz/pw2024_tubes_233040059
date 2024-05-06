<?php

require 'function/function.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/public/css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.css" integrity="sha512-pmAAV1X4Nh5jA9m+jcvwJXFQvCBi3T17aZ1KWkqXr7g/O2YMvO8rfaa5ETWDuBvRq6fbDjlw4jHL44jNTScaKg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/fontawesome.min.js" integrity="sha512-1M9vud0lqoXACA9QaA8IY8k1VR2dMJ2Qmqzt9pN2AH7eQHWpNsxBpaayV0kKkUsF7FLVQ2sA2SSc8w5VOm7/mg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="bg-black">
    <nav class="navbar navbar-expand-lg bg-body-transparent fixed-top">
        <div class="container-fluid mx-5 mt-1">
            <a class="navbar-brand text-warning" href="#"><i class="fa-solid fa-layer-group text-warning"></i> STACKED</a>
            <button class="navbar-toggler text-warning" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto ">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">TOP GAMES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">GAME LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">FEATURE</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button class="btn btn-outline-warning">SIGN IN</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- start header -->
    <section class="fix-header">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-4"> <!-- Ubah dari col-md-6 menjadi col-md-4 -->
                    <div class="container">
                        <h2 class="w-75">TEMUKAN CURRENCY PADA GAME MU</h2>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima sunt aperiam aliquid quod, eius dolore.</p>
                        <div>
                            <button class="btn btn-warning text-black me-1">GET STARTED</button>
                            <button class="btn btn-outline-warning">EXPLORE</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"> <!-- Ubah dari col-md-6 menjadi col-md-8 -->
                    <div class="container">
                        <img src="/public/img/main-splash.png" alt="Gambar" class="img-fluid"> <!-- Tambahkan class img-fluid untuk membuat gambar responsif -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- start Top games -->
    <section>
        <div class="container-fluid d-flex justify-content-center ">
            <h4>Popular by User Choice</h4>
        </div>
    </section>

    <!-- TODO: GET FROM DASHBOARD -->
    <swiper-container class="mySwiper" pagination="true" effect="coverflow" grab-cursor="true" centered-slides="true" slides-per-view="auto" coverflow-effect-rotate="50" coverflow-effect-stretch="0" coverflow-effect-depth="100" coverflow-effect-modifier="1" coverflow-effect-slide-shadows="true">
        <swiper-slide>
            <img src=" https://swiperjs.com/demos/images/nature-1.jpg" />
        </swiper-slide>
        <swiper-slide>
            <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
        </swiper-slide>
        <swiper-slide>
            <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
        </swiper-slide>
        <swiper-slide>
            <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
        </swiper-slide>
        <swiper-slide>
            <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
        </swiper-slide>
        <swiper-slide>
            <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
        </swiper-slide>
        <swiper-slide>
            <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
        </swiper-slide>
        <swiper-slide>
            <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
        </swiper-slide>
        <swiper-slide>
            <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
        </swiper-slide>
    </swiper-container>

    <!-- header -->
    <section>
        <div class="container-fluid d-flex justify-content-center ">
            <h4>Latest Supported Games</h4>
        </div>
    </section>

    <!-- start Games FEATURE -->
    <section>
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6"> <!-- Ubah dari col-md-6 menjadi col-md-8 -->
                    <div class="container">
                        <img src="/public/img/main-splash.png" alt="Gambar" class="img-fluid"> <!-- Tambahkan class img-fluid untuk membuat gambar responsif -->
                    </div>
                </div>
                <div class="col-md-4"> <!-- Ubah dari col-md-6 menjadi col-md-4 -->
                    <div class="container">
                        <h2 class="w-75">CHECK OUR TOP PRODUCT</h2>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima sunt aperiam aliquid quod, eius dolore.</p>
                        <div>
                            <button class="btn btn-warning text-black me-1">GET STARTED</button>
                            <button class="btn btn-outline-warning">EXPLORE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
</body>

</html>