-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2024 at 06:05 AM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw2024_tubes_233040059`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kuantitas` int NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `nama`, `kuantitas`, `harga`, `gambar`, `kategori_id`, `created_at`, `updated_at`) VALUES
(31, 'Guar Gura', 10, '250000', '664eabbedd81e.png', 2, '2024-05-23 02:36:46', '2024-05-23 02:36:46'),
(32, 'Maid costume', 10, '300000', '664eac20b589b.jpg', 2, '2024-05-23 02:38:24', '2024-05-23 02:49:44'),
(33, 'Kimetsu Key Chain', 9, '10000', '664eac4b1d887.jpg', 1, '2024-05-23 02:39:07', '2024-05-30 10:24:37'),
(34, 'Hokage Cosplay Costume', 10, '350000', '664eac89a4603.jpg', 2, '2024-05-23 02:40:09', '2024-05-23 02:48:59'),
(36, 'Oshi No Ko Ruby Keychain', 7, '7500', '664ead6ae0b89.png', 1, '2024-05-23 02:43:54', '2024-05-30 10:31:52'),
(37, 'Chika Stiker', 20, '500', '664eadc0ca6e9.png', 5, '2024-05-23 02:45:20', '2024-05-25 15:40:52'),
(38, 'Umaru Chan Stiker', 10, '500', '664eadf91793f.png', 5, '2024-05-23 02:46:17', '2024-05-25 06:37:04'),
(39, 'Raiden Shogun Costume', 5, '550000', '664eaf27603d2.jpg', 2, '2024-05-23 02:48:47', '2024-05-25 15:41:02'),
(40, 'Arknight Keychain Pack', 1, '75000', '664eafab10fd3.jpg', 1, '2024-05-23 02:53:31', '2024-05-29 15:37:16'),
(41, 'Kalsit purba :P Poster', 15, '15000', '664eaffc74ff4.jpg', 3, '2024-05-23 02:54:52', '2024-05-25 15:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'Accessories'),
(2, 'Kostum'),
(3, 'Poster'),
(5, 'Sticker');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `inventory_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `paymentMethod` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `inventory_id`, `quantity`, `total_price`, `order_date`, `paymentMethod`, `name`, `email`, `address`, `status`) VALUES
(55, 1, 40, 1, '75000', '2024-05-26 01:19:05', 'QRIS', 'a', 'a@a', 'a', 'pending'),
(56, 1, 40, 1, '75000', '2024-05-29 05:54:24', 'QRIS', '123', '123@123', '123', 'pending'),
(57, 1, 40, 1, '75000', '2024-05-29 05:55:14', 'QRIS', '123', '123@123', '123', 'pending'),
(58, 23, 40, 1, '75000', '2024-05-29 15:37:16', 'QRIS', 'aidil', 'aidil@aidil', 'rumah aidil', 'pending'),
(59, 19, 33, 1, '10000', '2024-05-30 10:24:37', 'DANA', 'asep', 'asep@asep.com', 'rumah asep', 'pending'),
(60, 19, 36, 3, '22500', '2024-05-30 10:31:52', 'QRIS', '123', '123@123', '123', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$OlKh4no8CFV/7ZaS.GvUqeyQVIvqEO6uIZgHtlpxgsaeEguesuc/W', 'admin@example.com', 'admin', '2024-05-17 08:16:40', '2024-05-29 14:52:39'),
(19, 'asep', '$2y$10$a/bGR6znzunuzQ1PGb.bkuRh/Ojhod.w/MM34VdNi5QYrGhO/xd4.', 'asep@asep', 'user', '2024-05-29 08:05:05', '2024-05-29 14:24:14'),
(22, '123', '$2y$10$jh3KJcJhMt7ZbUAxLT2/c.OqL6vdc45GynvfvlEaJZH3GUE2pFkQm', '123@123', 'user', '2024-05-29 08:13:39', '2024-05-29 08:13:39'),
(23, 'aidil', '$2y$10$cvWoBihUcg8ZXX2moQyQGOpjwWmZN6MJTt/kdo8hBBkkoQiepv3H2', 'aidil@mail.com', 'user', '2024-05-29 15:36:28', '2024-05-29 15:36:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `inventory_id` (`inventory_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
