@extends('layouts.app')

@section('title', 'Dashboard Monitoring - ULP Dukuh Kupang')

@section('content')
<!-- Header Dashboard -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Dashboard Monitoring Layanan & Permohonan</h3>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">Pusat kendali operasional dan rekapitulasi data pelanggan PT PLN (Persero) ULP Dukuh Kupang.</p>
    </div>
    <div>
        <div class="bg-white px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2 border">
            <i class="bi bi-calendar3 text-primary"></i>
            <span class="fw-semibold text-secondary" style="font-size: 0.85rem;">1 Sep 2026 - 30 Sep 2026</span>
        </div>
    </div>
</div>

<!-- BENTO GRID SECTION ATAS -->
<div class="row g-3 g-md-4 mb-4">
    <!-- 1. Total Permohonan -->
    <div class="col-12 col-xl-4">
        <div class="h-100 d-flex flex-column justify-content-between p-4 text-white rounded-4 shadow-sm" style="background: linear-gradient(135deg, #002b5c 0%, #0055b3 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-uppercase fw-semibold text-info" style="font-size: 0.75rem; letter-spacing: 1px;">Total Layanan Masuk</span>
                    <h6 class="fw-medium text-white mb-0" style="font-size: 0.9rem;">Periode Bulan Ini</h6>
                </div>
                <div class="bg-white bg-opacity-25 p-2 rounded-3">
                    <i class="bi bi-folder2-open fs-4 text-white"></i>
                </div>
            </div>
            <div class="my-3">
                <h1 class="fw-bold display-5 mb-0 text-white">{{ $total ?? 120 }}</h1>
                <small class="text-white-50" style="font-size: 0.8rem;"><i class="bi bi-shield-check text-info me-1"></i> Data terekam otomatis</small>
            </div>
            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-white border-opacity-10">
                <span style="font-size: 0.85rem;" class="fw-medium">ULP Dukuh Kupang</span>
                <span class="badge bg-info text-dark fw-bold px-3 py-1 rounded-pill" style="font-size: 0.75rem;">Live System</span>
            </div>
        </div>
    </div>

    <!-- 2. Statistik Status -->
    <div class="col-12 col-xl-8">
        <div class="row g-3 g-md-4 h-100">
            <div class="col-12 col-md-4">
                <div class="bg-white border border-1 border-light shadow-sm rounded-4 p-3 d-flex flex-column justify-content-between h-100 border-start border-4 border-secondary">
                    <div class="d-flex justify-content-between align-items-start">
                        <span class="text-muted fw-semibold" style="font-size: 0.75rem;">MENUNGGU</span>
                        <div class="bg-secondary bg-opacity-10 p-2 rounded-circle text-secondary"><i class="bi bi-clock-history"></i></div>
                    </div>
                    <div class="py-2">
                        <h2 class="fw-bold mb-1 text-secondary">{{ $menunggu ?? 15 }}</h2>
                        <span class="text-muted" style="font-size: 0.78rem;">Antrean verifikasi berkas</span>
                    </div>
                    <div class="text-secondary fw-semibold" style="font-size: 0.75rem;"><i class="bi bi-exclamation-circle me-1"></i> Perlu tindakan</div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="bg-white border border-1 border-light shadow-sm rounded-4 p-3 d-flex flex-column justify-content-between h-100 border-start border-4 border-primary">
                    <div class="d-flex justify-content-between align-items-start">
                        <span class="text-muted fw-semibold" style="font-size: 0.75rem;">SEDANG DIPROSES</span>
                        <div class="bg-primary bg-opacity-10 p-2 rounded-circle text-primary"><i class="bi bi-arrow-repeat"></i></div>
                    </div>
                    <div class="py-2">
                        <h2 class="fw-bold mb-1 text-primary">{{ $diproses ?? 30 }}</h2>
                        <span class="text-muted" style="font-size: 0.78rem;">Eksekusi lapangan / loket</span>
                    </div>
                    <div class="text-primary fw-semibold" style="font-size: 0.75rem;"><i class="bi bi-tools me-1"></i> Petugas teknis</div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="bg-white border border-1 border-light shadow-sm rounded-4 p-3 d-flex flex-column justify-content-between h-100 border-start border-4" style="border-color: #0ea5e9 !important;">
                    <div class="d-flex justify-content-between align-items-start">
                        <span class="text-muted fw-semibold" style="font-size: 0.75rem;">SELESAI</span>
                        <div class="p-2 rounded-circle" style="background-color: rgba(14, 165, 233, 0.1); color: #0ea5e9;"><i class="bi bi-check-circle-fill"></i></div>
                    </div>
                    <div class="py-2">
                        <h2 class="fw-bold mb-1" style="color: #0ea5e9;">{{ $selesai ?? 75 }}</h2>
                        <span class="text-muted" style="font-size: 0.78rem;">Layanan tuntas</span>
                    </div>
                    <div class="fw-semibold" style="font-size: 0.75rem; color: #0ea5e9;"><i class="bi bi-check-all me-1"></i> Berkas ditutup</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BENTO GRID SECTION BAWAH (GRAFIK) -->
