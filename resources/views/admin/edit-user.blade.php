@extends('layouts.admin')

@section('title', 'Edit User')

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
    <h2 style="color:#2E80FF; font-weight:600; margin:0;">✏️ Edit User</h2>
  </div>

  <div style="background:white; border-radius:15px; padding:30px; box-shadow:0 4px 10px rgba(0,0,0,0.05);">
    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" value="{{ $user->id }}">
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">Nama Lengkap</label>
          <input type="text" name="name" value="{{ $user->name }}" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
        </div>
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">Email</label>
          <input type="email" name="email" value="{{ $user->email }}" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
        </div>
      </div>

      <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">Password Baru (kosongkan jika tidak diubah)</label>
          <div style="position:relative;">
            <input type="password" name="password" id="passwordEdit" style="width:100%; padding:12px 45px 12px 12px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
            <button type="button" onclick="togglePasswordEdit()" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; color:#666; cursor:pointer; font-size:16px;">
              <i id="passwordEditIcon" class="fas fa-eye"></i>
            </button>
          </div>
        </div>
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">Kelas</label>
          <input type="text" name="kelas" value="{{ $user->kelas }}" style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px;" placeholder="Contoh: XII IPA 1">
        </div>
      </div>

      <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:30px;">
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">Jenis Kelamin</label>
          <select name="gender" style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
            <option value="">Pilih Gender</option>
            <option value="Laki-laki" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
          </select>
        </div>
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">Role</label>
          <select name="role" style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
            <option value="guru" {{ $user->role == 'guru' ? 'selected' : '' }}>Guru</option>
            <option value="staf" {{ $user->role == 'staf' ? 'selected' : '' }}>Staf</option>
          </select>
        </div>
      </div>

      <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">Jabatan</label>
          <input type="text" name="jabatan" value="{{ $user->jabatan }}" style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px;" placeholder="Contoh: Guru Matematika, Staff TU, dll">
        </div>
        <div>
          <label style="display:block; margin-bottom:8px; color:#333; font-weight:500;">No HP</label>
          <input type="text" name="no_hp" value="{{ $user->no_hp }}" style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; font-size:14px;" placeholder="08xxxxxxxxxx">
        </div>
      </div>

      <div style="display:flex; gap:10px;">
        <button type="submit" style="background:#2E80FF; color:white; padding:12px 25px; border:none; border-radius:8px; font-weight:500; cursor:pointer;">
          <i class="fas fa-save"></i> Update User
        </button>
        <a href="{{ route('admin.users') }}" style="background:#6c757d; color:white; padding:12px 25px; border-radius:8px; text-decoration:none; font-weight:500;">
          <i class="fas fa-times"></i> Batal
        </a>
      </div>
    </form>
  </div>

  <script>
    function togglePasswordEdit() {
      const passwordInput = document.getElementById('passwordEdit');
      const passwordIcon = document.getElementById('passwordEditIcon');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.className = 'fas fa-eye-slash';
      } else {
        passwordInput.type = 'password';
        passwordIcon.className = 'fas fa-eye';
      }
    }
  </script>
@endsection