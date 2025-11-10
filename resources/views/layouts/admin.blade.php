<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') | Canteenly Admin</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    * {
      font-family: 'Poppins', sans-serif;
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      min-height: 100vh;
      background: #f5f8fd;
    }

    /* === SIDEBAR === */
    .sidebar {
      width: 250px;
      background: #e8f2f5;
      padding: 20px;
      display: flex;
      flex-direction: column;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 30px;
      padding: 10px 15px;
    }

    .logo img {
      width: 50px;
      height: 50px;
      border: 2px solid #2E80FF;
      border-radius: 50%;
      padding: 5px;
      background-color: white;
    }

    .logo h2 {
      font-family: 'Poppins', sans-serif;
      font-size: 20px;
      color: #2E80FF;
      font-weight: 600;
    }

    .sidebar ul {
      list-style: none;
      margin-top: 10px;
    }

    .sidebar ul li {
      margin-bottom: 10px;
    }

    .sidebar ul li a {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      color: #2E80FF;
      font-weight: 500;
      padding: 10px 15px;
      border-radius: 10px;
      transition: 0.3s;
      white-space: nowrap;
    }

    .sidebar ul li a.active {
      background: #fff;
      border-left: 4px solid #2E80FF;
      color: #2E80FF;
      font-weight: 600;
    }

    .sidebar ul li a:hover {
      background: #f5f8fd;
    }



    .logout {
      margin-top: auto;
      border-top: 1px solid #c8d8e8;
      padding-top: 15px;
    }

    .logout a {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #2E80FF;
      text-decoration: none;
      font-weight: 600;
      border-radius: 10px;
      padding: 10px 15px;
      transition: 0.3s;
    }

    .logout a:hover {
      background: #f5f8fd;
    }

    .notification-badge {
      background: #ff4757;
      color: white;
      border-radius: 50%;
      padding: 2px 6px;
      font-size: 11px;
      font-weight: 600;
      margin-left: auto;
      animation: pulse 2s infinite;
      min-width: 18px;
      text-align: center;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }

    /* === MAIN AREA === */
    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    /* === NAVBAR === */
    .navbar {
      background: #fff;
      border-bottom: 1px solid #e4e8f0;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar h3 {
      color: #2E80FF;
      font-weight: 600;
    }

    .navbar .user {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #555;
      font-weight: 500;
    }

    .navbar .user i {
      color: #2E80FF;
      font-size: 20px;
    }

    /* === FOOTER === */
    .footer {
      background: #fff;
      border-top: 1px solid #e4e8f0;
      text-align: center;
      padding: 10px;
      color: #777;
      font-size: 13px;
    }

    /* === RESPONSIVE === */
    @media (max-width: 768px) {
      body { flex-direction: column; }
      .sidebar { width: 100%; flex-direction: row; justify-content: space-around; }
      .logo, .logout { display: none; }
      .main { padding-bottom: 60px; }
    }
  </style>
</head>

<body>
  {{-- SIDEBAR --}}
  <div class="sidebar">
    <div class="logo">
      <img src="{{ asset('assets/img/logo.png') }}" alt="Canteenly Logo">
      <h2>Canteenly</h2>
    </div>
    <ul>
  <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
  <li><a href="{{ route('admin.produk') }}" class="{{ request()->routeIs('admin.produk*') ? 'active' : '' }}"><i class="fas fa-box"></i> Kelola Produk</a></li>
  <li><a href="{{ route('admin.pesanan') }}" class="{{ request()->routeIs('admin.pesanan*') ? 'active' : '' }}"><i class="fas fa-shopping-cart"></i> <span>Kelola Pesanan</span> @php try { $pendingCount = \App\Models\Order::where('status', 'Menunggu')->count(); } catch(\Exception $e) { $pendingCount = 0; } @endphp @if($pendingCount > 0)<span class="notification-badge">{{ $pendingCount }}</span>@endif</a></li>
  <li><a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') || request()->routeIs('admin.*user*') ? 'active' : '' }}"><i class="fas fa-users"></i> Kelola User</a></li>
  <li><a href="/admin/notifikasi" class="{{ request()->is('admin/notifikasi') ? 'active' : '' }}"><i class="fas fa-bell"></i> Notifikasi @if($pendingCount > 0)<span class="notification-badge">{{ $pendingCount }}</span>@endif</a></li>
    </ul>
    <div class="logout">
      <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>

  {{-- MAIN AREA --}}
  <div class="main">
    {{-- NAVBAR --}}
    <div class="navbar">
      <h3>@yield('title')</h3>
      <div class="user" style="display: flex; align-items: center; gap: 8px;">
        <i class="fas fa-user-circle" style="color: #2E80FF; font-size: 20px;"></i>
        <div style="display: flex; flex-direction: column;">
          <span style="font-weight: 500; color: #555;">{{ session('user_name', 'Admin') }}</span>
          <small style="color: #999; font-size: 11px;">{{ ucfirst(session('user_role', 'admin')) }}</small>
        </div>
      </div>
    </div>

    {{-- HALAMAN KONTEN --}}
    <div class="content" style="padding: 30px;">
      @yield('content')
    </div>

    {{-- FOOTER --}}
    <div class="footer">
      <p>&copy; 2025 Canteenly. All rights reserved.</p>
    </div>
  </div>

</body>
</html>
