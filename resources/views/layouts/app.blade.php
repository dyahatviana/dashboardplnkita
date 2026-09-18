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
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Styling tombol merah modern dengan efek transisi interaktif */
        .btn-modern-danger {
            background-color: #e11d48 !important; 
            border: none !important;
            transition: all 0.2s ease-in-out !important;
        }
        .btn-modern-danger:hover {
            background-color: #be123c !important; 
            transform: translateY(-1px);
        }
        .btn-modern-danger:active,
        .btn-modern-danger:focus {
            background-color: #9f1239 !important; 
            box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.3) !important; 
            transform: translateY(0);
        }
        .btn-outline-primary:hover {
            background-color: #0066cc !important;
            color: #ffffff !important;
            border-color: #0066cc !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 102, 204, 0.2) !important;
        }

        /* Global Pagination Safety Styling */
        .pagination svg {
            width: 14px !important;
            height: 14px !important;
            max-width: 14px !important;
            max-height: 14px !important;
            vertical-align: middle;
        }

        :root {
            --sidebar-width-collapsed: 80px;
            --sidebar-width-expanded: 280px;
        }

        body {
            background-color: #f1f5f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            color: #0f172a;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            position: relative;
        }

        /* Desain Sidebar ala Gemini */
        #sidebar {
            min-width: var(--sidebar-width-collapsed);
            max-width: var(--sidebar-width-collapsed);
            min-height: 100vh;
            background: linear-gradient(180deg, #090d16 0%, #0f172a 100%);
            color: #f8fafc;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1050;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Saat sidebar dibuka/expanded */
        #sidebar.expanded {
            min-width: var(--sidebar-width-expanded);
            max-width: var(--sidebar-width-expanded);
        }

        /* Atur visibilitas teks saat mode collapsed vs expanded */
        .sidebar-text {
            display: none;
            white-space: nowrap;
        }
        #sidebar.expanded .sidebar-text {
            display: inline-block;
        }

        /* Sembunyikan elemen box lengkap saat collapsed */
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
            color: rgba(255, 255, 255, 0.75);
            border-radius: 12px;
            margin-bottom: 8px;
            padding: 12px 16px;
            font-weight: 500;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 16px;
            white-space: nowrap;
        }

        #sidebar .nav-link i {
            font-size: 1.25rem;
            min-width: 24px;
            text-align: center;
        }

        #sidebar .nav-link:hover {
            background: rgba(0, 102, 204, 0.15);
            color: #ffffff;
        }

        #sidebar .nav-link.active {
            background: linear-gradient(135deg, #002b5c 0%, #0055b3 100%);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 85, 179, 0.35);
            font-weight: 600;
        }

        .main-content {
            flex-grow: 1;
            padding: 2rem 2.5rem;
            width: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-left: var(--sidebar-width-collapsed);
        }

        .wrapper.sidebar-expanded .main-content {
            margin-left: var(--sidebar-width-expanded);
        }

        .sidebar-brand-box {
            background: linear-gradient(135deg, #002b5c 0%, #0055b3 100%);
            color: white;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 43, 92, 0.25);
            cursor: pointer;
        }

        /* Logo PLN Tanpa Kotak Putih (Transparan/Menyatu) */
        .pln-logo-clickable {
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        .pln-logo-clickable:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .main-content { padding: 1.25rem 1rem; margin-left: var(--sidebar-width-collapsed) !important; }
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="wrapper" id="pageWrapper">
    <!-- SIDEBAR -->
    <nav id="sidebar" class="p-3 d-flex flex-column">
        
        <!-- BAGIAN ATAS: LOGO PLN (Tombol Toggle Sidebar Tanpa Background Putih) -->
        <div class="mb-4 text-center">
            <div class="d-flex justify-content-center align-items-center py-2">
                <img src="{{ asset('images/logo-pln.jpeg') }}" alt="Logo PLN" class="pln-logo-clickable" id="plnLogoToggle" style="width: 38px; height: auto; object-fit: contain;" title="Buka/Tutup Sidebar" onerror="this.src='https://via.placeholder.com/40?text=PLN'">
            </div>

            <!-- Tampilan Lengkap Brand saat Sidebar Terbuka -->
            <div class="sidebar-brand-full sidebar-brand-box p-3 mt-2 text-center">
                <div class="d-flex flex-column lh-1">
                    <span class="fw-bold text-white mb-2" style="font-size: 0.95rem; letter-spacing: 0.5px;">ULP DUKUH KUPANG</span>
                    <span class="text-info fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.5px;">UP3 SURABAYA SELATAN</span>
                </div>
            </div>
        </div>

        <!-- MENU NAVIGASI BERDASARKAN ROLE -->
        <ul class="nav flex-column mb-auto w-100">

            @if(auth()->user()->role === 'cs')

                {{-- MENU KHUSUS CUSTOMER SERVICE --}}
                <li class="nav-item">
                    <a href="{{ route('cs.permohonan.index') }}"
                    class="nav-link {{ request()->is('cs/permohonan*') ? 'active' : '' }}" title="Permohonan">
                        <i class="bi bi-archive"></i>
                        <span class="sidebar-text">Permohonan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cs.permohonan.baru') }}"
                    class="nav-link {{ request()->is('cs/permohonan/baru') ? 'active' : '' }}" title="Input Permohonan">
                        <i class="bi bi-pencil-square"></i>
                        <span class="sidebar-text">Input Permohonan</span>
                    </a>
                </li>

            @elseif(auth()->user()->role === 'backoffice')

                {{-- MENU KHUSUS ADMIN / PEGAWAI (BACKOFFICE) --}}
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

        <!-- BAGIAN BAWAH: PROFIL PEGAWAI & LOGOUT -->
        <div class="mt-auto pt-3 border-top border-secondary border-opacity-25">
            
            <!-- Mode Ringkas (Hanya Ikon Inisial) -->
            <div class="sidebar-footer-icon text-center mb-3">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold shadow-sm mx-auto" style="width: 40px; height: 40px; font-size: 0.9rem;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}
                </div>
            </div>

            <!-- Mode Lengkap (Nama & Label Role Dinamis) -->
            <div class="sidebar-footer-full mb-3 px-2">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold shadow-sm flex-shrink-0" style="width: 38px; height: 38px; font-size: 0.85rem;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <div class="fw-semibold text-white text-truncate" style="font-size: 0.9rem;">
                            {{ auth()->user()->name ?? 'User PLN' }}
                        </div>
                        <small class="text-info" style="font-size: 0.7rem;">
                            @if(auth()->user()->role === 'backoffice')
                                Admin PLN ULP
                            @elseif(auth()->user()->role === 'cs')
                                Customer Service PLN ULP
                            @else
                                User PLN ULP
                            @endif
                        </small>
                    </div>
                </div>
            </div>

            <!-- Tombol Logout -->
            <button type="button" class="nav-link w-100 text-start text-danger border-0 bg-transparent fw-semibold" data-bs-toggle="modal" data-bs-target="#logoutModal" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
                <span class="sidebar-text">Logout</span>
            </button>
        </div>

        <div class="text-center text-white-50 mt-2 sidebar-text" style="font-size: 0.7rem;">
            &copy; 2026 Telkom University SBY
        </div>
    </nav>

    <!-- MAIN CONTENT AREA -->
    <div class="main-content">
        @yield('content')
    </div>
</div> <!-- Penutup .wrapper -->

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

                <!-- Form Logout -->
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
    const plnLogoToggle = document.getElementById('plnLogoToggle');

    plnLogoToggle.addEventListener('click', function() {
        sidebar.classList.toggle('expanded');
        pageWrapper.classList.toggle('sidebar-expanded');
    });
</script>
@stack('scripts')
</body>
</html>