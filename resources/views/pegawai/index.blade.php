@extends('layouts.app')

@section('title', 'Dashboard Pegawai')

@section('header_title', 'Dashboard Pegawai')

@section('header_desc', 'Kelola dan proses tugas permohonan dari Customer Service.')

@section('content')

<div class="container-fluid px-0">

    {{-- =========================
        HEADER BANNER / WELCOME CARD
    ========================== --}}
    @php
        $totalCount = $total ?? (method_exists($permohonans, 'total') ? $permohonans->total() : $permohonans->count());
        $menungguCount = $menunggu ?? $permohonans->where('status', 'Menunggu')->count();
        $diprosesCount = $diproses ?? $permohonans->where('status', 'Sedang Diproses')->count();
        $selesaiCount = $selesai ?? $permohonans->where('status', 'Selesai')->count();
        $ditolakCount = $ditolak ?? $permohonans->where('status', 'Ditolak')->count();
        $persenSelesai = $totalCount > 0 ? round(($selesaiCount / $totalCount) * 100) : 0;
    @endphp

    {{-- =========================
        HEADER BANNER / ROYAL BLUE PLN
    ========================== --}}
    <div class="welcome-banner p-4 p-md-5 rounded-4 mb-4 text-white position-relative overflow-hidden shadow-sm">
        <div class="position-relative z-1">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill mb-3 banner-badge">
                <span class="pulse-dot-white"></span>
                <span class="small fw-bold tracking-wider text-uppercase text-white" style="font-size: 0.75rem;">Sistem Monitoring Pelayanan & Penugasan</span>
            </div>
            <h1 class="fw-bold mb-2 text-white display-6 tracking-tight">
                Dashboard Pegawai
            </h1>
            <p class="mb-0 fs-6 max-w-2xl fw-normal lh-base" style="color: rgba(255, 255, 255, 0.9) !important;">
                Kelola, tinjau, dan proses seluruh permohonan pelanggan dari Customer Service dengan cepat dan terstruktur.
            </p>
        </div>
        <!-- Decorative subtle glowing lights -->
        <div class="position-absolute top-0 end-0 translate-middle-y glow-orb glow-white pointer-events-none"></div>
        <div class="position-absolute bottom-0 start-50 translate-middle-x glow-orb glow-sky pointer-events-none"></div>
    </div>


    {{-- =========================
        KPI CARDS (FRESH BLUE & VIBRANT ACCENTS)
    ========================== --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-3 mb-4">

        {{-- 1. TOTAL PENUGASAN (Hero Royal Blue) --}}
        <div class="col">
            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-blue-hero text-white position-relative overflow-hidden">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-uppercase fw-bold text-white text-opacity-75 fs-xs tracking-wider">Total Tugas</span>
                        <div class="kpi-icon-glass text-white">
                            <i class="bi bi-clipboard-data-fill"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="display-5 fw-bold text-white mb-1">{{ $totalCount }}</h2>
                        <div class="d-flex align-items-center gap-1.5 text-white text-opacity-75 fs-xs">
                            <i class="bi bi-shield-check text-info"></i>
                            <span>Semua permohonan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. MENUNGGU (Fresh White + Amber Accent) --}}
        <div class="col">
            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-white-card kpi-border-amber position-relative overflow-hidden">
                <div class="kpi-stripe stripe-amber"></div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-uppercase fw-bold text-muted fs-xs tracking-wider">Menunggu</span>
                        <div class="kpi-icon-badge badge-amber">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="display-5 fw-bold text-dark mb-1">{{ $menungguCount }}</h2>
                        <div class="d-flex align-items-center gap-1.5 text-warning-emphasis fs-xs fw-semibold">
                            <span class="pulse-dot-amber"></span>
                            <span>Perlu tindakan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. SEDANG DIPROSES (Fresh White + Electric Blue Accent) --}}
        <div class="col">
            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-white-card kpi-border-blue position-relative overflow-hidden">
                <div class="kpi-stripe stripe-blue"></div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-uppercase fw-bold text-muted fs-xs tracking-wider">Sedang Diproses</span>
                        <div class="kpi-icon-badge badge-blue">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="display-5 fw-bold text-dark mb-1">{{ $diprosesCount }}</h2>
                        <div class="d-flex align-items-center gap-1.5 text-primary fs-xs fw-semibold">
                            <i class="bi bi-tools"></i>
                            <span>Pengerjaan teknis</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. SELESAI (Fresh White + Emerald Accent) --}}
        <div class="col">
            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-white-card kpi-border-emerald position-relative overflow-hidden">
                <div class="kpi-stripe stripe-emerald"></div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-uppercase fw-bold text-muted fs-xs tracking-wider">Selesai</span>
                        <div class="kpi-icon-badge badge-emerald">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="display-5 fw-bold text-dark mb-1">{{ $selesaiCount }}</h2>
                        <div class="d-flex align-items-center gap-1.5 text-success fs-xs fw-semibold">
                            <i class="bi bi-check-all"></i>
                            <span>Layanan tuntas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 5. DITOLAK (Fresh White + Rose Accent) --}}
        <div class="col">
            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-white-card kpi-border-rose position-relative overflow-hidden">
                <div class="kpi-stripe stripe-rose"></div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-uppercase fw-bold text-muted fs-xs tracking-wider">Ditolak</span>
                        <div class="kpi-icon-badge badge-rose">
                            <i class="bi bi-x-circle"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="display-5 fw-bold text-dark mb-1">{{ $ditolakCount }}</h2>
                        <div class="d-flex align-items-center gap-1.5 text-danger fs-xs fw-semibold">
                            <i class="bi bi-slash-circle"></i>
                            <span>Berkas ditolak</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- =========================
        DAFTAR TUGAS
    ========================== --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5 bg-white position-relative">
        <!-- Aksen Garis Biru PLN di atas tabel -->
        <div class="position-absolute top-0 start-0 w-100" style="height: 4px; background: linear-gradient(90deg, #004b87, #0066cc, #0099ff);"></div>

        {{-- HEADER & SEARCH BAR --}}
        <div class="card-header bg-white border-0 p-4 pt-4 pb-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                <div>
                    <h4 class="fw-bold text-dark mb-1">
                        Daftar Tugas Masuk
                    </h4>
                    <p class="text-muted small mb-0">
                        Tugas yang dikirim oleh Customer Service untuk segera ditindaklanjuti
                    </p>
                </div>

                {{-- FORM SEARCH DAN NOTIFIKASI --}}
                <div class="d-flex align-items-center flex-wrap gap-3">
                    
                    @if(($menunggu ?? $permohonans->where('status', 'Menunggu')->count()) > 0)
                        <div class="new-task-info m-0 shadow-sm-soft">
                            <i class="bi bi-bell-fill me-2 text-warning"></i>
                            Ada <strong>{{ $menunggu ?? $permohonans->where('status', 'Menunggu')->count() }}</strong> tugas baru
                        </div>
                    @endif

                    <form action="{{ route('pegawai.index') }}" method="GET" class="d-flex gap-2 m-0">
                        <div class="input-group input-group-sm search-box-group shadow-sm rounded-3 overflow-hidden border">
                            <span class="input-group-text bg-white border-0 ps-3 text-muted">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control bg-white border-0 px-2 shadow-none" placeholder="Cari No. Agenda / Pelanggan..." value="{{ request('search') }}">
                            @if(request('search'))
                                <a href="{{ route('pegawai.index') }}" class="btn btn-white border-0 text-secondary d-flex align-items-center px-2" title="Reset">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                            <button class="btn btn-primary px-3 rounded-0 fw-semibold" type="submit">
                                Cari
                            </button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

        <hr class="m-0 text-muted opacity-10">

        {{-- BODY --}}
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 custom-table">
                    <thead>
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="py-3">No. Agenda</th>
                            <th class="py-3">Tanggal</th>
                            <th class="py-3">Pelanggan</th>
                            <th class="py-3">Jenis Permohonan</th>
                            <th class="py-3">Divisi Tujuan</th>
                            <th class="py-3">Status</th>
                            <th class="text-center py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permohonans as $index => $permohonan)
                            <tr>
                                {{-- NO (Mendukung Pagination) --}}
                                <td class="px-4 text-muted fw-medium">
                                    {{ method_exists($permohonans, 'firstItem') ? $permohonans->firstItem() + $index : $index + 1 }}
                                </td>

                                {{-- NO AGENDA --}}
                                <td>
                                    <span class="fw-bold text-primary">
                                        {{ $permohonan->no_agenda ?? '-' }}
                                    </span>
                                </td>

                                {{-- TANGGAL --}}
                                <td class="text-muted small">
                                    <i class="bi bi-calendar3 me-1"></i> {{ $permohonan->tanggal_permohonan ?? '-' }}
                                </td>

                                {{-- PELANGGAN --}}
                                <td>
                                    <div class="fw-semibold text-dark">
                                        {{ $permohonan->nama_pelanggan ?? '-' }}
                                    </div>
                                    <small class="text-muted font-monospace">
                                        ID: {{ $permohonan->id_pelanggan ?? '-' }}
                                    </small>
                                </td>

                                {{-- JENIS --}}
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 fw-normal">
                                        {{ $permohonan->jenis_permohonan ?? '-' }}
                                    </span>
                                </td>

                                {{-- DIVISI --}}
                                <td>
                                    <span class="text-secondary fw-medium small">
                                        <i class="bi bi-building me-1"></i> {{ $permohonan->divisi_tujuan ?? '-' }}
                                    </span>
                                </td>

                                {{-- STATUS --}}
                                <td>
                                    @if ($permohonan->status === 'Menunggu')
                                        <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3 py-2 fw-semibold shadow-2xs">
                                            <i class="bi bi-hourglass-split me-1"></i> Menunggu
                                        </span>
                                    @elseif ($permohonan->status === 'Sedang Diproses')
                                        <span class="badge bg-info-subtle text-info-emphasis rounded-pill px-3 py-2 fw-semibold shadow-2xs">
                                            <i class="bi bi-arrow-repeat me-1"></i> Sedang Diproses
                                        </span>
                                    @elseif ($permohonan->status === 'Selesai')
                                        <span class="badge bg-success-subtle text-success-emphasis rounded-pill px-3 py-2 fw-semibold shadow-2xs">
                                            <i class="bi bi-check-circle-fill me-1"></i> Selesai
                                        </span>
                                    @elseif ($permohonan->status === 'Ditolak')
                                        <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill px-3 py-2 fw-semibold shadow-2xs">
                                            <i class="bi bi-x-circle-fill me-1"></i> Ditolak
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill px-3 py-2 fw-semibold shadow-2xs">
                                            {{ $permohonan->status ?? 'Menunggu' }}
                                        </span>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('pegawai.show', $permohonan->id) }}"
                                           class="btn btn-sm btn-light border text-secondary rounded-3 shadow-2xs px-2.5 py-1.5 transition-all"
                                           title="Lihat detail">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        @if ($permohonan->status === 'Menunggu')
                                            <a href="{{ route('pegawai.show', $permohonan->id) }}"
                                               class="btn btn-sm btn-primary rounded-3 shadow-2xs px-2.5 py-1.5 transition-all"
                                               title="Proses tugas">
                                                <i class="bi bi-play-fill"></i>
                                            </a>
                                        @elseif ($permohonan->status === 'Sedang Diproses')
                                            <a href="{{ route('pegawai.show', $permohonan->id) }}"
                                               class="btn btn-sm btn-success rounded-3 shadow-2xs px-2.5 py-1.5 transition-all"
                                               title="Lanjutkan tugas">
                                                <i class="bi bi-arrow-right"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="empty-task py-4">
                                        <div class="mb-3 text-primary opacity-50">
                                            <i class="bi bi-inbox fs-1"></i>
                                        </div>
                                        <h5 class="fw-bold text-dark mb-1">
                                            Tidak ada tugas ditemukan
                                        </h5>
                                        <p class="text-muted small mb-0">
                                            Coba gunakan kata kunci pencarian yang lain atau belum ada data tugas masuk.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        @if (method_exists($permohonans, 'hasPages') && $permohonans->hasPages())
            <div class="card-footer bg-white border-0 py-4 px-4 d-flex justify-content-center">
                {{ $permohonans->links() }}
            </div>
        @endif


    </div>

