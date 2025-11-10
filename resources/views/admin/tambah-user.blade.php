@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')
  @if($errors->any())
  <div style="background:#f8d7da; color:#721c24; padding:15px; border-radius:10px; margin-bottom:20px; border:1px solid #f5c6cb;">
    <i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}
  </div>
  @endif

  <div style="display:flex; align-items:center; gap:10px; margin-bottom:25px;">
    <a href="{{ route('admin.users') }}" style="color:#2E80FF; text-decoration:none; font-size:18px;">
      <i class="fas fa-arrow-left"></i>
    </a>
    <h2 style="color:#2E80FF; font-weight:600; margin:0;">➕ Tambah User Baru</h2>
  </div>

  <div style="background:white; border-radius:15px; padding:30px; box-shadow:0 4px 10px rgba(0,0,0,0.05);">
    <form method="POST" action="{{ route('admin.users.store') }}">
      @csrf
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">Nama Lengkap</label>
          <input type="text" name="name" id="name" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
        </div>
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">Email</label>
          <input type="email" name="email" id="email" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
        </div>
      </div>

      <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">Password</label>
          <div style="position:relative;">
            <input type="password" name="password" id="password" required style="width:100%; padding:12px 45px 12px 12px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
            <button type="button" onclick="togglePassword()" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; color:#666; cursor:pointer; font-size:16px;">
              <i id="passwordIcon" class="fas fa-eye"></i>
            </button>
          </div>
        </div>
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">Jenis Kelamin</label>
          <select name="gender" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
      </div>

      <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">Role</label>
          <select name="role" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
            <option value="">Pilih Role</option>
            <option value="admin">Admin</option>
            <option value="siswa">Siswa</option>
            <option value="guru">Guru</option>
            <option value="staf">Staf</option>
          </select>
        </div>
        <div id="kelasContainer">
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">Kelas</label>
          <input type="text" name="kelas" style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px;" placeholder="Contoh: XII RPL 1">
        </div>
      </div>

      <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:30px;">
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">Jabatan</label>
          <input type="text" name="jabatan" style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px;" placeholder="Contoh: Guru Matematika, Staff TU, dll">
        </div>
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">No HP</label>
          <input type="text" name="no_hp" style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px;" placeholder="08xxxxxxxxxx">
        </div>
      </div>

      <div style="display:flex; gap:10px;">
        <button type="submit" style="background:#2E80FF; color:white; padding:12px 25px; border:none; border-radius:8px; font-weight:500; cursor:pointer;">
          <i class="fas fa-save"></i> Simpan User
        </button>
        <a href="{{ route('admin.users') }}" style="background:#6c757d; color:white; padding:12px 25px; border-radius:8px; text-decoration:none; font-weight:500;">
          <i class="fas fa-times"></i> Batal
        </a>
      </div>
    </form>
  </div>

  <script>
    // Toggle password visibility
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const passwordIcon = document.getElementById('passwordIcon');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.className = 'fas fa-eye-slash';
      } else {
        passwordInput.type = 'password';
        passwordIcon.className = 'fas fa-eye';
      }
    }

    // Handle role change
    document.querySelector('select[name="role"]').addEventListener('change', function() {
      const kelasInput = document.querySelector('input[name="kelas"]');
      const jabatanInput = document.querySelector('input[name="jabatan"]');
      const kelasContainer = document.getElementById('kelasContainer');
      
      if (this.value === 'siswa') {
        kelasContainer.style.display = 'block';
        kelasInput.required = true;
        jabatanInput.value = '';
        jabatanInput.required = false;
      } else if (this.value === 'guru' || this.value === 'staf' || this.value === 'admin') {
        kelasContainer.style.display = 'none';
        kelasInput.value = '';
        kelasInput.required = false;
        jabatanInput.required = true;
      }
    });
  </script>
@endsection