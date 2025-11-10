<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('nama_pembeli');
            $table->string('kelas');
            $table->string('ruangan');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('nama_produk');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('total_harga', 10, 2);
            $table->enum('status', ['Menunggu', 'Selesai', 'Dibatalkan'])->default('Menunggu');
            $table->string('metode_pembayaran')->default('DANA');
            $table->string('metode_pengambilan')->default('Antar ke kelas (PO)');
            $table->time('batas_waktu_po')->default('10:00:00');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};