@extends('layouts.app')

@section('content')

<div class="container-fluid px-0">

    <!-- HEADER HALAMAN & TOMBOL INPUT BARU -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1 page-title-gradient" style="letter-spacing: -0.5px; font-size: 1.6rem;">
                ULP DUKUH KUPANG - Loket CS
            </h2>

            <p class="text-secondary mb-0" style="font-size: 0.95rem;">
                Kelola dan pantau status permohonan masuk.
            </p>
        </div>

        <div>
            <a href="{{ route('cs.permohonan.create') }}"
               class="btn btn-custom-input d-inline-flex align-items-center gap-2 text-decoration-none shadow-sm rounded-3 px-4 py-2.5 fw-semibold text-white">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Input Baru</span>
            </a>
        </div>
    </div>


    <!-- ========================= -->
    <!-- KPI PERMOHONAN -->
    <!-- ========================= -->

    <div class="row g-3 mb-4">

        <!-- TOTAL PERMOHONAN -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-secondary mb-1 fw-medium" style="font-size: 0.9rem;">
                                Total Permohonan
                            </p>
                            <h3 class="fw-bold text-dark mb-0">
                                {{ $total ?? 0 }}
                            </h3>
                        </div>
                        <div class="kpi-icon bg-primary-subtle text-primary">
                            <i class="bi bi-file-earmark-text-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MENUNGGU -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-secondary mb-1 fw-medium" style="font-size: 0.9rem;">
                                Menunggu
                            </p>
                            <h3 class="fw-bold text-dark mb-0">
                                {{ $menunggu ?? 0 }}
                            </h3>
                        </div>
                        <div class="kpi-icon bg-warning-subtle text-warning">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEDANG DIPROSES -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-secondary mb-1 fw-medium" style="font-size: 0.9rem;">
                                Sedang Diproses
                            </p>
                            <h3 class="fw-bold text-dark mb-0">
                                {{ $diproses ?? 0 }}
                            </h3>
                        </div>
                        <div class="kpi-icon bg-info-subtle text-info">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SELESAI -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 kpi-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-secondary mb-1 fw-medium" style="font-size: 0.9rem;">
                                Selesai
                            </p>
                            <h3 class="fw-bold text-dark mb-0">
                                {{ $selesai ?? 0 }}
                            </h3>
                        </div>
                        <div class="kpi-icon bg-success-subtle text-success">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- ========================= -->
    <!-- PESAN SUCCESS -->
    -- ========================= -->

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-4 mb-4 border-0 fs-6"
             role="alert"
             style="background-color: #ecfdf5; border-left: 4px solid #10b981 !important; color: #065f46;">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <!-- ========================= -->
    <!-- TABEL STATUS PERMOHONAN -->
    <!-- ========================= -->

    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">

        <!-- HEADER TABEL & SEARCH -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <h4 class="fw-bold text-dark mb-0" style="font-size: 1.15rem;">
                Status Permohonan Pelanggan
            </h4>

            <form action="{{ route('cs.permohonan.index') }}" method="GET" class="d-flex align-items-center gap-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control rounded-3 bg-light border-0 px-3 py-2 fs-6"
                    placeholder="Cari No Agenda / ID Pel / Nama..."
                    style="width: 280px;"
                >
                <button type="submit" class="btn btn-primary px-4 rounded-3 fw-semibold fs-6">
                    Cari
                </button>

                @if(request('search'))
                    <a href="{{ route('cs.permohonan.index') }}"
                       class="btn text-white px-4 rounded-3 fw-semibold fs-6 shadow-sm text-decoration-none d-inline-flex align-items-center justify-content-center"
                       style="background-color: #64748b; border: none; transition: all 0.2s ease-in-out;"
                       onmouseover="this.style.backgroundColor='#475569'"
                       onmouseout="this.style.backgroundColor='#64748b'">
                        Reset
                    </a>
                @endif
            </form>
        </div>


        <!-- TABEL -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 custom-table">
               <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">NO</th>
                    <th>NO. AGENDA</th>
                    <th>TANGGAL</th>
                    <th>PEMOHON</th>        <!-- Kolom Pemohon di sebelah kiri Pelanggan -->
                    <th>PELANGGAN</th>
                    <th>JENIS PERMOHONAN</th>
                    <th>DIVISI TUJUAN</th>
                    <th class="text-center">STATUS</th>
                </tr>
            </thead>

                <tbody>
                    @forelse($permohonans ?? [] as $index => $item)
                        <tr>
                            <!-- NOMOR URUT -->
                            <td class="ps-3 text-secondary fw-semibold">
                                {{ method_exists($permohonans, 'firstItem') ? $permohonans->firstItem() + $index : $index + 1 }}
                            </td>

                            <!-- NO AGENDA -->
                            <!-- KODE PERBAIKAN SEMENTARA -->
                                <td>
                                    <span class="fw-bold text-dark">
                                        {{ $item->no_agenda ?? '-' }}
                                    </span>
                                </td>

                            <!-- TANGGAL -->
                            <td class="text-secondary">
                                <i class="bi bi-calendar-event text-muted me-1"></i>
                                {{ $item->tanggal_permohonan ?? '-' }}
                            </td>

                            <!-- PEMOHON (Baru Ditambahkan) -->
                            <td>
                                <div class="fw-bold text-dark" style="font-size: 0.95rem;">
                                    {{ $item->nama_pemohon ?? '-' }}
                                </div>
                            </td>

                            <!-- PELANGGAN -->
                            <td>
                                <div class="fw-bold text-dark" style="font-size: 0.95rem;">
                                    {{ $item->nama_pelanggan ?? '-' }}
                                </div>
                                <small class="text-muted d-block mt-0.5" style="font-size: 0.8rem;">
                                    ID: {{ $item->id_pelanggan ?? '-' }}
                                </small>
                            </td>

                            <!-- JENIS PERMOHONAN -->
                            <td>
                                <span class="badge-jenis">
                                    {{ $item->jenis_permohonan ?? '-' }}
                                </span>
                            </td>

                            <!-- DIVISI TUJUAN -->
                            <td class="text-secondary fw-medium">
                                <i class="bi bi-building text-muted me-1"></i>
                                {{ $item->divisi_tujuan ?? '-' }}
                            </td>

                            <!-- STATUS -->
                            <td class="pe-3 text-center">
                                @if($item->status == 'Menunggu')
                                    <span class="badge status-badge status-menunggu">
                                        <i class="bi bi-hourglass-split me-1"></i> Menunggu
                                    </span>
                                @elseif($item->status == 'Sedang Diproses')
                                    <span class="badge status-badge status-proses">
                                        <i class="bi bi-arrow-repeat me-1"></i> Sedang Diproses
                                    </span>
                                @elseif($item->status == 'Selesai')
                                    <span class="badge status-badge status-selesai">
                                        <i class="bi bi-check-circle-fill me-1"></i> Selesai
                                    </span>
                                @elseif($item->status == 'Ditolak')
                                    <span class="badge status-badge status-ditolak">
                                        <i class="bi bi-x-circle-fill me-1"></i> Ditolak
                                    </span>
                                @else
                                    <span class="badge status-badge bg-secondary text-white">
                                        {{ $item->status ?? 'Menunggu' }}
                                    </span>
                                @endif
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted fs-6">
                                <i class="bi bi-folder2-open fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                Belum ada data permohonan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINASI JIKA ADA -->
        @if(method_exists($permohonans, 'links'))
            <div class="mt-4 px-2">
                {{ $permohonans->links() }}
            </div>
        @endif

    </div>

