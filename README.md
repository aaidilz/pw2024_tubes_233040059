# STACKED - Toko Merchandise Anime

![Logo STACKED](public/img/logo.png)

## Daftar Isi

- [Pengenalan](#pengenalan)
- [Fitur](#fitur)
- [Instalasi](#instalasi)
- [Penggunaan](#penggunaan)
- [Lisensi](#lisensi)

## Pengenalan

Selamat datang di **STACKED**, toko lengkap untuk semua kebutuhan merchandise anime Anda! Proyek ini dibangun menggunakan PHP native untuk backend, Bootstrap 5 untuk desain UI yang responsif dan modern, serta FontAwesome untuk ikon.

## Fitur

- **Autentikasi Pengguna**: Daftar, masuk, dan kelola akun Anda.
- **Katalog Produk**: Jelajahi berbagai macam merchandise anime.
- **Keranjang Belanja**: Tambahkan barang ke keranjang dan kelola pembelian Anda.
- **Checkout**: Proses checkout yang mulus dan aman.
- **Panel Admin**: Kelola produk, kategori, dan pesanan.
- **Desain Responsif**: Tampilan yang menarik di perangkat desktop dan mobile.

## Instalasi

1. **Clone repositori:**

    ```sh
    git clone https://github.com/aaidilz/pw2024_tubes_233040059.git
    cd pw2024_tubes_233040059
    ```

2. **Siapkan lingkungan Anda:**

    Pastikan Anda memiliki server web dengan PHP dan MySQL terpasang (misalnya, XAMPP, MAMP, LAMP).

3. **Impor database:**

    - Buat database bernama `pw2024_tubes_233040059`.
    - Impor file SQL yang terletak di `pw2024_tubes_233040059.sql`.

4. **Konfigurasi aplikasi:**

    - Perbarui konfigurasi di `config/database/connection.php`:

      ```php
      $hostname = 'localhost';
      $username = 'root';
      $password = '';
      $db_name = 'pw2024_tubes_233040059';
      ```

5. **Jalankan aplikasi:**

    Tempatkan folder proyek di direktori root server web Anda dan buka di browser Anda.

## Penggunaan

- **Jelajahi Produk**: Navigasi melalui berbagai kategori dan temukan merchandise anime favorit Anda.
- **Tambah ke Keranjang**: Klik tombol "Tambah ke Keranjang" untuk memasukkan barang ke keranjang belanja Anda.
- **Checkout**: Lanjutkan ke checkout untuk menyelesaikan pembelian Anda.
- **Panel Admin**: Akses panel admin untuk mengelola produk dan pesanan (diperlukan login admin).

## Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT. Lihat file [LICENSE](LICENSE) untuk detailnya.

---

Dibuat dengan ❤️ oleh [aaidilz](https://github.com/aaidilz)
