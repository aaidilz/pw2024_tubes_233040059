<?php
session_start();
?>

<nav class="navbar navbar-expand-lg bg-body-transparent fixed-top">
    <div class="container-fluid mx-5 mt-1">
        <a class="navbar-brand text-white" href="#"><i class="fa-solid fa-layer-group text-warning"></i>STACKED</a>
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
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> <?php echo $_SESSION['username']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <?php if ($_SESSION['role'] == 'admin'): ?>
                                <li><a class="dropdown-item" href="/admin/dashboard.php">Dashboard Admin</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="/profile.php">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-warning" href="login.php">SIGN IN</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
