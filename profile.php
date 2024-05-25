<?php
require 'app/controller/ProfileController.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$controller = new ProfileController($conn);
$user = $controller->getUser($_SESSION['username']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldPassword = htmlspecialchars($_POST['old_password']);
    $newPassword = htmlspecialchars($_POST['new_password']);
    $confirmPassword = htmlspecialchars($_POST['confirm_password']);

    if ($newPassword === $confirmPassword) {
        $updateStatus = $controller->update($_SESSION['username'], $oldPassword, $newPassword);
        if ($updateStatus) {
            $message = "Profile updated successfully.";
        } else {
            $message = "Failed to update profile. Please check your old password.";
        }
    } else {
        $message = "New password and confirm password do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'layout/home/header.php'; ?>
<?php include 'layout/home/navbar.php'; ?>

<body class="d-flex justify-content-center align-items-center vh-100 overflow-auto">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card bg-dark text-white" style="border-radius: 15px; box-shadow: 0px 0px 50px black">
                    <div class="card-body d-flex flex-column align-items-center">
                        <h2 class="mt-3">My Account</h2>
                        <?php if (isset($message)): ?>
                            <div class="alert alert-info">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>
                        <form action="" method="POST" class="w-75">
                            <div class="form-group mb-3 mt-3">
                                <label for="username" class="mb-1">Username</label>
                                <p class="text-white">
                                    <?php echo htmlspecialchars($user['username']); ?>
                                </p>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email" class="mb-1">Email</label>
                                <p class="text-white">
                                    <?php echo htmlspecialchars($user['email']); ?>
                                </p>
                            </div>
                            <h4 class="mt-3">Change Password</h4>
                            <div class="form-group mb-3">
                                <label for="old_password" class="mb-1">Old Password</label>
                                <input type="password" name="old_password" id="old_password"
                                    class="form-control border border-light" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="new_password" class="mb-1">New Password</label>
                                <input type="password" name="new_password" id="new_password"
                                    class="form-control border border-light" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="confirm_password" class="mb-1">Confirm New Password</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="form-control border border-light" required>
                            </div>
                            <a href="index.php" class="btn btn-secondary mt-3">Kembali</a>
                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>