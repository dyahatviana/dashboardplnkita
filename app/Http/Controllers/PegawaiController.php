<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Dashboard Pegawai
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Ambil permohonan dari CS dengan dukungan fitur pencarian & pagination
        $permohonans = Permohonan::when($search, function ($query, $search) {
            return $query->where('no_agenda', 'like', '%' . $search . '%')
                         ->orWhere('nama_pelanggan', 'like', '%' . $search . '%')
                         ->orWhere('id_pelanggan', 'like', '%' . $search . '%')
                         ->orWhere('jenis_permohonan', 'like', '%' . $search . '%');
        })->latest()->paginate(10)->withQueryString();

        // Statistik tugas
        $total = Permohonan::count();
        $menunggu = Permohonan::where('status', 'Menunggu')->count();
        $diproses = Permohonan::where('status', 'Sedang Diproses')->count();
        $selesai = Permohonan::where('status', 'Selesai')->count();
        $ditolak = Permohonan::where('status', 'Ditolak')->count();

        return view('pegawai.index', compact(
            'permohonans',
            'total',
            'menunggu',
            'diproses',
            'selesai',
            'ditolak'
        ));
    }

    /**
     * Menampilkan detail tugas
     */
    public function show($id)
    {
        // Cari permohonan berdasarkan ID
        $permohonan = Permohonan::findOrFail($id);

        return view('pegawai.show', compact('permohonan'));
    }

    /**
     * Mengubah status tugas
     */
    public function updateStatus(Request $request, $id)
    {
        // Cari permohonan
        $permohonan = Permohonan::findOrFail($id);

        // Validasi status
        $request->validate([
            'status' => 'required|in:Menunggu,Sedang Diproses,Selesai,Ditolak',
        ]);

        // Update status
        $permohonan->update([
            'status' => $request->status,
        ]);

        // Kembali ke halaman detail
        return redirect()
            ->route('pegawai.show', $permohonan->id)
            ->with('success', 'Status tugas berhasil diperbarui.');
    }
}