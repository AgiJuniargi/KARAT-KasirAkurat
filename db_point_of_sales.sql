-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Feb 2025 pada 01.44
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_point_of_sales`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `phone`, `created_at`) VALUES
(6, 'Dwi Putra Juniargi', 'dwi@gmail.com', '$2y$10$l3KlbX1DApsVQDb5.j2PfOX6wIrU1EWiG.k1GbXBQQkkChjlGaCla', '081912667147', '2025-01-04'),
(10, 'Raka Setya Pramudya', 'raka@gmail.com', '$2y$10$K/dM/Vm5a4ham/PySIJRjOllSkEQhbqECOhYQ2wvhCLHxWGfn8u9S', '081912342345', '2025-02-03'),
(11, 'Zaky Nugroho', 'zaky@gmail.com', '$2y$10$ILAhYhBMXYRjcrt68wfW5uhTbKCHfTJhzQocdzuipLdUwhNSEePGe', '081229886754', '2025-02-03'),
(12, 'Budi Santoso', 'budi@gmail.com', '$2y$10$eNyPxt43Sz4vpPCACNFff.6dXfpfsqPD8chugmky2aA6Fg2RuyNrW', '081908776598', '2025-02-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`) VALUES
(1, 'Elektronik', 'Berisi barang elektronik saja', 0),
(2, 'Bekas', 'Berisi barang bekas saja', 0),
(3, 'Minuman', NULL, 0),
(5, 'Makanan', NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `order_placed_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `invoice_no`, `total_amount`, `order_date`, `payment_method`, `order_placed_by_id`) VALUES
(5, 'Dwi', 'INV-950644', '10000000', '2025-01-26', 'QRIS', 6),
(6, 'jaki', 'INV-296688', '10000000', '2025-01-26', 'QRIS', 6),
(9, 'Rehan', 'INV-510613', '40000', '2025-01-26', 'QRIS', 6),
(10, 'JAKI KIPAS', 'INV-661474', '40000', '2025-01-26', 'Uang Tunai', 6),
(13, 'Idin', 'INV-781150', '10000000', '2025-01-26', 'QRIS', 6),
(14, 'Budi', 'INV-322899', '20000', '2025-01-26', 'QRIS', 6),
(15, 'Udin', 'INV-968551', '20000', '2025-01-26', 'QRIS', 6),
(18, 'Burhan', 'INV-740530', '20000000', '2025-01-26', 'QRIS', 6),
(19, 'Doremi', 'INV-877186', '369369', '2025-01-26', 'QRIS', 6),
(20, 'Niba', 'INV-292302', '10000000', '2025-01-26', 'Uang Tunai', 6),
(22, 'asdasd', 'INV-139967', '123123', '2025-01-26', 'QRIS', 6),
(23, 'qwer', 'INV-446159', '10000000', '2025-01-26', 'Uang Tunai', 6),
(24, 'jawir', 'INV-798655', '30002000', '2025-01-28', 'QRIS', 6),
(25, 'Udin', 'INV-369010', '30000000', '2025-01-28', 'QRIS', 6),
(26, 'jawir', 'INV-375499', '20000000', '2025-01-29', 'Uang Tunai', 6),
(27, 'Pa Praroro', 'INV-661142', '20000000', '2025-01-29', 'QRIS', 6),
(28, 'Hytam', 'INV-896779', '10000000', '2025-01-29', 'Uang Tunai', 6),
(29, 'Praroro', 'INV-131443', '10000000', '2025-01-29', 'Uang Tunai', 6),
(30, 'jawir', 'INV-197949', '80000', '2025-01-29', 'Uang Tunai', 6),
(33, 'Udin', 'INV-707520', '10123123', '2025-01-29', 'Uang Tunai', 6),
(39, 'Hytam', 'INV-997617', '10000000', '2025-01-29', 'QRIS', 6),
(42, 'PAK PRARORO', 'INV-805561', '246246', '2025-01-29', 'QRIS', 6),
(43, 'Sampurasun', 'INV-320588', '20020000', '2025-01-30', 'QRIS', 6),
(44, 'Agi', 'INV-219961', '40000', '2025-01-30', 'Uang Tunai', 6),
(45, 'Burhan', 'INV-683496', '6000', '2025-01-30', 'QRIS', 6),
(46, 'Fadil', 'INV-305496', '10000000', '2025-02-01', 'QRIS', 6),
(47, 'Bagas', 'INV-591540', '50000', '2025-02-03', 'QRIS', 6),
(48, 'Raihan', 'INV-248636', '10000', '2025-02-03', 'Uang Tunai', 6),
(49, 'Faishal', 'INV-492919', '24000', '2025-02-03', 'QRIS', 6),
(50, 'Baskara', 'INV-729091', '15000', '2025-02-03', 'QRIS', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(1, 1, 2, '20000', '20000'),
(2, 1, 1, '10000000', '10000000'),
(3, 2, 1, '10000000', '10000000'),
(4, 2, 2, '20000', '20000'),
(5, 3, 1, '10000000', '2'),
(6, 3, 2, '20000', '1'),
(7, 4, 1, '10000000', '2'),
(8, 4, 4, '2000', '1'),
(9, 5, 1, '10000000', '1'),
(10, 6, 1, '10000000', '1'),
(11, 7, 2, '20000', '1'),
(12, 8, 2, '20000', '3'),
(13, 9, 2, '20000', '2'),
(14, 10, 2, '20000', '2'),
(15, 13, 1, '10000000', '1'),
(16, 14, 2, '20000', '1'),
(17, 15, 2, '20000', '1'),
(18, 18, 1, '10000000', '2'),
(19, 19, 6, '123123', '3'),
(20, 20, 1, '10000000', '1'),
(21, 22, 3, '123123', '1'),
(22, 23, 1, '10000000', '1'),
(23, 24, 1, '10000000', '3'),
(24, 24, 4, '2000', '1'),
(25, 25, 1, '10000000', '3'),
(26, 26, 1, '10000000', '2'),
(27, 27, 1, '10000000', '2'),
(28, 28, 1, '10000000', '1'),
(29, 29, 1, '10000000', '1'),
(30, 30, 2, '20000', '4'),
(31, 33, 3, '123123', '1'),
(32, 33, 1, '10000000', '1'),
(33, 39, 1, '10000000', '1'),
(34, 42, 3, '123123', '2'),
(35, 43, 2, '20000', '1'),
(36, 43, 1, '10000000', '2'),
(37, 44, 2, '20000', '2'),
(38, 45, 4, '2000', '3'),
(39, 46, 1, '10000000', '1'),
(40, 47, 3, '15000', '2'),
(41, 47, 11, '20000', '1'),
(42, 48, 4, '2000', '5'),
(43, 49, 11, '20000', '1'),
(44, 49, 4, '2000', '2'),
(45, 50, 3, '15000', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hidden',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `quantity`, `image`, `status`, `created_at`) VALUES
(1, 2, 'Advan Gen AI', '', 10000000, 72, 'assets/uploads/products/1736670629.jpg', 0, '2025-01-11 18:22:17'),
(2, 1, 'Kipas', 'Jual cepat', 20000, 82, 'assets/uploads/products/1736605545.png', 0, '2025-01-11 21:25:45'),
(3, 3, 'Latte', '', 15000, 7, 'assets/uploads/products/1738519267.jpg', 0, '2025-01-11 21:26:24'),
(4, 3, 'Lemon', '', 2000, 68, 'assets/uploads/products/1736605934.png', 0, '2025-01-11 21:32:14'),
(5, 2, 'Tisu', '', 9000, 50, 'assets/uploads/products/1736606056.png', 0, '2025-01-11 21:34:16'),
(6, 3, 'asdasd', '', 123123, 9, 'assets/uploads/products/1736606543.png', 0, '2025-01-11 21:42:23'),
(7, 1, '123', '', 12, 21, 'assets/uploads/products/1736606658.png', 0, '2025-01-11 21:44:18'),
(8, 1, 'Dsdf', '', 45, 24, 'assets/uploads/products/1736606717.png', 0, '2025-01-11 21:45:17'),
(9, 1, 'awdasda', '', 123, 12, 'assets/uploads/products/1736607282.png', 0, '2025-01-11 21:54:42'),
(10, 2, '123123123123', '', 100000, 12, 'assets/uploads/products/1736607389.jpg', 0, '2025-01-11 21:56:29'),
(11, 5, 'Pisang Tanduk', '', 20000, 3, 'assets/uploads/products/1736609053.jpeg', 0, '2025-01-11 22:24:13');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
