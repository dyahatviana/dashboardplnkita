<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permohonans', function (Blueprint $table) {
            $table->id();
            $table->string('no_agenda')->unique();
            $table->date('tanggal_permohonan');
            $table->string('id_pelanggan');
            $table->string('nama_pelanggan');
            $table->text('alamat');
            $table->string('no_telepon');
            $table->string('jenis_permohonan');
            $table->text('detail_permohonan');
            $table->enum('status', ['Menunggu', 'Sedang Diproses', 'Selesai', 'Ditolak'])->default('Menunggu');
            $table->string('divisi_tujuan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};
