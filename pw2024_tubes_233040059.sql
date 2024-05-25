-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 25, 2024 at 02:11 PM
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
  `nama` varchar(100) NOT NULL,
  `kuantitas` int NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `kategori_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `nama`, `kuantitas`, `harga`, `gambar`, `kategori_id`, `created_at`, `updated_at`) VALUES
(31, 'Guar Gura', 10, '250000', '664eabbedd81e.png', 2, '2024-05-23 02:36:46', '2024-05-23 02:36:46'),
(32, 'Maid costume', 10, '300000', '664eac20b589b.jpg', 2, '2024-05-23 02:38:24', '2024-05-23 02:49:44'),
(33, 'Kimetsu Key Chain', 10, '10000', '664eac4b1d887.jpg', 1, '2024-05-23 02:39:07', '2024-05-23 02:39:07'),
(34, 'Hokage Cosplay Costume', 10, '350000', '664eac89a4603.jpg', 2, '2024-05-23 02:40:09', '2024-05-23 02:48:59'),
(36, 'Oshi No Ko Ruby Keychain', 10, '7500', '664ead6ae0b89.png', 1, '2024-05-23 02:43:54', '2024-05-23 02:43:54'),
(37, 'Chika Stiker', 7, '500', '664eadc0ca6e9.png', 5, '2024-05-23 02:45:20', '2024-05-25 06:37:29'),
(38, 'Umaru Chan Stiker', 10, '500', '664eadf91793f.png', 5, '2024-05-23 02:46:17', '2024-05-25 06:37:04'),
(39, 'Raiden Shogun Costume', 5, '550000', '664eaf27603d2.jpg', 2, '2024-05-23 02:48:47', '2024-05-23 02:51:19'),
(40, 'Arknight Keychain Pack', 9, '75000', '664eafab10fd3.jpg', 1, '2024-05-23 02:53:31', '2024-05-25 06:50:17'),
(41, 'Kalsit purba :P Poster', 0, '15000', '664eaffc74ff4.jpg', 3, '2024-05-23 02:54:52', '2024-05-25 06:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(48, 8, 41, 5, '75000', '2024-05-25 06:35:20', 'QRIS', 'asep', 'asep@asep', 'asep', 'pending'),
(49, 8, 41, 5, '75000', '2024-05-25 06:35:51', 'QRIS', 'asep', 'asep@asep', 'asep', 'pending'),
(50, 9, 38, 10, '5000', '2024-05-25 06:37:04', 'OVO', 'ucup', 'ucup@ucup', 'jepang 123', 'pending'),
(51, 9, 37, 13, '6500', '2024-05-25 06:37:29', 'DANA', 'ucup', 'ucup@ucup', '123 jepang', 'pending'),
(52, 9, 40, 1, '75000', '2024-05-25 06:50:17', 'QRIS', 'asep', 'nurjamilah@123', 'jepang123', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$X0mvG7pC.GCg9v/zvSMci.VaZyqQ8tLkXAZxJTCrXNy2DfU6kxg6C', 'admin@example.com', 'admin', '2024-05-17 08:16:40', '2024-05-23 02:22:53'),
(8, 'asep', '$2y$10$YmH5F5uf0L.S9vGSWIDgVOH.epbbx/A5bD3.03E1RG82cfVbrF4c.', 'asep@asep', 'user', '2024-05-23 02:22:36', '2024-05-23 02:22:36'),
(9, 'ucup', '$2y$10$J0G0Zlo8d8KLsVRW8osg9O9DfFG1WHTjdbRG.pU0gta5LtUe3y28u', 'ucup@ucup', 'user', '2024-05-25 06:36:29', '2024-05-25 06:36:29');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
