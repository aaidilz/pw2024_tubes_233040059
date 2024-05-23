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

        // Buat nama file baru yang unik
        $fileExtension = pathinfo($gambar['name'], PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '.' . $fileExtension;
        $target_file = $target_dir . $uniqueFileName;

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
        $max_size = 1 * 1024 * 1024; // 1MB
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
        $stmt->bind_param('siisi', $nama, $kuantitas, $harga, $uniqueFileName, $kategori_id);

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
        $image_path = [];
        $target_dir = __DIR__ . '/../../uploads/';
        $sql = "SELECT gambar FROM inventory WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($image_path);
        $stmt->fetch();
        $stmt->close();

        if ($image_path) {
            $full_path = $target_dir . $image_path;
            if (file_exists($full_path)) {
                unlink($full_path);
            }

            $sql = "DELETE FROM inventory WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = 'Inventory berhasil dihapus';
                header('Location: inventory.php');
                exit();
            } else {
                $_SESSION['error_message'] = 'Gagal menghapus inventory';
                header('Location: inventory.php');
                exit();
            }
        }
    }

    public function updateInventory($id, $nama, $kuantitas, $harga, $gambar, $kategori_id)
{
    $target_dir = __DIR__ . '/../../uploads/';
    $old_image_path = [];

    // Ambil nama file gambar lama dari database
    $sql = "SELECT gambar FROM inventory WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($old_image_path);
    $stmt->fetch();
    $stmt->close();

    // Buat nama file baru yang unik jika ada file yang diunggah
    if ($gambar['error'] === UPLOAD_ERR_OK) {
        $fileExtension = pathinfo($gambar['name'], PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '.' . $fileExtension;
        $target_file = $target_dir . $uniqueFileName;

        // cek file
        if ($gambar['error'] !== 0) {
            $_SESSION['error_message'] = 'Gagal mengupload gambar';
            header('Location: edit_inventory.php?id=' . $id);
            exit();
        }

        // validasi tipe file
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        $file_type = mime_content_type($gambar['tmp_name']);
        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['error_message'] = 'Tipe file tidak diizinkan';
            header('Location: edit_inventory.php?id=' . $id);
            exit();
        }

        // validasi ukuran file
        $max_size = 1 * 1024 * 1024; // 1MB
        if ($gambar['size'] > $max_size) {
            $_SESSION['error_message'] = 'Ukuran file terlalu besar';
            header('Location: edit_inventory.php?id=' . $id);
            exit();
        }

        // validasi file adalah gambar
        if (getimagesize($gambar['tmp_name']) === false) {
            $_SESSION['error_message'] = 'File bukan gambar';
            header('Location: edit_inventory.php?id=' . $id);
            exit();
        }

        // Pindahkan file baru ke direktori tujuan
        if (move_uploaded_file($gambar['tmp_name'], $target_file)) {
            // Hapus file gambar lama jika ada
            if ($old_image_path) {
                $full_old_path = $target_dir . $old_image_path;
                if (file_exists($full_old_path)) {
                    unlink($full_old_path);
                }
            }
        } else {
            $_SESSION['error_message'] = 'Gagal mengupload gambar';
            header('Location: edit_inventory.php?id=' . $id);
            exit();
        }
    } else {
        // Jika tidak ada file yang diunggah, gunakan nama file gambar lama
        $uniqueFileName = $old_image_path;
    }

    // Update database dengan nama file baru atau yang lama jika tidak ada unggahan
    $sql = "UPDATE inventory SET nama = ?, kuantitas = ?, harga = ?, gambar = ?, kategori_id = ? WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('siisii', $nama, $kuantitas, $harga, $uniqueFileName, $kategori_id, $id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Inventory berhasil diubah';
        header('Location: inventory.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Gagal mengedit';
        header('Location: edit_inventory.php?id=' . $id);
        exit();
    }
}




    public function getInventoryById($id)
    {
        $sql = "SELECT * FROM inventory WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

}