<div class="row g-3 g-md-4">
    <!-- Donut Chart -->
    <div class="col-12 col-lg-6">
        <div class="bg-white border border-1 border-light shadow-sm rounded-4 p-4 h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-dark mb-0">Distribusi Jenis Permohonan & Layanan</h6>
                    <span class="badge bg-light text-primary border px-2 py-1" style="font-size: 0.7rem;">Kategori Kantor</span>
                </div>
                <div class="row align-items-center g-3">
                    <div class="col-sm-5 text-center">
                        <div style="position: relative; height: 180px; width: 100%;">
                            <canvas id="chartJenis"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="d-flex flex-column gap-2">
                            @php
                                $colors = ['#002b5c', '#004080', '#0066cc', '#0ea5e9', '#38bdf8'];
                                $defaultJenis = ['Pasang Baru' => 50, 'Perubahan Daya' => 30, 'Penyambungan Sementara' => 25, 'Pengaduan/Keluhan' => 15];$jenisData = isset($jenis_pengaduan) && !empty($jenis_pengaduan) ? $jenis_pengaduan :$defaultJenis;
                                $totalJenis = array_sum($jenisData) > 0 ? array_sum($jenisData) : 1;
                                $i = 0;
                            @endphp
                            @foreach($jenisData as $nama =>$jumlah)
                                @php
                                    $percent = round(($jumlah / $totalJenis) * 100);$color = $colors[$i % count($colors)];$i++;
                                @endphp
                                <div class="d-flex align-items-center justify-content-between p-2 bg-light border rounded-3">
                                    <div class="d-flex align-items-center gap-2 overflow-hidden pe-2">
                                        <span style="width: 10px; height: 10px; border-radius: 50%; background-color: {{ $color }}; flex-shrink: 0;"></span>
                                        <span class="text-secondary text-truncate fw-medium" style="font-size: 0.78rem;" title="{{ $nama }}">{{ $nama }}</span>
                                    </div>
                                    <div class="text-end flex-shrink-0">
                                        <span class="fw-bold text-dark" style="font-size: 0.8rem;">{{ $jumlah }}</span>
                                        <span class="text-muted" style="font-size: 0.7rem;">({{ $percent }}%)</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 pt-2 text-center border-top">
                <small class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-info-circle text-primary me-1"></i> Persentase dihitung otomatis dari transaksi layanan kantor</small>
            </div>
        </div>
    </div>

    <!-- Bar Chart Wilayah -->
    <div class="col-12 col-lg-6">
        <div class="bg-white border border-1 border-light shadow-sm rounded-4 p-4 h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-dark mb-0">5 Wilayah Layanan Permohonan Terbanyak</h6>
                    <span class="badge bg-light text-primary border px-2 py-1" style="font-size: 0.7rem;">Top Wilayah</span>
                </div>
                <div style="position: relative; height: 215px; width: 100%;">
                    <canvas id="chartWilayah"></canvas>
                </div>
            </div>
            <div class="mt-3 pt-2 text-center border-top">
                <small class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-geo-alt text-primary me-1"></i> Wilayah konsentrasi permohonan pelanggan terbanyak</small>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const dataJenis = @json($jenisData ?? []);

    @php
        $defaultWilayah = ['Dukuh Pakis' => 34, 'Wiyung' => 28, 'Karang Pilang' => 22, 'Jambangan' => 20, 'Gayungan' => 15];$wilayahData = isset($wilayah_pengaduan) && !empty($wilayah_pengaduan) ? $wilayah_pengaduan :$defaultWilayah;
    @endphp
    const dataWilayah = @json($wilayahData);

    Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
    Chart.defaults.color = '#64748b';

    // Chart Donat
    const ctxJenis = document.getElementById('chartJenis').getContext('2d');
    new Chart(ctxJenis, {
        type: 'doughnut',
        data: {
            labels: Object.keys(dataJenis),
            datasets: [{
                data: Object.values(dataJenis),
                backgroundColor: ['#002b5c', '#004080', '#0066cc', '#0ea5e9', '#38bdf8'],
                borderWidth: 2,
                borderColor: '#ffffff',
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: { legend: { display: false } }
        }
    });

    // Chart Bar
    const ctxWilayah = document.getElementById('chartWilayah').getContext('2d');
    let gradientBar = ctxWilayah.createLinearGradient(0, 0, 0, 215);
    gradientBar.addColorStop(0, '#0066cc');
    gradientBar.addColorStop(1, '#002b5c');

    new Chart(ctxWilayah, {
        type: 'bar',
        data: {
            labels: Object.keys(dataWilayah),
            datasets: [{
                label: 'Total Permohonan',
                data: Object.values(dataWilayah),
                backgroundColor: gradientBar,
                borderRadius: 8,
                barThickness: 'flex'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f1f5f9', borderDash: [4, 4] },
                    ticks: { precision: 0 }
                },
                x: { grid: { display: false } }
            },
            plugins: { legend: { display: false } }
        }
    });
</script>
@endpush
