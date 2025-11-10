-- Update database dengan kolom gambar produk
USE canteenly;

-- Tambah kolom gambar ke tabel products
ALTER TABLE products ADD COLUMN gambar VARCHAR(255) DEFAULT NULL AFTER deskripsi;

-- Update gambar untuk setiap produk
-- Minuman Kemasan
UPDATE products SET gambar = 'teh-botol-sosro.jpg' WHERE id = 1;
UPDATE products SET gambar = 'aqua.jpg' WHERE id = 2;
UPDATE products SET gambar = 'coca-cola.jpg' WHERE id = 3;
UPDATE products SET gambar = 'buavita.jpg' WHERE id = 4;

-- Makanan Kemasan
UPDATE products SET gambar = 'sari-roti.jpg' WHERE id = 5;
UPDATE products SET gambar = 'qtela-balado.jpg' WHERE id = 6;
UPDATE products SET gambar = 'chitato.jpg' WHERE id = 7;
UPDATE products SET gambar = 'indomie-goreng.jpg' WHERE id = 8;

-- ATK
UPDATE products SET gambar = 'pensil-2b.jpg' WHERE id = 9;
UPDATE products SET gambar = 'pulpen-biru.jpg' WHERE id = 10;
UPDATE products SET gambar = 'buku-tulis.jpg' WHERE id = 11;
UPDATE products SET gambar = 'penghapus.jpg' WHERE id = 12;

-- Obat
UPDATE products SET gambar = 'paracetamol.jpg' WHERE id = 13;
UPDATE products SET gambar = 'vitamin-c.jpg' WHERE id = 14;
UPDATE products SET gambar = 'antangin.jpg' WHERE id = 15;
UPDATE products SET gambar = 'betadine.jpg' WHERE id = 16;

-- Verifikasi update
SELECT id, nama_produk, kategori, gambar FROM products ORDER BY kategori_id, id;