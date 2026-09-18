<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonans';

    protected $fillable = [
        'no_agenda',
        'tanggal_permohonan',
        'id_pelanggan',
        'nama_pelanggan',
        'nama_pemohon',
        'alamat',
        'no_telepon',
        'jenis_permohonan',
        'jenis_tarif',
        'detail_permohonan',
        'status',
        'divisi_tujuan',
    ];

    /**
     * Relasi ke Tabel Master Pelanggan (jika ID Pelanggan merujuk ke tabel lain)
     * Sesuaikan 'id_pelanggan' dengan nama kolom di kedua tabel
     */
    public function dataPelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
}