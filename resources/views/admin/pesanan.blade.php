@extends('layouts.admin')

@section('title', 'Kelola Pesanan')

@section('content')
@if(session('success'))
<div style="background:#d4edda; color:#155724; padding:15px; border-radius:10px; margin-bottom:20px; border:1px solid #c3e6cb;">
  <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="background:#f8d7da; color:#721c24; padding:15px; border-radius:10px; margin-bottom:20px; border:1px solid #f5c6cb;">
  <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
</div>
@endif

<style>
  /* ========== STYLE DASAR ========== */
  .card-box {
    background: white;
    border-radius: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    width: 32%;
    min-width: 250px;
  }

  .card-box i {
    color: #2E80FF;
    font-size: 28px;
  }

  .status-alert {
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    color: #856404;
    padding: 10px 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .btn-tambah:hover {
    background: #1c6be0;
  }

  .table-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px; /* Supaya tabel tetap proporsional saat di-scroll */
  }

  thead {
    background: #f5f8fd;
    color: #2E80FF;
  }

  th, td {
    padding: 12px 16px;
    text-align: left;
    white-space: nowrap;
  }

  tr {
    border-top: 1px solid #f0f0f0;
  }

  tr:hover {
    background: #f9fafb;
  }

  .status-menunggu {
    color: #E5B100;
    font-weight: 600;
  }

  .status-selesai {
    color: #22c55e;
    font-weight: 600;
  }

  .btn-edit {
    background: #2E80FF;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 6px 12px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-weight: 600;
    cursor: pointer;
  }

  .btn-edit:hover {
    background: #1c6be0;
  }

  .btn-hapus {
    background: #EF4444;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 6px 12px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-weight: 600;
    cursor: pointer;
  }

  .btn-hapus:hover {
    background: #dc2626;
  }

  /* ========== RESPONSIVE ========== */
  @media (max-width: 992px) {
    .card-container {
      flex-wrap: wrap;
      justify-content: center;
    }

    .card-box {
      width: 45%;
    }
  }

  @media (max-width: 768px) {
    .card-box {
      width: 100%;
    }

    .btn-tambah {
      width: 100%;
      justify-content: center;
    }

    table {
      min-width: 700px;
    }

    .table-container {
      border-radius: 12px;
    }
  }

  @media (max-width: 480px) {
    h2 {
      font-size: 20px;
    }

    .btn-edit, .btn-hapus {
      padding: 6px 10px;
      font-size: 13px;
    }
  }
</style>

{{-- HEADER --}}
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
  <div style="display:flex; align-items:center; gap:10px;">
    <i class="fa fa-box" style="font-size:24px; color:#2E80FF;"></i>
    <h2 style="color:#2E80FF; font-weight:700;">Kelola Pesanan</h2>
  </div>
  @if($orders && $orders->count() > 0)
  <form action="{{ route('admin.pesanan.delete-all') }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus SEMUA pesanan? Tindakan ini tidak dapat dibatalkan!')">
    @csrf
    @method('DELETE')
    <button type="submit" style="background:#FF6B6B; color:white; border:none; padding:10px 16px; border-radius:8px; cursor:pointer; font-weight:600; display:flex; align-items:center; gap:8px;">
      <i class="fa fa-trash-alt"></i> Hapus Semua Pesanan
    </button>
  </form>
  @endif
</div>

@if($orders && $orders->count() > 0)
{{-- ALERT PESANAN BARU --}}
<div id="new-order-alert" style="background:#d4edda; color:#155724; padding:15px; border-radius:10px; margin-bottom:20px; border:1px solid #c3e6cb; display:none;">
  <i class="fas fa-bell" style="color:#ff4757;"></i> <strong>Pesanan Baru Masuk!</strong> Ada pesanan yang perlu diproses.
</div>

{{-- MONITORING PESANAN --}}
<div style="background:white; border-radius:15px; padding:20px; margin-bottom:20px; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
  <h3 style="color:#2E80FF; margin-bottom:15px; display:flex; align-items:center; gap:8px;">
    <i class="fa fa-chart-line"></i> Monitoring Pesanan Real-time
  </h3>
  <div style="display:flex; gap:15px; align-items:center;">
    <button onclick="refreshOrders()" style="background:#2E80FF; color:white; border:none; padding:8px 16px; border-radius:8px; cursor:pointer;">
      <i class="fa fa-refresh"></i> Refresh Data
    </button>
    <div style="color:#666; font-size:14px;">
      <i class="fa fa-clock"></i> Terakhir diperbarui: <span id="last-update">{{ now()->format('H:i:s') }}</span>
    </div>
  </div>
