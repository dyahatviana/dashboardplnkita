@extends('layouts.app')

@section('title', 'Dashboard Pegawai')

@section('header_title', 'Dashboard Pegawai')

@section('header_desc', 'Kelola dan proses tugas permohonan dari Customer Service.')

@section('content')

<div class="container-fluid px-0">

    {{-- =========================
        HEADER
    ========================== --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h2 class="fw-bold text-dark mb-1">
                Panel Pegawai
            </h2>

            <p class="text-muted mb-0">
                Daftar tugas permohonan dari Customer Service
            </p>
        </div>

        <div class="text-md-end">
            <small class="text-muted d-block">
                Login sebagai
            </small>

            <span class="fw-bold text-dark">
                {{ auth()->user()->name }}
            </span>
        </div>

    </div>


    {{-- =========================
        KPI
    ========================== --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL --}}
        <div class="col-12 col-sm-6 col-xl-4">

            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Total Tugas
                            </p>

                            <h2 class="fw-bold text-dark mb-0">
                                {{ $total ?? $permohonans->count() }}
                            </h2>
                        </div>

                        <div class="kpi-icon bg-primary-subtle text-primary">
                            <i class="bi bi-clipboard-data-fill"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- MENUNGGU --}}
        <div class="col-12 col-sm-6 col-xl-4">

            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Menunggu
                            </p>

                            <h2 class="fw-bold text-dark mb-0">
                                {{ $menunggu ?? $permohonans->where('status', 'Menunggu')->count() }}
                            </h2>
                        </div>

                        <div class="kpi-icon bg-warning-subtle text-warning">
                            <i class="bi bi-hourglass-split"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- DIPROSES --}}
        <div class="col-12 col-sm-6 col-xl-4">

            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Sedang Diproses
                            </p>

                            <h2 class="fw-bold text-dark mb-0">
                                {{ $diproses ?? $permohonans->where('status', 'Sedang Diproses')->count() }}
                            </h2>
                        </div>

                        <div class="kpi-icon bg-info-subtle text-info">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- SELESAI --}}
        <div class="col-12 col-sm-6 col-xl-4">

            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Selesai
                            </p>

                            <h2 class="fw-bold text-dark mb-0">
                                {{ $selesai ?? $permohonans->where('status', 'Selesai')->count() }}
                            </h2>
                        </div>

                        <div class="kpi-icon bg-success-subtle text-success">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- DITOLAK --}}
        <div class="col-12 col-sm-6 col-xl-4">

            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Ditolak
                            </p>

                            <h2 class="fw-bold text-dark mb-0">
                                {{ $ditolak ?? $permohonans->where('status', 'Ditolak')->count() }}
                            </h2>
                        </div>

                        <div class="kpi-icon bg-danger-subtle text-danger">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- TUGAS BARU --}}
        <div class="col-12 col-sm-6 col-xl-4">

            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Tugas Baru
                            </p>

                            <h2 class="fw-bold text-dark mb-0">
                                {{ $menunggu ?? $permohonans->where('status', 'Menunggu')->count() }}
                            </h2>
                        </div>

                        <div class="kpi-icon bg-secondary-subtle text-secondary">
                            <i class="bi bi-inbox-fill"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
        DAFTAR TUGAS
    ========================== --}}
    <div class="card border-0 shadow-sm rounded-4">

        {{-- HEADER --}}
        <div class="card-header bg-white border-0 rounded-top-4 p-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                <div>

                    <h4 class="fw-bold text-dark mb-1">
                        Daftar Tugas Masuk
                    </h4>

                    <p class="text-muted mb-0">
                        Tugas yang dikirim oleh Customer Service
                    </p>

                </div>


                {{-- INFO TUGAS BARU --}}
                @if(($menunggu ?? $permohonans->where('status', 'Menunggu')->count()) > 0)

                    <div class="new-task-info">

                        <i class="bi bi-bell-fill me-2"></i>

                        Ada

                        <strong>
                            {{ $menunggu ?? $permohonans->where('status', 'Menunggu')->count() }}
                        </strong>

                        tugas baru

                    </div>

                @endif

            </div>

        </div>


        {{-- BODY --}}
        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0 custom-table">

                    <thead>

                        <tr>

                            <th class="px-4">
                                No
                            </th>

                            <th>
                                No. Agenda
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Pelanggan
                            </th>

                            <th>
                                Jenis Permohonan
                            </th>

                            <th>
                                Divisi Tujuan
                            </th>

                            <th>
                                Status
                            </th>

                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($permohonans as $index => $permohonan)

                            <tr>

                                {{-- NO --}}
                                <td class="px-4 text-muted">
                                    {{ $index + 1 }}
                                </td>


                                {{-- NO AGENDA --}}
                                <td>

                                    <span class="fw-bold text-primary">
                                        {{ $permohonan->no_agenda ?? '-' }}
                                    </span>

                                </td>


                                {{-- TANGGAL --}}
                                <td>
                                    {{ $permohonan->tanggal_permohonan ?? '-' }}
                                </td>


                                {{-- PELANGGAN --}}
                                <td>

                                    <div class="fw-semibold text-dark">
                                        {{ $permohonan->nama_pelanggan ?? '-' }}
                                    </div>

                                    <small class="text-muted">
                                        ID:
                                        {{ $permohonan->id_pelanggan ?? '-' }}
                                    </small>

                                </td>


                                {{-- JENIS --}}
                                <td>
                                    {{ $permohonan->jenis_permohonan ?? '-' }}
                                </td>


                                {{-- DIVISI --}}
                                <td>

                                    <span class="text-secondary fw-medium">
                                        {{ $permohonan->divisi_tujuan ?? '-' }}
                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if ($permohonan->status === 'Menunggu')

                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">

                                            <i class="bi bi-hourglass-split me-1"></i>

                                            Menunggu

                                        </span>


                                    @elseif ($permohonan->status === 'Sedang Diproses')

                                        <span class="badge bg-info text-dark rounded-pill px-3 py-2">

                                            <i class="bi bi-arrow-repeat me-1"></i>

                                            Sedang Diproses

                                        </span>


                                    @elseif ($permohonan->status === 'Selesai')

                                        <span class="badge bg-success rounded-pill px-3 py-2">

                                            <i class="bi bi-check-circle-fill me-1"></i>

                                            Selesai

                                        </span>


                                    @elseif ($permohonan->status === 'Ditolak')

                                        <span class="badge bg-danger rounded-pill px-3 py-2">

                                            <i class="bi bi-x-circle-fill me-1"></i>

                                            Ditolak

                                        </span>


                                    @else

                                        <span class="badge bg-secondary rounded-pill px-3 py-2">

                                            {{ $permohonan->status ?? 'Menunggu' }}

                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-2">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('pegawai.show', $permohonan->id) }}"
                                           class="btn btn-sm btn-outline-secondary rounded-3"
                                           title="Lihat detail">

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        {{-- PROSES --}}
                                        @if ($permohonan->status === 'Menunggu')

                                            <a href="{{ route('pegawai.show', $permohonan->id) }}"
                                               class="btn btn-sm btn-primary rounded-3"
                                               title="Proses tugas">

                                                <i class="bi bi-play-fill"></i>

                                            </a>

                                        @elseif ($permohonan->status === 'Sedang Diproses')

                                            <a href="{{ route('pegawai.show', $permohonan->id) }}"
                                               class="btn btn-sm btn-success rounded-3"
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

                                    <div class="empty-task">

                                        <i class="bi bi-inbox fs-1 text-muted opacity-50"></i>

                                        <h6 class="fw-bold mt-3 mb-1">
                                            Belum ada tugas
                                        </h6>

                                        <p class="text-muted mb-0">
                                            Tugas dari CS akan muncul di halaman ini.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- =========================
    STYLE
========================== --}}
<style>

    .kpi-card {
        transition: all 0.2s ease-in-out;
    }

    .kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08) !important;
    }

    .kpi-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .new-task-info {
        background: #fff7ed;
        color: #9a3412;
        padding: 10px 16px;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .custom-table th {
        background: #f8f9fa;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #6c757d;
        font-weight: 700;
        white-space: nowrap;
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .custom-table td {
        padding-top: 16px;
        padding-bottom: 16px;
        font-size: 0.92rem;
    }

    .custom-table tbody tr {
        transition: background 0.15s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fbff;
    }

    .empty-task {
        padding: 20px;
    }

    @media (max-width: 768px) {

        .custom-table {
            min-width: 1100px;
        }

    }

</style>

@endsection
