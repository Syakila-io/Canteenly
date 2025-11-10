<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'aktif')
                          ->orderBy('kategori_id')
                          ->orderBy('nama_produk')
                          ->get();
        
        return view('user.produk', compact('products'));
    }

    public function adminIndex()
    {
        $products = Product::orderBy('kategori_id')
                          ->orderBy('nama_produk')
                          ->get();
        
        return view('admin.produk', compact('products'));
    }

    public function create()
    {
        return view('admin.tambah-produk');
    }

    public function store(Request $request)
    {
        try {
            $kategoriMap = [
                'Minuman Kemasan' => 1,
                'Makanan Kemasan' => 2,
                'ATK' => 3,
                'Obat' => 4
            ];
            
            // Handle file upload
            $gambarPath = null;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/img'), $fileName);
                $gambarPath = $fileName;
            }
            
            // Clean harga (remove dots)
            $harga = str_replace('.', '', $request->harga);
            
            Product::create([
                'nama_produk' => $request->nama_produk,
                'kategori_id' => $kategoriMap[$request->kategori] ?? 1,
                'kategori' => $request->kategori,
                'harga' => $harga,
                'stok' => $request->stok,
                'deskripsi' => $request->deskripsi ?? '',
                'gambar' => $gambarPath,
                'status' => 'aktif',
            ]);

            return redirect()->route('admin.produk')->with('success', 'Produk berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('admin.produk')->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit-produk', compact('product'));
    }

    public function update(Request $request, $id)
    {
        try {
            $kategoriMap = [
                'Minuman Kemasan' => 1,
                'Makanan Kemasan' => 2,
                'ATK' => 3,
                'Obat' => 4
            ];
            
            $product = Product::findOrFail($id);
            
            // Handle file upload
            $gambarPath = $product->gambar;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/img'), $fileName);
                $gambarPath = $fileName;
            }
            
            // Clean harga (remove dots)
            $harga = str_replace('.', '', $request->harga);
            
            $product->update([
                'nama_produk' => $request->nama_produk,
                'kategori_id' => $kategoriMap[$request->kategori] ?? 1,
                'kategori' => $request->kategori,
                'harga' => $harga,
                'stok' => $request->stok,
                'deskripsi' => $request->deskripsi ?? '',
                'gambar' => $gambarPath,
            ]);

            return redirect()->route('admin.produk')->with('success', 'Produk berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->route('admin.produk')->with('error', 'Gagal mengupdate produk: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Product::findOrFail($id)->delete();
            return redirect()->route('admin.produk')->with('success', 'Produk berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.produk')->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}