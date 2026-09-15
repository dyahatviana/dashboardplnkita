<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengaduan - PLN UP3 Surabaya Selatan</title>
    <!-- Load Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Load Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Load DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Load SheetJS untuk Export CSV -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

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

        /* Button Enterprise Style (Diperkecil & Warna Soft) */
        .btn-enterprise-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.85rem;
            border-radius: 6px;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-enterprise-outline {
            border: 1px solid #cbd5e1;
            color: #334155;
            background: white;
        }
        .btn-enterprise-outline:hover { background: #f1f5f9; color: #0f172a; }

        /* Custom Warna Hijau Soft untuk Export CSV */
        .btn-enterprise-success {
            background-color: #10b981; /* Soft Emerald Green */
            color: white;
            border: none;
            box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);
        }
        .btn-enterprise-success:hover {
            background-color: #059669;
            color: white;
        }

        .btn-enterprise-primary {
            background-color: #2563eb;
            color: white;
            border: none;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }
        .btn-enterprise-primary:hover { background-color: #1d4ed8; color: white; }

        /* Desain Tabel Enterprise */
        .table-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
        }

        .table-custom thead th {
            background-color: #f8fafc;
            color: #64748b;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            font-weight: 700;
            padding-top: 1rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-custom tbody td {
            color: #334155;
            font-size: 0.9rem;
            vertical-align: middle;
            padding-top: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .id-laporan {
            color: #2563eb;
            font-weight: 600;
            background: #eff6ff;
            padding: 4px 8px;
            border-radius: 6px;
            font-family: monospace;
            font-size: 0.95rem;
        }

        /* Soft Badges */
        .badge-soft {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8rem;
            letter-spacing: 0.3px;
        }
        .badge-soft-menunggu { background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0;}
        .badge-soft-diproses { background-color: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd;}
        .badge-soft-selesai  { background-color: #dcfce3; color: #166534; border: 1px solid #bbf7d0;}

        /* Modifikasi DataTables */
        .dataTables_wrapper .row { margin-bottom: 1rem; }
        div.dataTables_filter input {
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 0.375rem 0.75rem;
        }
        div.dataTables_filter input:focus {
            border-color: #38bdf8;
            outline: none;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
        }

        /* Modifikasi Form Input di Panel Filter */
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #cbd5e1;
        }
        .form-control:focus, .form-select:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
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
            <li class="nav-item"><a href="/data-pengaduan" class="nav-link active"><i class="bi bi-table me-3"></i> Data Pengaduan</a></li>
            <li class="nav-item"><a href="/rekapitulasi" class="nav-link"><i class="bi bi-file-bar-graph me-3"></i> Rekapitulasi</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-person-circle me-3"></i> Profil Tim</a></li>
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
                    <li class="breadcrumb-item active" aria-current="page">Master Data Pengaduan</li>
                </ol>
            </nav>
        </div>

        <!-- Header Halaman & Action Buttons -->
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h3 class="fw-bolder text-dark mb-1">Daftar Pengaduan Pelanggan</h3>
                <p class="text-secondary mb-0">Rekapitulasi komprehensif data pengaduan pelanggan guna mendukung proses pemantauan dan evaluasi pelayanan.</p>
            </div>
            <div class="d-flex gap-2">
                <!-- Tombol Filter Ukuran Ringkas -->
                <button class="btn btn-enterprise-sm btn-enterprise-outline" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilter">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <!-- Tombol Export CSV Warna Hijau Soft -->
                <button class="btn btn-enterprise-sm btn-enterprise-success" onclick="exportCSV()">
                    <i class="bi bi-cloud-download me-1"></i> Export .CSV
                </button>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="card table-card p-4">
            <div class="table-responsive">
                <table id="tabelPengaduan" class="table table-hover table-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">ID Laporan</th>
                            <th width="15%">Tgl Masuk</th>
                            <th width="25%">Kategori Gangguan</th>
                            <th width="20%">Wilayah</th>
                            <th width="20%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengaduans as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="id-laporan">{{ $data->id_pengaduan }}</span></td>
                            <td>
                                <div class="fw-semibold">{{ \Carbon\Carbon::parse($data->tanggal_masuk)->format('d M Y') }}</div>
                            </td>
                            <td>
                                <span class="text-dark fw-medium">{{ $data->jenis_pengaduan }}</span>
                            </td>
                            <td><i class="bi bi-geo-alt text-secondary me-1"></i> {{ $data->wilayah }}</td>
                            <td data-search="{{ $data->status_penyelesaian }}">
                                @if($data->status_penyelesaian == 'Menunggu')
                                    <span class="badge-soft badge-soft-menunggu"><i class="bi bi-hourglass-split me-1"></i> Menunggu</span>
                                @elseif($data->status_penyelesaian == 'Sedang Diproses')
                                    <span class="badge-soft badge-soft-diproses"><i class="bi bi-arrow-repeat me-1"></i> Diproses</span>
                                @else
                                    <span class="badge-soft badge-soft-selesai"><i class="bi bi-check2-circle me-1"></i> Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- PANEL FILTER (OFFCANVAS) DARI KANAN -->
<div class="offcanvas offcanvas-end shadow" tabindex="-1" id="offcanvasFilter" aria-labelledby="offcanvasFilterLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold text-dark" id="offcanvasFilterLabel"><i class="bi bi-funnel-fill text-primary me-2"></i> Filter Data Pengaduan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form id="formFilter">
            <!-- Filter Status -->
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary small text-uppercase">Status Penyelesaian</label>
                <select id="filterStatus" class="form-select">
                    <option value="" selected>Semua Status</option>
                    <option value="Menunggu">Menunggu</option>
                    <option value="Sedang Diproses">Sedang Diproses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>

            <!-- Filter Kategori -->
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary small text-uppercase">Kategori Gangguan</label>
                <select id="filterKategori" class="form-select">
                    <option value="" selected>Semua Kategori</option>
                    <option value="Gangguan Listrik">Gangguan Listrik</option>
                    <option value="Padam Listrik">Padam Listrik</option>
                    <option value="Kerusakan Meter">Kerusakan Meter</option>
                    <option value="Tegangan Tidak Normal">Tegangan Tidak Normal</option>
                </select>
            </div>

            <!-- Filter Wilayah -->
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary small text-uppercase">Wilayah / Area</label>
                <select id="filterWilayah" class="form-select">
                    <option value="" selected>Semua Wilayah</option>
                    <option value="Wonokromo">Wonokromo</option>
                    <option value="Gayungan">Gayungan</option>
                    <option value="Jambangan">Jambangan</option>
                    <option value="Wiyung">Wiyung</option>
                    <option value="Dukuh Pakis">Dukuh Pakis</option>
                    <option value="Sukomanunggal">Sukomanunggal</option>
                    <option value="Wonocolo">Wonocolo</option>
                </select>
            </div>

            <!-- Filter Tanggal -->
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary small text-uppercase">Rentang Tanggal Masuk</label>
                <div class="row g-2">
                    <div class="col-6">
                        <input type="date" id="filterStartDate" class="form-control" title="Dari Tanggal">
                    </div>
                    <div class="col-6">
                        <input type="date" id="filterEndDate" class="form-control" title="Sampai Tanggal">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="offcanvas-footer p-3 border-top d-flex gap-2 bg-light">
        <button type="button" class="btn btn-enterprise-outline w-50" onclick="resetFilter()">Reset Filter</button>
        <button type="button" class="btn btn-enterprise-primary w-50" onclick="terapkanFilter()">Terapkan</button>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Skrip Logika Filter & Export CSV -->
<script>
    var tabelData;

    $(document).ready(function() {
        tabelData = $('#tabelPengaduan').DataTable({
            language: {
                search: "",
                searchPlaceholder: "Cari ID atau nama...",
                lengthMenu: "Tampilkan _MENU_ baris",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data yang sesuai dengan filter",
                zeroRecords: "Data tidak ditemukan. Silakan sesuaikan filter Anda.",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "→",
                    previous: "←"
                }
            },
            ordering: true,
            pageLength: 10,
            dom: "<'row align-items-center'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-flex justify-content-end'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row align-items-center mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>"
        });

        // Ekstensi khusus DataTables untuk memfilter rentang tanggal
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#filterStartDate').val();
                var max = $('#filterEndDate').val();
                var dateStr = data[2]; // Index 2 adalah kolom Tanggal Masuk

                if (!min && !max) { return true; }

                var rowDate = new Date(dateStr);
                var minDate = min ? new Date(min) : null;
                var maxDate = max ? new Date(max) : null;

                if (
                    (minDate === null && rowDate <= maxDate) ||
                    (minDate <= rowDate && maxDate === null) ||
                    (minDate <= rowDate && rowDate <= maxDate)
                ) {
                    return true;
                }
                return false;
            }
        );
    });

    // Fungsi saat tombol "Terapkan" diklik
    function terapkanFilter() {
        var status = $('#filterStatus').val();
        var kategori = $('#filterKategori').val();
        var wilayah = $('#filterWilayah').val();

        tabelData.column(5).search(status);
        tabelData.column(3).search(kategori);
        tabelData.column(4).search(wilayah);
        tabelData.draw();

        var myOffcanvas = document.getElementById('offcanvasFilter');
        var bsOffcanvas = bootstrap.Offcanvas.getInstance(myOffcanvas);
        bsOffcanvas.hide();
    }

    // Fungsi saat tombol "Reset Filter" diklik
    function resetFilter() {
        $('#formFilter')[0].reset();
        tabelData.column(5).search('');
        tabelData.column(3).search('');
        tabelData.column(4).search('');
        tabelData.draw();

        var myOffcanvas = document.getElementById('offcanvasFilter');
        var bsOffcanvas = bootstrap.Offcanvas.getInstance(myOffcanvas);
        bsOffcanvas.hide();
    }

    // Fungsi untuk Export Tabel ke File CSV menggunakan SheetJS
    function exportCSV() {
        let table = document.getElementById("tabelPengaduan");
        let workbook = XLSX.utils.table_to_book(table, { sheet: "Data Pengaduan" });
        XLSX.writeFile(workbook, "Data_Pengaduan_PLN_UP3_SBY.csv");
    }
</script>

</body>
</html>
