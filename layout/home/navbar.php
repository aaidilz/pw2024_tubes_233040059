<style>
.navbar {
    background: rgba(0, 0, 0, 0);
    backdrop-filter: blur(5px);
}

.navbar-nav .nav-link {
    filter: drop-shadow(0 0 0 transparent);
    transition: filter 0.3s ease-in-out;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link:focus {
    filter: drop-shadow(0 0 5px rgb(255, 255, 0));
}   
</style>

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
                    <a class="btn btn-outline-warning" href="login.php">SIGN IN</a>
                </li>
            </ul>
        </div>
    </div>
</nav>