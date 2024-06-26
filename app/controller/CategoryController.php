<?php
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

    public function getCategoryById($id)
    {
        $sql = "SELECT * FROM kategori WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        
        return $result->fetch_assoc();
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
    $count = 0;
    // Periksa apakah kategori sedang digunakan oleh inventory
    $sql = "SELECT COUNT(*) FROM inventory WHERE kategori_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // Jika kategori digunakan oleh inventory, berikan pesan kesalahan
        $_SESSION['error_message'] = 'Kategori ini sedang digunakan oleh satu atau lebih inventory dan tidak bisa dihapus';
        header('Location: category.php');
        exit();
    } else {
        // Jika kategori tidak digunakan, lanjutkan penghapusan
        $sql = "DELETE FROM kategori WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Kategori berhasil dihapus';
        } else {
            $_SESSION['error_message'] = 'Kategori gagal dihapus';
        }
        header('Location: category.php');
        exit();
    }
}

}