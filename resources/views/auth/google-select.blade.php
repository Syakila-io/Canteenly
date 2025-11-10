@extends('layouts.app')

@section('title', 'Pilih Akun Google')

@section('content')
<div class="logo" style="display: flex; align-items: center; justify-content: center; gap: 12px; padding: 10px 0; margin-bottom: 25px;">
  <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Canteenly" style="width: 60px; height: 60px; border: 3px solid #2E80FF; border-radius: 50%; background-color: #fff; padding: 6px;">
  <h2 style="font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 700; color: #2E80FF; margin: 0;">Canteenly</h2>
</div>

<h3 class="title">Pilih Akun Google</h3>
<p class="subtitle">Pilih akun untuk masuk ke Canteenly</p>

<div class="google-accounts">
  @foreach($users as $user)
  <form action="{{ route('google.callback') }}" method="POST" class="google-account-form">
    @csrf
    <input type="hidden" name="email" value="{{ $user->email }}">
    <input type="hidden" name="name" value="{{ $user->name }}">
    
    <button type="submit" class="google-account-btn">
      <div class="account-avatar">
        <i class="fas fa-user-circle"></i>
      </div>
      <div class="account-info">
        <div class="account-name">{{ $user->name }}</div>
        <div class="account-email">{{ $user->email }}</div>
        <div class="account-role">{{ ucfirst($user->role) }}{{ $user->kelas ? ' - ' . $user->kelas : '' }}{{ $user->jabatan ? ' - ' . $user->jabatan : '' }}</div>
      </div>
      <div class="account-arrow">
        <i class="fas fa-chevron-right"></i>
      </div>
    </button>
  </form>
  @endforeach
  
  <form action="{{ route('google.callback') }}" method="POST" class="google-account-form">
    @csrf
    <input type="hidden" name="email" value="[REGISTER_NEW]">
    <input type="hidden" name="name" value="+ Daftar Akun Baru">
    
    <button type="submit" class="google-account-btn register-btn">
      <div class="account-avatar">
        <i class="fas fa-plus-circle" style="color: #28a745;"></i>
      </div>
      <div class="account-info">
        <div class="account-name">+ Daftar Akun Baru</div>
        <div class="account-email">Buat akun baru dengan Google</div>
      </div>
      <div class="account-arrow">
        <i class="fas fa-chevron-right"></i>
      </div>
    </button>
  </form>
</div>

<p class="bottom-text">
  <a href="{{ route('login') }}">← Kembali ke Login</a>
</p>

<style>
.google-accounts {
  margin: 20px 0;
}

.google-account-form {
  margin-bottom: 15px;
}

.google-account-btn {
  width: 100%;
  display: flex;
  align-items: center;
  padding: 15px 20px;
  background: #fff;
  border: 2px solid #e0e6f5;
  border-radius: 12px;
  cursor: pointer;
  transition: 0.3s;
  text-align: left;
}

.google-account-btn:hover {
  border-color: #2E80FF;
  background: #f8faff;
}

.account-avatar {
  margin-right: 15px;
}

.account-avatar i {
  font-size: 40px;
  color: #2E80FF;
}

.account-info {
  flex: 1;
}

.account-name {
  font-weight: 600;
  color: #333;
  font-size: 16px;
  margin-bottom: 3px;
}

.account-email {
  color: #666;
  font-size: 14px;
}

.account-role {
  color: #2E80FF;
  font-size: 12px;
  font-weight: 500;
  margin-top: 2px;
}

.account-arrow {
  color: #999;
}

.register-btn {
  border-color: #28a745 !important;
  background: #f8fff9 !important;
}

.register-btn:hover {
  border-color: #28a745 !important;
  background: #e8f5e8 !important;
}

.register-btn .account-name {
  color: #28a745;
  font-weight: 600;
}
</style>
@endsection