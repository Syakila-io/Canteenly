@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
  <div style="margin-bottom: 40px;">
    <h2 style="color:#2E80FF; font-weight:700; margin:0;">Assalamualaikum admin 🧕🏽</h2>
    <p style="color:#666; margin:10px 0 0 0;">Sistem siap menerima pesanan dari user</p>
  </div>

  <h3 style="color:#2E80FF; margin:10px 0 20px 0; font-weight:500;">📈 Statistik Sistem</h3>
  
  <div style="display:flex; gap:20px; margin-top:0; flex-wrap:wrap;">
    <!-- Kartu 1 -->
    <div style="flex:1; min-width:250px; background:white; border-radius:15px; padding:25px; box-shadow:0 4px 10px rgba(0,0,0,0.05); border:1px solid #e8f2f5;">
      <i class="fa fa-bag-shopping" style="font-size:24px; color:#2E80FF;"></i>
      <p style="margin:10px 0 0; font-weight:600; color:#555;">Total Produk</p>
      <h2 style="color:#2E80FF; margin-top:5px;">{{ $totalProducts ?? 0 }}</h2>
    </div>

    <!-- Kartu 2 -->
    <div style="flex:1; min-width:250px; background:white; border-radius:15px; padding:25px; box-shadow:0 4px 10px rgba(0,0,0,0.05); border:1px solid #e8f2f5;">
      <i class="fa fa-box" style="font-size:24px; color:#2E80FF;"></i>
      <p style="margin:10px 0 0; font-weight:600; color:#555;">Total Pesanan</p>
      <h2 style="color:#2E80FF; margin-top:5px;">0</h2>
    </div>

    <!-- Kartu 3 -->
    <div style="flex:1; min-width:250px; background:white; border-radius:15px; padding:25px; box-shadow:0 4px 10px rgba(0,0,0,0.05); border:1px solid #e8f2f5;">
      <i class="fa fa-money-bill" style="font-size:24px; color:#2E80FF;"></i>
      <p style="margin:10px 0 0; font-weight:600; color:#555;">Total Pendapatan</p>
      <h2 style="color:#2E80FF; margin-top:5px;">Rp 0</h2>
    </div>

    <!-- Kartu 4 -->
    <div style="flex:1; min-width:250px; background:white; border-radius:15px; padding:25px; box-shadow:0 4px 10px rgba(0,0,0,0.05); border:1px solid #e8f2f5;">
      <i class="fa fa-clock" style="font-size:24px; color:#2E80FF;"></i>
      <p style="margin:10px 0 0; font-weight:600; color:#555;">Pesanan Menunggu</p>
      <h2 style="color:#2E80FF; margin-top:5px;">{{ $pendingOrders ?? 0 }}</h2>
    </div>
  </div>

  <!-- Floating Notification -->
  <div id="notification" style="position:fixed; top:20px; right:20px; background:#28a745; color:white; padding:15px 20px; border-radius:10px; box-shadow:0 4px 15px rgba(0,0,0,0.2); display:none; z-index:1000; max-width:340px;">
    <div style="display:flex; align-items:center; gap:10px;">
      <i class="fas fa-bell" style="font-size:18px;"></i>
      <div style="flex:1;">
        <div id="notificationText" style="font-weight:600">Pesanan baru masuk!</div>
        <div id="notificationSub" style="font-size:12px; opacity:0.9">Klik untuk lihat detail atau tandai selesai.</div>
      </div>
      <div style="display:flex; gap:8px; margin-left:8px;">
        <button id="notifViewBtn" onclick="openNotifications()" style="background:#fff; color:#2E80FF; border:none; padding:6px 10px; border-radius:8px; cursor:pointer; font-weight:600;">Lihat</button>
        <button id="notifCompleteBtn" onclick="completeAll()" style="background:#ffffff66; color:#fff; border:none; padding:6px 10px; border-radius:8px; cursor:pointer; font-weight:600;">Selesai</button>
      </div>
      <button onclick="closeNotification()" style="background:none; border:none; color:white; font-size:16px; cursor:pointer; margin-left:8px;">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>

  <!-- Pending Orders Modal -->
  <div id="pendingModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; width:90%; max-width:720px; border-radius:12px; box-shadow:0 8px 30px rgba(0,0,0,0.2); z-index:1100; overflow:hidden;">
    <div style="padding:18px 20px; border-bottom:1px solid #eee; display:flex; align-items:center; gap:10px;">
      <h3 style="margin:0; color:#2E80FF;">Pesanan Menunggu</h3>
      <div style="margin-left:auto; display:flex; gap:8px;">
        <button onclick="closePendingModal()" style="background:none; border:none; font-weight:600; color:#666;">Tutup</button>
        <button onclick="completeAll()" style="background:#2E80FF; color:white; border:none; padding:8px 12px; border-radius:8px; font-weight:700;">Selesai Semua</button>
      </div>
    </div>
    <div id="pendingList" style="max-height:420px; overflow:auto; padding:12px 18px;">
      <p style="color:#666;">Memuat pesanan...</p>
    </div>
  </div>

  <div id="pendingBackdrop" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:1090;" onclick="closePendingModal()"></div>

  <script>
  let lastOrderCount = {{ $pendingOrders ?? 0 }};
  const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '';
    // If there are pending orders when the page loads, show a notification immediately
    if (lastOrderCount > 0) {
      showNotification('Ada ' + lastOrderCount + ' pesanan menunggu', '#28a745');
    }
    function checkNewOrders() {
      fetch('/admin/pesanan/count')
        .then(response => response.json())
        .then(data => {
          if (data.count > lastOrderCount) {
            showNotification('Pesanan baru masuk!', '#28a745');
            lastOrderCount = data.count;
            // Update pending orders display
            document.querySelector('.fa-clock').parentElement.querySelector('h2').textContent = data.count;
          }
        })
        .catch(error => console.log('Error:', error));
    }

    function showNotification(message, color = '#28a745') {
      const notification = document.getElementById('notification');
      const notificationText = document.getElementById('notificationText');
      
      notification.style.backgroundColor = color;
      notificationText.textContent = message;
      notification.style.display = 'block';
      
      // Auto hide after 5 seconds
      setTimeout(() => {
        notification.style.display = 'none';
      }, 5000);
    }

    function openNotifications() {
      // open modal and load pending orders
      document.getElementById('pendingModal').style.display = 'block';
      document.getElementById('pendingBackdrop').style.display = 'block';
      loadPendingOrders();
    }

    function closePendingModal() {
      document.getElementById('pendingModal').style.display = 'none';
      document.getElementById('pendingBackdrop').style.display = 'none';
    }

    async function loadPendingOrders() {
      try {
        const resp = await fetch('/admin/pesanan/pending');
        const data = await resp.json();
        const container = document.getElementById('pendingList');
        if (!data.orders || data.orders.length === 0) {
          container.innerHTML = '<p style="color:#666;">Tidak ada pesanan menunggu.</p>';
          return;
        }

        const items = data.orders.map(o => {
          return `
            <div style="display:flex; align-items:center; justify-content:space-between; padding:12px; border-bottom:1px solid #f1f1f1;">
              <div style="flex:1;">
                <div style="font-weight:700; color:#333;">${o.nama_produk} x${o.jumlah} — ${o.nama_pembeli}</div>
                <div style="font-size:13px; color:#666;">Total: Rp ${Number(o.total_harga).toLocaleString('id-ID')} • ID #${o.id} • ${new Date(o.created_at).toLocaleString()}</div>
              </div>
              <div style="display:flex; gap:8px; margin-left:12px;">
                <button onclick="completeOrder(${o.id})" style="background:#2E80FF; color:#fff; border:none; padding:8px 12px; border-radius:8px; font-weight:700;">Selesai</button>
                <a href="/admin/pesanan/edit/${o.id}" style="background:#fff; color:#2E80FF; border:1px solid #2E80FF; padding:8px 12px; border-radius:8px; font-weight:700; text-decoration:none;">Detail</a>
              </div>
            </div>
          `;
        }).join('');

        container.innerHTML = items;
      } catch (err) {
        console.error(err);
        document.getElementById('pendingList').innerHTML = '<p style="color:#c00;">Gagal memuat pesanan.</p>';
      }
    }

    async function completeOrder(id) {
      try {
        const resp = await fetch(`/admin/pesanan/${id}/status`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({ status: 'Selesai' })
        });

        if (!resp.ok) throw new Error('Gagal');
        // remove the order row and refresh totals/cards
        await loadPendingOrders();
        await fetchTotalsAndUpdateCards();
        showNotification('Pesanan ID #' + id + ' ditandai selesai', '#2E86AB');
      } catch (err) {
        console.error(err);
        showNotification('Gagal menandai pesanan selesai', '#ff4757');
      }
    }

    async function fetchTotalsAndUpdateCards() {
      try {
        const resp = await fetch('/admin/pesanan/totals');
        const data = await resp.json();
        const pendapatanCard = document.querySelectorAll('.fa-money-bill')[0];
        if (pendapatanCard) pendapatanCard.parentElement.querySelector('h2').textContent = 'Rp ' + numberWithCommas(data.total_revenue || 0);
        const pendingCard = document.querySelectorAll('.fa-clock')[0];
        if (pendingCard) pendingCard.parentElement.querySelector('h2').textContent = data.pending_count || 0;
        lastOrderCount = data.pending_count || 0;
      } catch (err) {
        console.error('Gagal fetch totals', err);
      }
    }

    async function completeAll() {
      try {
        const resp = await fetch('/admin/pesanan/complete-all', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          }
        });

        const data = await resp.json();
        if (data.success) {
          // show totals to admin
          const totalRp = formatRupiah(data.total_revenue || 0);
          showNotification('Semua pesanan ditandai selesai. Total pendapatan: ' + totalRp, '#2E86AB');
          // update dashboard total pendapatan and pending count
          const pendapatanCard = document.querySelectorAll('.fa-money-bill')[0];
          if (pendapatanCard) pendapatanCard.parentElement.querySelector('h2').textContent = 'Rp ' + numberWithCommas(data.total_revenue || 0);
          const pendingCard = document.querySelectorAll('.fa-clock')[0];
          if (pendingCard) pendingCard.parentElement.querySelector('h2').textContent = data.pending_count || 0;

          // notify students clients by updating a local flag - student dashboards poll /api/user/total-spent
        } else {
          showNotification('Gagal menandai selesai: ' + (data.message || ''), '#ff4757');
        }
      } catch (err) {
        console.error(err);
        showNotification('Terjadi error saat memproses.', '#ff4757');
      }
    }

    function numberWithCommas(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function formatRupiah(amount) {
      return 'Rp ' + numberWithCommas(amount);
    }

    function closeNotification() {
      document.getElementById('notification').style.display = 'none';
    }

    // Check for new orders every 3 seconds
    setInterval(checkNewOrders, 3000);
  </script>
@endsection
