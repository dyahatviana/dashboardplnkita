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
        'alamat',
        'no_telepon',
        'jenis_permohonan',
        'jenis_tarif',
        'detail_permohonan',
        'status',
        'divisi_tujuan',
    ];
}
