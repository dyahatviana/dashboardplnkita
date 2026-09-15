@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <!-- HEADER HALAMAN & TOMBOL INPUT BARU -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px; font-size: 1.6rem;">PLN UP3 Surabaya Selatan - Loket CS</h2>
            <p class="text-muted mb-0" style="font-size: 1rem;">Kelola dan pantau status permohonan masuk.</p>
        </div>
        <div>
            <!-- TOMBOL INPUT BARU DENGAN EFEK WARNA BERBEDA SAAT DIKLIK/HOVER -->
            <a href="{{ route('cs.permohonan.create') }}" class="btn btn-custom-input d-inline-flex align-items-center gap-2 text-decoration-none shadow-sm rounded-3 px-4 py-2.5 fw-semibold text-white">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Input Baru</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-4 mb-4 border-0 fs-6" role="alert" style="background-color: #ecfdf5; border-left: 4px solid #10b981 !important; color: #065f46;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- TABEL STATUS PERMOHONAN -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <h4 class="fw-bold text-dark mb-0 fs-5">Status Permohonan Pelanggan</h4>
            <form action="{{ route('cs.permohonan.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control rounded-3 bg-light border-0 px-3 py-2 fs-6" placeholder="Cari No Agenda / ID Pel / Nama..." style="width: 280px;">
                <button type="submit" class="btn btn-primary px-4 rounded-3 fw-semibold fs-6" style="background-color: #0066cc; border: none;">Cari</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 custom-table">
                <thead class="table-light text-secondary">
                    <tr>
                        <th class="py-3.5 rounded-start">No. Agenda</th>
                        <th class="py-3.5">Tanggal</th>
                        <th class="py-3.5">ID Pel / Nama</th>
                        <th class="py-3.5">Jenis Permohonan</th>
                        <th class="py-3.5">Status</th>
                        <th class="py-3.5 rounded-end">Divisi Tujuan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permohonans ?? [] as $item)
                        <tr>
                            <td class="fw-bold text-primary">{{ $item->no_agenda ?? '-' }}</td>
                            <td>{{ $item->tanggal_permohonan ?? '-' }}</td>
                            <td>
                                <div class="fw-bold text-dark fs-6">{{ $item->nama_pelanggan ?? '-' }}</td>
                                <small class="text-muted font-monospace" style="font-size: 0.85rem;">ID: {{ $item->id_pelanggan ?? '-' }}</small>
                            </td>
                            <td>{{ $item->jenis_permohonan ?? '-' }}</td>
                            <td>
                                @if($item->status == 'Menunggu')
                                    <span class="badge bg-warning text-dark px-3 py-2 fw-semibold rounded-pill fs-6">Menunggu</span>
                                @elseif($item->status == 'Progress')
                                    <span class="badge bg-info text-dark px-3 py-2 fw-semibold rounded-pill fs-6">Progress</span>
                                @elseif($item->status == 'Selesai')
                                    <span class="badge bg-success px-3 py-2 fw-semibold rounded-pill fs-6">Selesai</span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2 fw-semibold rounded-pill fs-6">{{ $item->status ?? 'Menunggu' }}</span>
                                @endif
                            </td>
                            <td class="text-secondary fw-medium">{{ $item->divisi_tujuan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted fs-6">
                                <i class="bi bi-folder2-open fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                Belum ada data permohonan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Styling Tombol Input Baru dengan Perubahan Warna saat Hover/Klik */
    .btn-custom-input {
        background: #0055b3; /* Warna biru standar awal */
        border: none;
        font-size: 1rem;
        transition: all 0.2s ease-in-out;
    }
    .btn-custom-input:hover {
        background: #003d82; /* Biru lebih gelap saat kursor mendekat (hover) */
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 85, 179, 0.25) !important;
    }
    .btn-custom-input:active, .btn-custom-input:focus {
        background: #002244 !important; /* Biru dongker / navy yang berbeda saat diklik (dipetik) */
        box-shadow: inset 0 3px 5px rgba(0,0,0,0.2) !important;
    }

    .custom-table th {
        font-size: 0.85rem !important;
        letter-spacing: 0.5px;
        font-weight: 700;
        text-transform: uppercase;
    }
    .custom-table td {
        font-size: 0.95rem !important;
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
    .form-control:focus {
        background-color: #ffffff !important;
        border-color: #0066cc !important;
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.12) !important;
    }
</style>
@endsection
