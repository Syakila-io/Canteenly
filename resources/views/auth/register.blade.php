@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
  <div class="logo" style="display: flex; align-items: center; justify-content: center; gap: 12px; padding: 10px 0; margin-bottom: 25px;">
    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Canteenly" style="width: 60px; height: 60px; border: 3px solid #2E80FF; border-radius: 50%; background-color: #fff; padding: 6px;">
    <h2 style="font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 700; color: #2E80FF; margin: 0;">Canteenly</h2>
  </div>

  <h3 class="title">Buat Akun Baru</h3>
  <p class="subtitle">Daftar untuk mulai menggunakan layanan kami</p>
  
  @if($errors->any())
  <div style="background:#f8d7da; color:#721c24; padding:12px; border-radius:8px; margin-bottom:15px; border:1px solid #f5c6cb;">
    <i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}
  </div>
  @endif

  <form action="{{ route('register.post') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nama Lengkap" required>
    <input type="email" name="email" placeholder="Email" required>
    
    <select name="gender" required style="width: 100%; padding: 12px 15px; border: 2px solid #e0e6f5; border-radius: 10px; outline: none; font-size: 14px; margin-bottom: 15px;">
      <option value="">Pilih Jenis Kelamin</option>
      <option value="Laki-laki">Laki-laki</option>
      <option value="Perempuan">Perempuan</option>
    </select>
    
    <select name="role" required style="width: 100%; padding: 12px 15px; border: 2px solid #e0e6f5; border-radius: 10px; outline: none; font-size: 14px; margin-bottom: 15px;">
      <option value="">Pilih Role</option>
      <option value="siswa">Siswa</option>
      <option value="guru">Guru</option>
      <option value="staf">Staf</option>
    </select>
    
    <input type="text" name="kelas" placeholder="Kelas (untuk siswa: 12 RPL 1)" id="kelasField">
    <input type="text" name="jabatan" placeholder="Jabatan (untuk guru/staf)" id="jabatanField">
    
    <div style="position:relative;">
      <input type="password" name="password" id="registerPassword" placeholder="Kata Sandi (angka 6 digit)" required style="padding-right:45px;">
      <button type="button" onclick="toggleRegisterPassword()" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; color:#666; cursor:pointer; font-size:16px;">
        <i id="registerPasswordIcon" class="fas fa-eye"></i>
      </button>
    </div>
    <div style="position:relative;">
      <input type="password" name="password_confirmation" id="confirmPassword" placeholder="Konfirmasi Kata Sandi" required style="padding-right:45px;">
      <button type="button" onclick="toggleConfirmPassword()" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; color:#666; cursor:pointer; font-size:16px;">
        <i id="confirmPasswordIcon" class="fas fa-eye"></i>
      </button>
    </div>
    
    <button type="submit" class="btn-primary">Daftar</button>
  </form>
  
  <script>
  document.querySelector('select[name="role"]').addEventListener('change', function() {
    const kelas = document.getElementById('kelasField');
    const jabatan = document.getElementById('jabatanField');
    
    if (this.value === 'siswa') {
      kelas.style.display = 'block';
      kelas.required = true;
      jabatan.style.display = 'none';
      jabatan.required = false;
    } else if (this.value === 'guru' || this.value === 'staf') {
      kelas.style.display = 'none';
      kelas.required = false;
      jabatan.style.display = 'block';
      jabatan.required = true;
    } else {
      kelas.style.display = 'block';
      jabatan.style.display = 'block';
      kelas.required = false;
      jabatan.required = false;
    }
  });

  function toggleRegisterPassword() {
    const passwordInput = document.getElementById('registerPassword');
    const passwordIcon = document.getElementById('registerPasswordIcon');
    
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      passwordIcon.className = 'fas fa-eye-slash';
    } else {
      passwordInput.type = 'password';
      passwordIcon.className = 'fas fa-eye';
    }
  }

  function toggleConfirmPassword() {
    const passwordInput = document.getElementById('confirmPassword');
    const passwordIcon = document.getElementById('confirmPasswordIcon');
    
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

  <a href="{{ route('google.register') }}" class="btn-google">
    <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google Icon">
    Daftar dengan Akun Google
  </a>

  <p class="bottom-text">
    Sudah punya akun? <a href="{{ url('/login') }}">Login</a>
  </p>
@endsection
