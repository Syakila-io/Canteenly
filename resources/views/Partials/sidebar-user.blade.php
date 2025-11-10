<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Canteenly Logo">
        <h2>Canteenly</h2>
    </div>
    
    <ul>
        <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="{{ route('produk') }}" class="{{ request()->routeIs('produk') ? 'active' : '' }}"><i class="fa fa-shopping-bag"></i> Produk</a></li>
        <li><a href="{{ route('pesanan') }}" class="{{ request()->routeIs('pesanan') ? 'active' : '' }}"><i class="fa fa-shopping-cart"></i> Pesanan</a></li>
    </ul>
    
    <div class="logout">
        <a href="{{ route('login') }}"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>
</div>
