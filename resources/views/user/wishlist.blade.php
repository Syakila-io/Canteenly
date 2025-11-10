@extends('layouts.user')

@section('title', 'Wishlist')

@section('styles')
<style>
.wishlist-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.wishlist-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.wishlist-header h2 {
    color: #2E80FF;
    font-weight: 700;
    font-size: 24px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.wishlist-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
    gap: 20px;
}

.wishlist-card {
    background: #fff;
    border-radius: 20px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    transition: transform 0.2s;
    position: relative;
}

.wishlist-card:hover {
    transform: translateY(-4px);
}

.wishlist-card img {
    width: 100%;
    height: 120px;
    object-fit: contain;
    margin-bottom: 10px;
}

.wishlist-card h4 {
    font-size: 16px;
    font-weight: 600;
    margin: 8px 0;
}

.wishlist-card .harga {
    color: #2E80FF;
    font-weight: 600;
    margin-bottom: 10px;
}

.wishlist-card .card-actions {
    display: flex;
    gap: 10px;
    align-items: center;
    justify-content: center;
}

.wishlist-card button {
    background: #2E80FF;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
    flex: 1;
}

.wishlist-card button:hover {
    background: #1E60CC;
}

.love-icon {
    color: #e74c3c;
    font-size: 18px;
    cursor: pointer;
    transition: 0.3s;
}

.love-icon:hover {
    transform: scale(1.2);
}

.empty-wishlist {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.empty-wishlist i {
    font-size: 80px;
    color: #ddd;
    margin-bottom: 20px;
}

.empty-wishlist h3 {
    margin-bottom: 10px;
    color: #999;
}

.empty-wishlist a {
    color: #2E80FF;
    text-decoration: none;
    font-weight: 600;
}
</style>
@endsection

@section('content')
<div class="wishlist-container">
    <div class="wishlist-header">
        <h2><i class="fa fa-heart"></i> Wishlist Kamu</h2>
    </div>

    <div id="wishlist-content">
        <div class="empty-wishlist">
            <i class="fa fa-heart-broken"></i>
            <h3>Wishlist masih kosong</h3>
            <p>Yuk tambahkan produk favorit kamu!</p>
            <a href="{{ route('produk') }}">Lihat Produk</a>
        </div>
    </div>
</div>

<script>
@php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=canteenly;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("SELECT * FROM products WHERE status = 'aktif'");
    $stmt->execute();
    $allProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $allProducts = [];
}
@endphp

const products = {
    @foreach($allProducts as $product)
    @php
    $imageMap = [
        'Teh Botol Sosro' => 'tehbotol.jpg',
        'Air Mineral Aqua' => 'aqua.jpg',
        'Coca Cola' => 'cocacola.jpg',
        'Jus Buavita' => 'buavita.jpg',
        'Roti Sari Roti' => 'roti.jpg',
        'Qtela Balado' => 'qtela.jpg',
        'Chitato' => 'chitato.jpg',
        'Indomie Goreng' => 'indomie.jpg',
        'Pensil 2B' => 'pensil.jpg',
        'Pulpen Biru' => 'pulpenbiru.jpg',
        'Buku Tulis' => 'buku.jpg',
        'Penghapus' => 'penghapus.jpg',
        'Paracetamol' => 'paracetamol.jpg',
        'Vitamin C' => 'vitamin.jpg',
        'Antangin' => 'antangin.jpg',
        'Betadine' => 'betadine.jpg'
    ];
    $imageName = $imageMap[$product['nama_produk']] ?? 'default.jpg';
    @endphp
    {{ $product['id'] }}: {
        name: '{{ $product['nama_produk'] }}',
        price: 'Rp {{ number_format($product['harga'], 0, ',', '.') }}',
        image: '{{ asset('assets/img/' . $imageName) }}'
    },
    @endforeach
};

function loadWishlistPage() {
    const wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
    const container = document.getElementById('wishlist-content');
    
    if (wishlist.length === 0) {
        container.innerHTML = `
            <div class="empty-wishlist">
                <i class="fa fa-heart-broken"></i>
                <h3>Wishlist masih kosong</h3>
                <p>Yuk tambahkan produk favorit kamu!</p>
                <a href="{{ route('produk') }}">Lihat Produk</a>
            </div>
        `;
        return;
    }
    
    let html = '<div class="wishlist-grid">';
    wishlist.forEach(productId => {
        const product = products[productId];
        if (product) {
            html += `
                <div class="wishlist-card">
                    <img src="${product.image}" alt="${product.name}">
                    <h4>${product.name}</h4>
                    <p class="harga">${product.price}</p>
                    <div class="card-actions">
                        <button onclick="addToCartFromWishlist(${productId})"><i class="fa fa-cart-plus"></i> Tambah ke Keranjang</button>
                        <i class="fa fa-heart love-icon" onclick="removeFromWishlistPage(${productId})"></i>
                    </div>
                </div>
            `;
        }
    });
    html += '</div>';
    
    container.innerHTML = html;
}

function removeFromWishlistPage(productId) {
    let wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
    wishlist = wishlist.filter(id => id !== productId);
    localStorage.setItem('wishlist', JSON.stringify(wishlist));
    loadWishlistPage();
}

function addToCartFromWishlist(productId) {
    const product = products[productId];
    if (!product) return;
    
    let cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    // Check if product already in cart
    const existingItem = cart.find(item => item.id === productId);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        const priceNumber = parseInt(product.price.replace(/[^0-9]/g, ''));
        const imageName = product.image.split('/').pop();
        cart.push({ 
            id: productId, 
            name: product.name, 
            price: priceNumber, 
            image: imageName, 
            quantity: 1 
        });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    alert(`${product.name} berhasil ditambahkan ke keranjang!`);
}

document.addEventListener('DOMContentLoaded', loadWishlistPage);
</script>
@endsection