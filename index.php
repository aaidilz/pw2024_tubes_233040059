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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/fontawesome.min.js" integrity="sha512-1M9vud0lqoXACA9QaA8IY8k1VR2dMJ2Qmqzt9pN2AH7eQHWpNsxBpaayV0kKkUsF7FLVQ2sA2SSc8w5VOm7/mg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="bg-black">
    <nav class="navbar navbar-expand-lg bg-body-transparent fixed-top">
        <div class="container-fluid mx-5 mt-1">
            <a class="navbar-brand text-warning" href="#"><i class="fa-solid fa-layer-group"></i> STACKED</a>
            <button class="navbar-toggler text-warning" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto ">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Top games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Game list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Feature</a>
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
    <section>
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6 mb-4">
                    <div class="container">
                        <h2 class="w-75">TEMUKAN CURRENCY PADA GAME MU</h2>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima sunt aperiam aliquid quod, eius dolore.</p>
                        <div>
                        <button class="btn btn-warning text-black me-1">GET STARTED</button>
                        <button class="btn btn-outline-warning">EXPLORE</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="container">
                        <img src="https://picsum.photos/500/300" alt="Gambar" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- start list -->
<section>
    <div class="container">
        <h3>CHECK OUR NEW SUPPORTED GAME</h3>
    </div>
</section>

</body>

</html>