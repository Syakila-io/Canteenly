@extends('layouts.user')

@section('title', 'Produk')

@section('styles')
<style>
/* === PRODUK PAGE STYLE === */
.produk-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Header */
.produk-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.produk-header h2 {
    color: #2E80FF;
    font-weight: 700;
    font-size: 24px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.search-bar {
    position: relative;
    width: 280px;
}

.search-bar input {
    width: 100%;
    padding: 10px 35px 10px 15px;
    border-radius: 25px;
    border: 1.5px solid #e0e6f5;
    outline: none;
    font-size: 14px;
}

.search-bar i {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #888;
}

/* Filter */
.filter-kategori {
    display: flex;
    gap: 10px;
}

.filter-kategori button {
    background: #fff;
    border: 2px solid #2E80FF;
    color: #2E80FF;
    border-radius: 50px;
    padding: 6px 18px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
}

.filter-kategori button.active,
.filter-kategori button:hover {
    background: #2E80FF;
    color: #fff;
}

/* Produk Grid */
.produk-wrapper {
    display: flex;
    gap: 25px;
    margin-top: 10px;
}

.produk-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
    gap: 20px;
    flex: 3;
}

.produk-card {
    background: #fff;
    border-radius: 20px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    transition: transform 0.2s;
}

.card-actions {
    display: flex;
    gap: 10px;
    align-items: center;
    justify-content: center;
    margin-top: 8px;
}

.card-actions button {
    flex: 1;
}

.wishlist-btn {
    background: none;
    border: none;
    font-size: 18px;
    color: #ddd;
    cursor: pointer;
    transition: 0.3s;
}

.wishlist-btn.active {
    color: #e74c3c;
}

.wishlist-btn:hover {
    transform: scale(1.2);
}

.produk-card:hover {
    transform: translateY(-4px);
}

.produk-card img {
    width: 100%;
    height: 120px;
    object-fit: contain;
    margin-bottom: 10px;
}

.produk-card h4 {
    font-size: 16px;
    font-weight: 600;
    margin: 8px 0;
}

.produk-card .harga {
    color: #2E80FF;
    font-weight: 600;
}

