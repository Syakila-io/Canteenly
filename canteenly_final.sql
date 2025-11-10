-- ================================================
-- DATABASE CANTEENLY FINAL
-- 4 Kategori: Minuman Kemasan, Makanan Kemasan, ATK, Obat
-- ================================================

DROP DATABASE IF EXISTS `canteenly`;
CREATE DATABASE `canteenly` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `canteenly`;

-- ================================================
-- TABEL 1: USERS (Admin, Siswa, Guru, Staf)
-- ================================================
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `role` enum('admin','siswa','guru','staf') NOT NULL DEFAULT 'siswa',
  `kelas` varchar(50) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Users dengan Gmail
INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `role`, `kelas`, `jabatan`, `no_hp`) VALUES
-- Admin
(1, 'Admin Canteenly', 'admin.canteenly@gmail.com', '123456', 'Laki-laki', 'admin', NULL, 'Administrator', '081234567890'),

-- Siswa
(2, 'Rafi Pratama', 'rafi.pratama@gmail.com', '111222', 'Laki-laki', 'siswa', '12 RPL 2', NULL, '081234567891'),
(3, 'Alya Sari', 'alya.sari@gmail.com', '333444', 'Perempuan', 'siswa', '12 RPL 1', NULL, '081234567892'),
(4, 'Budi Santoso', 'budi.santoso@gmail.com', '555666', 'Laki-laki', 'siswa', '12 TKJ 1', NULL, '081234567893'),
(5, 'Siti Nurhaliza', 'siti.nurhaliza@gmail.com', '777888', 'Perempuan', 'siswa', '12 RPL 1', NULL, '081234567894'),
(6, 'Ahmad Fauzi', 'ahmad.fauzi@gmail.com', '999000', 'Laki-laki', 'siswa', '12 TKJ 2', NULL, '081234567895'),

-- Guru
(7, 'Pak Joko Widodo', 'joko.widodo@gmail.com', '101010', 'Laki-laki', 'guru', NULL, 'Guru Matematika', '081234567896'),
(8, 'Bu Sari Dewi', 'sari.dewi@gmail.com', '202020', 'Perempuan', 'guru', NULL, 'Guru Bahasa Indonesia', '081234567897'),
(9, 'Pak Ahmad Yani', 'ahmad.yani@gmail.com', '303030', 'Laki-laki', 'guru', NULL, 'Guru Pemrograman', '081234567898'),

-- Staf
(10, 'Bu Rina Sari', 'rina.sari@gmail.com', '404040', 'Perempuan', 'staf', NULL, 'Staf Tata Usaha', '081234567899'),
(11, 'Pak Bambang', 'bambang.staf@gmail.com', '505050', 'Laki-laki', 'staf', NULL, 'Staf Perpustakaan', '081234567800'),
(12, 'Bu Indah Sari', 'indah.sari@gmail.com', '606060', 'Perempuan', 'staf', NULL, 'Staf Keuangan', '081234567801');

-- ================================================
-- TABEL 2: CATEGORIES (4 Kategori)
-- ================================================
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Categories (4 records)
INSERT INTO `categories` (`id`, `nama_kategori`, `deskripsi`) VALUES
(1, 'Minuman Kemasan', 'Minuman dalam kemasan botol, kaleng, atau cup'),
(2, 'Makanan Kemasan', 'Makanan ringan dan berat dalam kemasan'),
(3, 'ATK', 'Alat Tulis Kantor untuk siswa'),
(4, 'Obat', 'Obat-obatan ringan dan vitamin');

-- ================================================
-- TABEL 3: PRODUCTS (Produk 4 Kategori)
-- ================================================
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(100) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Products (16 records - 4 per kategori)
INSERT INTO `products` (`id`, `nama_produk`, `kategori_id`, `kategori`, `harga`, `stok`, `deskripsi`, `status`) VALUES
-- Minuman Kemasan
(1, 'Teh Botol Sosro', 1, 'Minuman Kemasan', 4000.00, 30, 'Teh manis dalam kemasan botol 450ml', 'aktif'),
(2, 'Air Mineral Aqua', 1, 'Minuman Kemasan', 2000.00, 40, 'Air mineral kemasan 600ml', 'aktif'),
(3, 'Coca Cola', 1, 'Minuman Kemasan', 5000.00, 25, 'Minuman bersoda kemasan kaleng 330ml', 'aktif'),
(4, 'Jus Buavita', 1, 'Minuman Kemasan', 6000.00, 20, 'Jus buah kemasan kotak 250ml', 'aktif'),

-- Makanan Kemasan
(5, 'Roti Sari Roti', 2, 'Makanan Kemasan', 5000.00, 25, 'Roti tawar kemasan plastik', 'aktif'),
(6, 'Qtela Balado', 2, 'Makanan Kemasan', 5000.00, 15, 'Keripik singkong rasa balado kemasan', 'aktif'),
(7, 'Chitato', 2, 'Makanan Kemasan', 6000.00, 22, 'Keripik kentang kemasan foil', 'aktif'),
(8, 'Indomie Goreng', 2, 'Makanan Kemasan', 3500.00, 35, 'Mie instan goreng kemasan', 'aktif'),

-- ATK
(9, 'Pensil 2B', 3, 'ATK', 3000.00, 50, 'Pensil untuk menulis dan menggambar', 'aktif'),
(10, 'Pulpen Biru', 3, 'ATK', 2500.00, 35, 'Pulpen tinta biru untuk menulis', 'aktif'),
(11, 'Buku Tulis', 3, 'ATK', 5000.00, 30, 'Buku tulis 38 lembar bergaris', 'aktif'),
(12, 'Penghapus', 3, 'ATK', 1500.00, 45, 'Penghapus karet putih bersih', 'aktif'),

