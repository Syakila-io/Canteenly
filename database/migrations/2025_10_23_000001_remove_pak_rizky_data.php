<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RemovePakRizkyData extends Migration
{
    public function up()
    {
        // Hapus data Pak Rizky dari tabel users
        DB::table('users')->where('name', 'like', '%Rizky%')->delete();
    }

    public function down()
    {
        // Tidak perlu rollback karena ini menghapus data test
    }
}