</div>
@else
{{-- EMPTY STATE --}}
<div style="background:white; border-radius:15px; padding:40px; margin-bottom:20px; box-shadow:0 2px 8px rgba(0,0,0,0.05); text-align:center;">
  <i class="fa fa-inbox" style="font-size:60px; color:#ddd; margin-bottom:20px;"></i>
  <h3 style="color:#666; margin-bottom:10px;">Belum Ada Pesanan</h3>
  <p style="color:#999;">Pesanan dari user akan muncul di sini secara real-time</p>
</div>
@endif

@if($orders && $orders->count() > 0)
{{-- Kartu Statistik --}}
<div class="card-container" style="display:flex; gap:20px; margin-bottom:24px;">
  <div class="card-box">
    <i class="fa fa-clock"></i>
    <div>
      <p style="font-weight:700; color:#333;">Pesanan Menunggu</p>
      <p style="color:#555; font-size:14px;">{{ $pendingOrders ?? 0 }} pesanan belum diproses</p>
    </div>
  </div>

  <div class="card-box">
    <i class="fa fa-check-circle"></i>
    <div>
      <p style="font-weight:700; color:#333;">Pesanan Selesai</p>
      <p style="color:#555; font-size:14px;">{{ $completedOrders ?? 0 }} pesanan sudah diambil</p>
    </div>
  </div>

  <div class="card-box">
    <i class="fa fa-times-circle"></i>
    <div>
      <p style="font-weight:700; color:#333;">Dibatalkan</p>
      <p style="color:#555; font-size:14px;">{{ $cancelledOrders ?? 0 }} pesanan dibatalkan</p>
    </div>
  </div>
</div>
@endif



{{-- Tabel Pesanan --}}
<div class="table-container">
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Pembeli</th>
        <th>Kelas</th>
        <th>Ruangan</th>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if($orders && count($orders) > 0)
        @foreach($orders as $index => $order)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $order->nama_pembeli }}</td>
          <td>{{ $order->kelas }}</td>
          <td>{{ $order->ruangan }}</td>
          <td>{{ $order->nama_produk }}</td>
          <td>{{ $order->jumlah }}</td>
          <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
          <td class="status-{{ strtolower($order->status) }}">{{ $order->status }}</td>
          <td style="display:flex; gap:5px; align-items:center;">
            <a href="{{ route('admin.pesanan.edit', $order->id) }}" class="btn-edit">
              <i class="fa fa-pen"></i> Edit
            </a>
            <form action="{{ route('admin.pesanan.destroy', $order->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus pesanan ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-hapus">
                <i class="fa fa-trash"></i> Hapus
              </button>
            </form>
            <form action="{{ route('admin.pesanan.status', $order->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('PUT')
              <select name="status" onchange="this.form.submit()" style="padding:4px 8px; border-radius:4px; border:1px solid #ddd; font-size:12px;">
                <option value="Menunggu" {{ $order->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Dibatalkan" {{ $order->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
              </select>
            </form>
          </td>
        </tr>
        @endforeach
      @else
        <tr>
          <td colspan="9" style="text-align:center; color:#666; padding:40px;">
            <i class="fa fa-box" style="font-size:40px; margin-bottom:10px; display:block;"></i>
            Belum ada pesanan
          </td>
        </tr>
      @endif
    </tbody>
  </table>
</div>

<script>
let lastOrderCount = {{ $orders->count() }};

// Manual refresh orders table
function refreshOrders() {
  location.reload();
}

// Check for new orders
function checkNewOrders() {
  fetch('/admin/pesanan/count')
    .then(response => response.json())
    .then(data => {
      const currentCount = data.count;
      
      if (currentCount > lastOrderCount) {
        // Show alert
        const alert = document.getElementById('new-order-alert');
        if (alert) {
          alert.style.display = 'block';
          
          // Play notification sound
          playNotificationSound();
          
          // Show browser notification
          if (Notification.permission === 'granted') {
            new Notification('Pesanan Baru!', {
              body: `Ada ${currentCount - lastOrderCount} pesanan baru masuk`,
              icon: '/assets/img/logo.png'
            });
          }
          
          // Auto refresh after 3 seconds
          setTimeout(() => {
            refreshOrders();
          }, 3000);
        }
      }
      
      lastOrderCount = currentCount;
      
      // Update last update time
      const timeEl = document.getElementById('last-update');
      if (timeEl) {
        timeEl.textContent = new Date().toLocaleTimeString();
      }
    })
    .catch(error => console.log('Check orders error:', error));
}

function playNotificationSound() {
  const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBTuR2O/Eeyw');
  audio.play().catch(() => {});
}

// Request notification permission
if ('Notification' in window && Notification.permission === 'default') {
  Notification.requestPermission();
}

// Check for new orders every 10 seconds
setInterval(checkNewOrders, 10000);
</script>
@endsection
