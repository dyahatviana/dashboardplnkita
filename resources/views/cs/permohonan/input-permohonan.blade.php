@extends('layouts.app')

@section('title', 'Form Input Permohonan Baru - ULP Dukuh Kupang')

@section('content')
<div class="container-fluid px-0">

    <!-- TOMBOL KEMBALI KE DAFTAR -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('cs.permohonan.index') }}" class="btn btn-outline-primary d-inline-flex align-items-center gap-2 px-4 py-2.5 rounded-3 shadow-sm fw-semibold transition-all fs-6" style="border-color: #0066cc; color: #0066cc;">
            <i class="bi bi-arrow-left"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <!-- FORM CARD DENGAN MODERN BLUE PALETTE -->
    <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5 bg-white position-relative overflow-hidden mb-5">
        <!-- Aksen Dekoratif Gradient Biru PLN -->
        <div class="position-absolute top-0 start-0 w-100" style="height: 5px; background: linear-gradient(90deg, #004b87, #0066cc, #0099ff);"></div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4 text-dark fs-6" role="alert" style="background-color: #fef2f2; border-left: 4px solid #dc3545 !important;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-4"></i>
                    <div>
                        <strong class="text-danger">Terjadi Kesalahan Validasi!</strong> Silakan periksa kembali isian form yang ditandai merah di bawah.
                    </div>
                </div>
                <ul class="mb-0 mt-2 ms-4 text-secondary small fs-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('cs.permohonan.store') }}" method="POST" id="formPermohonan">
            @csrf

            <div class="row g-4">
                <!-- Tanggal Permohonan -->
                <div class="col-md-6">
                    <label for="tanggal_permohonan" class="form-label fw-bold text-dark text-uppercase tracking-wider mb-2" style="font-size: 0.9rem;">
                        <i class="bi bi-calendar-event text-primary me-1"></i> Tanggal Permohonan
                    </label>
                    <div class="input-group input-group-lg">
                        <input type="date" class="form-control bg-light border-0 py-3 fs-5 @error('tanggal_permohonan') is-invalid @enderror" id="tanggal_permohonan" name="tanggal_permohonan" value="{{ old('tanggal_permohonan', date('Y-m-d')) }}" required>
                    </div>
                    @error('tanggal_permohonan')
                        <div class="invalid-feedback d-block fs-6">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ID Pelanggan -->
                <div class="col-md-6">
                    <label for="id_pelanggan" class="form-label fw-bold text-dark text-uppercase tracking-wider mb-2" style="font-size: 0.9rem;">
                        <i class="bi bi-upc-scan text-primary me-1"></i> ID Pelanggan
                    </label>
                    <div class="input-group input-group-lg">
                        <input type="text" id="id_pelanggan" name="id_pelanggan" class="form-control bg-light border-0 py-3 fs-5 @error('id_pelanggan') is-invalid @enderror" placeholder="Masukkan 12 digit ID Pelanggan" value="{{ old('id_pelanggan') }}" maxlength="12" required>
                        <button type="button" id="btn-cek-pelanggan" class="btn btn-primary px-4 fw-semibold" style="background-color: #0066cc; border: none;">
                            <i class="bi bi-search me-1"></i> Cek ID
                        </button>
                    </div>
                    @error('id_pelanggan')
                        <div class="invalid-feedback d-block fs-6">{{ $message }}</div>
                    @enderror

                    <!-- Box Preview Data Pemilik Asli dengan Tombol Salin Cepat -->
                    <div id="info-pelanggan" class="mt-3 p-3 rounded-3 bg-light border border-success-subtle shadow-sm" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="text-success fw-bold d-flex align-items-center gap-1">
                                <i class="bi bi-check-circle-fill"></i> Data Pemilik dari Database PLN:
                            </div>
                            <button type="button" id="btn-gunakan-data" class="btn btn-sm btn-success py-1 px-2 fw-semibold" style="font-size: 0.8rem;">
                                <i class="bi bi-arrow-down-circle me-1"></i> Gunakan Data Ini
                            </button>
                        </div>
                        <p class="mb-1 text-secondary"><strong>Nama Pemilik Meter:</strong> <span id="text-nama-db" class="text-dark fw-semibold"></span></p>
                        <p class="mb-0 text-secondary"><strong>Alamat Meter:</strong> <span id="text-alamat-db" class="text-dark fw-semibold"></span></p>
                    </div>
                </div>

                <!-- 1. NAMA PEMOHON (Diisi manual oleh CS) -->
                <div class="col-md-6">
                    <label for="nama_pemohon" class="form-label fw-bold text-dark text-uppercase tracking-wider mb-2" style="font-size: 0.9rem;">
                        <i class="bi bi-person text-primary me-1"></i> Nama Pemohon
                    </label>
                    <input type="text" class="form-control form-control-lg bg-light border-0 py-3 fs-5 @error('nama_pemohon') is-invalid @enderror" id="nama_pemohon" name="nama_pemohon" value="{{ old('nama_pemohon') }}" required placeholder="Ketik nama orang yang mengajukan...">
                    @error('nama_pemohon')
                        <div class="invalid-feedback fs-6">{{ $message }}</div>
                    @enderror
                </div>

                <!-- 2. NAMA PELANGGAN / PEMILIK METER (Dari database PLN / hasil Cek ID) -->
                <div class="col-md-6">
                    <label for="nama_pelanggan" class="form-label fw-bold text-dark text-uppercase tracking-wider mb-2" style="font-size: 0.9rem;">
                        <i class="bi bi-shield-check text-primary me-1"></i> Nama Pelanggan (Pemilik Meter PLN)
                    </label>
                    <input type="text" class="form-control form-control-lg bg-light border-0 py-3 fs-5 @error('nama_pelanggan') is-invalid @enderror" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" required placeholder="Otomatis terisi saat Cek ID atau ketik manual">
                    @error('nama_pelanggan')
                        <div class="invalid-feedback fs-6">{{ $message }}</div>
                    @enderror
                </div>

                <!-- No Telepon / HP -->
                <div class="col-md-6">
                    <label for="no_telepon" class="form-label fw-bold text-dark text-uppercase tracking-wider mb-2" style="font-size: 0.9rem;">
                        <i class="bi bi-telephone text-primary me-1"></i> No. Telepon / HP
                    </label>
                    <input type="text" class="form-control form-control-lg bg-light border-0 py-3 fs-5 @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required placeholder="Contoh: 08123456789" oninput="this.value = this.value.replace(/[^0-9+\-\s]/g, '')">
                    @error('no_telepon')
                        <div class="invalid-feedback fs-6">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Alamat Pemohon -->
                <div class="col-md-12">
                    <label for="alamat_pemohon" class="form-label fw-bold text-dark text-uppercase tracking-wider mb-2" style="font-size: 0.9rem;">
                        <i class="bi bi-geo-alt text-primary me-1"></i> Alamat Lokasi / Pemohon
                    </label>
                    <textarea class="form-control bg-light border-0 p-3 fs-5 @error('alamat_pemohon') is-invalid @enderror" id="alamat_pemohon" name="alamat_pemohon" rows="3" required placeholder="Ketik alamat lengkap lokasi/pemohon...">{{ old('alamat_pemohon') }}</textarea>
                    @error('alamat_pemohon')
                        <div class="invalid-feedback fs-6">{{ $message }}</div>
                    @enderror
                </div>

                @php
                    $listJenisPermohonan = ['Pasang Baru', 'Perubahan Daya', 'Penyambungan Sementara', 'Pengaduan/Keluhan'];
                    $oldJenis = old('jenis_permohonan');
                    $isJenisLainnya = $oldJenis && !in_array($oldJenis, $listJenisPermohonan);

                    $listDivisi = ['Teknik', 'Transaksi Energi', 'Pemasaran & Pelayanan Pelanggan', 'Keuangan & Umum'];
                    $oldDivisi = old('divisi_tujuan');
                    $isDivisiLainnya = $oldDivisi && !in_array($oldDivisi, $listDivisi);
                @endphp

                <!-- Jenis Permohonan -->
                <div class="col-md-4">
                    <label for="jenis_permohonan" class="form-label fw-bold text-dark text-uppercase tracking-wider mb-2" style="font-size: 0.9rem;">
                        <i class="bi bi-file-earmark-text text-primary me-1"></i> Jenis Permohonan
                    </label>
                    <select class="form-select form-select-lg bg-light border-0 py-3 fs-5 @error('jenis_permohonan') is-invalid @enderror" id="jenis_permohonan" name="jenis_permohonan" required onchange="cekDropdown('jenis_permohonan', 'wrapper_lainnya_jenis', 'jenis_permohonan_lainnya')">
                        <option value="" selected disabled>Pilih Jenis Permohonan...</option>
                        <option value="Pasang Baru" {{ ($oldJenis == 'Pasang Baru') ? 'selected' : '' }}>Pasang Baru</option>
                        <option value="Perubahan Daya" {{ ($oldJenis == 'Perubahan Daya') ? 'selected' : '' }}>Perubahan Daya</option>
                        <option value="Penyambungan Sementara" {{ ($oldJenis == 'Penyambungan Sementara') ? 'selected' : '' }}>Penyambungan Sementara</option>
                        <option value="Pengaduan/Keluhan" {{ ($oldJenis == 'Pengaduan/Keluhan') ? 'selected' : '' }}>Pengaduan/Keluhan</option>
                        <option value="Lainnya" {{ $isJenisLainnya ? 'selected' : '' }}>Lainnya...</option>
                    </select>

                    <div id="wrapper_lainnya_jenis" class="mt-2 {{ $isJenisLainnya ? '' : 'd-none' }}">
                        <input type="text" class="form-control bg-light border-0 py-2.5 fs-6" id="jenis_permohonan_lainnya" name="jenis_permohonan_lainnya" value="{{ $isJenisLainnya ? $oldJenis : old('jenis_permohonan_lainnya') }}" placeholder="Ketik jenis permohonan...">
                    </div>

                    @error('jenis_permohonan')
                        <div class="invalid-feedback fs-6 d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jenis Tarif -->
                <div class="col-md-4">
                    <label for="jenis_tarif" class="form-label fw-bold text-dark text-uppercase tracking-wider mb-2" style="font-size: 0.9rem;">
                        <i class="bi bi-lightning text-primary me-1"></i> Jenis Tarif
                    </label>
                    <select class="form-select form-select-lg bg-light border-0 py-3 fs-5 @error('jenis_tarif') is-invalid @enderror" id="jenis_tarif" name="jenis_tarif" required>
                        <option value="" selected disabled>Pilih Jenis Tarif...</option>
                        <option value="Prabayar" {{ old('jenis_tarif') == 'Prabayar' ? 'selected' : '' }}>Prabayar</option>
                        <option value="Pascabayar" {{ old('jenis_tarif') == 'Pascabayar' ? 'selected' : '' }}>Pascabayar</option>
                    </select>
                    @error('jenis_tarif')
                        <div class="invalid-feedback fs-6">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Divisi Tujuan -->
                <div class="col-md-4">
                    <label for="divisi_tujuan" class="form-label fw-bold text-dark text-uppercase tracking-wider mb-2" style="font-size: 0.9rem;">
                        <i class="bi bi-diagram-3 text-primary me-1"></i> Divisi Tujuan
                    </label>
                    <select class="form-select form-select-lg bg-light border-0 py-3 fs-5 @error('divisi_tujuan') is-invalid @enderror" id="divisi_tujuan" name="divisi_tujuan" required onchange="cekDropdown('divisi_tujuan', 'wrapper_lainnya_divisi', 'divisi_tujuan_lainnya')">
                        <option value="" selected disabled>Pilih Divisi Tujuan...</option>
                        <option value="Teknik" {{ ($oldDivisi == 'Teknik') ? 'selected' : '' }}>Teknik</option>
                        <option value="Transaksi Energi" {{ ($oldDivisi == 'Transaksi Energi') ? 'selected' : '' }}>Transaksi Energi</option>
                        <option value="Pemasaran & Pelayanan Pelanggan" {{ ($oldDivisi == 'Pemasaran & Pelayanan Pelanggan') ? 'selected' : '' }}>Pemasaran & Pelayanan Pelanggan</option>
                        <option value="Keuangan & Umum" {{ ($oldDivisi == 'Keuangan & Umum') ? 'selected' : '' }}>Keuangan & Umum</option>
                        <option value="Lainnya" {{ $isDivisiLainnya ? 'selected' : '' }}>Lainnya...</option>
                    </select>

                    <div id="wrapper_lainnya_divisi" class="mt-2 {{ $isDivisiLainnya ? '' : 'd-none' }}">
                        <input type="text" class="form-control bg-light border-0 py-2.5 fs-6" id="divisi_tujuan_lainnya" name="divisi_tujuan_lainnya" value="{{ $isDivisiLainnya ? $oldDivisi : old('divisi_tujuan_lainnya') }}" placeholder="Ketik nama divisi...">
                    </div>

                    @error('divisi_tujuan')
                        <div class="invalid-feedback fs-6 d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Detail Permohonan -->
                <div class="col-md-12">
                    <label for="detail_permohonan" class="form-label fw-bold text-dark text-uppercase tracking-wider mb-2" style="font-size: 0.9rem;">
                        <i class="bi bi-chat-left-text text-primary me-1"></i> Detail Permohonan / Keterangan
                    </label>
                    <textarea class="form-control bg-light border-0 p-3 fs-5 @error('detail_permohonan') is-invalid @enderror" id="detail_permohonan" name="detail_permohonan" rows="4" required placeholder="Tuliskan detail permohonan atau keluhan pelanggan secara spesifik...">{{ old('detail_permohonan') }}</textarea>
                    @error('detail_permohonan')
                        <div class="invalid-feedback fs-6">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex align-items-center justify-content-end gap-3 mt-5 pt-4 border-top border-light">
                <button type="reset" class="btn btn-light text-secondary border px-4 py-3 rounded-3 fw-semibold shadow-sm transition-all fs-6" style="background-color: #f8fafc;" onclick="resetSemuaLainnya()">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Form
                </button>
                <button type="submit" class="btn btn-primary px-5 py-3 rounded-3 shadow fw-semibold d-inline-flex align-items-center gap-2 fs-6" style="background: linear-gradient(135deg, #004b87 0%, #0066cc 100%); border: none;">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Simpan Permohonan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function cekDropdown(selectId, wrapperId, inputId) {
        const select = document.getElementById(selectId);
        const wrapper = document.getElementById(wrapperId);
        const inputLainnya = document.getElementById(inputId);

        if (select.value === 'Lainnya') {
            wrapper.classList.remove('d-none');
            inputLainnya.setAttribute('required', 'required');
            inputLainnya.focus();
        } else {
            wrapper.classList.add('d-none');
            inputLainnya.removeAttribute('required');
            inputLainnya.value = '';
        }
    }

    function resetSemuaLainnya() {
        document.getElementById('wrapper_lainnya_jenis').classList.add('d-none');
        document.getElementById('jenis_permohonan_lainnya').removeAttribute('required');
        document.getElementById('jenis_permohonan_lainnya').value = '';

        document.getElementById('wrapper_lainnya_divisi').classList.add('d-none');
        document.getElementById('divisi_tujuan_lainnya').removeAttribute('required');
        document.getElementById('divisi_tujuan_lainnya').value = '';

        document.getElementById('info-pelanggan').style.display = 'none';

        window.fetchedNamaPelanggan = null;
        window.fetchedAlamatPelanggan = null;

        document.getElementById('nama_pelanggan').classList.remove('auto-filled');
        document.getElementById('alamat_pemohon').classList.remove('auto-filled');
    }

    // Fungsi fetch data pelanggan dari database
    function fetchPelanggan(idPel) {
        if (idPel !== '') {
            fetch(`/cs/get-pelanggan/${idPel}`)
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        window.fetchedNamaPelanggan = result.data.nama;
                        window.fetchedAlamatPelanggan = result.data.alamat;

                        document.getElementById('text-nama-db').textContent = result.data.nama;
                        document.getElementById('text-alamat-db').textContent = result.data.alamat;
                        document.getElementById('info-pelanggan').style.display = 'block';
                    } else {
                        alert('ID Pelanggan tidak terdaftar di database!');
                        document.getElementById('info-pelanggan').style.display = 'none';
                        window.fetchedNamaPelanggan = null;
                        window.fetchedAlamatPelanggan = null;
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    // Event Listener Tombol "Gunakan Data Ini"
    document.getElementById('btn-gunakan-data').addEventListener('click', function() {
        if (window.fetchedNamaPelanggan && window.fetchedAlamatPelanggan) {
            // Masukkan nama pemilik meter PLN ke input nama_pelanggan
            const inputNamaPelanggan = document.getElementById('nama_pelanggan');
            inputNamaPelanggan.value = window.fetchedNamaPelanggan;
            inputNamaPelanggan.classList.add('auto-filled');

            // Masukkan alamat ke alamat_pemohon
            const inputAlamat = document.getElementById('alamat_pemohon');
            inputAlamat.value = window.fetchedAlamatPelanggan;
            inputAlamat.classList.add('auto-filled');
        }
    });

    // Hapus warna auto-filled jika CS mengetik manual ulang
    document.getElementById('nama_pelanggan').addEventListener('input', function() {
        if(this.value.trim() === '') {
            this.classList.remove('auto-filled');
        }
    });
    document.getElementById('alamat_pemohon').addEventListener('input', function() {
        if(this.value.trim() === '') {
            this.classList.remove('auto-filled');
        }
    });

    // Event Listener Tombol Cek ID Pelanggan
    document.getElementById('btn-cek-pelanggan').addEventListener('click', function() {
        let idPel = document.getElementById('id_pelanggan').value.trim();
        fetchPelanggan(idPel);
    });

    // Event Listener Blur Input ID Pelanggan
    document.getElementById('id_pelanggan').addEventListener('blur', function() {
        let idPel = this.value.trim();
        if(idPel !== '') {
            fetchPelanggan(idPel);
        }
    });

    // Tangani pengiriman form custom "Lainnya"
    document.getElementById('formPermohonan').addEventListener('submit', function(e) {
        const selectJenis = document.getElementById('jenis_permohonan');
        const inputJenisLainnya = document.getElementById('jenis_permohonan_lainnya');
        if (selectJenis.value === 'Lainnya' && inputJenisLainnya.value.trim() !== '') {
            let customOption = document.createElement('option');
            customOption.value = inputJenisLainnya.value.trim();
            customOption.text = inputJenisLainnya.value.trim();
            customOption.selected = true;
            selectJenis.appendChild(customOption);
        }

        const selectDivisi = document.getElementById('divisi_tujuan');
        const inputDivisiLainnya = document.getElementById('divisi_tujuan_lainnya');
        if (selectDivisi.value === 'Lainnya' && inputDivisiLainnya.value.trim() !== '') {
            let customOptionDivisi = document.createElement('option');
            customOptionDivisi.value = inputDivisiLainnya.value.trim();
            customOptionDivisi.text = inputDivisiLainnya.value.trim();
            customOptionDivisi.selected = true;
            selectDivisi.appendChild(customOptionDivisi);
        }
    });
</script>

<style>
    /* Styling modern emerald untuk input form yang terisi otomatis dari database PLN */
    .auto-filled {
        background-color: #ecfdf5 !important; 
        border: 1px solid #34d399 !important;    
        color: #065f46 !important;             
    }

    .form-control, .form-select {
        color: #0f172a;
        transition: all 0.2s ease-in-out;
    }
    .form-control::placeholder, .form-select::placeholder {
        color: #94a3b8;
        opacity: 1;
    }
    .form-control:focus, .form-select:focus {
        background-color: #ffffff !important;
        border-color: #0066cc !important;
        color: #0f172a !important;
        box-shadow: 0 0 0 4px rgba(0, 102, 204, 0.12) !important;
    }
    .tracking-wider {
        letter-spacing: 0.6px;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #003d70 0%, #0052a3 100%) !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 102, 204, 0.25) !important;
    }
    .btn-outline-primary:hover {
        background-color: #0066cc !important;
        color: #ffffff !important;
    }
</style>
@endsection