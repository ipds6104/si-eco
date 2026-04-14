@extends('layouts.app')

@section('content')

<div class="container-fluid px-4" style="margin-top:90px; margin-bottom: 50px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark"><i class="fas fa-file-alt me-2 text-warning"></i>Detail Jawaban Responden</h3>
        <a href="{{ route('kues.edit', $data->id) }}" class="btn btn-warning text-white shadow-sm fw-bold">
            <i class="fas fa-edit me-1"></i> Edit Data
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 border-bottom">
            <div class="row align-items-center">
                <div class="col">
                    <span class="text-muted small text-uppercase fw-bold">ID Responden: #{{ $data->id }}</span>
                </div>
                <div class="col-auto">
                    <span class="badge {{ $data->punya_usaha == 'ya' ? 'bg-success' : 'bg-secondary' }} py-2 px-3">
                        {{ $data->punya_usaha == 'ya' ? 'Pelaku Usaha' : 'Bukan Pelaku Usaha' }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="card-body p-4">

            {{-- SECTION 1: IDENTITAS --}}
            <div class="section-badge mb-3">
                <span class="bg-warning text-white px-3 py-1 rounded-pill small fw-bold">I. INFORMASI RESPONDEN</span>
            </div>

            <div class="row mb-4 bg-light p-3 rounded-3 mx-0">
                <div class="col-md-6 mb-3 mb-md-0 border-end-md">
                    <div class="mb-3">
                        <label class="text-muted small d-block">Nama Lengkap</label>
                        <span class="h6 fw-bold mb-0">{{ $data->nama }}</span>
                    </div>
                    <div>
                        <label class="text-muted small d-block">NIK (Identitas)</label>
                        <span class="h6 fw-bold mb-0">{{ $data->nik }}</span>
                    </div>
                </div>
                <div class="col-md-6 ps-md-4">
                    <div class="mb-3">
                        <label class="text-muted small d-block">WhatsApp / Telp</label>
                        <span class="h6 fw-bold mb-0 text-primary">{{ $data->no_hp }}</span>
                    </div>
                    <div>
                        <label class="text-muted small d-block">Kategori / Pekerjaan</label>
                        <span class="h6 fw-bold mb-0">{{ $data->kategori_responden ?? '-' }}</span>
                    </div>
                </div>
            </div>

            @if($data->punya_usaha == 'ya')
                {{-- SECTION 2: KARAKTERISTIK USAHA --}}
                <div class="section-badge mb-3 mt-5">
                    <span class="bg-primary text-white px-3 py-1 rounded-pill small fw-bold">II. KARAKTERISTIK USAHA</span>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 h-100 bg-white">
                            <label class="text-muted small d-block mb-1 text-uppercase fw-bold">Kegiatan Utama</label>
                            <p class="mb-0 fw-bold">{{ $data->kegiatan_utama }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 h-100 bg-white">
                            <label class="text-muted small d-block mb-1 text-uppercase fw-bold">Jenis Klasifikasi</label>
                            <p class="mb-0 fw-bold">
                                @if($data->jenis_usaha == '1') Produksi Barang Sendiri
                                @elseif($data->jenis_usaha == '2') Perdagangan/Reseller
                                @elseif($data->jenis_usaha == '3') Kuliner (Makan/Minum)
                                @elseif($data->jenis_usaha == '4') Jasa Lainnya
                                @else - @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 h-100 bg-white">
                            <label class="text-muted small d-block mb-1 text-uppercase fw-bold">Lokasi Operasional</label>
                            <p class="mb-0 fw-bold">{{ $data->alamat_usaha }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-white">
                            <label class="text-muted small d-block mb-1 text-uppercase fw-bold">Estimasi Omset/Bulan</label>
                            <span class="h5 fw-bold text-success mb-0">Rp {{ number_format($data->omzet, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: EKONOMI DIGITAL --}}
                <div class="section-badge mb-3 mt-5">
                    <span class="bg-info text-white px-3 py-1 rounded-pill small fw-bold">III. PENETRASI EKONOMI DIGITAL</span>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 border-start border-info border-4 rounded-3 bg-light">
                            <label class="text-muted small d-block mb-2 text-uppercase fw-bold"><i class="fas fa-globe me-1"></i> Platform Yang Digunakan</label>
                            <p class="mb-2">{{ $data->platform_digital ?? '-' }}</p>
                            
                            <label class="text-muted small d-block mb-1 mt-3 text-uppercase fw-bold">Proporsi Transaksi Daring (Online)</label>
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar bg-info progress-bar-striped" role="progressbar" 
                                    style="width: {{ $data->proporsi_pendapatan_digital == '76-100%' ? '100%' : ($data->proporsi_pendapatan_digital == '51-75%' ? '75%' : ($data->proporsi_pendapatan_digital == '26-50%' ? '50%' : ($data->proporsi_pendapatan_digital == '1-25%' ? '25%' : '0%'))) }};">
                                    {{ $data->proporsi_pendapatan_digital ?? '0%' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border-start border-info border-4 rounded-3 bg-light h-100">
                            <div class="mb-3">
                                <label class="text-muted small d-block mb-1 text-uppercase fw-bold"><i class="fas fa-credit-card me-1"></i> Metode Pembayaran</label>
                                <p class="mb-0">{{ $data->metode_pembayaran_digital ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="text-muted small d-block mb-1 text-uppercase fw-bold"><i class="fas fa-desktop me-1"></i> Integrasi Software</label>
                                <p class="mb-0">{{ $data->software_operasional ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="card {{ $data->is_producer ? 'border-info' : 'border-light' }} bg-white">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle {{ $data->is_producer ? 'bg-info' : 'bg-secondary' }} text-white p-3 me-3">
                                    <i class="fas {{ $data->is_producer ? 'fa-microchip' : 'fa-user-tag' }} fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold">Status Klasifikasi Produser Digital</h6>
                                    @if($data->is_producer)
                                        <span class="text-info fw-bold">Responden adalah PRODUSER PRODUK DIGITAL (Pembuat Konten/Software/App)</span>
                                    @else
                                        <span class="text-muted">Responden hanya berperan sebagai pengguna/pedagang platform digital.</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 4: KOMUNITAS --}}
                <div class="section-badge mb-3 mt-5">
                    <span class="bg-secondary text-white px-3 py-1 rounded-pill small fw-bold">IV. ASPEK SOSIAL & KOMUNITAS</span>
                </div>
                <div class="p-3 border-start border-secondary border-4 rounded-3 bg-light">
                    <p class="mb-0">
                        <strong>Ikut Komunitas:</strong> {{ $data->ikut_komunitas == 'ya' ? 'Ya' : 'Tidak' }}
                        @if($data->ikut_komunitas == 'ya')
                            <br><strong>Nama Komunitas:</strong> {{ $data->nama_komunitas ?? '-' }}
                        @endif
                    </p>
                </div>

            @else
                <div class="text-center py-5">
                    <div class="mb-3 text-muted opacity-50"><i class="fas fa-info-circle fa-4x"></i></div>
                    <h5 class="text-muted">Responden ini tidak memiliki usaha.</h5>
                    <p class="text-muted small">Hanya data informasi dasar yang tersedia untuk responden non-pelaku usaha.</p>
                </div>
            @endif

            <div class="mt-5 border-top pt-4 text-center">
                <a href="{{ route('kues.jawaban') }}" class="btn btn-outline-secondary px-5 py-2 fw-bold">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Responden
                </a>
            </div>

        </div>
    </div>
</div>

<style>
    .border-end-md { border-right: 1px solid #dee2e6; }
    @media (max-width: 767.98px) { .border-end-md { border-right: none; } }
    .section-badge span { letter-spacing: 0.5px; }
    .bg-light { background-color: #f8f9fa !important; }
</style>

@endsection