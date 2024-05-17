<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database/connection.php';

class InventoryController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllInventory()
    {
        $sql = "SELECT inventory.*, kategori.nama AS kategori_nama FROM inventory LEFT JOIN kategori ON inventory.kategori_id = kategori.id";
        $result = $this->conn->query($sql);

        $inventory = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $inventory[] = $row;
            }
        }
        return $inventory;
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

    public function createInventory($nama, $kuantitas, $harga, $gambar, $kategori_id)
    {
        $target_dir = __DIR__ . '/../../uploads/';
        $target_file = $target_dir . basename($gambar['name']);

        // cek file
        if ($gambar['error'] !== 0) {
            $_SESSION['error_message'] = 'Gagal mengupload gambar';
            header('Location: create_inventory.php');
            exit();
        }

        // validasi tipe file
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        $file_type = mime_content_type($gambar['tmp_name']);
        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['error_message'] = 'Tipe file tidak diizinkan';
            header('Location: create_inventory.php');
            exit();
        }

        // validasi ukuran file
        $max_size = 1 * 1024 * 1024; // 5MB
        if ($gambar['size'] > $max_size) {
            $_SESSION['error_message'] = 'Ukuran file terlalu besar';
            header('Location: create_inventory.php');
            exit();
        }

        // validasi file adalah gambar
        if (getimagesize($gambar['tmp_name']) === false) {
            $_SESSION['error_message'] = 'File bukan gambar';
            header('Location: create_inventory.php');
            exit();
        }

        $sql = "INSERT INTO inventory (nama, kuantitas, harga, gambar, kategori_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('siisi', $nama, $kuantitas, $harga, $gambar['name'], $kategori_id);

        if ($stmt->execute()) {
            if (move_uploaded_file($gambar['tmp_name'], $target_file)) {
                $_SESSION['success_message'] = 'Inventory berhasil ditambahkan';
                header('Location: inventory.php');
                exit();
            } else {
                $_SESSION['error_message'] = 'Gagal mengupload gambar';
                header('Location: create_inventory.php');
                exit();
            }
        } else {
            $_SESSION['error_message'] = 'Gagal menambahkan inventory';
            header('Location: create_inventory.php');
            exit();
        }
    }

    public function deleteInventory($id)
    {
        $sql = "DELETE FROM inventory WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function searchInventory($keyword)
    {
        $sql = "SELECT inventory.*, kategori.nama AS kategori_nama FROM inventory LEFT JOIN kategori ON inventory.kategori_id = kategori.id WHERE inventory.nama LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $keyword = "%{$keyword}%";
        $stmt->bind_param('s', $keyword);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}