-- Obat
(13, 'Paracetamol', 4, 'Obat', 2000.00, 20, 'Obat penurun panas dan pereda nyeri', 'aktif'),
(14, 'Vitamin C', 4, 'Obat', 8000.00, 12, 'Suplemen vitamin C 1000mg', 'aktif'),
(15, 'Antangin', 4, 'Obat', 3000.00, 18, 'Obat masuk angin herbal', 'aktif'),
(16, 'Betadine', 4, 'Obat', 5000.00, 15, 'Antiseptik untuk luka kecil', 'aktif');

-- ================================================
-- TABEL 4: ORDERS (Pesanan)
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
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Orders (15 records - termasuk guru dan staf)
INSERT INTO `orders` (`id`, `user_id`, `nama_pembeli`, `kelas`, `ruangan`, `product_id`, `nama_produk`, `jumlah`, `harga_satuan`, `total_harga`, `status`, `metode_pembayaran`, `catatan`) VALUES
-- Pesanan Siswa
(1, 2, 'Rafi Pratama', '12 RPL 2', '06', 5, 'Roti Sari Roti', 2, 5000.00, 10000.00, 'Menunggu', 'DANA', 'Tolong antar saat istirahat'),
(2, 3, 'Alya Sari', '12 RPL 1', '04', 6, 'Qtela Balado', 1, 5000.00, 5000.00, 'Selesai', 'OVO', NULL),
(3, 4, 'Budi Santoso', '12 TKJ 1', '08', 1, 'Teh Botol Sosro', 2, 4000.00, 8000.00, 'Selesai', 'GoPay', NULL),
(4, 5, 'Siti Nurhaliza', '12 RPL 1', '04', 9, 'Pensil 2B', 3, 3000.00, 9000.00, 'Selesai', 'ShopeePay', NULL),
(5, 6, 'Ahmad Fauzi', '12 TKJ 2', '09', 8, 'Indomie Goreng', 2, 3500.00, 7000.00, 'Menunggu', 'DANA', 'Level pedas sedang'),
(6, 2, 'Rafi Pratama', '12 RPL 2', '06', 11, 'Buku Tulis', 2, 5000.00, 10000.00, 'Menunggu', 'DANA', NULL),
(7, 3, 'Alya Sari', '12 RPL 1', '04', 4, 'Jus Buavita', 1, 6000.00, 6000.00, 'Dibatalkan', 'OVO', 'Batal karena tidak jadi'),
(8, 5, 'Siti Nurhaliza', '12 RPL 1', '04', 14, 'Vitamin C', 1, 8000.00, 8000.00, 'Menunggu', 'ShopeePay', 'Untuk daya tahan tubuh'),
(9, 4, 'Budi Santoso', '12 TKJ 1', '08', 2, 'Air Mineral Aqua', 3, 2000.00, 6000.00, 'Selesai', 'GoPay', NULL),

-- Pesanan Guru
(10, 7, 'Pak Joko Widodo', 'Guru', 'R.Guru', 3, 'Coca Cola', 1, 5000.00, 5000.00, 'Selesai', 'DANA', 'Antar ke ruang guru'),
(11, 8, 'Bu Sari Dewi', 'Guru', 'R.Guru', 13, 'Paracetamol', 1, 2000.00, 2000.00, 'Selesai', 'OVO', 'Untuk sakit kepala'),
(12, 9, 'Pak Ahmad Yani', 'Guru', 'Lab.Komp', 7, 'Chitato', 2, 6000.00, 12000.00, 'Menunggu', 'GoPay', 'Antar ke lab komputer'),

-- Pesanan Staf
(13, 10, 'Bu Rina Sari', 'Staf', 'R.TU', 1, 'Teh Botol Sosro', 2, 4000.00, 8000.00, 'Selesai', 'DANA', 'Antar ke ruang TU'),
(14, 11, 'Pak Bambang', 'Staf', 'Perpus', 10, 'Pulpen Biru', 5, 2500.00, 12500.00, 'Menunggu', 'Cash', 'Untuk keperluan perpustakaan'),
(15, 12, 'Bu Indah Sari', 'Staf', 'R.Keuangan', 15, 'Antangin', 1, 3000.00, 3000.00, 'Selesai', 'ShopeePay', NULL);

-- ================================================
-- SET AUTO INCREMENT VALUES
-- ================================================
ALTER TABLE `users` AUTO_INCREMENT = 13;
ALTER TABLE `categories` AUTO_INCREMENT = 5;
ALTER TABLE `products` AUTO_INCREMENT = 17;
ALTER TABLE `orders` AUTO_INCREMENT = 16;

-- ================================================
-- CREATE INDEXES FOR PERFORMANCE
-- ================================================
CREATE INDEX idx_products_kategori ON products(kategori);
CREATE INDEX idx_products_status ON products(status);
CREATE INDEX idx_orders_status ON orders(status);
CREATE INDEX idx_users_role ON users(role);

-- ================================================
-- SUMMARY DATABASE
-- ================================================
-- Database: canteenly
-- Kategori: 4 (Minuman Kemasan, Makanan Kemasan, ATK, Obat)
-- Tables: 4 (users, categories, products, orders)
-- Total Records: 47
-- - users: 12 records (1 admin, 5 siswa, 3 guru, 3 staf)
-- - categories: 4 records
-- - products: 16 records (4 per kategori)
-- - orders: 15 records
-- 
-- AKUN LOGIN:
-- Admin: admin.canteenly@gmail.com / password
-- Siswa: rafi.pratama@gmail.com / password (dan 4 lainnya)
-- Guru: joko.widodo@gmail.com / password (dan 2 lainnya)
-- Staf: rina.sari@gmail.com / password (dan 2 lainnya)
-- ================================================