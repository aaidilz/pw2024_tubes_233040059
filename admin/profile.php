<?php
require '../config/protected.php';
require '../layout/admin/header.php';
require '../app/controller/ProfileController.php';

$controller = new ProfileController($conn);
$admin = $controller->getUser($_SESSION['username']);

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
<!-- admin profile card -->
<div class="container mt-4 w-50">
    <div class="card">
        <div class="card-header">
            <h1>Profile</h1>
        </div>
        <div class="card-body">
            <form action="profile.php" method="POST">
                <?php if (isset($message)): ?>
                    <div class="alert alert-info">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control"
                        value="<?php echo $admin['username']; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="old_password">Old Password</label>
                    <input type="password" name="old_password" id="old_password" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>