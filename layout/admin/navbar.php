<style>
.navbar {
    top: 0;
    left: 0;
    width: 100%;
}

.navbar .container-fluid {
    display: flex;
    justify-content: space-between;
}

.navbar-brand {
    margin-right: auto;
}

.navbar-toggler {
    margin-left: auto; 
}

.navbar-collapse {
    justify-content: center; 
}

.nav-pills {
    display: flex;
    justify-content: center; 
}

.navbar-nav {
    display: flex;
    align-items: center;
}

</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand mx-3" href="#">Hello, User</i></a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav nav-pills mb-auto">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link active" aria-current="page">
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>
                <li>
                    <a href="order.php" class="nav-link text-white">
                        <i class="fa fa-cart-shopping"></i> Orders
                    </a>
                </li>
                <li>
                    <a href="application.php" class="nav-link text-white">
                        <i class="fa fa-gamepad"></i> Applications
                    </a>
                </li>
                <li>
                    <a href="user.php" class="nav-link text-white">
                        <i class="fa fa-cart-shopping"></i> Users
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-user"></i> Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controller/logout.php"><i class="fa fa-door-open"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>