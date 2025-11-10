@extends('layouts.app')

@section('title', 'Login Berhasil')

@section('content')
<div class="success-container">
  <div class="success-icon">
    <i class="fas fa-check-circle"></i>
  </div>
  
  <h3 class="title">Login Berhasil!</h3>
  <p class="subtitle">Selamat datang di Canteenly</p>
  
  <div class="user-info">
    <div class="user-avatar">
      <i class="fas fa-user-circle"></i>
    </div>
    <div class="user-details">
      <div class="user-name">{{ session('user_name') }}</div>
      <div class="user-email">{{ session('user_email') }}</div>
      <div class="user-role">{{ session('user_role') === 'admin' ? 'Administrator' : 'Siswa' }}</div>
    </div>
  </div>
  
  <div class="redirect-info">
    <p>Anda akan diarahkan ke dashboard dalam <span id="countdown">3</span> detik...</p>
  </div>
  
  <a href="{{ session('user_role') === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="btn-primary">
    Lanjut ke Dashboard
  </a>
</div>

<style>
.success-container {
  text-align: center;
  max-width: 400px;
  margin: 0 auto;
}

.success-icon {
  margin-bottom: 20px;
}

.success-icon i {
  font-size: 60px;
  color: #27ae60;
}

.user-info {
  background: #f8faff;
  border: 2px solid #e0e6f5;
  border-radius: 12px;
  padding: 20px;
  margin: 20px 0;
  display: flex;
  align-items: center;
  text-align: left;
}

.user-avatar {
  margin-right: 15px;
}

.user-avatar i {
  font-size: 40px;
  color: #2E80FF;
}

.user-name {
  font-weight: 600;
  color: #333;
  font-size: 16px;
  margin-bottom: 3px;
}

.user-email {
  color: #666;
  font-size: 14px;
  margin-bottom: 3px;
}

.user-role {
  color: #2E80FF;
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
}

.redirect-info {
  margin: 20px 0;
  color: #666;
  font-size: 14px;
}

#countdown {
  font-weight: 600;
  color: #2E80FF;
}
</style>

<script>
let countdown = 3;
const countdownElement = document.getElementById('countdown');

const timer = setInterval(() => {
  countdown--;
  countdownElement.textContent = countdown;
  
  if (countdown <= 0) {
    clearInterval(timer);
    window.location.href = '{{ session("user_role") === "admin" ? route("admin.dashboard") : route("dashboard") }}';
  }
}, 1000);
</script>
@endsection