</div>


{{-- =========================
    STYLE TAMBAHAN (PROFESSIONAL SHADOW & DEEP BLUE THEME)
========================== --}}
<style>
    /* Royal Blue PLN Corporate Banner (Segar, Cerah & Berwibawa) */
    .welcome-banner {
        background: linear-gradient(135deg, #003e7e 0%, #0056b3 40%, #0077e6 75%, #0099ff 100%);
        border: 1px solid rgba(255, 255, 255, 0.25) !important;
        box-shadow: 0 10px 25px -5px rgba(0, 86, 179, 0.3);
    }

    .banner-badge {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.35);
        backdrop-filter: blur(8px);
    }

    .pulse-dot-white {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #ffffff;
        box-shadow: 0 0 8px #ffffff;
        animation: pulseAnimation 2s infinite;
        display: inline-block;
    }

    @keyframes pulseAnimation {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(0.85); }
    }

    /* Ambient Glowing Light Orbs (White & Sky Blue) */
    .glow-orb {
        width: 320px;
        height: 320px;
        border-radius: 50%;
        filter: blur(50px);
    }
    .glow-white {
        background: radial-gradient(circle, rgba(255, 255, 255, 0.22) 0%, transparent 70%);
        margin-top: -60px;
        margin-right: -40px;
    }
    .glow-sky {
        background: radial-gradient(circle, rgba(125, 211, 252, 0.3) 0%, transparent 70%);
        margin-bottom: -80px;
    }

    /* Custom Box Shadows */
    .shadow-custom {
        box-shadow: 0 6px 20px -4px rgba(15, 23, 42, 0.07), 0 2px 6px -1px rgba(15, 23, 42, 0.04) !important;
    }

    .shadow-sm-soft {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04) !important;
    }

    .shadow-2xs {
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    /* =========================================
       KPI CARDS STYLING (FRESH & VIBRANT BLUE THEME)
       ========================================= */
    .kpi-blue-hero {
        background: linear-gradient(135deg, #004b87 0%, #0066cc 65%, #0ea5e9 100%) !important;
        box-shadow: 0 8px 20px -4px rgba(0, 102, 204, 0.3) !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .kpi-blue-hero:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 28px -4px rgba(0, 102, 204, 0.4) !important;
    }

    .kpi-icon-glass {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        backdrop-filter: blur(4px);
    }

    .kpi-white-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04) !important;
    }
    .kpi-white-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -4px rgba(0, 85, 179, 0.12) !important;
    }

    .kpi-stripe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }
    .stripe-amber { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
    .stripe-blue { background: linear-gradient(90deg, #0066cc, #38bdf8); }
    .stripe-emerald { background: linear-gradient(90deg, #059669, #10b981); }
    .stripe-rose { background: linear-gradient(90deg, #e11d48, #f43f5e); }

    .kpi-border-amber:hover { border-color: #fcd34d !important; }
    .kpi-border-blue:hover { border-color: #93c5fd !important; }
    .kpi-border-emerald:hover { border-color: #6ee7b7 !important; }
    .kpi-border-rose:hover { border-color: #fda4af !important; }

    .kpi-icon-badge {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    .badge-amber { background: #fffbeb; color: #d97706; }
    .badge-blue { background: #eff6ff; color: #0066cc; }
    .badge-emerald { background: #ecfdf5; color: #059669; }
    .badge-rose { background: #fff1f2; color: #e11d48; }

    .pulse-dot-amber {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background-color: #f59e0b;
        box-shadow: 0 0 8px #f59e0b;
        animation: pulseAnimation 1.5s infinite;
        display: inline-block;
    }

    .text-amber-400 { color: #fbbf24 !important; }
    .text-amber-300 { color: #fcd34d !important; }
    .text-cyan-400 { color: #22d3ee !important; }
    .text-rose-400 { color: #fb7185 !important; }
    .text-emerald-400 { color: #34d399 !important; }
    .text-sky-300 { color: #7dd3fc !important; }
    .text-sky-400 { color: #38bdf8 !important; }
    .fw-black { font-weight: 900; }

    .new-task-info {
        background: #fffbeb;
        color: #92400e;
        border: 1px solid #fef3c7;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }

    /* Search Box Styling */
    .search-box-group .form-control:focus {
        background-color: #ffffff !important;
        box-shadow: none;
    }

    /* Table Styling */
    .custom-table th {
        background: #f8fafc;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #475569;
        font-weight: 700;
        white-space: nowrap;
        border-bottom: 2px solid #e2e8f0;
    }

    .custom-table td {
        padding-top: 16px;
        padding-bottom: 16px;
        font-size: 0.9rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }

    .custom-table tbody tr {
        transition: background 0.15s ease, transform 0.15s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fbff;
    }

    .tracking-tight { letter-spacing: -0.02em; }
    .tracking-wide { letter-spacing: 0.025em; }
    .fs-xs { font-size: 0.7rem; }

    @media (max-width: 768px) {
        .custom-table {
            min-width: 1100px;
        }
    }

    /* =========================================
       CUSTOM PAGINATION STYLING (MODERN & CENTERED)
       ========================================= */
    .pagination-custom {
        display: flex;
        gap: 6px;
        padding-left: 0;
        list-style: none;
    }

    .pagination-custom .page-item {
        margin: 0;
    }

    .pagination-custom .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 14px;
        font-size: 0.875rem;
        font-weight: 500;
        color: #1e3a8a;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none;
    }

    .pagination-custom .page-link:hover {
        background-color: #eff6ff;
        color: #2563eb;
        border-color: #93c5fd;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
    }

    .pagination-custom .page-item.active .page-link {
        background: linear-gradient(135deg, #002b5c 0%, #0055b3 100%);
        border-color: #0055b3;
        color: #ffffff;
        font-weight: 600;
        box-shadow: 0 4px 14px rgba(0, 85, 179, 0.35);
        cursor: default;
    }

    .pagination-custom .page-item.disabled .page-link {
        color: #94a3b8;
        background-color: #f8fafc;
        border-color: #e2e8f0;
        box-shadow: none;
        cursor: not-allowed;
        opacity: 0.7;
    }

    /* Cegah SVG/icon membesar secara liar */
    .pagination-custom i,
    .pagination-custom svg,
    .pagination i,
    .pagination svg {
        font-size: 0.95rem;
        width: 14px !important;
        height: 14px !important;
        max-width: 14px !important;
        max-height: 14px !important;
        display: inline-block;
        vertical-align: middle;
    }
</style>

@endsection