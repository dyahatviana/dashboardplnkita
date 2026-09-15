<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;

class PegawaiController extends Controller
{
    /**
     * Menampilkan daftar tugas untuk pegawai
     */
    public function index()
    {
        $permohonans = Permohonan::latest()->get();

        return view('pegawai.index', compact('permohonans'));
    }
}
