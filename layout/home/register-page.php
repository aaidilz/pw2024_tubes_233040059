<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card bg-dark text-white" style="border-radius: 15px; box-shadow: 0px 0px 50px black">
                <div class="card-body d-flex flex-column align-items-center">
                    <h2 class="mt-3">CREATE AN ACCOUNT</h2>
                    <form action="../../app/controller/RegisterController.php" method="POST" class="w-75">
                        <div class="form-group mb-3 mt-3">
                            <label for="username" class="mb-1">Username</label>
                            <input type="text" name="username" id="username" placeholder="Your Username"
                                class="form-control border border-light" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="mb-1">Email</label>
                            <input type="email" name="email" id="email" placeholder="Your Email"
                                class="form-control border border-light" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="mb-1">Password</label>
                            <input type="password" name="password" id="password" placeholder="Your Password"
                                class="form-control border border-light" required>
                        </div>

                        <div class="form-group mb-5">
                            <label for="confirm_password" class="mb-1">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm"
                                class="form-control border border-light" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block w-100 mb-2">Register</button>
                    </form>
                    <?php
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    if (isset($_SESSION['error_message'])) {
                        echo "<p class='text-center'>" . $_SESSION['error_message'] . "</p>";
                        unset($_SESSION['error_message']);
                    }
                    ?>
                    <div class="container mb-5">
                        <p class="text-center text-white mt-3">Have already an account? <a href="login.php "
                                class="fw-bold text-white"><u>Login here</u></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>