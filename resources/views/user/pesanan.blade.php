@extends('layouts.user')

@section('title', 'Pesanan Saya')

@section('styles')
<style>
.pesanan-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.pesanan-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.pesanan-header h2 {
    color: #2E80FF;
    font-weight: 700;
    font-size: 24px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-status {
    display: flex;
    gap: 10px;
}

.filter-status button {
    background: #fff;
    border: 2px solid #2E80FF;
    color: #2E80FF;
    border-radius: 50px;
    padding: 6px 18px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
}

.filter-status button.active,
.filter-status button:hover {
    background: #2E80FF;
    color: #fff;
}

.pesanan-card {
    background: #fff;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    display: flex;
    gap: 20px;
    align-items: center;
}

.pesanan-image {
    width: 80px;
    height: 80px;
    object-fit: contain;
    border-radius: 12px;
    background: #f8faff;
    padding: 10px;
}

.pesanan-info {
    flex: 1;
}

.pesanan-info h4 {
    margin: 0 0 8px 0;
    font-size: 18px;
    font-weight: 600;
    color: #333;
}

.pesanan-info p {
    margin: 4px 0;
    color: #666;
    font-size: 14px;
}

.pesanan-price {
    font-size: 16px;
    font-weight: 600;
    color: #2E80FF;
    margin-top: 8px;
}

.pesanan-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: flex-end;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.status-menunggu {
    background: #fff3cd;
    color: #856404;
}

.status-selesai {
    background: #d4edda;
    color: #155724;
}

.status-dibatalkan {
    background: #f8d7da;
    color: #721c24;
}

.btn-cancel {
    background: #fff;
    border: 2px solid #e74c3c;
    color: #e74c3c;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
}

.btn-cancel:hover {
    background: #e74c3c;
    color: #fff;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #999;
}

.empty-state i {
    font-size: 60px;
    margin-bottom: 20px;
    color: #ddd;
}

.empty-state h3 {
    margin-bottom: 10px;
    color: #666;
}

.empty-state a {
    color: #2E80FF;
    text-decoration: none;
    font-weight: 600;
}
</style>
@endsection

@section('content')
<div class="pesanan-container">
    <!-- Header -->
    <div class="pesanan-header">
        <h2><i class="fas fa-clipboard-list"></i> Pesanan Saya</h2>
        <div class="filter-status">
            <button class="active" onclick="filterStatus('semua')">Semua</button>
            <button onclick="filterStatus('Menunggu')">Menunggu</button>
            <button onclick="filterStatus('Selesai')">Selesai</button>
            <button onclick="filterStatus('Dibatalkan')">Dibatalkan</button>
        </div>
    </div>

    <!-- Daftar Pesanan -->
    <div class="pesanan-list">
        @if($orders && count($orders) > 0)
            @foreach($orders as $order)
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
                $imageName = $imageMap[$order->nama_produk] ?? 'logo.png';
            @endphp
            <div class="pesanan-card" data-status="{{ $order->status }}">
                <img src="{{ asset('assets/img/' . $imageName) }}" alt="{{ $order->nama_produk }}" class="pesanan-image">
                
                <div class="pesanan-info">
                    <h4>{{ $order->nama_produk }}</h4>
                    <p><i class="fas fa-calendar"></i> {{ $order->created_at->format('d M Y, H:i') }}</p>
                    <p><i class="fas fa-school"></i> {{ $order->lokasi_sekolah ?? 'SMK Negeri 1 Jakarta' }}</p>
                    <p><i class="fas fa-door-open"></i> {{ $order->kelas }} - {{ $order->ruangan }}</p>
                    <p><i class="fas fa-credit-card"></i> {{ $order->metode_pembayaran }}</p>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $order->metode_pengambilan }}</p>
                    @if($order->catatan)
                        <p><i class="fas fa-sticky-note"></i> {{ $order->catatan }}</p>
                    @endif
                    @if($order->bukti_pembayaran)
                        <p><i class="fas fa-receipt"></i> <a href="{{ asset('assets/img/' . $order->bukti_pembayaran) }}" target="_blank" style="color: #2E80FF;">Lihat Bukti Pembayaran</a></p>
                    @endif
                    <div class="pesanan-price">
                        {{ $order->jumlah }}x - Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </div>
                </div>

                <div class="pesanan-actions">
                    <span class="status-badge status-{{ strtolower($order->status) }}">
                        {{ $order->status }}
                    </span>
                    
                    @if($order->status === 'Menunggu')
                        <button class="btn-cancel" onclick="cancelOrder({{ $order->id }})">
                            <i class="fas fa-times"></i> Batalkan
                        </button>
                    @endif
                    
                    <form action="{{ route('pesanan.delete', $order->id) }}" method="POST" style="display:inline; margin-top:5px;" onsubmit="return confirm('Yakin hapus pesanan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:#e74c3c; color:white; border:none; padding:6px 12px; border-radius:8px; font-size:12px; cursor:pointer; display:flex; align-items:center; gap:4px;">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        @else
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h3>Belum ada pesanan</h3>
                <p>Anda belum memiliki pesanan. Mulai berbelanja sekarang!</p>
                <a href="{{ route('produk') }}">Lihat Produk</a>
            </div>
        @endif
    </div>
</div>

<script>
function filterStatus(status) {
    const cards = document.querySelectorAll('.pesanan-card');
    const buttons = document.querySelectorAll('.filter-status button');
    
    // Update active button
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    // Filter orders
    cards.forEach(card => {
        const orderStatus = card.dataset.status;
        if (status === 'semua' || orderStatus === status) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

function cancelOrder(orderId) {
    if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
        // Create form to submit cancellation
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/pesanan/${orderId}/cancel`;
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        // Add method override for PUT
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection