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
                background-color: #e11d48 !important; /* Warna dasar: Merah Rose Modern (Tailwind rose-600) */
                border: none !important;
                transition: all 0.2s ease-in-out !important;
            }

            /* Saat kursor diarahkan (Hover) */
            .btn-modern-danger:hover {
                background-color: #be123c !important; /* Menjadi sedikit lebih gelap & elegan */
                transform: translateY(-1px);
            }

            /* Saat tombol diklik (Active / Dipetik) */
            .btn-modern-danger:active,
            .btn-modern-danger:focus {
                background-color: #9f1239 !important; /* Menjadi semakin pekat saat ditekan */
                box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.3) !important; /* Efek ring glow modern */
                transform: translateY(0);
            }
        .btn-outline-primary:hover {
        background-color: #0066cc !important;
        color: #ffffff !important;
        border-color: #0066cc !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 102, 204, 0.2) !important;
    }

        :root {
            --sidebar-width: 280px;
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

        /* Desain Sidebar */
        #sidebar {
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, #090d16 0%, #0f172a 100%);
            color: #f8fafc;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1050;
            transform: translateX(-100%);
        }

        #sidebar.show {
            transform: translateX(0);
        }

        #sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            border-radius: 12px;
            margin-bottom: 8px;
            padding: 12px 18px;
            font-weight: 500;
            transition: all 0.25s ease;
            border: 1px solid transparent;
        }

        #sidebar .nav-link:hover {
            background: rgba(0, 102, 204, 0.15);
            color: #ffffff;
            transform: translateX(4px);
            border-color: rgba(0, 102, 204, 0.3);
        }

        #sidebar .nav-link.active {
            background: linear-gradient(135deg, #002b5c 0%, #0055b3 100%);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 85, 179, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.15);
            font-weight: 600;
        }

        .main-content {
            flex-grow: 1;
            padding: 2rem 2.5rem;
            width: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-left: 0;
        }

        .wrapper.sidebar-active .main-content {
            margin-left: var(--sidebar-width);
        }

        .sidebar-brand-box {
            background: linear-gradient(135deg, #002b5c 0%, #0055b3 100%);
            color: white;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 43, 92, 0.25);
        }

        #sidebarCollapse {
            background-color: #0066cc;
            border: 1px solid #0055b3;
            color: #ffffff;
            border-radius: 12px;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
            flex-shrink: 0;
        }
        #sidebarCollapse:hover {
            background-color: #0055b3;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .main-content { padding: 1.25rem 1rem; }
            .wrapper.sidebar-active .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="wrapper" id="pageWrapper">
    <!-- SIDEBAR -->
    <nav id="sidebar" class="p-3 d-flex flex-column">
        <div class="sidebar-brand-box text-center p-3 mb-4 mt-2">
            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center shadow-sm mb-2" style="width: 46px; height: 46px; background: rgba(255, 255, 255, 0.95); padding: 7px;">
                <img src="{{ asset('images/logo-pln.jpeg') }}" alt="Logo PLN" style="width: 100%; height: 100%; object-fit: contain;" onerror="this.src='https://via.placeholder.com/40?text=PLN'">
            </div>
            <div class="d-flex flex-column lh-1">
                <span class="fw-bold text-white mb-2" style="font-size: 0.95rem; letter-spacing: 0.5px;">ULP DUKUH KUPANG</span>
                <span class="text-info fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.5px;">UP3 SURABAYA SELATAN</span>
            </div>
        </div>

        <ul class="nav flex-column mb-auto w-100">

            @if(auth()->user()->role === 'cs')

                {{-- MENU CS --}}
                                <li class="nav-item">
                        <a href="{{ route('cs.permohonan.index') }}"
                        class="nav-link {{ request()->is('cs/permohonan') ? 'active' : '' }}">
                            <i class="bi bi-archive me-3"></i>
                            Permohonan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cs.permohonan.baru') }}"
                        class="nav-link {{ request()->is('cs/permohonan/baru') ? 'active' : '' }}">
                            <i class="bi bi-pencil-square me-3"></i>
                            Input Permohonan
                        </a>
                </li>

            @elseif(auth()->user()->role === 'backoffice')

                {{-- MENU PEGAWAI --}}
                <li class="nav-item">
                    <a href="{{ route('pegawai.index') }}"
                    class="nav-link {{ request()->is('pegawai') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill me-3"></i>
                        Dashboard Pegawai
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pegawai.index') }}"
                    class="nav-link {{ request()->is('pegawai*') ? 'active' : '' }}">
                        <i class="bi bi-list-task me-3"></i>
                        Tugas Masuk
                    </a>
                </li>

            @endif

        </ul>

        <!-- Tombol Logout yang memicu Modal -->
        <div class="mt-3">
            <button type="button" class="nav-link w-100 text-start text-danger border-0 bg-transparent fw-semibold" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right me-3"></i> Logout
            </button>
        </div>

        <hr class="border-secondary border-opacity-25 mt-3">
        <div class="text-center text-white-50" style="font-size: 0.75rem;">
            &copy; 2026 Kerja Praktik<br>Telkom University SBY
        </div>
    </nav>

    <!-- MAIN CONTENT AREA -->
    <div class="main-content">
        <!-- Global Top Bar: Dinamis sesuai halaman -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center bg-white p-3 px-4 rounded-4 shadow-sm mb-4 border-start border-4 border-primary gap-3">
            <div class="d-flex align-items-center gap-3">
                <button type="button" id="sidebarCollapse" class="btn shadow-sm" title="Buka/Tutup Sidebar">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <div>
                    <!-- Judul dengan ukuran besar -->
                    <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px; font-size: 1.75rem;">
                        @yield('header_title', 'Dashboard ULP Dukuh Kupang')
                    </h3>
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        @yield('header_desc', 'Kelola dan Pantau Aktivitas Layanan Pelanggan.')
                    </p>
                </div>
            </div>
            <div>
                @stack('header_action')
            </div>
        </div>

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

              <!-- Form Logout dengan Tombol Merah Modern & Interaktif -->
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
    const sidebarCollapseBtn = document.getElementById('sidebarCollapse');

    sidebarCollapseBtn.addEventListener('click', function() {
        sidebar.classList.toggle('show');
        pageWrapper.classList.toggle('sidebar-active');
    });
</script>
@stack('scripts')
</body>
</html>
