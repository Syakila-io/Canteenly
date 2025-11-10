@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content')
@if(session('success'))
<div style="background:#d4edda; color:#155724; padding:15px; border-radius:10px; margin-bottom:20px; border:1px solid #c3e6cb;">
  <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="background:#f8d7da; color:#721c24; padding:15px; border-radius:10px; margin-bottom:20px; border:1px solid #f5c6cb;">
  <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
</div>
@endif

<style>
  .header-page {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
  }

  .header-page i {
    font-size: 28px;
    color: #2E80FF;
  }

  .header-text {
    display: flex;
    flex-direction: column;
    line-height: 1.1;
  }

  .header-text span:first-child {
    color: #2E80FF;
    font-size: 20px;
    font-weight: 700;
  }

  .header-text span:last-child {
    color: #2E80FF;
    font-size: 28px;
    font-weight: 800;
  }

  .btn-edit, .btn-hapus, .btn-tambah {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: none;
    padding: 6px 12px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
  }

  .btn-tambah {
    background: #2E80FF;
    color: white;
  }

  .btn-edit {
    background: #2E80FF;
    color: white;
  }

  .btn-hapus {
    background: #FF6B6B;
    color: white;
  }

  .btn-tambah:hover { background: #1c6be0; }
  .btn-edit:hover { background: #1c6be0; }
  .btn-hapus:hover { background: #e53935; }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 16px;
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  }

  thead {
    background: #f5f8fd;
    color: #2E80FF;
  }

  th, td {
    padding: 12px 16px;
    text-align: center;
  }

  tbody tr:hover {
    background: #f9fafb;
  }
</style>

{{-- HEADER --}}
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
  <div style="display:flex; align-items:center; gap:10px;">
    <i class="fa fa-bag-shopping" style="font-size:24px; color:#2E80FF;"></i>
    <h2 style="color:#2E80FF; font-weight:700;">Kelola Produk</h2>
  </div>

</div>

{{-- FORM TAMBAH PRODUK --}}
<div style="background:white; border-radius:15px; padding:20px; margin-bottom:20px; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
  <h3 style="color:#2E80FF; margin-bottom:15px; display:flex; align-items:center; gap:8px;">
    <i class="fa fa-plus-circle"></i> Tambah Produk Cepat
  </h3>
  <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" style="display:grid; grid-template-columns:1fr 1fr 1fr 1fr 1fr auto; gap:15px; align-items:end;">
    @csrf
    <div>
      <label style="display:block; margin-bottom:5px; font-weight:600; color:#333;">Nama Produk</label>
      <input type="text" name="nama_produk" required style="width:100%; padding:8px 12px; border:2px solid #e0e6f5; border-radius:8px; outline:none;">
    </div>
    <div>
      <label style="display:block; margin-bottom:5px; font-weight:600; color:#333;">Kategori</label>
      <select name="kategori" required style="width:100%; padding:8px 12px; border:2px solid #e0e6f5; border-radius:8px; outline:none;">
        <option value="">Pilih Kategori</option>
        <option value="Minuman Kemasan">Minuman Kemasan</option>
        <option value="Makanan Kemasan">Makanan Kemasan</option>
        <option value="ATK">ATK</option>
        <option value="Obat">Obat</option>
      </select>
    </div>
    <div>
      <label style="display:block; margin-bottom:5px; font-weight:600; color:#333;">Harga</label>
      <input type="text" name="harga" id="hargaInput" placeholder="5.000" required style="width:100%; padding:8px 12px; border:2px solid #e0e6f5; border-radius:8px; outline:none;" oninput="formatHarga(this)">
    </div>
    <div>
      <label style="display:block; margin-bottom:5px; font-weight:600; color:#333;">Stok</label>
      <input type="number" name="stok" min="0" required style="width:100%; padding:8px 12px; border:2px solid #e0e6f5; border-radius:8px; outline:none;">
    </div>
    <div>
      <label style="display:block; margin-bottom:5px; font-weight:600; color:#333;">Gambar</label>
      <input type="file" name="gambar" accept="image/*" style="width:100%; padding:8px 12px; border:2px solid #e0e6f5; border-radius:8px; outline:none;">
    </div>
    <button type="submit" class="btn-tambah" style="height:fit-content;">
      <i class="fa fa-save"></i> Simpan
    </button>
  </form>
</div>
{{-- TABEL PRODUK --}}
<div style="overflow-x:auto;">
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if($products && count($products) > 0)
        @foreach($products as $index => $product)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $product->nama_produk }}</td>
          <td>{{ $product->kategori }}</td>
          <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
          <td>{{ $product->stok }}</td>
          <td style="display:flex; justify-content:center; gap:8px;">
            <a href="{{ route('admin.edit-produk', $product->id) }}" class="btn-edit">
              <i class="fa fa-pen"></i> Edit
            </a>
            <form action="{{ route('admin.produk.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus produk ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-hapus">
                <i class="fa fa-trash"></i> Hapus
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      @else
        <tr>
          <td colspan="6" style="text-align:center; color:#666; padding:40px;">
            <i class="fa fa-box" style="font-size:40px; margin-bottom:10px; display:block;"></i>
            Belum ada produk
          </td>
        </tr>
      @endif
    </tbody>
  </table>
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
