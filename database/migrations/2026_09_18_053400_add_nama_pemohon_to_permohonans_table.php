<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            // Cek dulu apakah kolomnya belum ada, baru ditambahkan
            if (!Schema::hasColumn('permohonans', 'nama_pemohon')) {
                $table->string('nama_pemohon')->after('id_pelanggan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            if (Schema::hasColumn('permohonans', 'nama_pemohon')) {
                $table->dropColumn('nama_pemohon');
            }
        });
    }
};
