-- ================================================
-- DATABASE CANTEENLY LENGKAP
-- Sistem Manajemen Kantin Sekolah
-- ================================================

-- Hapus database jika sudah ada, lalu buat baru
DROP DATABASE IF EXISTS `canteenly`;
CREATE DATABASE `canteenly` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `canteenly`;

-- ================================================
-- TABEL 1: USERS (Pengguna)
-- ================================================
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `kelas` varchar(20) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Users (10 records)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `kelas`, `no_hp`, `alamat`) VALUES
(1, 'Admin Canteenly', 'admin@canteenly.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, '081234567890', 'Ruang Admin Sekolah'),
(2, 'Rafi Pratama', 'rafi@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '12 RPL 2', '081234567891', 'Jl. Merdeka No. 10'),
(3, 'Alya Sari', 'alya@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '12 RPL 1', '081234567892', 'Jl. Sudirman No. 15'),
(4, 'Budi Santoso', 'budi@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '12 TKJ 1', '081234567893', 'Jl. Ahmad Yani No. 20'),
(5, 'Siti Nurhaliza', 'siti@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '12 RPL 1', '081234567894', 'Jl. Diponegoro No. 25'),
(6, 'Ahmad Fauzi', 'ahmad@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '12 TKJ 2', '081234567895', 'Jl. Gatot Subroto No. 30'),
(7, 'Dewi Lestari', 'dewi@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '12 RPL 2', '081234567896', 'Jl. Kartini No. 35'),
(8, 'Andi Wijaya', 'andi@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '12 MM 1', '081234567897', 'Jl. Pahlawan No. 40'),
(9, 'Maya Sari', 'maya@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '12 MM 2', '081234567898', 'Jl. Veteran No. 45'),
(10, 'Rizki Ramadan', 'rizki@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '12 TKJ 1', '081234567899', 'Jl. Pemuda No. 50');

-- ================================================
-- TABEL 2: CATEGORIES (Kategori Produk)
-- ================================================
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Categories (5 records)
INSERT INTO `categories` (`id`, `nama_kategori`, `deskripsi`) VALUES
(1, 'Snack', 'Makanan ringan dan cemilan'),
(2, 'Minuman', 'Berbagai jenis minuman segar'),
(3, 'Makanan Berat', 'Makanan utama dan kenyang'),
(4, 'ATK', 'Alat Tulis Kantor untuk siswa'),
(5, 'Obat', 'Obat-obatan ringan dan vitamin');

-- ================================================
-- TABEL 3: PRODUCTS (Produk)
-- ================================================
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(100) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Products (20 records)
INSERT INTO `products` (`id`, `nama_produk`, `kategori_id`, `kategori`, `harga`, `stok`, `deskripsi`, `status`) VALUES
(1, 'Roti Sari Roti', 1, 'Snack', 5000.00, 25, 'Roti tawar segar dan lembut', 'aktif'),
(2, 'Teh Botol Sosro', 2, 'Minuman', 4000.00, 30, 'Teh manis dalam kemasan botol', 'aktif'),
(3, 'Pensil 2B', 4, 'ATK', 3000.00, 50, 'Pensil untuk menulis dan menggambar', 'aktif'),
(4, 'Roti Sari Gandum', 1, 'Snack', 5000.00, 20, 'Roti gandum sehat dan bergizi', 'aktif'),
(5, 'Qtela Balado', 1, 'Snack', 5000.00, 15, 'Keripik singkong rasa balado pedas', 'aktif'),
(6, 'Nasi Ayam Geprek', 3, 'Makanan Berat', 15000.00, 10, 'Nasi dengan ayam geprek pedas', 'aktif'),
(7, 'Air Mineral', 2, 'Minuman', 2000.00, 40, 'Air mineral kemasan 600ml', 'aktif'),
(8, 'Pulpen Biru', 4, 'ATK', 2500.00, 35, 'Pulpen tinta biru untuk menulis', 'aktif'),
(9, 'Mie Ayam', 3, 'Makanan Berat', 12000.00, 8, 'Mie ayam dengan kuah gurih', 'aktif'),
(10, 'Keripik Singkong', 1, 'Snack', 4000.00, 18, 'Keripik singkong renyah original', 'aktif'),
(11, 'Es Teh Manis', 2, 'Minuman', 3000.00, 25, 'Es teh manis segar dingin', 'aktif'),
(12, 'Buku Tulis', 4, 'ATK', 5000.00, 30, 'Buku tulis 38 lembar bergaris', 'aktif'),
(13, 'Nasi Gudeg', 3, 'Makanan Berat', 13000.00, 6, 'Nasi gudeg khas Yogyakarta', 'aktif'),
(14, 'Chitato', 1, 'Snack', 6000.00, 22, 'Keripik kentang rasa sapi panggang', 'aktif'),
(15, 'Jus Jeruk', 2, 'Minuman', 5000.00, 15, 'Jus jeruk segar tanpa pengawet', 'aktif'),
(16, 'Penghapus', 4, 'ATK', 1500.00, 45, 'Penghapus karet putih bersih', 'aktif'),
(17, 'Paracetamol', 5, 'Obat', 2000.00, 20, 'Obat penurun panas dan pereda nyeri', 'aktif'),
(18, 'Nasi Rendang', 3, 'Makanan Berat', 16000.00, 5, 'Nasi dengan rendang daging sapi', 'aktif'),
(19, 'Tango', 1, 'Snack', 3500.00, 28, 'Wafer coklat renyah dan manis', 'aktif'),
(20, 'Vitamin C', 5, 'Obat', 8000.00, 12, 'Suplemen vitamin C 1000mg', 'aktif');

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

-- Data Orders (15 records)
INSERT INTO `orders` (`id`, `user_id`, `nama_pembeli`, `kelas`, `ruangan`, `product_id`, `nama_produk`, `jumlah`, `harga_satuan`, `total_harga`, `status`, `metode_pembayaran`, `catatan`) VALUES
(1, 2, 'Rafi Pratama', '12 RPL 2', '06', 4, 'Roti Sari Gandum', 2, 5000.00, 10000.00, 'Menunggu', 'DANA', 'Tolong antar saat istirahat'),
(2, 3, 'Alya Sari', '12 RPL 1', '04', 5, 'Qtela Balado', 1, 5000.00, 5000.00, 'Selesai', 'OVO', NULL),
(3, 2, 'Rafi Pratama', '12 RPL 2', '06', 6, 'Nasi Ayam Geprek', 1, 15000.00, 15000.00, 'Menunggu', 'DANA', 'Level pedas sedang'),
(4, 4, 'Budi Santoso', '12 TKJ 1', '08', 2, 'Teh Botol Sosro', 2, 4000.00, 8000.00, 'Selesai', 'GoPay', NULL),
(5, 3, 'Alya Sari', '12 RPL 1', '04', 1, 'Roti Sari Roti', 1, 5000.00, 5000.00, 'Dibatalkan', 'DANA', 'Batal karena tidak jadi'),
(6, 5, 'Siti Nurhaliza', '12 RPL 1', '04', 11, 'Es Teh Manis', 3, 3000.00, 9000.00, 'Selesai', 'ShopeePay', NULL),
(7, 6, 'Ahmad Fauzi', '12 TKJ 2', '09', 9, 'Mie Ayam', 1, 12000.00, 12000.00, 'Menunggu', 'DANA', 'Tambah cabe rawit'),
(8, 7, 'Dewi Lestari', '12 RPL 2', '06', 14, 'Chitato', 2, 6000.00, 12000.00, 'Selesai', 'OVO', NULL),
(9, 8, 'Andi Wijaya', '12 MM 1', '10', 3, 'Pensil 2B', 5, 3000.00, 15000.00, 'Selesai', 'Cash', NULL),
(10, 9, 'Maya Sari', '12 MM 2', '11', 15, 'Jus Jeruk', 1, 5000.00, 5000.00, 'Menunggu', 'GoPay', 'Tanpa es'),
(11, 10, 'Rizki Ramadan', '12 TKJ 1', '08', 13, 'Nasi Gudeg', 1, 13000.00, 13000.00, 'Selesai', 'DANA', NULL),
(12, 4, 'Budi Santoso', '12 TKJ 1', '08', 17, 'Paracetamol', 1, 2000.00, 2000.00, 'Selesai', 'Cash', 'Untuk sakit kepala'),
(13, 5, 'Siti Nurhaliza', '12 RPL 1', '04', 12, 'Buku Tulis', 3, 5000.00, 15000.00, 'Menunggu', 'ShopeePay', NULL),
(14, 7, 'Dewi Lestari', '12 RPL 2', '06', 19, 'Tango', 4, 3500.00, 14000.00, 'Selesai', 'OVO', NULL),
(15, 8, 'Andi Wijaya', '12 MM 1', '10', 20, 'Vitamin C', 1, 8000.00, 8000.00, 'Menunggu', 'DANA', 'Untuk daya tahan tubuh');

-- ================================================
-- TABEL 5: ORDER_ITEMS (Detail Item Pesanan)
-- ================================================
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Order Items (15 records sesuai dengan orders)
INSERT INTO `order_items` (`order_id`, `product_id`, `nama_produk`, `harga_satuan`, `jumlah`, `subtotal`) VALUES
(1, 4, 'Roti Sari Gandum', 5000.00, 2, 10000.00),
(2, 5, 'Qtela Balado', 5000.00, 1, 5000.00),
(3, 6, 'Nasi Ayam Geprek', 15000.00, 1, 15000.00),
(4, 2, 'Teh Botol Sosro', 4000.00, 2, 8000.00),
(5, 1, 'Roti Sari Roti', 5000.00, 1, 5000.00),
(6, 11, 'Es Teh Manis', 3000.00, 3, 9000.00),
(7, 9, 'Mie Ayam', 12000.00, 1, 12000.00),
(8, 14, 'Chitato', 6000.00, 2, 12000.00),
(9, 3, 'Pensil 2B', 3000.00, 5, 15000.00),
(10, 15, 'Jus Jeruk', 5000.00, 1, 5000.00),
(11, 13, 'Nasi Gudeg', 13000.00, 1, 13000.00),
(12, 17, 'Paracetamol', 2000.00, 1, 2000.00),
(13, 12, 'Buku Tulis', 5000.00, 3, 15000.00),
(14, 19, 'Tango', 3500.00, 4, 14000.00),
(15, 20, 'Vitamin C', 8000.00, 1, 8000.00);

-- ================================================
-- SET AUTO INCREMENT VALUES
-- ================================================
ALTER TABLE `users` AUTO_INCREMENT = 11;
ALTER TABLE `categories` AUTO_INCREMENT = 6;
ALTER TABLE `products` AUTO_INCREMENT = 21;
ALTER TABLE `orders` AUTO_INCREMENT = 16;
ALTER TABLE `order_items` AUTO_INCREMENT = 16;

-- ================================================
-- CREATE INDEXES FOR PERFORMANCE
-- ================================================
CREATE INDEX idx_products_kategori ON products(kategori);
CREATE INDEX idx_products_status ON products(status);
CREATE INDEX idx_orders_status ON orders(status);
CREATE INDEX idx_orders_created_at ON orders(created_at);
CREATE INDEX idx_users_role ON users(role);

-- ================================================
-- SUMMARY DATABASE
-- ================================================
-- Database: canteenly
-- Tables: 5 (users, categories, products, orders, order_items)
-- Total Records: 70
-- - users: 10 records
-- - categories: 5 records  
-- - products: 20 records
-- - orders: 15 records
-- - order_items: 15 records
-- ================================================