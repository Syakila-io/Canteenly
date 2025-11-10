@extends('layouts.admin')

@section('title', 'Tambah Produk')

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
  .form-group select,
  .form-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e0e6f5;
    border-radius: 10px;
    outline: none;
    font-size: 14px;
    transition: 0.3s;
  }

  .form-group input:focus,
  .form-group select:focus,
  .form-group textarea:focus {
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
    <i class="fas fa-plus-circle"></i>
    <h2>Tambah Produk Baru</h2>
  </div>

  <form action="{{ route('admin.produk.store') }}" method="POST">
    @csrf
    
    <div class="form-group">
      <label for="nama_produk">Nama Produk</label>
      <input type="text" id="nama_produk" name="nama_produk" required>
    </div>

    <div class="form-group">
      <label for="kategori">Kategori</label>
      <select id="kategori" name="kategori" required>
        <option value="">Pilih Kategori</option>
        <option value="Minuman Kemasan">Minuman Kemasan</option>
        <option value="Makanan Kemasan">Makanan Kemasan</option>
        <option value="ATK">ATK</option>
        <option value="Obat">Obat</option>
      </select>
    </div>

    <div class="form-group">
      <label for="harga">Harga</label>
      <input type="text" id="harga" name="harga" placeholder="Contoh: 5000" required>
    </div>

    <div class="form-group">
      <label for="stok">Stok</label>
      <input type="number" id="stok" name="stok" min="0" required>
    </div>

    <div class="form-group">
      <label for="deskripsi">Deskripsi (Opsional)</label>
      <textarea id="deskripsi" name="deskripsi" rows="3"></textarea>
    </div>

    <div style="display: flex; gap: 10px;">
      <a href="{{ route('admin.produk') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
      <button type="submit" class="btn-submit">
        <i class="fas fa-save"></i> Simpan Produk
      </button>
    </div>
  </form>
</div>
@endsection