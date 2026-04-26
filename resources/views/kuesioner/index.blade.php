@extends('layouts.app')

@section('stylecss')
<style>
    /* Modern Radio & Checkbox Cards */
    .card-input-group {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .card-input {
        position: relative;
        display: block;
        cursor: pointer;
        margin-bottom: 0;
    }

    .card-input input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .card-input-content {
        display: flex;
        align-items: center;
        padding: 14px 18px;
        background: #ffffff;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        min-height: 64px;
    }

    .card-input:hover .card-input-content {
        border-color: #fbad6d;
        background: #fffaf5;
        transform: translateY(-1px);
    }

    .card-input input:checked + .card-input-content {
        border-color: #f79039;
        background: #fff7ef;
        box-shadow: 0 4px 15px rgba(247, 144, 57, 0.12);
    }

    /* Radio Indicator */
    .card-input-radio-icon {
        width: 22px;
        height: 22px;
        border: 2px solid #cbd5e0;
        border-radius: 50%;
        margin-right: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s ease;
        background: #fff;
    }

    .card-input input:checked + .card-input-content .card-input-radio-icon {
        border-color: #f79039;
        background: #f79039;
    }

    .card-input-radio-icon::after {
        content: '';
        width: 8px;
        height: 8px;
        background: #fff;
        border-radius: 50%;
        transform: scale(0);
        transition: transform 0.2s ease;
    }

    .card-input input:checked + .card-input-content .card-input-radio-icon::after {
        transform: scale(1);
    }

    /* Checkbox Indicator */
    .card-input-check-icon {
        width: 22px;
        height: 22px;
        border: 2px solid #cbd5e0;
        border-radius: 6px;
        margin-right: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s ease;
        background: #fff;
    }

    .card-input input:checked + .card-input-content .card-input-check-icon {
        border-color: #f79039;
        background: #f79039;
    }

    .card-input-check-icon::after {
        content: '\f00c';
        font-family: 'Font Awesome 5 Solid';
        font-size: 11px;
        color: #fff;
        display: none;
    }

    .card-input input:checked + .card-input-content .card-input-check-icon::after {
        display: block;
    }

    .card-input-label {
        font-size: 0.95rem;
        font-weight: 500;
        color: #4a5568;
        line-height: 1.4;
    }

    .card-input input:checked + .card-input-content .card-input-label {
        color: #1a202c;
        font-weight: 600;
    }

    @media (min-width: 768px) {
        .card-input-group.grid-layout {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .card-input-group.grid-layout .card-input {
            margin-bottom: 0;
        }
    }

    @media (max-width: 576px) {
        .card-input-content {
            padding: 12px 15px;
        }
        .card-input-label {
            font-size: 0.9rem;
        }
    }
</style>
@endsection

@section('content')

<div class="container mt-4 mt-md-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            @if(session('success'))
                <div class="card shadow-lg border-0 rounded-4 animate__animated animate__zoomIn">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                        </div>
                        <h2 class="fw-bold text-dark">Data Berhasil Terkirim!</h2>
                        <p class="lead text-muted mb-4">Kontribusi Anda sangat berarti dalam membantu <strong>BPS Kabupaten Mempawah</strong> memetakan potensi ekonomi digital yang lebih akurat.</p>
                        
                        <div class="bg-light p-4 rounded-4 mb-4 text-start border-start border-warning border-4">
                            <h6 class="fw-bold text-dark"><i class="fas fa-shield-alt me-2 text-warning"></i>Apa selanjutnya?</h6>
                            <p class="small text-muted mb-0">Data Anda akan diolah secara anonim untuk keperluan statistik nasional. Identitas pribadi Anda dilindungi sepenuhnya dan tidak akan dipublikasikan.</p>
                        </div>

                        <div class="mb-5">
                            <p class="fw-bold text-dark small text-uppercase mb-3">Bantu sesama pelaku usaha agar terdata:</p>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="https://wa.me/?text=Halo!%20Ayo%20bantu%20BPS%20Kabupaten%20Mempawah%20memetakan%20ekonomi%20digital%20kita.%20Cukup%203%20menit%20isi%20kuesionernya%20di%20sini:%20{{ urlencode(url()->current()) }}" target="_blank" class="btn btn-success px-4 rounded-pill shadow-sm">
                                    <i class="fab fa-whatsapp me-2"></i> Bagikan ke WhatsApp
                                </a>
                                <button type="button" onclick="copyToClipboard()" class="btn btn-outline-secondary px-4 rounded-pill">
                                    <i class="fas fa-copy me-2"></i> Salin Link
                                </button>
                            </div>
                        </div>

                        <hr class="my-4">
                        <a href="{{ route('welcome') }}" class="btn btn-warning btn-lg px-5 text-white fw-bold shadow-sm rounded-pill">Kembali ke Beranda</a>
                    </div>
                </div>

                <script>
                function copyToClipboard() {
                    const el = document.createElement('textarea');
                    el.value = "{{ url()->current() }}";
                    document.body.appendChild(el);
                    el.select();
                    document.execCommand('copy');
                    document.body.removeChild(el);
                    
                    Swal.fire({
                        title: 'Tersalin!',
                        text: 'Link kuesioner berhasil disalin ke clipboard.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
                </script>
            @else
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white py-3" style="background: linear-gradient(135deg, #f79039 0%, #fbad6d 100%);">
                    <div class="d-flex align-items-center">
                        <div class="bg-white rounded-circle p-2 me-3 shadow-sm">
                            <i class="fas fa-poll-h fa-lg" style="color: #f79039;"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-uppercase tracking-wider">Identifikasi Ekonomi Digital</h4>
                            <small class="opacity-75">BPS Kabupaten Mempawah</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('kues.store') }}" id="formKuesioner" enctype="multipart/form-data">
                        @csrf
                    
                    <!-- STEP 0: PENGANTAR & SKRINING -->
                    <div id="step-pengantar" class="animate__animated animate__fadeIn">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/img/logo.webp') }}" alt="Logo BPS" style="height: 60px; margin-bottom: 20px;">
                            <h2 class="fw-bold text-dark mb-1">KUESIONER CAIKUE</h2>
                            <p class="text-muted lead">Identifikasi dan Pemetaan Pelaku Usaha & Potensi Ekonomi Digital</p>
                            <div class="d-flex justify-content-center gap-2">
                                <div class="badge bg-light text-dark border p-2">Sensus Ekonomi 2026 • Kabupaten Mempawah</div>
                                <div class="badge bg-warning text-white border-0 p-2 shadow-sm"><i class="far fa-clock me-1"></i> Cukup 3 Menit</div>
                            </div>
                        </div>

                        <div class="alert alert-info border-0 shadow-sm mb-4">
                            <i class="fas fa-info-circle me-2"></i> <strong>INFO:</strong> Tanda bintang (*) menandakan pertanyaan wajib diisi. Data Anda dilindungi oleh UU No. 16 Tahun 1997 tentang Statistik dan UU No. 27 Tahun 2022 tentang Pelindungan Data Pribadi. Informasi yang diberikan semata-mata digunakan untuk keperluan statistik nasional.
                        </div>

                        <div class="card bg-light border-0 rounded-4 mb-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-dark mb-3">BAGIAN 0: SKRINING AWAL</h5>
                                
                                <div class="mb-4">
                                    <label class="fw-bold text-dark mb-3">S1. Apakah Anda atau anggota rumah tangga Anda saat ini memiliki usaha atau kegiatan yang menghasilkan pendapatan, baik secara online maupun offline? <span class="text-danger">*</span></label>
                                    <div class="card-input-group">
                                        <label class="card-input">
                                            <input type="radio" name="punya_usaha" id="skriningYa" value="ya">
                                            <div class="card-input-content">
                                                <div class="card-input-radio-icon"></div>
                                                <div class="card-input-label">Ya — saya memiliki atau terlibat dalam usaha yang menghasilkan pendapatan</div>
                                            </div>
                                        </label>
                                        <label class="card-input">
                                            <input type="radio" name="punya_usaha" id="skriningTidak" value="tidak">
                                            <div class="card-input-content">
                                                <div class="card-input-radio-icon"></div>
                                                <div class="card-input-label">Tidak — tidak ada kegiatan usaha apapun</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3 d-none" id="skrining_pengisi_wrapper">
                                    <label class="fw-bold text-dark mb-3">S2. Siapa yang mengisi formulir ini? <span class="text-danger">*</span></label>
                                    <div class="card-input-group">
                                        <label class="card-input">
                                            <input type="radio" name="status_pengisi" id="statusPemilikSkrining" value="Pemilik Usaha" checked>
                                            <div class="card-input-content">
                                                <div class="card-input-radio-icon"></div>
                                                <div class="card-input-label">Pemilik / pelaku usaha langsung</div>
                                            </div>
                                        </label>
                                        <label class="card-input">
                                            <input type="radio" name="status_pengisi" id="statusPendampingSkrining" value="Pendamping/RT">
                                            <div class="card-input-content">
                                                <div class="card-input-radio-icon"></div>
                                                <div class="card-input-label">Petugas pendataan / Ketua RT / Pendamping</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-warning btn-lg px-5 text-white fw-bold shadow-sm" id="btn-mulai-kuesioner" disabled>
                                Mulai Isi Kuesioner <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- KUESIONER FORM WRAPPER -->
                    <div id="kuesioner-wrapper" class="d-none animate__animated animate__fadeIn">
                        <!-- STEP INDICATOR -->
                        <div class="step-indicator mb-4">
                            <div class="step-line"></div>
                            <div class="step-item active" data-step="1">
                                <span class="step-number">1</span>
                                <span class="step-label">Identitas</span>
                            </div>
                            <div class="step-item" data-step="2">
                                <span class="step-number">2</span>
                                <span class="step-label">Usaha</span>
                            </div>
                            <div class="step-item" data-step="3">
                                <span class="step-number">3</span>
                                <span class="step-label">Digital</span>
                            </div>
                            <div class="step-item" data-step="4">
                                <span class="step-number">4</span>
                                <span class="step-label">Final</span>
                            </div>
                        </div>

                        <!-- PROGRESS BAR -->
                        <div class="d-flex justify-content-between align-items-end mb-2">
                            <small class="text-muted fw-bold text-uppercase" style="font-size: 10px;">Progress Pengisian</small>
                            <small class="text-warning fw-bold" style="font-size: 10px;"><i class="far fa-clock me-1"></i> Estimasi Selesai: 3 Menit</small>
                        </div>
                        <div class="progress mb-5" style="height: 6px; border-radius: 10px;">
                            <div id="progressBar" class="progress-bar bg-warning" role="progressbar" style="width: 25%; transition: width 0.4s ease;"></div>
                        </div>

                        <!-- STEP 1: INFORMASI RESPONDEN -->
                        <div class="step-content">
                            <div class="section-title mb-4">
                                <h5 class="fw-bold text-dark"><i class="fas fa-id-card me-2 text-warning"></i>I. INFORMASI RESPONDEN</h5>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Pemilik Usaha" required>
                                        <label for="nama">1. Nama Pemilik / Pelaku Usaha <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK" maxlength="16" required>
                                        <label for="nik">2. NIK (16 Digit) <span class="text-danger">*</span></label>
                                        <div class="form-text small text-muted"><i class="fas fa-shield-alt me-1"></i> NIK dijamin kerahasiaannya dan hanya digunakan untuk deduplikasi data statistik Sensus Ekonomi 2026.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="tel" name="no_hp" id="no_hp" class="form-control" placeholder="No HP" required>
                                        <label for="no_hp">3. Nomor HP / WhatsApp aktif <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <!-- WILAYAH -->
                                <div class="col-12"><label class="fw-bold text-muted small text-uppercase">4. Wilayah Domisili Usaha <span class="text-danger">*</span></label></div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <select id="kabupaten_id" name="kabupaten_id" class="form-select" required>
                                            <option value="">Pilih Kabupaten</option>
                                            @foreach($kabupatens as $kab)
                                                <option value="{{ $kab->id }}">{{ $kab->name }}</option>
                                            @endforeach
                                        </select>
                                        <label>Kabupaten</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <select id="kecamatan_id" name="kecamatan_id" class="form-select" required disabled>
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                        <label>Kecamatan</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <select id="desa_id" name="desa_id" class="form-select" required disabled>
                                            <option value="">Pilih Desa</option>
                                        </select>
                                        <label>Desa</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <select id="sls_id" name="sls_id" class="form-select" required disabled>
                                            <option value="">Pilih RT / SLS</option>
                                        </select>
                                        <label>RT / SLS</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select name="pekerjaan" id="pekerjaan" class="form-select" required>
                                            <option value="">Pilih Pekerjaan / Status</option>
                                            <option value="Mengurus rumah tangga">Mengurus rumah tangga</option>
                                            <option value="Wiraswasta">Wiraswasta / pemilik usaha penuh waktu</option>
                                            <option value="Pegawai Swasta">Karyawan / pegawai swasta</option>
                                            <option value="Pegawai Negeri/BUMN">Aparatur Sipil Negara (ASN) / BUMN / TNI / Polri</option>
                                            <option value="Pelajar / Mahasiswa">Pelajar / Mahasiswa</option>
                                            <option value="Lainnya">Lainnya (sebutkan)</option>
                                        </select>
                                        <label>6. Pekerjaan / status utama pemilik usaha <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-12 d-none" id="pekerjaan_lainnya_wrapper">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="pekerjaan_lainnya" class="form-control" placeholder="Sebutkan pekerjaan">
                                        <label>Sebutkan Pekerjaan</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-2 gap-2">
                                            <label class="fw-bold text-muted small text-uppercase mb-0">5. Alamat lengkap tempat usaha</label>
                                            <button type="button" class="btn btn-primary shadow-sm" id="btn-lokasi-saya">
                                                <i class="fas fa-map-marker-alt me-1"></i> Gunakan Lokasi Saya
                                            </button>
                                        </div>
                                        <p class="small text-muted mb-2"><em><i class="fas fa-info-circle me-1"></i> Geser pin atau klik pada peta untuk menentukan lokasi. Jika usaha sepenuhnya online (tidak ada lokasi fisik), kolom alamat dan koordinat dapat dikosongkan.</em></p>
                                        
                                        <textarea name="alamat_usaha" class="form-control mb-3" rows="2" placeholder="Nama jalan, nomor, RT/RW, patokan..."></textarea>
                                        
                                        <!-- MAP PICKER -->
                                        <div id="map" style="height: 300px; border-radius: 12px; border: 2px solid #eee;" class="mb-3"></div>
                                        
                                        <input type="hidden" name="latitude" id="lat">
                                        <input type="hidden" name="longitude" id="lng">
                                        <input type="hidden" name="accuracy" id="accuracy">

                                        <!-- ACCURACY INDICATOR -->
                                        <div id="accuracy-box" class="alert alert-secondary py-2 px-3 mt-2 mb-3 d-none shadow-sm border-0">
                                            <div class="d-flex align-items-center">
                                                <div id="accuracy-icon" class="me-2"><i class="fas fa-satellite-dish"></i></div>
                                                <div>
                                                    <small class="d-block text-uppercase fw-bold" style="font-size: 10px;">Akurasi GPS</small>
                                                    <span id="accuracy-text" class="fw-bold h6 mb-0">Mendeteksi...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                             </div>

                             <div class="d-flex justify-content-end mt-5">
                                 <button type="button" class="btn btn-warning btn-lg px-5 text-white fw-bold next-btn">Lanjut <i class="fas fa-chevron-right ms-2"></i></button>
                             </div>
                        </div>

                        <!-- STEP 2: KARAKTERISTIK USAHA -->
                        <div class="step-content d-none">
                            <div class="section-title mb-4">
                                <h5 class="fw-bold text-dark"><i class="fas fa-store me-2 text-warning"></i>II. KARAKTERISTIK USAHA</h5>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase mb-1">7. Nama usaha / merek dagang</label>
                                        <p class="small text-muted mb-2"><em>Jika tidak memiliki nama usaha resmi, tuliskan produk atau jasa utama yang Anda jual.</em></p>
                                        <input type="text" name="kegiatan_utama" class="form-control" placeholder="Contoh: Bubur Ayam Pak Lukman, Toko Online Batik Mempawah...">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase">8. Kategori usaha utama <span class="text-danger">*</span></label>
                                        <select name="jenis_usaha" class="form-select" required>
                                            <option value="">Pilih Kategori</option>
                                            <option value="Produksi barang sendiri">Produksi barang sendiri (kerajinan, pertanian/agribisnis, manufaktur rumahan, dll)</option>
                                            <option value="Kuliner">Kuliner (makanan dan minuman jadi: warung, katering, snack, dll)</option>
                                            <option value="Perdagangan / reseller / dropship">Perdagangan / reseller / dropship (menjual kembali produk orang lain)</option>
                                            <option value="Jasa digital">Jasa digital (desain grafis, admin media sosial, pengelola konten, dll)</option>
                                            <option value="Kreator konten / influencer">Kreator konten / influencer (YouTube, TikTok, Instagram, podcast, dll)</option>
                                            <option value="Jasa non-digital">Jasa non-digital (laundry, bengkel, salon, ojek, dll)</option>
                                            <option value="Pertanian / perikanan / perkebunan">Pertanian / perikanan / perkebunan (dijual langsung tanpa pengolahan)</option>
                                            <option value="Lainnya">Lainnya (sebutkan)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase">9. Jumlah tenaga kerja (termasuk pemilik) <span class="text-danger">*</span></label>
                                        <select name="jumlah_tk" class="form-select" required>
                                            <option value="">Pilih Jumlah</option>
                                            <option value="Hanya saya sendiri">Hanya saya sendiri (usaha solo)</option>
                                            <option value="2-4 orang">2–4 orang</option>
                                            <option value="5-19 orang">5–19 orang</option>
                                            <option value="20 orang atau lebih">20 orang atau lebih</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase">10. Tahun mulai beroperasi <span class="text-danger">*</span></label>
                                        <select name="tahun_mulai" class="form-select" required>
                                            <option value="">Pilih Tahun</option>
                                            <option value="Sebelum 2020">Sebelum 2020</option>
                                            <option value="2020-2021">2020 – 2021 (masa pandemi)</option>
                                            <option value="2022-2023">2022 – 2023</option>
                                            <option value="2024 atau setelahnya">2024 atau setelahnya</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-dark mb-1">11. Estimasi omset (penerimaan kotor) usaha per bulan <span class="text-danger">*</span></label>
                                        <p class="text-muted small mb-2"><em>Omset = total penerimaan dari penjualan barang/jasa SEBELUM dikurangi biaya apapun. Bukan keuntungan bersih.</em></p>
                                        <select name="omzet" class="form-select" required>
                                            <option value="">Pilih Rentang Omset</option>
                                            <option value="Kurang dari Rp 1 juta">Kurang dari Rp 1 juta</option>
                                            <option value="Rp 1 juta – Rp 4,9 juta">Rp 1 juta – Rp 4,9 juta</option>
                                            <option value="Rp 5 juta – Rp 9,9 juta">Rp 5 juta – Rp 9,9 juta</option>
                                            <option value="Rp 10 juta – Rp 29,9 juta">Rp 10 juta – Rp 29,9 juta</option>
                                            <option value="Rp 30 juta – Rp 50 juta">Rp 30 juta – Rp 50 juta</option>
                                            <option value="Lebih dari Rp 50 juta">Lebih dari Rp 50 juta</option>
                                            <option value="Tidak tahu / tidak ingat">Tidak tahu / tidak ingat</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase">12. Status legalitas usaha <span class="text-danger">*</span></label>
                                        <select name="legalitas" class="form-select" required>
                                            <option value="">Pilih Legalitas</option>
                                            <option value="Belum memiliki legalitas apapun">Belum memiliki legalitas apapun</option>
                                            <option value="Memiliki NIB (Nomor Induk Berusaha)">Memiliki NIB (Nomor Induk Berusaha) dari OSS</option>
                                            <option value="Memiliki SIUP / izin usaha daerah">Memiliki SIUP / izin usaha daerah</option>
                                            <option value="Terdaftar sebagai CV / PT / koperasi">Terdaftar sebagai CV / PT / koperasi</option>
                                            <option value="Tidak tahu">Tidak tahu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-outline-secondary btn-lg px-4 prev-btn">Kembali</button>
                                <button type="button" class="btn btn-warning btn-lg px-5 text-white fw-bold next-btn">Lanjut <i class="fas fa-chevron-right ms-2"></i></button>
                            </div>
                        </div>

                        <!-- STEP 3: AKTIVITAS DIGITAL -->
                        <div class="step-content d-none">
                            <div class="section-title mb-4">
                                <h5 class="fw-bold text-dark"><i class="fas fa-laptop-code me-2 text-warning"></i>III. AKTIVITAS DIGITAL</h5>
                            </div>

                            <!-- BRIDGE QUESTION D0 -->
                            <div class="card bg-light border-0 rounded-4 mb-4">
                                <div class="card-body p-4">
                                    <label class="fw-bold text-dark mb-3">D0. Apakah usaha Anda memanfaatkan saluran digital (internet, media sosial, marketplace, aplikasi pembayaran, dll) dalam kegiatan penjualan atau operasionalnya? <span class="text-danger">*</span></label>
                                    <div class="card-input-group">
                                        <label class="card-input">
                                            <input type="radio" name="use_digital" id="useDigitalYa" value="ya" checked>
                                            <div class="card-input-content">
                                                <div class="card-input-radio-icon"></div>
                                                <div class="card-input-label">Ya — usaha saya menggunakan saluran digital</div>
                                            </div>
                                        </label>
                                        <label class="card-input">
                                            <input type="radio" name="use_digital" id="useDigitalTidak" value="tidak">
                                            <div class="card-input-content">
                                                <div class="card-input-radio-icon"></div>
                                                <div class="card-input-label">Tidak — usaha saya sepenuhnya offline</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="digital_detail_wrapper">
                                <div class="row g-3">
                                    <!-- PLATFORM -->
                                    <div class="col-12 py-2">
                                        <label class="fw-bold text-muted small text-uppercase mb-2">13. Platform digital yang digunakan untuk usaha <span class="text-danger">*</span></label>
                                        <div class="card-input-group grid-layout">
                                            @foreach(['Marketplace (Shopee, Tokopedia, Lazada, Bukalapak, dll)', 'TikTok Shop / live commerce', 'Instagram / Facebook (feed, story, atau DM)', 'WhatsApp Business', 'WhatsApp pribadi', 'Platform freelance (Fiverr, Upwork, dll)', 'Website / toko online sendiri', 'Lainnya'] as $item)
                                            <label class="card-input">
                                                <input type="checkbox" name="platform_digital_v2[]" value="{{ $item }}" id="plat_{{ $loop->index }}">
                                                <div class="card-input-content">
                                                    <div class="card-input-check-icon"></div>
                                                    <div class="card-input-label">{{ $item }}</div>
                                                </div>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- SUMBER PENGHASILAN -->
                                    <div class="col-12">
                                        <label class="fw-bold text-muted small text-uppercase mb-2">14. Sumber penghasilan dari aktivitas digital <span class="text-danger">*</span></label>
                                        <div class="card-input-group grid-layout">
                                            @foreach(['Penjualan produk / barang', 'Penjualan jasa / layanan', 'Komisi afiliasi (affiliate marketing)', 'Pendapatan iklan (Google Adsense, YouTube, dll)', 'Live streaming (gift, donasi, komisi live)', 'Lainnya'] as $item)
                                            <label class="card-input">
                                                <input type="checkbox" name="sumber_penghasilan_digital[]" value="{{ $item }}" id="income_{{ $loop->index }}">
                                                <div class="card-input-content">
                                                    <div class="card-input-check-icon"></div>
                                                    <div class="card-input-label">{{ $item }}</div>
                                                </div>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- LAMA DIGITAL -->
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold text-muted small text-uppercase mb-2">15. Sudah berapa lama memanfaatkan saluran digital? <span class="text-danger">*</span></label>
                                        <select name="lama_aktivitas_digital" class="form-select">
                                            <option value="">Pilih Lama Menggunakan</option>
                                            <option value="Kurang dari 6 bulan">Kurang dari 6 bulan</option>
                                            <option value="6 bulan – 1 tahun">6 bulan – 1 tahun</option>
                                            <option value="1 – 3 tahun">1 – 3 tahun</option>
                                            <option value="Lebih dari 3 tahun">Lebih dari 3 tahun</option>
                                            <option value="Tidak ingat">Tidak ingat</option>
                                        </select>
                                    </div>

                                    <!-- DAMPAK DIGITAL -->
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold text-muted small text-uppercase mb-2">16. Apakah digital meningkatkan omset? <span class="text-danger">*</span></label>
                                        <select name="tambah_penghasilan_digital" class="form-select">
                                            <option value="">Pilih Pengaruh</option>
                                            <option value="Ya, meningkatkan secara signifikan">Ya, meningkatkan omset secara signifikan</option>
                                            <option value="Ya, sedikit meningkat">Ya, sedikit meningkat</option>
                                            <option value="Tidak ada perubahan / sama saja">Tidak ada perubahan / sama saja</option>
                                            <option value="Justru menurun">Justru menurun setelah memanfaatkan digital</option>
                                            <option value="Belum dapat dinilai">Belum dapat dinilai (masih baru)</option>
                                        </select>
                                    </div>

                                    <!-- PEMBAYARAN -->
                                    <div class="col-12 py-2">
                                        <label class="fw-bold text-muted small text-uppercase mb-2">17. Metode pembayaran digital yang diterima <span class="text-danger">*</span></label>
                                        <div class="card-input-group grid-layout">
                                            @foreach(['QRIS (stiker / QR code)', 'Transfer mobile banking / internet banking', 'Dompet digital (GoPay/OVO/Dana/dll)', 'COD (bayar di tempat via kurir)', 'Hanya menerima tunai', 'Lainnya'] as $item)
                                            <label class="card-input">
                                                <input type="checkbox" name="metode_pembayaran_digital[]" value="{{ $item }}" id="pay_{{ $loop->index }}">
                                                <div class="card-input-content">
                                                    <div class="card-input-check-icon"></div>
                                                    <div class="card-input-label">{{ $item }}</div>
                                                </div>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- KENDALA -->
                                    <div class="col-12 py-2">
                                        <label class="fw-bold text-muted small text-uppercase mb-1">18. Kendala utama dalam menjalankan usaha digital <span class="text-danger">*</span></label>
                                        <p class="text-muted small mb-2"><em>Silakan pilih maksimal 3 kendala yang paling dirasakan.</em></p>
                                        <div class="card-input-group grid-layout">
                                            @foreach([
                                                'Modal / pembiayaan',
                                                'Keterbatasan akses internet / sinyal',
                                                'Kemampuan / literasi digital (cara operasional)',
                                                'Kurangnya minat / jumlah pembeli (sepi)',
                                                'Persaingan dengan penjual dari luar daerah',
                                                'Biaya logistik / pengiriman yang mahal',
                                                'Keamanan data / risiko penipuan (scam)',
                                                'Masalah perizinan / sertifikasi (Halal, NIB, dll)',
                                                'Tidak ada kendala signifikan',
                                                'Lainnya'
                                            ] as $item)
                                            <label class="card-input">
                                                <input type="checkbox" class="kendala-cb" name="kendala[]" value="{{ $item }}" id="kendala_{{ $loop->index }}" {{ $item == 'Lainnya' ? 'onclick=toggleKendalaLainnya(this.checked)' : '' }}>
                                                <div class="card-input-content">
                                                    <div class="card-input-check-icon"></div>
                                                    <div class="card-input-label">{{ $item }}</div>
                                                </div>
                                            </label>
                                            @endforeach
                                            <div id="kendala_lainnya_wrapper" class="mt-2 d-none">
                                                <input type="text" name="kendala_lainnya" class="form-control" placeholder="Sebutkan kendala lainnya...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-outline-secondary btn-lg px-4 prev-btn">Kembali</button>
                                <button type="button" class="btn btn-warning btn-lg px-5 text-white fw-bold next-btn">Lanjut <i class="fas fa-chevron-right ms-2"></i></button>
                            </div>
                        </div>

                        <!-- STEP 4: FINAL -->
                        <div class="step-content d-none">
                            <div class="section-title mb-4">
                                <h5 class="fw-bold text-dark"><i class="fas fa-camera me-2 text-warning"></i>IV. FINALISASI DATA</h5>
                            </div>

                            <div class="card mb-4 border-2">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label class="fw-bold text-dark mb-3">19. Apakah Anda sudah atau akan dikunjungi petugas Sensus Ekonomi 2026 secara langsung? <span class="text-danger">*</span></label>
                                        <div class="card-input-group">
                                            @foreach([
                                                'Sudah dikunjungi petugas SE2026',
                                                'Belum dikunjungi, tapi tahu akan dikunjungi',
                                                'Belum dikunjungi dan tidak tahu',
                                                'Tidak tahu'
                                            ] as $item)
                                            <label class="card-input">
                                                <input type="radio" name="se2026_visit" value="{{ $item }}" required>
                                                <div class="card-input-content">
                                                    <div class="card-input-radio-icon"></div>
                                                    <div class="card-input-label">{{ $item }}</div>
                                                </div>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <hr>

                                    <label class="fw-bold mb-1 d-block">20. Unggah foto tempat usaha atau produk utama (Opsional)</label>
                                    <p class="small text-muted mb-3"><em>Format: JPG/PNG, Maks 5MB. Boleh dikosongkan jika tidak tersedia.</em></p>
                                    <div class="upload-zone text-center p-4 border rounded-3 bg-light">
                                        <i class="fas fa-store fa-3x text-muted mb-2 me-3"></i>
                                        <i class="fas fa-box-open fa-3x text-muted mb-2"></i>
                                        <div class="mt-3">
                                            <input type="file" name="foto_rumah" class="form-control" accept="image/*" id="foto_rumah_input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-warning border-0 shadow-sm small mb-4">
                                <i class="fas fa-shield-alt me-2"></i> Dengan menekan tombol KIRIM, Anda menyatakan bahwa data yang diisi adalah benar dan bersedia digunakan untuk keperluan statistik nasional sesuai UU No. 16 Tahun 1997. Jawaban Anda bersifat RAHASIA dan tidak akan mempengaruhi status perpajakan atau program bantuan sosial Anda.
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-outline-secondary btn-lg px-4 prev-btn">Kembali</button>
                                <button type="submit" class="btn btn-success btn-lg px-5 fw-bold shadow">KIRIM DATA <i class="fas fa-paper-plane ms-2"></i></button>
                            </div>
                        </div>

                    </form>
                    </div> <!-- End kuesioner-wrapper -->
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- LEAFLET CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

@endsection

@section('script')
<script src="{{ asset('assets/js/plugin/sweetalert2.all.min.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let currentStep = 0;
    let historyStep = [];
    const stepContents = document.querySelectorAll(".step-content");
    const indicatorItems = document.querySelectorAll(".step-item");
    const kuesForm = document.getElementById("formKuesioner");
    
    window.toggleKendalaLainnya = function(show) {
        const wrapper = document.getElementById('kendala_lainnya_wrapper');
        if (show) {
            wrapper.classList.remove('d-none');
            wrapper.querySelector('input').focus();
        } else {
            wrapper.classList.add('d-none');
            wrapper.querySelector('input').value = '';
        }
    }

    // Limit Kendala to Max 3
    const kendalaCbs = document.querySelectorAll('.kendala-cb');
    kendalaCbs.forEach(cb => {
        cb.addEventListener('change', function() {
            const checkedCount = document.querySelectorAll('.kendala-cb:checked').length;
            if (checkedCount > 3) {
                this.checked = false;
                // If it was 'Lainnya', we should hide the wrapper again
                if (this.value === 'Lainnya') toggleKendalaLainnya(false);
                
                Swal.fire({
                    title: 'Batas Maksimal',
                    text: 'Silakan pilih maksimal 3 kendala utama.',
                    icon: 'warning',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });

    // --- SCREENING LOGIC ---
    const skriningUsaha = document.querySelectorAll('input[name="punya_usaha"]');
    const skriningPengisiWrapper = document.getElementById('skrining_pengisi_wrapper');
    const btnMulai = document.getElementById('btn-mulai-kuesioner');
    
    skriningUsaha.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'tidak') {
                skriningPengisiWrapper.classList.add('d-none');
                btnMulai.disabled = false;
                btnMulai.innerHTML = 'Selesai <i class="fas fa-check ms-2"></i>';
                btnMulai.classList.remove('btn-warning');
                btnMulai.classList.add('btn-success');
            } else {
                skriningPengisiWrapper.classList.remove('d-none');
                btnMulai.disabled = false;
                btnMulai.innerHTML = 'Mulai Isi Kuesioner <i class="fas fa-arrow-right ms-2"></i>';
                btnMulai.classList.remove('btn-success');
                btnMulai.classList.add('btn-warning');
            }
        });
    });

    btnMulai.addEventListener('click', function() {
        const selectedSkrining = document.querySelector('input[name="punya_usaha"]:checked').value;
        if (selectedSkrining === 'tidak') {
            Swal.fire({
                title: 'Terima Kasih',
                text: 'Terima kasih atas partisipasi Anda. Karena Anda tidak memiliki kegiatan usaha, Anda tidak perlu melanjutkan pengisian formulir ini.',
                icon: 'success'
            }).then(() => {
                window.location.reload();
            });
            return;
        }
        
        document.getElementById('step-pengantar').classList.add('d-none');
        document.getElementById('kuesioner-wrapper').classList.remove('d-none');
        updateStep(0);
    });

    // --- DIGITAL FILTER LOGIC ---
    const useDigitalRadios = document.querySelectorAll('input[name="use_digital"]');
    const digitalDetailWrapper = document.getElementById('digital_detail_wrapper');
    
    useDigitalRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'tidak') {
                digitalDetailWrapper.classList.add('d-none');
                digitalDetailWrapper.querySelectorAll('input, select').forEach(i => i.required = false);
            } else {
                digitalDetailWrapper.classList.remove('d-none');
                digitalDetailWrapper.querySelectorAll('input, select').forEach(i => {
                    // Re-add required if they should be
                    if (i.name === 'lama_aktivitas_digital' || i.name === 'tambah_penghasilan_digital') i.required = true;
                });
            }
        });
    });

    // Initialize Map
    let map, marker;
    function initMap() {
        if (map) return;
        const defaultLat = -0.0247;
        const defaultLng = 109.3404;

        map = L.map('map').setView([defaultLat, defaultLng], 13);
        L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3'],
            attribution: 'Map data &copy; Google'
        }).addTo(map);

        marker = L.marker([defaultLat, defaultLng], {draggable: true}).addTo(map);
        document.getElementById('lat').value = defaultLat;
        document.getElementById('lng').value = defaultLng;

        function updateLocation(lat, lng, accuracy = null) {
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
            const accBox = document.getElementById('accuracy-box');
            const accText = document.getElementById('accuracy-text');
            const accInput = document.getElementById('accuracy');

            if (accuracy !== null) {
                accInput.value = Math.round(accuracy);
                accBox.classList.remove('d-none');
                accText.innerText = Math.round(accuracy) + " meter";
                if (accuracy <= 30) {
                    accBox.className = 'alert alert-success py-2 px-3 mt-2 mb-3 shadow-sm border-0';
                    document.getElementById('accuracy-icon').innerHTML = '<i class="fas fa-check-circle fa-lg"></i>';
                } else {
                    accBox.className = 'alert alert-danger py-2 px-3 mt-2 mb-3 shadow-sm border-0';
                    document.getElementById('accuracy-icon').innerHTML = '<i class="fas fa-exclamation-triangle fa-lg"></i>';
                }
            }

            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(res => res.json())
                .then(data => {
                    const alamatInput = document.querySelector('textarea[name="alamat_usaha"]');
                    if (alamatInput) {
                        let baseAddress = (data && data.display_name) ? data.display_name : '';
                        alamatInput.value = `${baseAddress}\n(Lat: ${lat}, Lng: ${lng})`;
                    }
                });
        }

        marker.on('dragend', function (e) {
            const pos = marker.getLatLng();
            updateLocation(pos.lat, pos.lng);
        });
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            updateLocation(e.latlng.lat, e.latlng.lng);
        });

        const btnLokasi = document.getElementById('btn-lokasi-saya');
        if (btnLokasi) {
            btnLokasi.addEventListener('click', function() {
                const btnOrigText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mencari...';
                this.disabled = true;

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(position => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        const accuracy = position.coords.accuracy;
                        map.setView([lat, lng], 16);
                        marker.setLatLng([lat, lng]);
                        updateLocation(lat, lng, accuracy);
                        this.innerHTML = btnOrigText;
                        this.disabled = false;
                    }, error => {
                        alert("Gagal mengakses lokasi.");
                        this.innerHTML = btnOrigText;
                        this.disabled = false;
                    });
                }
            });
        }
    }

    function updateStep(targetStep) {
        stepContents.forEach((content, idx) => {
            content.classList.toggle("d-none", idx !== targetStep);
        });
        indicatorItems.forEach((item, idx) => {
            item.classList.remove("active", "completed");
            if (idx < targetStep) item.classList.add("completed");
            if (idx === targetStep) item.classList.add("active");
        });
        const progressBar = document.getElementById("progressBar");
        if (progressBar) {
            progressBar.style.width = ((targetStep + 1) / 4) * 100 + "%";
        }
        currentStep = targetStep;
        if (targetStep === 0) {
            setTimeout(() => {
                initMap();
                if (map) map.invalidateSize();
            }, 500); 
        }
    }

    // Regions Loading logic
    const kabSelect = document.getElementById('kabupaten_id');
    const kecSelect = document.getElementById('kecamatan_id');
    const desaSelect = document.getElementById('desa_id');
    const slsSelect = document.getElementById('sls_id');
    const regionSelectors = [kabSelect, kecSelect, desaSelect];
    
    kabSelect?.addEventListener('change', function() {
        loadRegions(this.value, kecSelect, 'Pilih Kecamatan');
        desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
        desaSelect.disabled = true;
        slsSelect.innerHTML = '<option value="">Pilih RT / SLS</option>';
        slsSelect.disabled = true;
    });

    kecSelect?.addEventListener('change', function() {
        loadRegions(this.value, desaSelect, 'Pilih Desa');
        slsSelect.innerHTML = '<option value="">Pilih RT / SLS</option>';
        slsSelect.disabled = true;
    });

    desaSelect?.addEventListener('change', function() {
        loadRegions(this.value, slsSelect, 'Pilih RT / SLS');
    });

    function loadRegions(parentId, targetSelect, placeholder) {
        if (!parentId) {
            targetSelect.innerHTML = `<option value="">${placeholder}</option>`;
            targetSelect.disabled = true;
            return;
        }
        fetch(`/kuesioner/regions/${parentId}`)
            .then(res => res.json())
            .then(data => {
                targetSelect.innerHTML = `<option value="">${placeholder}</option>`;
                data.forEach(region => {
                    targetSelect.innerHTML += `<option value="${region.id}">${region.name}</option>`;
                });
                targetSelect.disabled = false;
            });
    }

    // Pekerjaan Lainnya logic
    const pekerjaanSelect = document.getElementById('pekerjaan');
    pekerjaanSelect?.addEventListener('change', function() {
        document.getElementById('pekerjaan_lainnya_wrapper').classList.toggle('d-none', this.value !== 'Lainnya');
    });

    // Navigation logic
    document.querySelectorAll(".next-btn").forEach(btn => {
        btn.addEventListener("click", function() {
            const activeStep = stepContents[currentStep];
            const inputs = activeStep.querySelectorAll('input[required], select[required]');
            let valid = true;
            inputs.forEach(i => {
                if (!i.value) {
                    i.classList.add('is-invalid');
                    valid = false;
                } else {
                    i.classList.remove('is-invalid');
                }
            });

            if (!valid) {
                 Swal.fire('Perhatian', 'Mohon lengkapi semua field wajib diisi.', 'warning');
                 return;
            }

            // Accuracy Validation for Step 1 (Identity)
            if (currentStep === 0) {
                const accValue = document.getElementById('accuracy').value;
                if (!accValue || accValue > 30) {
                    Swal.fire({
                        title: 'Akurasi GPS Rendah',
                        text: 'Akurasi lokasi Anda lebih dari 30 meter atau belum terdeteksi. Data akan tetap disimpan, namun kami sarankan untuk mengambil koordinat di luar ruangan jika memungkinkan.',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonText: 'Tetap Lanjutkan',
                        cancelButtonText: 'Tunggu Sebentar',
                        confirmButtonColor: '#f79039'
                    }).then((result) => {
                        if (result.isConfirmed) proceedToNextStep();
                    });
                    return;
                }
            }

            proceedToNextStep();

            function proceedToNextStep() {
                historyStep.push(currentStep);
                
                // Skip logic if No Digital (D0)
                if (currentStep === 2 && document.querySelector('input[name="use_digital"]:checked').value === 'tidak') {
                    updateStep(3); // Jump to final
                    return;
                }

                updateStep(currentStep + 1);
            }
        });
    });

    document.querySelectorAll(".prev-btn").forEach(btn => {
        btn.addEventListener("click", function() {
            if (historyStep.length > 0) updateStep(historyStep.pop());
        });
    });
});
</script>

<style>
.step-indicator { display: flex; justify-content: space-between; position: relative; z-index: 1; }
.step-line { position: absolute; top: 20px; left: 40px; right: 40px; height: 3px; background: #e9ecef; z-index: -1; }
.step-item { text-align: center; background: transparent; flex: 1; }
.step-number { width: 40px; height: 40px; line-height: 36px; display: inline-block; border-radius: 50%; background: #fff; border: 2px solid #e9ecef; color: #adb5bd; font-weight: bold; margin-bottom: 5px; }
.step-label { display: block; font-size: 11px; color: #adb5bd; text-transform: uppercase; font-weight: 600; }
.step-item.active .step-number { border-color: #f79039; color: #f79039; }
.step-item.active .step-label { color: #f79039; }
.step-item.completed .step-number { background: #f79039; border-color: #f79039; color: #fff; }
</style>
@endsection