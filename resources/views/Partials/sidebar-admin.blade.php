<div class="sidebar" style="
    width:250px; background:#D9E8FF; padding:20px; 
    display:flex; flex-direction:column; min-height:100vh;">
    
    {{-- Logo --}}
    <div class="logo" style="display:flex; align-items:center; gap:10px; margin-bottom:30px;">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" 
             style="width:50px; height:50px; border-radius:50%; background:white; padding:5px; border:2px solid #2E80FF;">
        <h2 style="color:#2E80FF; font-weight:700; font-size:20px;">Canteenly</h2>
    </div>

    {{-- Menu --}}
    <ul style="list-style:none; padding:0; margin:0; flex:1;">
        <li style="margin-bottom:10px;">
            <a href="/admin/dashboard" 
               class="{{ request()->is('admin/dashboard') ? 'active' : '' }}" 
               style="display:flex; align-items:center; gap:10px; text-decoration:none; color:#2B6BE4; padding:12px 15px; border-radius:12px; transition:0.3s;
                      {{ request()->is('admin/dashboard') ? 'background:white; border-left:4px solid #2E80FF; color:#2E80FF; font-weight:600;' : '' }}">
                <i class="fa fa-home" style="width:22px; text-align:center; font-size:18px;"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li style="margin-bottom:10px;">
            <a href="/admin/produk" 
               class="{{ request()->is('admin/produk*') ? 'active' : '' }}" 
               style="display:flex; align-items:center; gap:10px; text-decoration:none; color:#2B6BE4; padding:12px 15px; border-radius:12px; transition:0.3s;
                      {{ request()->is('admin/produk*') ? 'background:white; border-left:4px solid #2E80FF; color:#2E80FF; font-weight:600;' : '' }}">
                <i class="fa fa-bag-shopping" style="width:22px; text-align:center; font-size:18px;"></i>
                <span>Kelola Produk</span>
            </a>
        </li>

        <li style="margin-bottom:10px;">
            <a href="/admin/pesanan" 
               class="{{ request()->is('admin/pesanan*') ? 'active' : '' }}" 
               style="display:flex; align-items:center; gap:10px; text-decoration:none; color:#2B6BE4; padding:12px 15px; border-radius:12px; transition:0.3s;
                      {{ request()->is('admin/pesanan*') ? 'background:white; border-left:4px solid #2E80FF; color:#2E80FF; font-weight:600;' : '' }}">
                <i class="fa fa-box" style="width:22px; text-align:center; font-size:18px;"></i>
                <span>Kelola Pesanan</span>
            </a>
        </li>
    </ul>

    {{-- Logout --}}
    <div style="border-top:1px solid #C8D8F8; padding-top:15px; margin-top:auto;">
        <a href="#" style="text-decoration:none; color:#2B6BE4; display:flex; align-items:center; gap:8px; padding:10px 15px; border-radius:10px; font-weight:600; transition:0.3s;">
            <i class="fa fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>
