<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pelanggan - PLN UP3 Surabaya Selatan</title>
    <!-- Load Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Load Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        .wrapper { display: flex; width: 100%; align-items: stretch; }

        /* Desain Sidebar Kiri */
        #sidebar {
            min-width: 260px;
            max-width: 260px;
            min-height: 100vh;
            background-color: #0f172a;
            color: #f8fafc;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        #sidebar .nav-link {
            color: rgba(255, 255, 255, 0.6);
            border-radius: 8px;
            margin-bottom: 5px;
            padding: 12px 20px;
            font-weight: 500;
            transition: all 0.3s;
        }
        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.08);
            color: #38bdf8;
            transform: translateX(4px);
        }

        .main-content { flex-grow: 1; padding: 2rem 3rem; }

        /* Topbar Nav / Breadcrumb Area */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .breadcrumb-item a { color: #64748b; text-decoration: none; font-weight: 500;}
        .breadcrumb-item.active { color: #0f172a; font-weight: 600; }

        /* Card Styling */
        .profile-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
            overflow: hidden;
        }

        .avatar-container {
            width: 90px;
            height: 90px;
            background-color: #38bdf8;
            color: #0f172a;
            font-size: 2.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 4px solid #ffffff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .info-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            font-weight: 700;
        }

        .info-value {
            font-size: 1rem;
            color: #1e293b;
            font-weight: 600;
        }

        .badge-daya {
            background-color: #fef08a;
            color: #854d0e;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            border: 1px solid #fde047;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <!-- MENU SIDEBAR (KIRI) -->
    <nav id="sidebar" class="p-3 d-flex flex-column">
        <div class="text-center mb-4 mt-2 border-bottom border-secondary pb-4">
            <i class="bi bi-lightning-charge-fill text-info" style="font-size: 2.5rem;"></i>
            <h5 class="fw-bold text-white mt-2 mb-0">PLN UP3 SBY</h5>
            <small class="text-white-50">Surabaya Selatan</small>
        </div>

        <ul class="nav flex-column mb-auto w-100">
            <li class="nav-item"><a href="/" class="nav-link"><i class="bi bi-speedometer2 me-3"></i> Dashboard</a></li>
            <li class="nav-item"><a href="/data-pengaduan" class="nav-link"><i class="bi bi-table me-3"></i> Data Pengaduan</a></li>
            <li class="nav-item"><a href="/rekapitulasi" class="nav-link"><i class="bi bi-file-bar-graph me-3"></i> Rekapitulasi</a></li>
            <!-- Menu Diubah Menjadi Profil Pelanggan -->
            <li class="nav-item"><a href="/profil-pelanggan" class="nav-link active"><i class="bi bi-person-badge me-3"></i> Profil Pelanggan</a></li>
        </ul>

        <hr class="border-secondary mt-5">
        <div class="text-center text-white-50" style="font-size: 0.8rem;">
            &copy; 2026 Kerja Praktik<br>Telkom University SBY
        </div>
    </nav>

    <!-- AREA KONTEN UTAMA (KANAN) -->
    <div class="main-content">

        <!-- Top Bar -->
        <div class="top-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
            </nav>
        </div>

        <!-- Header Halaman -->
        <div class="mb-4">
            <h3 class="fw-bolder text-dark mb-1">Profil & Informasi Konsumen</h3>
            <p class="text-secondary mb-0">Detail identitas pelanggan, informasi teknis kWh meter, dan riwayat layanan kelistrikan.</p>
        </div>

        <!-- Konten Profil Konsumen -->
        <div class="row">
            <!-- Kolom Kiri: Kartu Identitas Ringkas -->
            <div class="col-lg-4 mb-4">
                <div class="profile-card text-center p-4">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="avatar-container">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">Aya Atviana</h5>
                    <p class="text-muted small mb-3"><i class="bi bi-upc-scan me-1"></i> ID Pelanggan: <strong>541209882103</strong></p>
                    <span class="badge-daya"><i class="bi bi-lightning-fill me-1"></i> Daya: 2.200 VA (Pascabayar)</span>

                    <hr class="my-4">

                    <div class="text-start">
                        <div class="mb-3">
                            <span class="info-label">Tarif / Golongan</span>
                            <div class="info-value">R-2 / Rumah Tangga Menengah</div>
                        </div>
                        <div class="mb-3">
                            <span class="info-label">Status Pelanggan</span>
                            <div class="info-value text-success"><i class="bi bi-check-circle-fill me-1"></i> Aktif / Berlangganan</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Informasi Detail & Riwayat Pengaduan Konsumen -->
            <div class="col-lg-8">
                <div class="profile-card p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2"><i class="bi bi-info-circle text-primary me-2"></i>Informasi Kontak & Lokasi</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <span class="info-label">Nomor Telepon / WhatsApp</span>
                            <div class="info-value">0812-3456-7890</div>
                        </div>
                        <div class="col-md-6">
                            <span class="info-label">Email Terdaftar</span>
                            <div class="info-value">aya.atviana@gmail.com</div>
                        </div>
                        <div class="col-12">
                            <span class="info-label">Alamat Instalasi / Lokasi Layanan</span>
                            <div class="info-value"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Jl. Bukit Pakis Timur I, Dukuh Pakis, Kec. Dukuhpakis, Surabaya</div>
                        </div>
                        <div class="col-md-6">
                            <span class="info-label">Unit Area PLN (UP3)</span>
                            <div class="info-value">UP3 Surabaya Selatan</div>
                        </div>
                        <div class="col-md-6">
                            <span class="info-label">Unit Layanan (ULP)</span>
                            <div class="info-value">ULP Dukuh Kupang</div>
                        </div>
                    </div>
                </div>

                <!-- Bagian Riwayat Keluhan Konsumen Ini -->
                <div class="profile-card p-4">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2"><i class="bi bi-clock-history text-primary me-2"></i>Riwayat Pengaduan Konsumen</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                            <thead class="table-light">
                                <tr>
                                    <th>No Tiket</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Kendala</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-semibold">#PLN-2026-081</td>
                                    <td>12 Feb 2026</td>
                                    <td>Gangguan Aliran Listrik (Padam)</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">#PLN-2026-042</td>
                                    <td>05 Jan 2026</td>
                                    <td>MCB Sering Turun (Anjlok)</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
