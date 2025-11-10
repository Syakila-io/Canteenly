@extends('layouts.user')

@section('title', 'Dashboard')

@section('styles')
<style>
.hero-section {
  background: linear-gradient(135deg, #2E80FF 0%, #1e5bb8 100%);
  border-radius: 20px;
  padding: 40px;
  color: white;
  margin-bottom: 30px;
  position: relative;
  overflow: hidden;
}

.hero-section::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -20%;
  width: 200px;
  height: 200px;
  background: rgba(255,255,255,0.1);
  border-radius: 50%;
  animation: float 6s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
}

.greeting-emoji {
  display: inline-block;
  font-size: 1.2em;
}

.hero-content h1 {
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 10px;
}

.hero-content p {
  font-size: 16px;
  opacity: 0.9;
  margin-bottom: 20px;
}

.quick-actions {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
  margin-bottom: 30px;
}

.action-card {
  background: white;
  border-radius: 15px;
  padding: 25px;
  text-align: center;
  box-shadow: 0 4px 15px rgba(0,0,0,0.08);
  transition: all 0.3s ease;
  text-decoration: none;
  color: inherit;
}

.action-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 8px 25px rgba(46,128,255,0.15);
  text-decoration: none;
  color: inherit;
}

.action-icon {
  width: 60px;
  height: 60px;
  background: linear-gradient(135deg, #2E80FF, #1e5bb8);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 15px;
}

.action-icon i {
  color: white;
  font-size: 24px;
}

.action-card h3 {
  font-size: 16px;
  font-weight: 600;
  color: #333;
  margin-bottom: 8px;
}

.action-card p {
  font-size: 14px;
  color: #666;
  margin: 0;
}

.features-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

.feature-card {
  background: white;
  border-radius: 15px;
  padding: 20px;
  border-left: 4px solid #2E80FF;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.feature-card h4 {
  color: #2E80FF;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 10px;
}

.feature-card p {
  color: #666;
  font-size: 14px;
  margin: 0;
}

@media (max-width: 768px) {
  .hero-section {
    padding: 25px;
  }
  
  .hero-content h1 {
    font-size: 24px;
  }
  
  .quick-actions {
    grid-template-columns: repeat(2, 1fr);
  }
}
</style>
@endsection

@section('content')
  @if(session('login_success'))
  <div style="background:#d4edda; color:#155724; padding:15px; border-radius:10px; margin-bottom:20px; border:1px solid #c3e6cb;">
    <i class="fas fa-check-circle"></i> Login berhasil! Selamat datang di Canteenly.
  </div>
  @endif
  
  @if(session('success'))
  <div style="background:#d4edda; color:#155724; padding:15px; border-radius:10px; margin-bottom:20px; border:1px solid #c3e6cb;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
  </div>
  @endif

  <!-- Hero Section -->
  <div class="hero-section">
    <div class="hero-content">
      <h1>
        @if(session('user_gender') == 'Laki-laki')
          <span class="greeting-emoji">🙏</span>
        @else
          <span class="greeting-emoji">🧕</span>
        @endif
        Assalamualaikum, {{ session('user_name', 'User') }}!
      </h1>
      <p>Nikmati pengalaman berbelanja yang mudah dan menyenangkan di kantin digital kami</p>
      @if(session('user_kelas'))
      <div style="background: rgba(255,255,255,0.2); padding: 8px 15px; border-radius: 20px; display: inline-block; font-size: 14px;">
        <i class="fas fa-graduation-cap"></i> {{ session('user_kelas') }} | {{ ucfirst(session('user_role')) }}
      </div>
      @endif
    </div>
  </div>

  <!-- Statistics Cards -->
  <div class="quick-actions">
    <div class="action-card">
      <div class="action-icon">
        <i class="fas fa-box"></i>
      </div>
      <h3>Total Produk</h3>
      <p>{{ $totalProducts ?? 0 }} produk tersedia</p>
    </div>

    <div class="action-card">
      <div class="action-icon">
        <i class="fas fa-shopping-cart"></i>
      </div>
      <h3>Total Pesanan</h3>
      <p>{{ $totalOrders ?? 0 }} pesanan dibuat</p>
    </div>

    <div class="action-card">
      <div class="action-icon">
        <i class="fas fa-money-bill-wave"></i>
      </div>
      <h3>Total Pengeluaran</h3>
      <p id="totalPengeluaran">Rp {{ number_format($totalSpent ?? 0, 0, ',', '.') }}</p>
    </div>
  </div>



  <!-- Features Section -->
  <h3 style="color: #2E80FF; font-weight: 600; margin-bottom: 20px;">✨ Fitur Unggulan</h3>
  <div class="features-grid">
    <div class="feature-card">
      <h4>🚀 Pesan Cepat</h4>
      <p>Sistem pemesanan yang mudah dan cepat dengan berbagai pilihan pembayaran</p>
    </div>
    
    <div class="feature-card">
      <h4>📱 Real-time Update</h4>
      <p>Pantau status pesanan secara real-time dari proses hingga siap diambil</p>
    </div>
    
    <div class="feature-card">
      <h4>💳 Pembayaran Fleksibel</h4>
      <p>Mendukung berbagai metode pembayaran digital untuk kemudahan transaksi</p>
    </div>
  </div>

  <!-- Floating Notification -->
  <div id="userNotification" style="position:fixed; top:20px; right:20px; background:#2E80FF; color:white; padding:15px 20px; border-radius:10px; box-shadow:0 4px 15px rgba(0,0,0,0.2); display:none; z-index:1000; max-width:300px;">
    <div style="display:flex; align-items:center; gap:10px;">
      <i class="fas fa-check-circle" style="font-size:18px;"></i>
      <span id="userNotificationText">Pesanan Anda telah selesai!</span>
      <button onclick="closeUserNotification()" style="background:none; border:none; color:white; font-size:16px; cursor:pointer; margin-left:auto;">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>

  <script>
    let lastCompletedCount = 0;

    function playNotificationSound() {
      const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBTuR2O/Eeyw');
      audio.play().catch(() => {
        // Handle autoplay restrictions silently
        console.log('Tidak dapat memutar suara notifikasi');
      });
    }

    function checkOrderStatus() {
      fetch('/api/user/orders/completed')
        .then(response => response.json())
        .then(data => {
          if (data.count > lastCompletedCount) {
            showUserNotification('Pesanan Anda telah selesai!', '#28a745');
            playNotificationSound(); // Mainkan suara notifikasi
            lastCompletedCount = data.count;
          }
        })
        .catch(error => console.log('Error:', error));
    }

    function showUserNotification(message, color = '#2E80FF') {
      const notification = document.getElementById('userNotification');
      const notificationText = document.getElementById('userNotificationText');
      
      notification.style.backgroundColor = color;
      notificationText.textContent = message;
      notification.style.display = 'block';
      
      // Auto hide after 5 seconds
      setTimeout(() => {
        notification.style.display = 'none';
      }, 5000);
    }

    function closeUserNotification() {
      document.getElementById('userNotification').style.display = 'none';
    }

    // Check for completed orders every 5 seconds
    setInterval(checkOrderStatus, 5000);

    // Poll total spent for this user and update display
    async function updateTotalSpent() {
      try {
        const resp = await fetch('/api/user/total-spent');
        const data = await resp.json();
        const el = document.getElementById('totalPengeluaran');
        if (el) el.textContent = 'Rp ' + (data.total_spent ? Number(data.total_spent).toLocaleString('id-ID') : '0');
      } catch (err) {
        console.error('Gagal mendapatkan total pengeluaran:', err);
      }
    }

    // initial fetch and periodic update
    updateTotalSpent();
    setInterval(updateTotalSpent, 5000);
  </script>
@endsection