.produk-card button {
    background: #2E80FF;
    color: #fff;
    border: none;
    padding: 10px;
    width: 100%;
    border-radius: 12px;
    font-weight: 500;
    margin-top: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.produk-card button:hover {
    background: #1E60CC;
}

/* Keranjang */
.keranjang {
    flex: 1;
    background: #fff;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    height: fit-content;
}

.keranjang h3 {
    color: #2E80FF;
    font-size: 18px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

.keranjang-item {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #f8faff;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 10px;
}

.keranjang-item img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

.keranjang-item p {
    margin: 0;
    font-weight: 500;
}

.keranjang-item span {
    color: #2E80FF;
    font-weight: 600;
}

.checkout {
    background: #2E80FF;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 12px;
    font-weight: 600;
    width: 100%;
    cursor: pointer;
    margin-top: 15px;
}

.checkout:hover {
    background: #1E60CC;
}

/* Flying Heart Animation */
@keyframes flyToWishlist {
    0% {
        transform: scale(1) translate(0, 0);
        opacity: 1;
    }
    50% {
        transform: scale(1.5) translate(-50px, -30px);
        opacity: 0.8;
    }
    100% {
        transform: scale(0.5) translate(-200px, -100px);
        opacity: 0;
    }
}

.flying-heart {
    position: fixed;
    color: #e74c3c;
    font-size: 20px;
    pointer-events: none;
    z-index: 1000;
    animation: flyToWishlist 1s ease-out forwards;
}

.wishlist-btn {
    position: relative;
    overflow: hidden;
}

.wishlist-btn::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(231, 76, 60, 0.3);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.3s ease;
}

.wishlist-btn.active::after {
    width: 40px;
    height: 40px;
}
</style>

<script>
function filterProduk(kategori) {
    const cards = document.querySelectorAll('.produk-card');
    const buttons = document.querySelectorAll('.filter-kategori button');
    
    // Update active button
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    // Filter products
    cards.forEach(card => {
        const produkKategori = card.dataset.kategori;
        if (kategori === 'semua' || produkKategori === kategori) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function toggleWishlist(productId) {
    const btn = event.target.closest('.wishlist-btn');
    const isActive = btn.classList.contains('active');
    
    if (isActive) {
        btn.classList.remove('active');
        removeFromWishlist(productId);
    } else {
        btn.classList.add('active');
        addToWishlist(productId);
        createFlyingHeart(btn);
    }
}

function createFlyingHeart(btn) {
    const rect = btn.getBoundingClientRect();
    const heart = document.createElement('i');
    heart.className = 'fas fa-heart flying-heart';
    heart.style.left = rect.left + rect.width/2 + 'px';
    heart.style.top = rect.top + rect.height/2 + 'px';
    
    document.body.appendChild(heart);
    
    setTimeout(() => {
        heart.remove();
    }, 1000);
}

function addToWishlist(productId) {
    let wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
    if (!wishlist.includes(productId)) {
        wishlist.push(productId);
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
    }
}

function removeFromWishlist(productId) {
    let wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
    wishlist = wishlist.filter(id => id !== productId);
    localStorage.setItem('wishlist', JSON.stringify(wishlist));
}

function loadWishlist() {
    const wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
    wishlist.forEach(productId => {
        const btn = document.querySelector(`[onclick="toggleWishlist(${productId})"]`);
        if (btn) btn.classList.add('active');
    });
}

function searchProducts() {
    const searchInput = document.querySelector('.search-bar input');
    const searchTerm = searchInput.value.toLowerCase();
    const cards = document.querySelectorAll('.produk-card');
    
    cards.forEach(card => {
        const productName = card.querySelector('h4').textContent.toLowerCase();
        if (productName.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function addToCart(id, name, price, image) {
    let cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    // Check if product already in cart
    const existingItem = cart.find(item => item.id === id);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ id, name, price, image, quantity: 1 });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartDisplay();
}

function removeFromCart(id) {
    let cart = JSON.parse(localStorage.getItem('cart') || '[]');
    cart = cart.filter(item => item.id !== id);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartDisplay();
}

function updateCartDisplay() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const checkoutBtn = document.getElementById('checkout-btn');
    const totalPrice = document.getElementById('total-price');
    
    if (cart.length === 0) {
        cartItems.innerHTML = `
            <div style="text-align: center; color: #999; padding: 20px;">
                <i class="fas fa-shopping-cart" style="font-size: 40px; margin-bottom: 10px;"></i>
                <p>Keranjang kosong</p>
                <small>Tambahkan produk untuk mulai berbelanja</small>
            </div>
        `;
        cartTotal.style.display = 'none';
        checkoutBtn.style.display = 'none';
    } else {
        cartItems.innerHTML = '';
        let total = 0;
        
        cart.forEach(item => {
            total += item.price * item.quantity;
            cartItems.innerHTML += `
                <div class="keranjang-item">
                    <img src="${item.image}" alt="${item.name}">
                    <div style="flex: 1;">
                        <p>${item.name}</p>
                        <span>Rp ${item.price.toLocaleString()} x ${item.quantity}</span>
                    </div>
                    <button onclick="removeFromCart(${item.id})" style="background: #e74c3c; color: white; border: none; border-radius: 50%; width: 25px; height: 25px; cursor: pointer;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
        });
        
        totalPrice.textContent = `Rp ${total.toLocaleString()}`;
        cartTotal.style.display = 'block';
        checkoutBtn.style.display = 'block';
    }
}

function checkout() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    if (cart.length > 0) {
        localStorage.setItem('checkoutCart', JSON.stringify(cart));
        window.location.href = '/checkout';
    }
}

// Load wishlist and cart on page load
document.addEventListener('DOMContentLoaded', function() {
    loadWishlist();
    updateCartDisplay();
});
</script>
@endsection

@section('content')
<div class="produk-container">
    <!-- Header -->
    <div class="produk-header">
        <h2><i class="fas fa-store"></i> Produk Canteenly</h2>
        <div class="search-bar">
            <input type="text" placeholder="Cari produk..." oninput="searchProducts()">
            <i class="fas fa-search"></i>
        </div>
    </div>

    <!-- Filter Kategori -->
    <div class="filter-kategori">
        <button class="active" onclick="filterProduk('semua')">Semua</button>
        <button onclick="filterProduk('Minuman Kemasan')">Minuman</button>
        <button onclick="filterProduk('Makanan Kemasan')">Makanan</button>
        <button onclick="filterProduk('ATK')">ATK</button>
        <button onclick="filterProduk('Obat')">Obat</button>
    </div>

    <!-- Produk dan Keranjang -->
    <div class="produk-wrapper">
        <!-- Daftar Produk -->
        <div class="produk-list">
            @foreach($products as $product)
            @php
                // Prioritas gambar: 1. Upload dari admin, 2. Default berdasarkan nama
                if ($product->gambar && file_exists(public_path('assets/img/' . $product->gambar))) {
                    $imageUrl = asset('assets/img/' . $product->gambar);
                } else {
                    // Fallback ke gambar default berdasarkan nama produk
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
                    $imageName = $imageMap[$product->nama_produk] ?? 'logo.png';
                    $imageUrl = asset('assets/img/' . $imageName);
                }
            @endphp
            <div class="produk-card" data-kategori="{{ $product->kategori }}">
                <img src="{{ $imageUrl }}" 
                     alt="{{ $product->nama_produk }}" 
                     onerror="this.src='{{ asset('assets/img/logo.png') }}'">
                <h4>{{ $product->nama_produk }}</h4>
                <p class="harga">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                <p style="font-size: 12px; color: #666; margin: 5px 0;">Stok: {{ $product->stok }}</p>
                <div class="card-actions">
                    <button onclick="addToCart({{ $product->id }}, '{{ $product->nama_produk }}', {{ $product->harga }}, '{{ $imageUrl }}')">
                        <i class="fas fa-cart-plus"></i> Tambah
                    </button>
                    <button class="wishlist-btn" onclick="toggleWishlist({{ $product->id }})">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Keranjang -->
        <div class="keranjang">
            <h3><i class="fas fa-shopping-cart"></i> Keranjang</h3>
            <div id="cart-items">
                <div style="text-align: center; color: #999; padding: 20px;">
                    <i class="fas fa-shopping-cart" style="font-size: 40px; margin-bottom: 10px;"></i>
                    <p>Keranjang kosong</p>
                    <small>Tambahkan produk untuk mulai berbelanja</small>
                </div>
            </div>
            <div id="cart-total" style="display: none; margin-top: 15px; padding-top: 15px; border-top: 2px solid #f0f0f0;">
                <div style="display: flex; justify-content: space-between; align-items: center; font-weight: 600; font-size: 16px;">
                    <span>Total:</span>
                    <span id="total-price" style="color: #2E80FF;">Rp 0</span>
                </div>
            </div>
            <button id="checkout-btn" class="checkout" onclick="checkout()" style="display: none;">
                <i class="fas fa-credit-card"></i> Checkout
            </button>
        </div>
    </div>
</div>
@endsection