</div>


<!-- ========================= -->
<!-- STYLE KUSTOM UNTUK HALAMAN -->
<!-- ========================= -->

<style>
    .card {
        border: none;
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.04);
        border-radius: 1rem;
    }

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
        font-size: 1.3rem;
    }

    /* Tombol Input Baru */
    .btn-custom-input {
        background: var(--accent-gradient, linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%));
        border: none;
        font-size: 0.95rem;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }

    .btn-custom-input:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35) !important;
    }

    /* Tabel Styling Modern */
    .custom-table {
        font-family: 'Inter', sans-serif;
        color: #334155;
        vertical-align: middle;
    }

    .custom-table thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-size: 0.75rem !important;
        letter-spacing: 0.6px;
        font-weight: 700;
        text-transform: uppercase;
        border-bottom: 2px solid #e2e8f0 !important;
    }

    .custom-table tbody td {
        font-size: 0.88rem !important;
        padding-top: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .custom-table tbody tr {
        transition: background-color 0.15s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fafc !important;
    }

    /* Link Agenda */
    .agenda-link {
        color: #2563eb !important;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.15s ease;
    }

    .agenda-link:hover {
        color: #1d4ed8 !important;
        text-decoration: underline;
    }

    /* Badge Jenis Permohonan */
    .badge-jenis {
        background-color: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
        font-weight: 500;
        font-size: 0.75rem;
        padding: 0.35em 0.75em;
        border-radius: 50rem;
        display: inline-block;
    }

    /* Status Badge Kustom */
    .status-badge {
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        font-size: 0.75rem;
        padding: 0.4em 0.9em;
        border-radius: 50rem;
    }

    .status-menunggu {
        background-color: #fef3c7 !important;
        color: #b45309 !important;
        border: 1px solid #fde68a;
    }

    .status-proses {
        background-color: #e0f2fe !important;
        color: #0369a1 !important;
        border: 1px solid #bae6fd;
    }

    .status-selesai {
        background-color: #dcfce7 !important;
        color: #15803d !important;
        border: 1px solid #bbf7d0;
    }

    .status-ditolak {
        background-color: #fee2e2 !important;
        color: #b91c1c !important;
        border: 1px solid #fecaca;
    }

    /* Search Input */
    .form-control:focus {
        background-color: #ffffff !important;
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12) !important;
    }

    @media (max-width: 576px) {
        .form-control {
            width: 100% !important;
        }
    }
</style>

@endsection
