<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database/connection.php';

class ProfileController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUser($username) {
        $stmt = $this->conn->prepare("SELECT username, email FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($username, $oldPassword, $newPassword) {
        // Validate the old password
        $stmt = $this->conn->prepare("SELECT password FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (password_verify($oldPassword, $user['password'])) {
            // Update email and password
            $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
            $stmt = $this->conn->prepare("UPDATE user SET password = ? WHERE username = ?");
            $stmt->bind_param("ss", $newPasswordHash, $username);
            return $stmt->execute();
        } else {
            return false;
        }
    }
}
