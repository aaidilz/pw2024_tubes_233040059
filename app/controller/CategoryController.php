<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database/connection.php';

class CategoryController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM kategori";
        $result = $this->conn->query($sql);
        
        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        return $categories;
    }

    public function createCategory($nama)
    {
        $sql = "INSERT INTO kategori (nama) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $nama);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Kategori berhasil ditambahkan';
            header('Location: category.php');
        } else {
            $_SESSION['error_message'] = 'Kategori gagal ditambahkan';
            header('Location: category.php');
        }
    }

    public function updateCategory($id, $nama)
    {
        $sql = "UPDATE kategori SET nama = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $nama, $id);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Kategori berhasil diubah';
            header('Location: category.php');
        } else {
            $_SESSION['error_message'] = 'Kategori gagal diubah';
            header('Location: category.php');
        }
    }

    public function deleteCategory($id)
    {
        $sql = "DELETE FROM kategori WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Kategori berhasil dihapus';
            header('Location: category.php');
        } else {
            $_SESSION['error'] = 'Kategori gagal dihapus';
            header('Location: category.php');
        }
    }
}