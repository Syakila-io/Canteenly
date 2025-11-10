@extends('layouts.admin')

@section('title', 'Tambah Pesanan')

@section('content')
  <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
    <i class="fa fa-plus-square" style="font-size:24px; color:#2E80FF;"></i>
    <h2 style="color:#2E80FF; font-weight:700;">Tambah Pesanan</h2>
  </div>

  <div style="background:white; border:1px solid #E2EDFF; border-radius:20px; padding:40px; max-width:800px; box-shadow:0 4px 15px rgba(46,128,255,0.05);">
    <form action="#" method="POST" style="display:flex; flex-direction:column; gap:25px;">
      @csrf
      <div>
        <label style="display:block; font-weight:700; color:#333; margin-bottom:6px;">Nama Pembeli</label>
        <input type="text" placeholder="Masukkan nama pembeli"
          style="width:100%; border:1px solid #E2EDFF; border-radius:12px; padding:12px 16px;">
      </div>

      <div>
        <label style="display:block; font-weight:700; color:#333; margin-bottom:6px;">Kelas</label>
        <input type="text" placeholder="Masukkan kelas (contoh: 12 RPL 1)"
          style="width:100%; border:1px solid #E2EDFF; border-radius:12px; padding:12px 16px;">
      </div>

      <div>
        <label style="display:block; font-weight:700; color:#333; margin-bottom:6px;">Ruangan</label>
        <input type="text" placeholder="Masukkan ruangan"
          style="width:100%; border:1px solid #E2EDFF; border-radius:12px; padding:12px 16px;">
      </div>

      <div>
        <label style="display:block; font-weight:700; color:#333; margin-bottom:6px;">Produk</label>
        <select style="width:100%; border:1px solid #E2EDFF; border-radius:12px; padding:12px 16px;">
          <option>Roti Sari Gandum</option>
          <option>Qtela Balado</option>
          <option>Teh Botol Sosro</option>
        </select>
      </div>

      <div>
        <label style="display:block; font-weight:700; color:#333; margin-bottom:6px;">Jumlah</label>
        <input type="number" placeholder="Masukkan jumlah"
          style="width:100%; border:1px solid #E2EDFF; border-radius:12px; padding:12px 16px;">
      </div>

      <div>
        <label style="display:block; font-weight:700; color:#333; margin-bottom:6px;">Status</label>
        <select style="width:100%; border:1px solid #E2EDFF; border-radius:12px; padding:12px 16px;">
          <option>Menunggu</option>
          <option>Selesai</option>
          <option>Dibatalkan</option>
        </select>
      </div>

      <div style="display:flex; gap:15px; margin-top:10px;">
        <button type="submit" style="background:#2E80FF; color:white; border:none; padding:12px 24px; border-radius:10px; font-weight:600; display:flex; align-items:center; gap:8px;">
          <i class="fa fa-floppy-disk"></i> Simpan
        </button>
        <a href="{{ route('admin.pesanan') }}" style="background:#B0B0B0; color:white; text-decoration:none; padding:12px 24px; border-radius:10px; font-weight:600; display:flex; align-items:center; gap:8px;">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
      </div>
    </form>
  </div>
@endsection