@extends('layouts.admin')

@section('title', 'Notifikasi')

@section('content')
<style>
  .notif-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
  }

  .notif-header i {
    font-size: 24px;
    color: #2E80FF;
  }

  .notif-header h2 {
    color: #2E80FF;
    font-weight: 700;
    font-size: 24px;
  }

  .notif-card {
    background: white;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    border-left: 4px solid #2E80FF;
    display: flex;
    align-items: center;
    gap: 15px;
  }

  .notif-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #f5f8fd;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2E80FF;
    font-size: 20px;
  }

  .notif-content {
    flex: 1;
  }

  .notif-title {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
  }

  .notif-desc {
    color: #666;
    font-size: 14px;
    margin-bottom: 5px;
  }

  .notif-time {
    color: #999;
    font-size: 12px;
  }

  .notif-badge {
    background: #ff4757;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 600;
  }

  .empty-notif {
    text-align: center;
    padding: 60px 20px;
    color: #666;
  }

  .empty-notif i {
    font-size: 60px;
    color: #ddd;
    margin-bottom: 20px;
  }

  .notif-actions {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  .btn-read, .btn-delete {
    background: none;
    border: none;
    padding: 8px;
    border-radius: 50%;
    cursor: pointer;
    transition: 0.3s;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .btn-read {
    color: #22c55e;
  }

  .btn-read:hover {
    background: #dcfce7;
  }

  .btn-delete {
    color: #ef4444;
  }

  .btn-delete:hover {
    background: #fef2f2;
  }

  .notif-card[data-read="true"] {
    opacity: 0.6;
    background: #f8f9fa;
  }

  .notif-card[data-read="true"] .notif-title::after {
    content: " ✓";
    color: #22c55e;
    font-size: 12px;
  }

  .notif-header-actions {
    display: flex;
    gap: 10px;
    margin-left: auto;
  }

  .btn-clear-all, .btn-mark-all {
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    transition: 0.3s;
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .btn-clear-all {
    background: #ef4444;
    color: white;
  }

  .btn-clear-all:hover {
    background: #dc2626;
  }

  .btn-mark-all {
    background: #22c55e;
    color: white;
  }

  .btn-mark-all:hover {
    background: #16a34a;
  }
</style>

<div class="notif-header" style="display: flex; align-items: center;">
  <i class="fas fa-bell"></i>
  <h2>Notifikasi</h2>
  <div class="notif-header-actions">
    <button onclick="markAllAsRead()" class="btn-mark-all">
      <i class="fas fa-check-double"></i> Tandai Semua Dibaca
    </button>
    <button onclick="clearAllNotifications()" class="btn-clear-all">
      <i class="fas fa-trash"></i> Hapus Semua
    </button>
  </div>
</div>

<div class="notif-list">
  @php
  try {
    $recentOrders = \App\Models\Order::orderBy('created_at', 'desc')->take(5)->get();
    $lowStockProducts = \App\Models\Product::where('stok', '<', 10)->take(3)->get();
  } catch (\Exception $e) {
    $recentOrders = collect();
    $lowStockProducts = collect();
  }
  @endphp
  
  @if($recentOrders->count() > 0)
    @foreach($recentOrders as $order)
    <div class="notif-card" id="notif-order-{{ $order->id }}" data-read="{{ $order->status != 'Menunggu' ? 'true' : 'false' }}">
      <div class="notif-icon">
        <i class="fas fa-shopping-cart"></i>
      </div>
      <div class="notif-content">
        <div class="notif-title">Pesanan Baru</div>
        <div class="notif-desc">{{ $order->nama_pembeli }} memesan {{ $order->nama_produk }}</div>
        <div class="notif-time">{{ $order->created_at->diffForHumans() }}</div>
      </div>
      <div class="notif-actions">
        @if($order->status == 'Menunggu')
        <button onclick="markAsRead('order', {{ $order->id }})" class="btn-read" title="Tandai sudah dibaca">
          <i class="fas fa-check"></i>
        </button>
        @endif
        <button onclick="deleteNotification('order', {{ $order->id }})" class="btn-delete" title="Hapus notifikasi">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    @endforeach
  @endif
  
  @if($lowStockProducts->count() > 0)
    @foreach($lowStockProducts as $product)
    <div class="notif-card" id="notif-product-{{ $product->id }}">
      <div class="notif-icon">
        <i class="fas fa-exclamation-triangle"></i>
      </div>
      <div class="notif-content">
        <div class="notif-title">Stok Menipis</div>
        <div class="notif-desc">Stok {{ $product->nama_produk }} tinggal {{ $product->stok }} buah</div>
        <div class="notif-time">{{ $product->updated_at->diffForHumans() }}</div>
      </div>
      <div class="notif-actions">
        <button onclick="markAsRead('product', {{ $product->id }})" class="btn-read" title="Tandai sudah dibaca">
          <i class="fas fa-check"></i>
        </button>
        <button onclick="deleteNotification('product', {{ $product->id }})" class="btn-delete" title="Hapus notifikasi">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    @endforeach
  @endif
  
  @if($recentOrders->isEmpty() && $lowStockProducts->isEmpty())
  <div class="empty-notif">
    <i class="fas fa-bell-slash"></i>
    <h3>Belum Ada Notifikasi</h3>
    <p>Notifikasi akan muncul ketika:</p>
    <ul style="text-align:left; margin-top:15px; color:#999;">
      <li>• Ada pesanan baru dari user</li>
      <li>• Stok produk menipis (< 10)</li>
    </ul>
  </div>
  @endif
</div>

<script>
function markAsRead(type, id) {
  const card = document.getElementById(`notif-${type}-${id}`);
  if (card) {
    card.setAttribute('data-read', 'true');
    
    // Store in localStorage
    const readNotifs = JSON.parse(localStorage.getItem('readNotifications') || '[]');
    const notifId = `${type}-${id}`;
    if (!readNotifs.includes(notifId)) {
      readNotifs.push(notifId);
      localStorage.setItem('readNotifications', JSON.stringify(readNotifs));
    }
  }
}

function deleteNotification(type, id) {
  if (confirm('Hapus notifikasi ini?')) {
    const card = document.getElementById(`notif-${type}-${id}`);
    if (card) {
      card.style.animation = 'fadeOut 0.3s ease-out';
      setTimeout(() => {
        card.remove();
        checkEmptyState();
      }, 300);
      
      // Store in localStorage
      const deletedNotifs = JSON.parse(localStorage.getItem('deletedNotifications') || '[]');
      const notifId = `${type}-${id}`;
      if (!deletedNotifs.includes(notifId)) {
        deletedNotifs.push(notifId);
        localStorage.setItem('deletedNotifications', JSON.stringify(deletedNotifs));
      }
    }
  }
}

function markAllAsRead() {
  const cards = document.querySelectorAll('.notif-card');
  cards.forEach(card => {
    card.setAttribute('data-read', 'true');
  });
  
  // Store all as read
  const allNotifs = [];
  cards.forEach(card => {
    const id = card.id.replace('notif-', '');
    allNotifs.push(id);
  });
  localStorage.setItem('readNotifications', JSON.stringify(allNotifs));
}

function clearAllNotifications() {
  if (confirm('Hapus semua notifikasi?')) {
    const cards = document.querySelectorAll('.notif-card');
    cards.forEach((card, index) => {
      setTimeout(() => {
        card.style.animation = 'fadeOut 0.3s ease-out';
        setTimeout(() => {
          card.remove();
          if (index === cards.length - 1) {
            checkEmptyState();
          }
        }, 300);
      }, index * 100);
    });
    
    // Store all as deleted
    const allNotifs = [];
    cards.forEach(card => {
      const id = card.id.replace('notif-', '');
      allNotifs.push(id);
    });
    localStorage.setItem('deletedNotifications', JSON.stringify(allNotifs));
  }
}

function checkEmptyState() {
  const notifList = document.querySelector('.notif-list');
  const remainingCards = notifList.querySelectorAll('.notif-card');
  
  if (remainingCards.length === 0) {
    notifList.innerHTML = `
      <div class="empty-notif">
        <i class="fas fa-bell-slash"></i>
        <h3>Semua notifikasi telah dibersihkan</h3>
        <p>Notifikasi baru akan muncul di sini</p>
      </div>
    `;
  }
}

// Load saved states on page load
document.addEventListener('DOMContentLoaded', function() {
  const readNotifs = JSON.parse(localStorage.getItem('readNotifications') || '[]');
  const deletedNotifs = JSON.parse(localStorage.getItem('deletedNotifications') || '[]');
  
  // Mark as read
  readNotifs.forEach(notifId => {
    const card = document.getElementById(`notif-${notifId}`);
    if (card) {
      card.setAttribute('data-read', 'true');
    }
  });
  
  // Hide deleted
  deletedNotifs.forEach(notifId => {
    const card = document.getElementById(`notif-${notifId}`);
    if (card) {
      card.remove();
    }
  });
  
  checkEmptyState();
});
</script>

<style>
@keyframes fadeOut {
  from { opacity: 1; transform: translateX(0); }
  to { opacity: 0; transform: translateX(100%); }
}
</style>
@endsection