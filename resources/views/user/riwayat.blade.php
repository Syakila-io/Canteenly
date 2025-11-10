@extends('layouts.user')

@section('title', 'Riwayat Transaksi')

@section('styles')
<style>
.riwayat-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.riwayat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.riwayat-header h2 {
    color: #2E80FF;
    font-weight: 700;
    font-size: 24px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-riwayat {
    display: flex;
    gap: 10px;
}

.filter-riwayat select {
    padding: 8px 12px;
    border: 2px solid #e0e6f5;
    border-radius: 8px;
    outline: none;
}

.riwayat-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.riwayat-card {
    background: #fff;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    border-left: 4px solid #2E80FF;
}

.riwayat-header-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.order-id {
    font-weight: 600;
    color: #333;
}

.order-date {
    color: #666;
    font-size: 14px;
}

.status-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.status-selesai {
    background: #d4edda;
    color: #155724;
}

.status-dibatalkan {
    background: #f8d7da;
    color: #721c24;
}

.riwayat-items {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 15px;
}

.riwayat-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px;
    background: #f8faff;
    border-radius: 8px;
}

.riwayat-item img {
    width: 40px;
    height: 40px;
    object-fit: contain;
    border-radius: 6px;
}

.item-info {
    flex: 1;
}

.item-info h5 {
    margin: 0 0 2px 0;
    font-size: 14px;
    font-weight: 600;
}

.item-info p {
    margin: 0;
    font-size: 12px;
    color: #666;
}

.item-price {
    font-weight: 600;
    color: #2E80FF;
}

.riwayat-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 15px;
    border-top: 1px solid #f0f0f0;
}

.total-price {
    font-weight: 700;
    font-size: 16px;
    color: #2E80FF;
}

.reorder-btn {
    background: #2E80FF;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    transition: 0.3s;
}

.reorder-btn:hover {
    background: #1E60CC;
}

.empty-riwayat {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.empty-riwayat i {
    font-size: 80px;
    color: #ddd;
    margin-bottom: 20px;
}


</style>
@endsection

@section('content')
<div class="riwayat-container">
    <div class="riwayat-header">
        <h2><i class="fa fa-history"></i> Riwayat Transaksi</h2>
        <div class="filter-riwayat">
            <input type="text" id="search-riwayat" placeholder="Cari transaksi..." 
                   style="padding: 8px 12px; border: 2px solid #e0e6f5; border-radius: 8px; outline: none; width: 200px;"
                   oninput="searchRiwayat()" onkeypress="handleEnterSearch(event)">
            <select onchange="filterRiwayat(this.value)">
                <option value="semua">Semua Status</option>
                <option value="selesai">Selesai</option>
                <option value="dibatalkan">Dibatalkan</option>
            </select>
            <select onchange="filterBulan(this.value)">
                <option value="semua">Semua Bulan</option>
                <option value="12">Desember 2024</option>
                <option value="11">November 2024</option>
                <option value="10">Oktober 2024</option>
            </select>
        </div>
    </div>

    <div class="riwayat-list">
        <div class="empty-riwayat">
            <i class="fa fa-history"></i>
            <h3>Belum ada riwayat transaksi</h3>
            <p>Mulai berbelanja untuk melihat riwayat transaksi Anda</p>
            <a href="{{ route('produk') }}" style="color: #2E80FF; text-decoration: none; font-weight: 600;">Lihat Produk</a>
        </div>
    </div>
</div>



<script>
function filterRiwayat(status) {
    const cards = document.querySelectorAll('.riwayat-card');
    cards.forEach(card => {
        const cardStatus = card.dataset.status;
        if (status === 'semua' || cardStatus === status) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function filterBulan(bulan) {
    const cards = document.querySelectorAll('.riwayat-card');
    cards.forEach(card => {
        const cardBulan = card.dataset.bulan;
        if (bulan === 'semua' || cardBulan === bulan) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function searchRiwayat() {
    const searchTerm = document.getElementById('search-riwayat').value.toLowerCase();
    const cards = document.querySelectorAll('.riwayat-card');
    
    cards.forEach(card => {
        const orderId = card.querySelector('.order-id').textContent.toLowerCase();
        const productNames = Array.from(card.querySelectorAll('.item-info h5'))
            .map(h5 => h5.textContent.toLowerCase()).join(' ');
        
        if (orderId.includes(searchTerm) || productNames.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function handleEnterSearch(event) {
    if (event.key === 'Enter') {
        searchRiwayat();
    }
}

function reorder(productIds) {
    alert('Fitur Quick Reorder akan segera hadir!\nProduk: ' + productIds.join(', '));
    // Nanti bisa redirect ke halaman produk dengan auto-add ke keranjang
}


</script>
@endsection