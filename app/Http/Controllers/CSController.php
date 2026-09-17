<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permohonan;
use Illuminate\Support\Str;

class CSController extends Controller
{
    // Menampilkan halaman dashboard & daftar permohonan
    public function index()
    {
        // Mengambil semua data permohonan terbaru
        $permohonans = Permohonan::latest()->get();

        // Data KPI
        $total = $permohonans->count();

        $menunggu = $permohonans
            ->where('status', 'Menunggu')
            ->count();

        $diproses = $permohonans
            ->where('status', 'Sedang Diproses')
            ->count();

        $selesai = $permohonans
            ->where('status', 'Selesai')
            ->count();

        return view('cs.permohonan.index', compact(
            'permohonans',
            'total',
            'menunggu',
            'diproses',
            'selesai'
        ));
    }

    // Menampilkan form input permohonan baru
    public function create()
    {
        return view('cs.permohonan.input-permohonan');
    }

    // Menyimpan data permohonan ke database
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_permohonan' => 'required|date',
            'id_pelanggan' => 'required|string|digits:12',
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|min:11|max:13',
            'jenis_permohonan' => 'required|string|max:100',
            'jenis_tarif' => 'required|string|in:Prabayar,Pascabayar',
            'divisi_tujuan' => 'required|string|max:100',
            'detail_permohonan' => 'required|string',
        ]);

        Permohonan::create([
            'no_agenda' => 'PRM-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
            'tanggal_permohonan' => $request->tanggal_permohonan,
            'id_pelanggan' => $request->id_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'jenis_permohonan' => $request->jenis_permohonan,
            'jenis_tarif' => $request->jenis_tarif,
            'divisi_tujuan' => $request->divisi_tujuan,
            'detail_permohonan' => $request->detail_permohonan,
            'status' => 'Menunggu',
        ]);

        return redirect()
            ->route('cs.permohonan.index')
            ->with('success', 'Permohonan berhasil disimpan!');
    }
}
