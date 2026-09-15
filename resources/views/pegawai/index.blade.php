@extends('layouts.app')

@section('title', 'Dashboard Pegawai')

@section('header_title', 'Dashboard Pegawai')

@section('header_desc', 'Kelola dan proses tugas permohonan dari Customer Service.')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Panel Pegawai</h3>
            <p class="text-muted mb-0">
                Daftar tugas permohonan dari Customer Service
            </p>
        </div>

        <div class="text-end">
            <small class="text-muted">Login sebagai</small>
            <div class="fw-semibold">
                {{ auth()->user()->name }}
            </div>
        </div>
    </div>

    {{-- Card Statistik --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-muted">Total Tugas</small>
                    <h2 class="fw-bold mt-2">
                        {{ $permohonans->count() }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-muted">Menunggu</small>
                    <h2 class="fw-bold mt-2">
                        {{ $permohonans->where('status', 'Menunggu')->count() }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-muted">Selesai</small>
                    <h2 class="fw-bold mt-2">
                        {{ $permohonans->where('status', 'Selesai')->count() }}
                    </h2>
                </div>
            </div>
        </div>

    </div>

    {{-- Daftar Tugas --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">
                Daftar Tugas Masuk
            </h5>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th class="px-3">No</th>
                            <th>No. Agenda</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Jenis Permohonan</th>
                            <th>Divisi Tujuan</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($permohonans as $index => $permohonan)

                            <tr>

                                <td class="px-3">
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $permohonan->no_agenda }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $permohonan->tanggal_permohonan }}
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $permohonan->nama_pelanggan }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $permohonan->id_pelanggan }}
                                    </small>
                                </td>

                                <td>
                                    {{ $permohonan->jenis_permohonan }}
                                </td>

                                <td>
                                    {{ $permohonan->divisi_tujuan }}
                                </td>

                                <td>

                                    @if ($permohonan->status === 'Menunggu')

                                        <span class="badge bg-warning text-dark">
                                            Menunggu
                                        </span>

                                    @elseif ($permohonan->status === 'Sedang Diproses')

                                        <span class="badge bg-primary">
                                            Sedang Diproses
                                        </span>

                                    @elseif ($permohonan->status === 'Selesai')

                                        <span class="badge bg-success">
                                            Selesai
                                        </span>

                                    @elseif ($permohonan->status === 'Ditolak')

                                        <span class="badge bg-danger">
                                            Ditolak
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center py-5">

                                    <div class="text-muted">
                                        Belum ada tugas dari CS.
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

@endsection
