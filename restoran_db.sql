-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2026 at 12:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama_menu`, `harga`, `kategori`, `deskripsi`, `gambar`) VALUES
(2, 'Kepiting Saus Padang', 85000, 'Makanan', 'Kepiting segar dengan saus padang pedas manis', '1777023679_69eb3abf19e70.jpg'),
(3, 'Udang Goreng Tepung', 55000, 'Makanan', 'Udang crispy dengan balutan tepung renyah', '1777023728_69eb3af0e7c15.jpeg'),
(4, 'Cumi Saus Tiram', 60000, 'Makanan', 'Cumi empuk dengan saus tiram gurih', '1777023783_69eb3b276a83c.jpg'),
(5, 'Ikan Bakar Jimbaran', 70000, 'Makanan', 'Ikan bakar dengan bumbu khas Jimbaran', '1777023819_69eb3b4bc66e3.png'),
(6, 'Kerang Saus Asam Manis', 50000, 'Makanan', 'Kerang segar dengan saus asam manis', '1777023859_69eb3b73d51c6.jpg'),
(7, 'Sup Ikan Kakap', 65000, 'Makanan', 'Sup ikan kakap dengan kuah segar', '1777023984_69eb3bf0e5176.jpg'),
(8, 'Udang Saus Mentega', 58000, 'Makanan', 'Udang dengan saus mentega gurih', '1777024020_69eb3c14ee067.jpg'),
(9, 'Cumi Goreng Tepung', 52000, 'Makanan', 'Cumi crispy renyah di luar lembut di dalam', '1777024064_69eb3c4008f58.jpg'),
(10, 'Ikan Goreng Sambal Matah', 68000, 'Makanan', 'Ikan goreng dengan sambal matah khas Bali', '1777024119_69eb3c773094f.jpg'),
(11, 'Lobster Bakar', 120000, 'Makanan', 'Lobster segar dibakar dengan bumbu spesial', '1777024183_69eb3cb7eb93e.jpg'),
(12, 'Es Teh Manis', 10000, 'Minuman', 'Teh manis dingin segar', '1777024693_69eb3eb5db696.png'),
(13, 'Es Jeruk', 12000, 'Minuman', 'Perasan jeruk segar dengan es', '1777024706_69eb3ec2161b9.jpg'),
(14, 'Air Mineral', 8000, 'Minuman', 'Air mineral dingin', '1777024717_69eb3ecdc23ec.png'),
(15, 'Es Kelapa Muda', 15000, 'Minuman', 'Kelapa muda segar dengan es', '1777024753_69eb3ef1da2cb.jpg'),
(16, 'Jus Mangga', 18000, 'Minuman', 'Jus mangga manis segar', '1777024769_69eb3f01d7f5e.jpg'),
(17, 'Jus Alpukat', 20000, 'Minuman', 'Jus alpukat creamy dengan coklat', '1777024783_69eb3f0fa6102.jpg'),
(18, 'Jus Jeruk', 15000, 'Minuman', 'Jus jeruk segar tanpa pemanis buatan', '1777024802_69eb3f22b74eb.jpg'),
(19, 'Es Lemon Tea', 14000, 'Minuman', 'Teh dengan perasan lemon segar', '1777024822_69eb3f3624cdd.jpg'),
(20, 'Soda Gembira', 17000, 'Minuman', 'Minuman soda dengan susu dan sirup', '1777024831_69eb3f3f199e8.jpg'),
(21, 'Kopi Hitam', 12000, 'Minuman', 'Kopi hitam hangat khas Indonesia', '1777024842_69eb3f4acae3d.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$bBDm6H1DJ0mu7.bN208qlOIjkeuZmTCt92nLqwlqNaQtQVfpeaNX.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
