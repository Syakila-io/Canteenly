<?php
// Test koneksi database dan list produk
try {
    $pdo = new PDO('mysql:host=localhost;dbname=canteenly;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>DAFTAR PRODUK DARI DATABASE:</h2>";
    
    $stmt = $pdo->prepare("SELECT * FROM products WHERE status = 'aktif' ORDER BY kategori_id, nama_produk");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr style='background: #2E80FF; color: white;'>";
    echo "<th>ID</th><th>Nama Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Gambar</th>";
    echo "</tr>";
    
    foreach($products as $product) {
        echo "<tr>";
        echo "<td>" . $product['id'] . "</td>";
        echo "<td>" . $product['nama_produk'] . "</td>";
        echo "<td>" . $product['kategori'] . "</td>";
        echo "<td>Rp " . number_format($product['harga'], 0, ',', '.') . "</td>";
        echo "<td>" . $product['stok'] . "</td>";
        echo "<td>" . ($product['gambar'] ?? 'NULL') . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "<br><strong>Total Produk: " . count($products) . "</strong>";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>