<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_pembeli',
        'kelas',
        'ruangan',
        'lokasi_sekolah',
        'product_id',
        'nama_produk',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'status',
        'metode_pembayaran',
        'metode_pengambilan',
        'waktu_pengambilan',
        'batas_waktu_po',
        'catatan',
        'bukti_pembayaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}