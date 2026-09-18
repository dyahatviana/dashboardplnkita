<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permohonan;
use App\Models\Pelanggan;
use Illuminate\Support\Str;

class CSController extends Controller
{
    // Menampilkan halaman dashboard & daftar permohonan
    public function index()
    {
        $permohonans = Permohonan::latest()->get();

        $total = Permohonan::count();
        $menunggu = Permohonan::where('status', 'Menunggu')->count();
        $diproses = Permohonan::where('status', 'Sedang Diproses')->count();
        $selesai = Permohonan::where('status', 'Selesai')->count();

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

    // API AJAX untuk mengambil data pemilik dari database berdasarkan ID Pelanggan
    public function getPelanggan($id)
    {
        $pelanggan = Pelanggan::where('id_pelanggan', $id)->first();

        if ($pelanggan) {
            return response()->json([
                'success' => true,
                'data' => [
                    'nama'   => $pelanggan->nama,
                    'alamat' => $pelanggan->alamat
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data pelanggan tidak ditemukan'
        ], 404);
    }

    // Menyimpan data permohonan ke database
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_permohonan'  => 'required|date',
            'id_pelanggan'        => 'required|string|digits:12',
            'nama_pemohon'        => 'required|string|max:255', // <--- Validasi untuk Nama Pemohon
            'nama_pelanggan'      => 'required|string|max:255', // Nama Pemilik dari DB PLN
            'alamat_pemohon'      => 'required|string',
            'no_telepon'          => ['required', 'string', 'regex:/^[0-9\+\-\s]+$/', 'min:10', 'max:15'],
            'jenis_permohonan'    => 'required|string|max:100',
            'jenis_tarif'         => 'required|string|in:Prabayar,Pascabayar',
            'divisi_tujuan'       => 'required|string|max:100',
            'detail_permohonan'   => 'required|string',
        ], [
            'id_pelanggan.digits' => 'ID Pelanggan harus persis 12 digit angka.',
            'no_telepon.regex'    => 'Format nomor telepon/HP tidak valid.',
            'no_telepon.min'      => 'Nomor telepon minimal terdiri dari 10 karakter.',
            'no_telepon.max'      => 'Nomor telepon maksimal terdiri dari 15 karakter.',
        ]);

        Permohonan::create([
            'no_agenda'           => 'PRM-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
            'tanggal_permohonan'  => $request->tanggal_permohonan,
            'id_pelanggan'        => $request->id_pelanggan,
            'nama_pemohon'        => $request->nama_pemohon,     // <--- Disimpan ke kolom nama_pemohon
            'nama_pelanggan'      => $request->nama_pelanggan,   // Nama Pemilik dari DB PLN
            'alamat'              => $request->alamat_pemohon,   
            'no_telepon'          => $request->no_telepon,
            'jenis_permohonan'    => $request->jenis_permohonan,
            'jenis_tarif'         => $request->jenis_tarif,
            'divisi_tujuan'       => $request->divisi_tujuan,
            'detail_permohonan'   => $request->detail_permohonan,
            'status'              => 'Menunggu',
        ]);

        return redirect()
            ->route('cs.permohonan.index')
            ->with('success', 'Permohonan berhasil disimpan!');
    }
}