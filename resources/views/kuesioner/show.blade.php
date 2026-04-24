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
                        <label class="text-muted small d-block">Status Pengisi</label>
                        <span class="badge bg-secondary mb-2">{{ $data->status_pengisi ?? 'Pemilik Usaha' }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small d-block">Nama Lengkap</label>
                        <span class="h6 fw-bold mb-0">{{ $data->nama }}</span>
                    </div>
                    <div>
                        <label class="text-muted small d-block">NIK (Identitas)</label>
                        <span class="h6 fw-bold mb-0">{{ $data->nik ?? '-' }}</span>
                    </div>
                </div>
                <div class="col-md-6 ps-md-4">
                    <div class="mb-3">
                        <label class="text-muted small d-block">WhatsApp / Telp</label>
                        <span class="h6 fw-bold mb-0 text-primary">{{ $data->no_hp }}</span>
                    </div>
                    <div>
                        <label class="text-muted small d-block">Wilayah Tugas</label>
                        <span class="h6 fw-bold mb-0">
                            {{ $data->kabupaten->name ?? '-' }} > 
                            {{ $data->kecamatan->name ?? '-' }} > 
                            {{ $data->desa->name ?? '-' }} > 
                            {{ $data->sls->name ?? '-' }}
                        </span>
                    </div>
                </div>
            </div>

            @if($data->punya_usaha == 'ya')
                {{-- SECTION 2: KARAKTERISTIK USAHA --}}
                <div class="section-badge mb-3 mt-5">
                    <span class="bg-primary text-white px-3 py-1 rounded-pill small fw-bold">II. KARAKTERISTIK USAHA</span>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 border rounded-3 h-100 bg-white shadow-sm">
                            <label class="text-muted small d-block mb-1 text-uppercase fw-bold">Kategori Usaha</label>
                            <p class="mb-0 fw-bold">{{ $data->jenis_usaha ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 border rounded-3 h-100 bg-white shadow-sm">
                            <label class="text-muted small d-block mb-1 text-uppercase fw-bold">Tenaga Kerja</label>
                            <p class="mb-0 fw-bold">{{ $data->jumlah_tk ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 border rounded-3 h-100 bg-white shadow-sm">
                            <label class="text-muted small d-block mb-1 text-uppercase fw-bold">Tahun Mulai</label>
                            <p class="mb-0 fw-bold">{{ $data->tahun_mulai ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 border rounded-3 h-100 bg-white shadow-sm">
                            <label class="text-muted small d-block mb-1 text-uppercase fw-bold">Legalitas</label>
                            <p class="mb-0 fw-bold">{{ $data->legalitas ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3 border rounded-3 bg-white shadow-sm">
                            <label class="text-muted small d-block mb-1 text-uppercase fw-bold">Nama Usaha & Alamat</label>
                            <p class="mb-1 fw-bold h5 text-primary">{{ $data->kegiatan_utama }}</p>
                            <p class="mb-0 text-muted">{{ $data->alamat_usaha ?? 'Tidak ada alamat fisik' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-white shadow-sm border-start border-success border-4">
                            <label class="text-muted small d-block mb-1 text-uppercase fw-bold">Estimasi Omset/Bulan</label>
                            <span class="h5 fw-bold text-success mb-0">{{ $data->omzet ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: EKONOMI DIGITAL --}}
                <div class="section-badge mb-3 mt-5">
                    <span class="bg-info text-white px-3 py-1 rounded-pill small fw-bold">III. AKTIVITAS DIGITAL</span>
                </div>
                
                <div class="row g-4 mb-4">
                    <div class="col-12">
                        <div class="p-3 border rounded-3 {{ $data->use_digital == 'ya' ? 'bg-white border-info' : 'bg-light' }} shadow-sm">
                            <div class="d-flex align-items-center mb-2">
                                <div class="rounded-circle {{ $data->use_digital == 'ya' ? 'bg-info' : 'bg-secondary' }} text-white p-2 me-3">
                                    <i class="fas {{ $data->use_digital == 'ya' ? 'fa-check' : 'fa-times' }}"></i>
                                </div>
                                <h6 class="mb-0 fw-bold">Status Pemanfaatan Saluran Digital: 
                                    <span class="{{ $data->use_digital == 'ya' ? 'text-info' : 'text-muted' }}">
                                        {{ $data->use_digital == 'ya' ? 'YA, MENGGUNAKAN' : 'TIDAK (OFFLINE MURNI)' }}
                                    </span>
                                </h6>
                            </div>
                        </div>
                    </div>

                    @if($data->use_digital == 'ya')
                    <div class="col-md-6">
                        <div class="p-3 border-start border-info border-4 rounded-3 bg-white shadow-sm h-100">
                            <label class="text-muted small d-block mb-2 text-uppercase fw-bold"><i class="fas fa-layer-group me-1 text-info"></i> Platform & Sumber Penghasilan</label>
                            <div class="mb-3">
                                <small class="text-muted d-block">Platform:</small>
                                <p class="mb-0 fw-bold">{{ $data->platform_digital_v2 ?? '-' }}</p>
                            </div>
                            <div>
                                <small class="text-muted d-block">Sumber Penghasilan:</small>
                                <p class="mb-0 fw-bold">{{ $data->sumber_penghasilan_digital ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border-start border-info border-4 rounded-3 bg-white shadow-sm h-100">
                            <label class="text-muted small d-block mb-2 text-uppercase fw-bold"><i class="fas fa-chart-line me-1 text-info"></i> Pengalaman & Dampak</label>
                            <div class="mb-3">
                                <small class="text-muted d-block">Lama Menggunakan:</small>
                                <p class="mb-0 fw-bold">{{ $data->lama_aktivitas_digital ?? '-' }}</p>
                            </div>
                            <div>
                                <small class="text-muted d-block">Dampak terhadap Omset:</small>
                                <p class="mb-0 fw-bold">{{ $data->tambah_penghasilan_digital ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="p-3 border-start border-info border-4 rounded-3 bg-white shadow-sm">
                            <label class="text-muted small d-block mb-2 text-uppercase fw-bold"><i class="fas fa-credit-card me-1 text-info"></i> Metode Pembayaran & Kendala</label>
                            <div class="mb-3">
                                <small class="text-muted d-block">Metode Pembayaran Digital:</small>
                                <p class="mb-0 fw-bold">{{ $data->metode_pembayaran_digital ?? '-' }}</p>
                            </div>
                            <div>
                                <small class="text-muted d-block">Kendala Utama:</small>
                                <p class="mb-0 fw-bold text-danger">{{ $data->kendala ?? 'Tidak ada kendala signifikan' }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- SECTION 4: FINALISASI & SENSUS --}}
                <div class="section-badge mb-3 mt-5">
                    <span class="bg-success text-white px-3 py-1 rounded-pill small fw-bold">IV. FINALISASI & SENSUS EKONOMI 2026</span>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-12">
                        <div class="p-3 border-start border-success border-4 rounded-3 bg-white shadow-sm">
                            <label class="text-muted small d-block mb-1 text-uppercase fw-bold">Status Kunjungan Petugas SE2026</label>
                            <p class="mb-0 fw-bold h6">{{ $data->se2026_visit ?? '-' }}</p>
                        </div>
                    </div>
                    @if($data->foto_rumah)
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-white shadow-sm">
                            <label class="text-muted small d-block mb-2 text-uppercase fw-bold">Foto Tempat Usaha / Produk</label>
                            <img src="{{ asset('storage/' . $data->foto_rumah) }}" class="img-fluid rounded shadow-sm border" style="max-height: 300px; width: 100%; object-fit: cover;">
                        </div>
                    </div>
                    @endif
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