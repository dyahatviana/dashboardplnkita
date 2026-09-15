<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CSController;
use App\Http\Controllers\PegawaiController;

// Route Halaman Utama (http://127.0.0.1:8000)
Route::get('/', function () {

    // Jika belum login, lempar ke halaman login
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    // Jika login sebagai CS
    if (auth()->user()->role === 'cs') {
        return redirect()->route('cs.permohonan.index');
    }

    // Jika login sebagai Pegawai
    if (auth()->user()->role === 'backoffice') {
        return redirect()->route('pegawai.index');
    }

    return redirect()->route('login');
});

// Guest Routes (Hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Routes (Harus login terlebih dahulu)
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Route
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'total' => 120,
            'menunggu' => 15,
            'diproses' => 30,
            'selesai' => 75,
            'jenis_pengaduan' => [
                'Gangguan Jaringan' => 50,
                'KWH Meter Rusak' => 30,
                'PJU Padam' => 25,
                'Tegangan Rendah' => 15
            ],
            'wilayah_terbanyak' => [
                'Wonokromo' => 35,
                'Rungkut' => 28,
                'Gubeng' => 22,
                'Tegalsari' => 20,
                'Mulyorejo' => 15
            ]
        ]);
    })->name('dashboard');

    // Route Khusus CS
    Route::prefix('cs')->name('cs.')->group(function () {
        // Halaman Tabel Daftar Permohonan
        Route::get('/permohonan', [CSController::class, 'index'])->name('permohonan.index');

        // Halaman Form Input Permohonan Baru
        Route::get('/permohonan/create', [CSController::class, 'create'])->name('permohonan.create');
        Route::get('/permohonan/baru', [CSController::class, 'create'])->name('permohonan.baru');

        // Proses Simpan Data Form
        Route::post('/permohonan', [CSController::class, 'store'])->name('permohonan.store');
    });

    // Route Khusus Pegawai
// Route Khusus Pegawai
Route::prefix('pegawai')->name('pegawai.')->group(function () {

    // Halaman daftar tugas dari CS
    Route::get('/', [PegawaiController::class, 'index'])
        ->name('index');

    // Halaman detail tugas
    Route::get('/{id}', [PegawaiController::class, 'show'])
        ->name('show');

    // Proses perubahan status tugas
    Route::post('/{id}/status', [PegawaiController::class, 'updateStatus'])
        ->name('updateStatus');

});

    // Route Rekapitulasi
    Route::get('/rekapitulasi', function () {
        return view('rekapitulasi');
    })->name('rekapitulasi');
});
