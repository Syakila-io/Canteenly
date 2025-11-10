@extends('layouts.admin')

@section('title', 'Kelola User')

@section('content')
  @if(session('success'))
  <div style="background:#d4edda; color:#155724; padding:15px; border-radius:10px; margin-bottom:20px; border:1px solid #c3e6cb;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
  </div>
  @endif

  @if($errors->any())
  <div style="background:#f8d7da; color:#721c24; padding:15px; border-radius:10px; margin-bottom:20px; border:1px solid #f5c6cb;">
    <i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}
  </div>
  @endif

  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px;">
    <h2 style="color:#2E80FF; font-weight:600; margin:0;">👥 Kelola User</h2>
    <a href="{{ route('admin.tambah-user') }}" style="background:#2E80FF; color:white; padding:10px 20px; border-radius:8px; text-decoration:none; font-weight:500;">
      <i class="fas fa-plus"></i> Tambah User
    </a>
  </div>

  <div style="background:white; border-radius:15px; padding:25px; box-shadow:0 4px 10px rgba(0,0,0,0.05);">
    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr style="background:#f8f9fa; border-bottom:2px solid #dee2e6;">
          <th style="padding:15px; text-align:center; color:#495057; font-weight:600; width:50px;">No</th>
          <th style="padding:15px; text-align:left; color:#495057; font-weight:600;">Nama</th>
          <th style="padding:15px; text-align:left; color:#495057; font-weight:600;">Email</th>
          <th style="padding:15px; text-align:left; color:#495057; font-weight:600;">Password</th>
          <th style="padding:15px; text-align:left; color:#495057; font-weight:600;">Role</th>
          <th style="padding:15px; text-align:left; color:#495057; font-weight:600;">Kelas</th>
          <th style="padding:15px; text-align:left; color:#495057; font-weight:600;">Jabatan</th>
          <th style="padding:15px; text-align:center; color:#495057; font-weight:600;">No HP</th>
          <th style="padding:15px; text-align:center; color:#495057; font-weight:600;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $index => $user)
        <tr style="border-bottom:1px solid #dee2e6;">
          <td style="padding:15px; text-align:center; color:#666; font-weight:500;">{{ $index + 1 }}</td>
          <td style="padding:15px; color:#333; white-space:nowrap;">{{ $user->name }}</td>
          <td style="padding:15px; color:#666; white-space:nowrap;">{{ $user->email }}</td>
          <td style="padding:15px; color:#666; white-space:nowrap;">{{ $user->password }}</td>
          <td style="padding:15px;">
            @php
              // Determine background color based on role (parenthesized to avoid nested ternary parse error)
              $bg = ($user->role == 'admin') ? '#2E80FF' : (($user->role == 'siswa') ? '#28a745' : (($user->role == 'guru') ? '#ffc107' : '#6c757d'));
            @endphp
            <span style="background:{{ $bg }}; color:white; padding:4px 8px; border-radius:12px; font-size:12px; font-weight:500;">
              {{ ucfirst($user->role) }}
            </span>
          </td>
          <td style="padding:15px; color:#666; white-space:nowrap;">{{ $user->kelas ?? '-' }}</td>
          <td style="padding:15px; color:#666; white-space:nowrap;">{{ $user->jabatan ?? '-' }}</td>
          <td style="padding:15px; color:#666; white-space:nowrap;">{{ $user->no_hp ?? '-' }}</td>
          <td style="padding:15px; text-align:center;">
            <div style="display:flex; gap:5px; justify-content:center; align-items:center;">
              <a href="{{ route('admin.edit-user', $user->id) }}" style="background:#ffc107; color:white; padding:6px 12px; border-radius:5px; text-decoration:none; font-size:12px;">
                <i class="fas fa-edit"></i> Edit
              </a>
              <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" style="background:#dc3545; color:white; padding:6px 12px; border-radius:5px; border:none; cursor:pointer; font-size:12px;">
                  <i class="fas fa-trash"></i> Hapus
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="9" style="padding:30px; text-align:center; color:#666;">Belum ada user terdaftar</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection