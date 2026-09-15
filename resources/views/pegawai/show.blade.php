@extends('layouts.app')

@section('title', 'Detail Tugas')

@section('header_title', 'Detail Tugas')

@section('header_desc', 'Detail permohonan pelanggan dari Customer Service.')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Detail Tugas
            </h3>

            <p class="text-muted mb-0">
                Informasi lengkap permohonan pelanggan
            </p>
        </div>

        <a href="{{ route('pegawai.index') }}"
           class="btn btn-outline-secondary rounded-3 px-4">

            <i class="bi bi-arrow-left me-2"></i>
            Kembali

        </a>

    </div>


    <div class="row g-4">

        {{-- INFORMASI PERMOHONAN --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-0 p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted d-block mb-1">
                                No. Agenda
                            </small>

                            <h4 class="fw-bold text-primary mb-0">
                                {{ $permohonan->no_agenda ?? '-' }}
                            </h4>

                        </div>


                        {{-- STATUS --}}
                        <div>

                            @if ($permohonan->status === 'Menunggu')

                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                    <i class="bi bi-hourglass-split me-1"></i>
                                    Menunggu
                                </span>

                            @elseif ($permohonan->status === 'Sedang Diproses')

                                <span class="badge bg-primary rounded-pill px-3 py-2">
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

                            @endif

                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    {{-- INFORMASI PERMOHONAN --}}
                    <h5 class="fw-bold mb-3">
                        Informasi Permohonan
                    </h5>

                    <div class="row g-3 mb-4">

                        <div class="col-md-6">
                            <div class="detail-box">
                                <small>Tanggal Permohonan</small>
                                <div>
                                    {{ $permohonan->tanggal_permohonan ?? '-' }}
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="detail-box">
                                <small>Jenis Permohonan</small>
                                <div>
                                    {{ $permohonan->jenis_permohonan ?? '-' }}
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="detail-box">
                                <small>Jenis Tarif</small>
                                <div>
                                    {{ $permohonan->jenis_tarif ?? '-' }}
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="detail-box">
                                <small>Divisi Tujuan</small>
                                <div>
                                    {{ $permohonan->divisi_tujuan ?? '-' }}
                                </div>
                            </div>
                        </div>

                    </div>


                    {{-- INFORMASI PELANGGAN --}}
                    <h5 class="fw-bold mb-3">
                        Informasi Pelanggan
                    </h5>

                    <div class="row g-3 mb-4">

                        <div class="col-md-6">
                            <div class="detail-box">
                                <small>ID Pelanggan</small>
                                <div>
                                    {{ $permohonan->id_pelanggan ?? '-' }}
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="detail-box">
                                <small>Nama Pelanggan</small>
                                <div>
                                    {{ $permohonan->nama_pelanggan ?? '-' }}
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="detail-box">
                                <small>No. Telepon</small>
                                <div>
                                    {{ $permohonan->no_telepon ?? '-' }}
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="detail-box">
                                <small>Alamat</small>
                                <div>
                                    {{ $permohonan->alamat ?? '-' }}
                                </div>
                            </div>
                        </div>

                    </div>


                    {{-- DETAIL PERMOHONAN --}}
                    <h5 class="fw-bold mb-3">
                        Detail Permohonan
                    </h5>

                    <div class="detail-description">
                        {{ $permohonan->detail_permohonan ?? '-' }}
                    </div>

                </div>

            </div>

        </div>


        {{-- PANEL STATUS --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">
                        Status Tugas
                    </h5>


                    {{-- TIMELINE STATUS --}}
                    <div class="status-timeline">

                        <div class="timeline-item active">

                            <div class="timeline-icon">
                                <i class="bi bi-inbox-fill"></i>
                            </div>

                            <div>
                                <strong>Menunggu</strong>
                                <small>Tugas diterima dari CS</small>
                            </div>

                        </div>


                        <div class="timeline-item
                            {{ in_array($permohonan->status, ['Sedang Diproses', 'Selesai']) ? 'active' : '' }}">

                            <div class="timeline-icon">
                                <i class="bi bi-arrow-repeat"></i>
                            </div>

                            <div>
                                <strong>Sedang Diproses</strong>
                                <small>Tugas sedang dikerjakan</small>
                            </div>

                        </div>


                        <div class="timeline-item
                            {{ $permohonan->status === 'Selesai' ? 'active' : '' }}">

                            <div class="timeline-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>

                            <div>
                                <strong>Selesai</strong>
                                <small>Tugas telah diselesaikan</small>
                            </div>

                        </div>

                    </div>


                    {{-- STATUS SAAT INI --}}
                    <div class="current-status mt-3">

                        <small class="text-muted d-block mb-1">
                            Status saat ini
                        </small>

                        <strong>
                            {{ $permohonan->status ?? 'Menunggu' }}
                        </strong>

                    </div>


                    {{-- NOTIFIKASI BERHASIL --}}
                    @if (session('success'))

                        <div class="alert alert-success mt-3 mb-0">

                            <i class="bi bi-check-circle me-2"></i>

                            {{ session('success') }}

                        </div>

                    @endif


                    {{-- PERUBAHAN STATUS --}}
                    <div class="mt-4">

                        <h6 class="fw-bold mb-3">
                            Perubahan Status
                        </h6>


                        {{-- MENUNGGU --}}
                        @if ($permohonan->status === 'Menunggu')

                            <form action="{{ route('pegawai.updateStatus', $permohonan->id) }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="status"
                                       value="Sedang Diproses">

                                <button type="submit"
                                        class="btn btn-primary w-100 rounded-3 py-2">

                                    <i class="bi bi-play-fill me-1"></i>
                                    Mulai Proses Tugas

                                </button>

                            </form>


                            <form action="{{ route('pegawai.updateStatus', $permohonan->id) }}"
                                  method="POST"
                                  class="mt-2">

                                @csrf

                                <input type="hidden"
                                       name="status"
                                       value="Ditolak">

                                <button type="submit"
                                        class="btn btn-outline-danger w-100 rounded-3 py-2">

                                    <i class="bi bi-x-circle me-1"></i>
                                    Tolak Tugas

                                </button>

                            </form>


                        {{-- SEDANG DIPROSES --}}
                        @elseif ($permohonan->status === 'Sedang Diproses')

                            <form action="{{ route('pegawai.updateStatus', $permohonan->id) }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="status"
                                       value="Selesai">

                                <button type="submit"
                                        class="btn btn-success w-100 rounded-3 py-2">

                                    <i class="bi bi-check-circle me-1"></i>
                                    Tandai Selesai

                                </button>

                            </form>


                        {{-- SELESAI --}}
                        @elseif ($permohonan->status === 'Selesai')

                            <div class="alert alert-success mb-0">

                                <i class="bi bi-check-circle-fill me-2"></i>

                                Tugas ini sudah selesai.

                            </div>


                        {{-- DITOLAK --}}
                        @elseif ($permohonan->status === 'Ditolak')

                            <div class="alert alert-danger mb-0">

                                <i class="bi bi-x-circle-fill me-2"></i>

                                Tugas ini telah ditolak.

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<style>

.detail-box {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 15px 18px;
    height: 100%;
}

.detail-box small {
    display: block;
    color: #6c757d;
    font-size: 0.8rem;
    margin-bottom: 5px;
}

.detail-box div {
    color: #212529;
    font-weight: 600;
}

.detail-description {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 18px;
    min-height: 100px;
    line-height: 1.6;
    color: #343a40;
}

.status-timeline {
    position: relative;
}

.timeline-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding-bottom: 25px;
    position: relative;
    opacity: 0.45;
}

.timeline-item.active {
    opacity: 1;
}

.timeline-icon {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}

.timeline-item.active .timeline-icon {
    background: #e7f1ff;
    color: #0066cc;
}

.timeline-item strong {
    display: block;
    color: #212529;
    margin-top: 7px;
}

.timeline-item small {
    display: block;
    color: #6c757d;
    margin-top: 3px;
}

.current-status {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 15px 18px;
}

.current-status strong {
    color: #0066cc;
}

</style>

@endsection
