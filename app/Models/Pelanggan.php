<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'data_pelanggan'; // Sesuai dengan nama tabel di gambar

    protected $fillable = [
        'id_pelanggan',
        'nama',
        'alamat',
    ];
}
