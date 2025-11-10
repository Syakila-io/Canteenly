@extends('layouts.admin')

@section('title', 'Edit Pesanan')

@section('content')
<style>
  .form-container {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    max-width: 600px;
  }

  .form-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 30px;
  }

  .form-header i {
    font-size: 24px;
    color: #800000;
  }

  .form-header h2 {
    color: #800000;
    font-weight: 700;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
  }

  .form-group input,
  .form-group select {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e0e6f5;
    border-radius: 10px;
    outline: none;
    font-size: 14px;
    transition: 0.3s;
  }

  .form-group input:focus,
  .form-group select:focus {
    border-color: #800000;
  }

  .btn-submit {
    background: #2E80FF;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .btn-submit:hover {
    background: #1c6be0;
  }

  .btn-back {
    background: #6c757d;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-right: 10px;
  }

  .btn-back:hover {
    background: #5a6268;
  }
</style>

<div class="form-container">
  <div class="form-header">
    <i class="fas fa-edit"></i>
    <h2>Edit Pesanan</h2>
  </div>

  <form action="{{ route('admin.pesanan.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
      <label for="nama_pembeli">Nama Pembeli</label>
      <input type="text" id="nama_pembeli" name="nama_pembeli" value="{{ $order->nama_pembeli }}" required>
    </div>

    <div class="form-group">
      <label for="kelas">Kelas</label>
      <input type="text" id="kelas" name="kelas" value="{{ $order->kelas }}" required>
    </div>

    <div class="form-group">
      <label for="ruangan">Ruangan</label>
      <input type="text" id="ruangan" name="ruangan" value="{{ $order->ruangan }}" required>
    </div>

    <div class="form-group">
      <label for="jumlah">Jumlah</label>
      <input type="number" id="jumlah" name="jumlah" value="{{ $order->jumlah }}" min="1" required>
    </div>

    <div class="form-group">
      <label for="status">Status</label>
      <select id="status" name="status" required>
        <option value="Menunggu" {{ $order->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
        <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        <option value="Dibatalkan" {{ $order->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
      </select>
    </div>

    @if($order->bukti_pembayaran)
    <div class="form-group">
      <label>Bukti Pembayaran</label>
      <div style="margin-top: 10px;">
        <img src="{{ asset('assets/img/' . $order->bukti_pembayaran) }}" alt="Bukti Pembayaran" style="max-width: 300px; max-height: 200px; object-fit: contain; border: 1px solid #ddd; border-radius: 8px;">
        <p style="font-size: 12px; color: #666; margin: 5px 0;">Bukti pembayaran yang diupload user</p>
      </div>
    </div>
    @endif

    <div style="display: flex; gap: 10px;">
      <a href="{{ route('admin.pesanan') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
      <button type="submit" class="btn-submit">
        <i class="fas fa-save"></i> Simpan
      </button>
    </div>
  </form>
</div>
@endsection