@extends('layouts.admin')

@section('title', 'Edit Produk')

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
    <i class="fas fa-edit"></i>
    <h2>Edit Produk</h2>
  </div>

  <form action="{{ route('admin.produk.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="form-group">
      <label for="nama_produk">Nama Produk</label>
      <input type="text" id="nama_produk" name="nama_produk" value="{{ $product->nama_produk }}" required>
    </div>

    <div class="form-group">
      <label for="kategori">Kategori</label>
      <select id="kategori" name="kategori" required>
        <option value="">Pilih Kategori</option>
        <option value="Minuman Kemasan" {{ $product->kategori == 'Minuman Kemasan' ? 'selected' : '' }}>Minuman Kemasan</option>
        <option value="Makanan Kemasan" {{ $product->kategori == 'Makanan Kemasan' ? 'selected' : '' }}>Makanan Kemasan</option>
        <option value="ATK" {{ $product->kategori == 'ATK' ? 'selected' : '' }}>ATK</option>
        <option value="Obat" {{ $product->kategori == 'Obat' ? 'selected' : '' }}>Obat</option>
      </select>
    </div>

    <div class="form-group">
      <label for="harga">Harga</label>
      <input type="text" id="harga" name="harga" value="{{ number_format($product->harga, 0, ',', '.') }}" placeholder="5.000" required oninput="formatHarga(this)">
    </div>

    <div class="form-group">
      <label for="stok">Stok</label>
      <input type="number" id="stok" name="stok" value="{{ $product->stok }}" min="0" required>
    </div>

    <div class="form-group">
      <label for="gambar">Gambar Produk</label>
      @if($product->gambar)
        <div style="margin-bottom: 10px;">
          <img src="{{ asset('assets/img/' . $product->gambar) }}" alt="Current Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
          <p style="font-size: 12px; color: #666; margin: 5px 0;">Gambar upload saat ini</p>
        </div>
      @endif
      <input type="file" id="gambar" name="gambar" accept="image/*">
      <small style="color: #666;">Kosongkan jika tidak ingin mengubah gambar</small>
    </div>

    <div class="form-group">
      <label for="deskripsi">Deskripsi (Opsional)</label>
      <textarea id="deskripsi" name="deskripsi" rows="3">{{ $product->deskripsi ?? '' }}</textarea>
    </div>

    <div style="display: flex; gap: 10px;">
      <a href="{{ route('admin.produk') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
      <button type="submit" class="btn-submit">
        <i class="fas fa-save"></i> Update Produk
      </button>
    </div>
  </form>
</div>

<script>
function formatHarga(input) {
  let value = input.value.replace(/\D/g, '');
  if (value) {
    value = parseInt(value).toLocaleString('id-ID');
    input.value = value;
  }
}
</script>
@endsection