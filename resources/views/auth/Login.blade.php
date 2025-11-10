@extends('layouts.app')

@section('title', 'Login')

@section('content')
  <div class="logo" style="display: flex; align-items: center; justify-content: center; gap: 12px; padding: 10px 0; margin-bottom: 25px;">
    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Canteenly" style="width: 60px; height: 60px; border: 3px solid #2E80FF; border-radius: 50%; background-color: #fff; padding: 6px;">
    <h2 style="font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 700; color: #2E80FF; margin: 0;">Canteenly</h2>
  </div>

  <h3 class="title">Masuk ke Akun</h3>
  <p class="subtitle">Silakan login untuk melanjutkan</p>
  
  @if($errors->any())
  <div style="background:#f8d7da; color:#721c24; padding:12px; border-radius:8px; margin-bottom:15px; border:1px solid #f5c6cb;">
    <i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}
  </div>
  @endif

  <form action="{{ route('login.post') }}" method="POST" id="loginForm">
    @csrf
    <input type="email" name="email" placeholder="Email" value="{{ Cookie::get('remember_email') }}" required>
    <div style="position:relative;">
      <input type="password" name="password" id="loginPassword" placeholder="Kata Sandi" required style="padding-right:45px;">
      <button type="button" onclick="toggleLoginPassword()" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; color:#666; cursor:pointer; font-size:16px;">
        <i id="loginPasswordIcon" class="fas fa-eye"></i>
      </button>
    </div>
    
    <div style="display: flex; align-items: center; justify-content: space-between; margin: 15px 0;">
      <div style="display: flex; align-items: center; gap: 8px; font-size: 14px;">
        <input type="checkbox" name="remember" id="remember" {{ Cookie::get('remember_email') ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: #2E80FF;">
        <label for="remember" style="color: #666; cursor: pointer; user-select: none;">Ingat saya</label>
      </div>
    </div>
    
    <button type="submit" class="btn-primary" id="loginBtn">Masuk</button>
  </form>

  <script>
  document.getElementById('loginForm').addEventListener('submit', function(e) {
    const btn = document.getElementById('loginBtn');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Masuk...';
    btn.disabled = true;
  });

  function toggleLoginPassword() {
    const passwordInput = document.getElementById('loginPassword');
    const passwordIcon = document.getElementById('loginPasswordIcon');
    
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      passwordIcon.className = 'fas fa-eye-slash';
    } else {
      passwordInput.type = 'password';
      passwordIcon.className = 'fas fa-eye';
    }
  }
  </script>

  <div class="divider">atau</div>

  <a href="{{ route('google.login') }}" class="btn-google">
    <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google Icon">
    Masuk dengan Akun Google
  </a>

  <p class="bottom-text">
    Belum punya akun? <a href="{{ url('/register') }}">Daftar</a>
  </p>
@endsection
