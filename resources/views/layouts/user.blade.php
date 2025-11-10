<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') | Canteenly</title>

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
      background: #fff;
      border-right: 1px solid #e4e8f0;
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
    }

    .sidebar ul li a.active {
      background: #2E80FF;
      color: #fff;
    }

    .sidebar ul li a:hover:not(.active) {
      background: #f5f8fd;
    }

    .logout {
      margin-top: auto;
      border-top: 1px solid #e4e8f0;
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
  
  @yield('styles')
</head>

<body>
  {{-- SIDEBAR --}}
  <div class="sidebar">
    <div class="logo">
      <img src="{{ asset('assets/img/logo.png') }}" alt="Canteenly Logo">
      <h2>Canteenly</h2>
    </div>
    <ul>
      <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
      <li><a href="{{ route('produk') }}" class="{{ request()->routeIs('produk') || request()->routeIs('checkout') ? 'active' : '' }}"><i class="fas fa-box"></i> Produk</a></li>
      <li><a href="{{ route('wishlist') }}" class="{{ request()->routeIs('wishlist') ? 'active' : '' }}"><i class="fas fa-heart"></i> Wishlist</a></li>
      <li><a href="{{ route('pesanan') }}" class="{{ request()->routeIs('pesanan') ? 'active' : '' }}"><i class="fas fa-shopping-cart"></i> Pesanan</a></li>
      <li><a href="{{ route('riwayat') }}" class="{{ request()->routeIs('riwayat') ? 'active' : '' }}"><i class="fas fa-history"></i> Riwayat</a></li>
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
          <span style="font-weight: 500; color: #555;">{{ session('user_name', 'User') }}</span>
          <small style="color: #999; font-size: 11px;">{{ ucfirst(session('user_role', 'user')) }}{{ session('user_kelas') ? ' - ' . session('user_kelas') : '' }}</small>
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
