<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-dark text-white">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">
            <a class="navbar-brand mx-3" href="#">Hello, <?php echo $_SESSION['username']; ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    // Dapatkan nama file dari URL saat ini
                    $current_page = basename($_SERVER['PHP_SELF'], ".php");
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'dashboard') ? 'active' : ''; ?>" aria-current="page" href="dashboard.php">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'order') ? 'active' : ''; ?>" href="../admin/order.php">
                            <i class="fa fa-cart-shopping"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'inventory') ? 'active' : ''; ?>" href="../admin/inventory.php">
                            <i class="fa fa-boxes-stacked"></i> inventory
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'users') ? 'active' : ''; ?>" href="../admin/users.php">
                            <i class="fa fa-user"></i> Users
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo ($current_page == 'profile') ? 'active' : ''; ?>" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i> Profile
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../admin/profile.php"><i class="fa fa-cog"></i> Setting</a>
                            <a class="dropdown-item" href="../index.php"><i class="fa fa-house"></i> Dashboard Index</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'logout') ? 'active' : ''; ?>" href="../../logout.php"><i class="fa fa-door-open"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>