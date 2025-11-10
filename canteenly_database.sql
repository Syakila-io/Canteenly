-- ================================================
-- DATABASE CANTEENLY
-- Sistem Manajemen Kantin Sekolah
-- ================================================

-- Buat database baru
CREATE DATABASE IF NOT EXISTS `canteenly` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `canteenly`;

-- ================================================
-- TABEL USERS (Pengguna)
-- ================================================
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `kelas` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- TABEL PRODUCTS (Produk)
-- ================================================
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- TABEL ORDERS (Pesanan)
-- ================================================
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `nama_pembeli` varchar(100) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `ruangan` varchar(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `status` enum('Menunggu','Selesai','Dibatalkan') NOT NULL DEFAULT 'Menunggu',
  `metode_pembayaran` varchar(50) DEFAULT 'DANA',
  `metode_pengambilan` varchar(100) DEFAULT 'Antar ke kelas (PO)',
  `batas_waktu_po` time DEFAULT '10:00:00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- DATA SAMPLE USERS
-- ================================================
INSERT INTO `users` (`name`, `email`, `password`, `role`, `kelas`) VALUES
('Admin Canteenly', 'admin@canteenly.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL),
('Rafi Pratama', 'rafi@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '12 RPL 2'),
('Alya Sari', 'alya@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '12 RPL 1'),
('Budi Santoso', 'budi@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '12 TKJ 1');

-- ================================================
-- DATA SAMPLE PRODUCTS
-- ================================================
INSERT INTO `products` (`nama_produk`, `kategori`, `harga`, `stok`) VALUES
('Roti Sari Roti', 'Snack', 5000.00, 25),
('Teh Botol Sosro', 'Minuman', 4000.00, 30),
('Pensil 2B', 'ATK', 3000.00, 50),
('Roti Sari Gandum', 'Snack', 5000.00, 20),
('Qtela Balado', 'Snack', 5000.00, 15),
('Nasi Ayam Geprek', 'Makanan Berat', 15000.00, 10),
('Air Mineral', 'Minuman', 2000.00, 40),
('Pulpen Biru', 'ATK', 2500.00, 35),
('Mie Ayam', 'Makanan Berat', 12000.00, 8),
('Keripik Singkong', 'Snack', 4000.00, 18);

-- ================================================
-- DATA SAMPLE ORDERS
-- ================================================
INSERT INTO `orders` (`user_id`, `nama_pembeli`, `kelas`, `ruangan`, `product_id`, `nama_produk`, `jumlah`, `harga_satuan`, `total_harga`, `status`) VALUES
(2, 'Rafi Pratama', '12 RPL 2', '06', 4, 'Roti Sari Gandum', 2, 5000.00, 10000.00, 'Menunggu'),
(3, 'Alya Sari', '12 RPL 1', '04', 5, 'Qtela Balado', 1, 5000.00, 5000.00, 'Selesai'),
(2, 'Rafi Pratama', '12 RPL 2', '06', 6, 'Nasi Ayam Geprek', 1, 15000.00, 15000.00, 'Menunggu'),
(4, 'Budi Santoso', '12 TKJ 1', '08', 2, 'Teh Botol Sosro', 2, 4000.00, 8000.00, 'Selesai'),
(3, 'Alya Sari', '12 RPL 1', '04', 1, 'Roti Sari Roti', 1, 5000.00, 5000.00, 'Dibatalkan');

-- ================================================
-- SET AUTO INCREMENT
-- ================================================
ALTER TABLE `users` AUTO_INCREMENT = 5;
ALTER TABLE `products` AUTO_INCREMENT = 11;
ALTER TABLE `orders` AUTO_INCREMENT = 6;