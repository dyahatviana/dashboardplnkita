<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Monitoring - ULP Dukuh Kupang')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --sidebar-width-collapsed: 88px;
            --sidebar-width-expanded: 280px;
            --sidebar-bg: linear-gradient(180deg, #0b1c3d 0%, #040a18 100%);
            --accent-blue: #2563eb;
            --accent-gradient: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%);
            --accent-gradient-hover: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
        }

        body {
            background-color: #f8fafc;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            color: #334155;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            position: relative;
        }

        /* Desain Sidebar */
        #sidebar {
            min-width: var(--sidebar-width-collapsed);
            max-width: var(--sidebar-width-collapsed);
            min-height: 100vh;
            background: var(--sidebar-bg);
            color: #f8fafc;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 4px 0 25px rgba(0, 0, 0, 0.12);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1050;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        #sidebar.expanded {
            min-width: var(--sidebar-width-expanded);
            max-width: var(--sidebar-width-expanded);
        }

        .sidebar-text {
            display: none;
            white-space: nowrap;
        }
        #sidebar.expanded .sidebar-text {
            display: inline-block;
        }

        .sidebar-brand-full, .sidebar-footer-full {
            display: none;
        }
        #sidebar.expanded .sidebar-brand-full,
        #sidebar.expanded .sidebar-footer-full {
            display: block;
        }

        .sidebar-brand-icon, .sidebar-footer-icon {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #sidebar.expanded .sidebar-brand-icon,
        #sidebar.expanded .sidebar-footer-icon {
            display: none;
        }

        #sidebar .nav-link {
            color: #94a3b8;
            border-radius: 12px;
            margin-bottom: 6px;
            padding: 12px 16px;
            font-weight: 500;
            font-size: 0.92rem;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 14px;
            white-space: nowrap;
        }

        #sidebar .nav-link i {
            font-size: 1.25rem;
            min-width: 24px;
            text-align: center;
        }

        #sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.06);
            color: #ffffff;
            transform: translateX(4px);
        }

        #sidebar .nav-link.active {
            background: var(--accent-gradient);
            color: #ffffff;
            box-shadow: 0 4px 16px rgba(29, 78, 216, 0.4);
            font-weight: 600;
            border-left: 4px solid #93c5fd;
        }

        /* Styling Khusus Tombol Logout Sidebar */
        .sidebar-logout-btn {
            color: #fb7185 !important;
            background: rgba(244, 63, 94, 0.04);
            border: 1px solid rgba(244, 63, 94, 0.12) !important;
            border-radius: 12px;
            margin-bottom: 6px;
            padding: 12px 16px;
            font-weight: 600;
            font-size: 0.92rem;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 14px;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .sidebar-logout-btn i {
            font-size: 1.25rem;
            min-width: 24px;
            text-align: center;
            color: #f43f5e;
            transition: transform 0.2s ease;
        }

        .sidebar-logout-btn:hover {
            background: rgba(244, 63, 94, 0.12) !important;
            color: #ffe4e6 !important;
            border-color: rgba(244, 63, 94, 0.3) !important;
            transform: translateX(4px);
            box-shadow: 0 4px 15px rgba(244, 63, 94, 0.2);
        }

        .sidebar-logout-btn:hover i {
            transform: scale(1.1);
        }

        /* PERUBAHAN UTAMA: Agar main-content menjadi flex kolom penuh dan footer menempel di bawah */
        .main-content {
            flex-grow: 1;
            padding: 2.25rem 2.5rem;
            width: 100%;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            margin-left: var(--sidebar-width-collapsed);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .wrapper.sidebar-expanded .main-content {
            margin-left: var(--sidebar-width-expanded);
        }

        .sidebar-brand-box {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: white;
            border-radius: 16px;
            backdrop-filter: blur(10px);
        }

        /* Tombol Garis 3 Berwarna */
        .sidebar-toggler-btn {
            background: var(--accent-gradient);
            color: #ffffff;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .sidebar-toggler-btn:hover {
            background: var(--accent-gradient-hover);
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.45);
            color: #ffffff;
        }

        .sidebar-toggler-btn:active {
            transform: translateY(0) scale(0.98);
        }

        .top-header-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        .top-header-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            height: 60%;
            width: 4px;
            background: var(--accent-gradient);
            border-radius: 0 4px 4px 0;
        }

        .page-title-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .btn-primary, .btn-info, button[type="submit"].btn-primary {
            background: var(--accent-gradient) !important;
            border: none !important;
            color: #ffffff !important;
            font-weight: 500;
            border-radius: 12px !important;
            padding: 0.55rem 1.25rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .btn-primary:hover, .btn-info:hover {
            background: var(--accent-gradient-hover) !important;
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4) !important;
            transform: translateY(-2px) !important;
        }

        .card {
            border: none;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.04);
            border-radius: 1rem;
        }

        .btn-modern-danger {
            background-color: #f43f5e !important;
            border: none !important;
            border-radius: 12px !important;
            transition: all 0.25s ease-in-out !important;
        }
        .btn-modern-danger:hover {
            background-color: #e11d48 !important;
            box-shadow: 0 4px 14px rgba(244, 63, 94, 0.35) !important;
            transform: translateY(-1px);
        }

        .pagination svg {
            width: 14px !important;
            height: 14px !important;
            max-width: 14px !important;
            max-height: 14px !important;
            vertical-align: middle;
        }

        @media (max-width: 768px) {
            .main-content { padding: 1.25rem 1rem; margin-left: var(--sidebar-width-collapsed) !important; }
            .wrapper.sidebar-expanded .main-content { margin-left: var(--sidebar-width-collapsed) !important; }
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="wrapper sidebar-expanded" id="pageWrapper">
    <!-- SIDEBAR -->
    <nav id="sidebar" class="expanded p-3 d-flex flex-column">

        <!-- LOGO & BRAND -->
        <div class="mb-4 text-center">
            <div class="d-flex justify-content-center align-items-center py-1">
                <div class="p-2 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10 shadow-sm">
                    <img src="{{ asset('images/logo-pln.jpeg') }}" alt="Logo PLN" style="width: 36px; height: auto; object-fit: contain;" onerror="this.src='https://via.placeholder.com/40?text=PLN'">
                </div>
            </div>

            <div class="sidebar-brand-full sidebar-brand-box p-3 mt-3 text-center">
                <div class="d-flex flex-column lh-1">
                    <span class="fw-bold text-white mb-2" style="font-size: 0.95rem; letter-spacing: 0.5px;">ULP DUKUH KUPANG</span>
                    <span class="fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.5px; color: #93c5fd;">UP3 SURABAYA SELATAN</span>
                </div>
            </div>
        </div>

        <!-- MENU NAVIGASI -->
        <ul class="nav flex-column mb-auto w-100">
            @if(auth()->user()->role === 'cs')
                <li class="nav-item">
                    <a href="{{ route('cs.permohonan.index') }}"
                    class="nav-link {{ request()->is('cs/permohonan') || (request()->is('cs/permohonan/*') && !request()->is('cs/permohonan/baru')) ? 'active' : '' }}" title="Permohonan">
                        <i class="bi bi-grid-fill"></i>
                        <span class="sidebar-text">Permohonan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cs.permohonan.baru') }}"
                    class="nav-link {{ request()->is('cs/permohonan/baru') ? 'active' : '' }}" title="Input Permohonan">
                        <i class="bi bi-file-earmark-plus-fill"></i>
                        <span class="sidebar-text">Input Permohonan</span>
                    </a>
                </li>
            @elseif(auth()->user()->role === 'backoffice')
                <li class="nav-item">
                    <a href="{{ route('pegawai.index') }}"
                    class="nav-link {{ request()->is('pegawai') ? 'active' : '' }}" title="Dashboard Pegawai">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span class="sidebar-text">Dashboard Pegawai</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pegawai.index') }}"
                    class="nav-link {{ request()->is('pegawai/tugas*') ? 'active' : '' }}" title="Tugas Masuk">
                        <i class="bi bi-list-task"></i>
                        <span class="sidebar-text">Tugas Masuk</span>
                    </a>
                </li>
            @endif
        </ul>

        <!-- PROFIL & LOGOUT -->
        <div class="mt-auto pt-3 border-top border-secondary border-opacity-10">

            <!-- Mode Ringkas (Saat Sidebar Ditutup) -->
            <div class="sidebar-footer-icon text-center mb-3">
                <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold shadow-sm mx-auto" style="width: 42px; height: 42px; font-size: 0.95rem; background: var(--accent-gradient);">
                    {{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}
                </div>
            </div>

            <!-- Mode Lengkap (Saat Sidebar Dibuka) -->
            <div class="sidebar-footer-full mb-3 px-2">
                <div class="p-2.5 rounded-3 d-flex align-items-center gap-3" style="background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08); backdrop-filter: blur(8px);">
                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold shadow-sm flex-shrink-0" style="width: 40px; height: 40px; font-size: 0.9rem; background: var(--accent-gradient);">
                        {{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <div class="fw-semibold text-white text-truncate" style="font-size: 0.9rem; letter-spacing: 0.2px;">
                            {{ auth()->user()->name ?? 'User PLN' }}
                        </div>
                        <div class="d-flex align-items-center gap-1 mt-0.5">
                            <span class="inline-block rounded-circle" style="width: 6px; height: 6px; background-color: #38bdf8;"></span>
                            <span style="font-size: 0.72rem; color: #93c5fd; font-weight: 500;">
                                @if(auth()->user()->role === 'backoffice')
                                    Admin PLN ULP
                                @elseif(auth()->user()->role === 'cs')
                                    Customer Service PLN ULP
                                @else
                                    User PLN ULP
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Logout -->
            <button type="button" class="sidebar-logout-btn" data-bs-toggle="modal" data-bs-target="#logoutModal" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
                <span class="sidebar-text">Logout</span>
            </button>
        </div>

        <div class="text-center text-white-50 mt-2 sidebar-text" style="font-size: 0.68rem; letter-spacing: 0.3px;">
            &copy; 2026 Telkom University SBY
        </div>
    </nav>

    <!-- MAIN CONTENT AREA -->
    <div class="main-content">

        <!-- HEADER UTAMA -->
        <div class="card top-header-card shadow-sm rounded-4 mb-4 p-3">
            <div class="d-flex align-items-center gap-3 ps-2">
                <button type="button" class="sidebar-toggler-btn" id="sidebarToggleBtn" title="Buka/Tutup Sidebar">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <div>
                    <h4 class="fw-bold text-dark mb-0" style="font-size: 1.15rem; letter-spacing: -0.2px;">DASHBOARD PLN UP3 SURABAYA SELATAN</h4>
                    <p class="text-secondary mb-0" style="font-size: 0.82rem;">Kelola dan Pantau Aktivitas Layanan Pelanggan.</p>
                </div>
            </div>
        </div>

        <!-- ISI KONTEN DINAMIS -->
        <div class="flex-grow-1">
            @yield('content')
        </div>

        <!-- FOOTER KUSTOM DI BAWAH HALAMAN UTAMA -->
        <footer class="w-full py-4 mt-5 bg-white border-top border-slate-200 rounded-4 shadow-sm px-4">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 text-center text-md-start">

                <!-- Identitas / Logo PLN & Kampus -->
                <div class="d-flex align-items-center gap-3 justify-content-center justify-content-md-start">
                    <div class="d-flex align-items-center gap-2 bg-primary bg-opacity-10 px-3 py-1.5 rounded-3 border border-primary border-opacity-25">
                        <span class="fw-bold tracking-wider text-primary" style="font-size: 0.9rem;">PLN</span>
                        <span class="text-muted small border-start border-primary border-opacity-25 ps-2">Persero</span>
                    </div>

                    <div class="d-flex align-items-center gap-2 bg-warning bg-opacity-10 px-3 py-1.5 rounded-3 border border-warning border-opacity-25">
                        <span class="fw-bold text-warning-emphasis" style="font-size: 0.85rem;">KAMPUS</span>
                        <span class="text-muted small border-start border-warning border-opacity-25 ps-2">Mitra Energi</span>
                    </div>
                </div>

                <!-- Kata Mutiara -->
                <div class="text-muted fst-italic small max-w-md">
                    "Energi terbaik bukan hanya yang mengalir menyinari negeri, tetapi juga semangat kolaborasi ilmu dan teknologi."
                </div>

                <!-- Copyright -->
                <div class="text-muted small">
                    &copy; {{ date('Y') }} PLN ULP Dukuh Kupang.
                </div>
            </div>
        </footer>

    </div>
</div>

<!-- MODAL KONFIRMASI LOGOUT -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 p-3">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="logoutModalLabel">
                    <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i> Konfirmasi Keluar
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-secondary fs-6 py-4">
                Apakah Anda yakin ingin keluar dari aplikasi? Sesi Anda akan diakhiri.
            </div>
            <div class="modal-footer border-0 pt-0 gap-2">
                <button type="button" class="btn btn-light px-4 rounded-3 fw-semibold text-secondary" data-bs-dismiss="modal" style="background-color: #f1f5f9;">
                    Batal
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn px-4 rounded-3 fw-semibold text-white btn-modern-danger shadow-sm">
                        Ya, Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sidebar = document.getElementById('sidebar');
    const pageWrapper = document.getElementById('pageWrapper');
    const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');

    const savedState = localStorage.getItem('sidebarExpanded');
    if (savedState === 'false') {
        sidebar.classList.remove('expanded');
        pageWrapper.classList.remove('sidebar-expanded');
    } else {
        sidebar.classList.add('expanded');
        pageWrapper.classList.add('sidebar-expanded');
    }

    sidebarToggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('expanded');
        pageWrapper.classList.toggle('sidebar-expanded');
        const isExpanded = sidebar.classList.contains('expanded');
        localStorage.setItem('sidebarExpanded', isExpanded);
    });
</script>
@stack('scripts')
</body>
</html>
