<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    // Izinkan semua kolom ini untuk diisi oleh seeder
    protected $fillable = [
        'id_pengaduan',
        'tanggal_masuk',
        'jenis_pengaduan',
        'wilayah',
        'status_penyelesaian'
    ];
}
