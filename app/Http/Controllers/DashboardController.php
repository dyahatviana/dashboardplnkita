<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan; // Pastikan Model ini di-import!
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    // 1. Data Grafik & Kartu
    $total = Pengaduan::count();
    $menunggu = Pengaduan::where('status_penyelesaian', 'Menunggu')->count();
    $diproses = Pengaduan::where('status_penyelesaian', 'Sedang Diproses')->count();
    $selesai = Pengaduan::where('status_penyelesaian', 'Selesai')->count();

    $jenis_pengaduan = Pengaduan::select('jenis_pengaduan', DB::raw('count(*) as total'))->groupBy('jenis_pengaduan')->pluck('total', 'jenis_pengaduan');
    $wilayah_terbanyak = Pengaduan::select('wilayah', DB::raw('count(*) as total'))->groupBy('wilayah')->orderBy('total', 'desc')->take(5)->pluck('total', 'wilayah');

    // 2. Data Tabel (TAMBAHKAN INI)
    $pengaduans = Pengaduan::orderBy('tanggal_masuk', 'desc')->get();

    // 3. Kirim semua data ke satu view saja
    return view('dashboard', compact('total', 'menunggu', 'diproses', 'selesai', 'jenis_pengaduan', 'wilayah_terbanyak', 'pengaduans'));
}
public function data()
{
    $pengaduans = \App\Models\Pengaduan::orderBy('tanggal_masuk', 'desc')->get();
    return view('data-pengaduan', compact('pengaduans'));
}
public function rekapitulasi()
    {
        // Menghitung agregat data berdasarkan wilayah
        $rekapWilayah = \App\Models\Pengaduan::select(
            'wilayah',
            DB::raw('count(*) as total'),
            DB::raw('SUM(CASE WHEN status_penyelesaian = "Menunggu" THEN 1 ELSE 0 END) as menunggu'),
            DB::raw('SUM(CASE WHEN status_penyelesaian = "Sedang Diproses" THEN 1 ELSE 0 END) as diproses'),
            DB::raw('SUM(CASE WHEN status_penyelesaian = "Selesai" THEN 1 ELSE 0 END) as selesai')
        )
        ->groupBy('wilayah')
        ->orderBy('total', 'desc')
        ->get();

        return view('rekapitulasi', compact('rekapWilayah'));
    }

}
