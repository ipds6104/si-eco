@extends('layouts.app')

@section('content')

<div class="container-fluid px-4" style="margin-top:90px; margin-bottom: 50px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark"><i class="fas fa-edit me-2 text-warning"></i>Edit Data Responden</h3>
        <a href="{{ route('kues.jawaban') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('kues.update', $data->id) }}" method="POST" id="editForm">
                @csrf
                @method('PUT')

                {{-- SECTION I: IDENTITAS --}}
                <div class="section-title mb-4 bg-light p-3 border-start border-warning border-5 rounded-end shadow-sm">
                    <h5 class="mb-0 fw-bold text-dark">I. INFORMASI RESPONDEN</h5>
                </div>

                <div class="row g-3 mb-5">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="fw-bold small text-muted text-uppercase mb-1">Status Pengisi</label>
                            <select name="status_pengisi" class="form-select">
                                <option value="Pemilik Usaha" {{ $data->status_pengisi == 'Pemilik Usaha' ? 'selected' : '' }}>Pemilik Usaha</option>
                                <option value="Pendamping/RT" {{ $data->status_pengisi == 'Pendamping/RT' ? 'selected' : '' }}>Pendata / Ketua RT / Pendamping</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="fw-bold small text-muted text-uppercase mb-1">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="fw-bold small text-muted text-uppercase mb-1">NIK (16 Digit)</label>
                            <input type="text" name="nik" class="form-control" value="{{ $data->nik }}" maxlength="16" pattern="\d{16}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="fw-bold small text-muted text-uppercase mb-1">Nomor HP / WhatsApp</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ $data->no_hp }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="fw-bold small text-muted text-uppercase mb-1">Kategori Responden</label>
                            <select name="kategori_responden" class="form-select">
                                <option value="Mahasiswa" {{ $data->kategori_responden == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                <option value="Wiraswasta" {{ $data->kategori_responden == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta / Pemilik Usaha</option>
                                <option value="Pegawai Negeri" {{ $data->kategori_responden == 'Pegawai Negeri' ? 'selected' : '' }}>Pegawai Negeri / BUMN</option>
                                <option value="Pegawai Swasta" {{ $data->kategori_responden == 'Pegawai Swasta' ? 'selected' : '' }}>Pegawai Swasta</option>
                                <option value="Lainnya" {{ $data->kategori_responden == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="fw-bold small text-muted text-uppercase mb-1">Punya Usaha?</label>
                            <select name="punya_usaha" id="punya_usaha" class="form-select border-warning">
                                <option value="ya" {{ $data->punya_usaha == 'ya' ? 'selected' : '' }}>Ya, Memiliki Usaha</option>
                                <option value="tidak" {{ $data->punya_usaha == 'tidak' ? 'selected' : '' }}>Tidak Memiliki Usaha</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="usaha_section" class="{{ $data->punya_usaha == 'tidak' ? 'd-none' : '' }}">
                    {{-- SECTION II: KARAKTERISTIK USAHA --}}
                    <div class="section-title mb-4 bg-light p-3 border-start border-warning border-5 rounded-end shadow-sm">
                        <h5 class="mb-0 fw-bold text-dark">II. KARAKTERISTIK USAHA</h5>
                    </div>

                    <div class="row g-3 mb-5">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Nama Usaha / Kegiatan Utama</label>
                                <input type="text" name="kegiatan_utama" class="form-control" value="{{ $data->kegiatan_utama }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Kategori Usaha</label>
                                <input type="text" name="jenis_usaha" class="form-control" value="{{ $data->jenis_usaha }}" placeholder="Contoh: Kuliner, Jasa, dll">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Jumlah Tenaga Kerja</label>
                                <input type="text" name="jumlah_tk" class="form-control" value="{{ $data->jumlah_tk }}" placeholder="Contoh: 1-5 Orang">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Tahun Mulai Beroperasi</label>
                                <input type="number" name="tahun_mulai" class="form-control" value="{{ $data->tahun_mulai }}" placeholder="Contoh: 2020">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Legalitas Usaha</label>
                                <input type="text" name="legalitas" class="form-control" value="{{ $data->legalitas }}" placeholder="Contoh: NIB, IUMK, Tidak Ada">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Alamat Usaha (Fisik/Online)</label>
                                <input type="text" name="alamat_usaha" class="form-control" value="{{ $data->alamat_usaha }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Estimasi Omset per Bulan</label>
                                <input type="text" name="omzet" class="form-control" value="{{ $data->omzet }}">
                            </div>
                        </div>
                    </div>

                    {{-- SECTION III: AKTIVITAS DIGITAL --}}
                    <div class="section-title mb-4 bg-light p-3 border-start border-info border-5 rounded-end shadow-sm">
                        <h5 class="mb-0 fw-bold text-dark">III. AKTIVITAS DIGITAL</h5>
                    </div>

                    <div class="row g-3 mb-5">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Pemanfaatan Saluran Digital?</label>
                                <select name="use_digital" id="use_digital" class="form-select border-info">
                                    <option value="ya" {{ $data->use_digital == 'ya' ? 'selected' : '' }}>Ya, Menggunakan Digital</option>
                                    <option value="tidak" {{ $data->use_digital == 'tidak' ? 'selected' : '' }}>Tidak (Offline Murni)</option>
                                </select>
                            </div>
                        </div>
                        <div id="digital_fields" class="row g-3 {{ $data->use_digital == 'tidak' ? 'd-none' : '' }}">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold small text-muted text-uppercase mb-1">Platform (Shopee, WA, FB, dll)</label>
                                    <input type="text" name="platform_digital_v2" class="form-control" value="{{ $data->platform_digital_v2 }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold small text-muted text-uppercase mb-1">Sumber Penghasilan Digital</label>
                                    <input type="text" name="sumber_penghasilan_digital" class="form-control" value="{{ $data->sumber_penghasilan_digital }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold small text-muted text-uppercase mb-1">Lama Beraktivitas Digital</label>
                                    <input type="text" name="lama_aktivitas_digital" class="form-control" value="{{ $data->lama_aktivitas_digital }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold small text-muted text-uppercase mb-1">Dampak Terhadap Omset</label>
                                    <input type="text" name="tambah_penghasilan_digital" class="form-control" value="{{ $data->tambah_penghasilan_digital }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold small text-muted text-uppercase mb-1">Metode Pembayaran Digital</label>
                                    <input type="text" name="metode_pembayaran_digital" class="form-control" value="{{ $data->metode_pembayaran_digital }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold small text-muted text-uppercase mb-1">Kendala Utama</label>
                                    <input type="text" name="kendala" class="form-control" value="{{ $data->kendala }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SECTION IV: FINALISASI & SENSUS --}}
                    <div class="section-title mb-4 bg-light p-3 border-start border-success border-5 rounded-end shadow-sm">
                        <h5 class="mb-0 fw-bold text-dark">IV. FINALISASI & SENSUS EKONOMI 2026</h5>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Pernah Dikunjungi Petugas SE2026?</label>
                                <input type="text" name="se2026_visit" class="form-control" value="{{ $data->se2026_visit }}">
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="mt-5 border-top pt-4 text-end">
                    <button type="submit" class="btn btn-warning btn-lg text-white fw-bold px-5 py-3 shadow border-0">
                        <i class="fas fa-save me-2"></i> UPDATE DATA RESPONDEN
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const usahaSelect = document.getElementById('punya_usaha');
    const usahaSection = document.getElementById('usaha_section');
    
    usahaSelect.addEventListener('change', function() {
        usahaSection.classList.toggle('d-none', this.value !== 'ya');
    });

    const digitalSelect = document.getElementById('use_digital');
    const digitalFields = document.getElementById('digital_fields');
    
    digitalSelect.addEventListener('change', function() {
        digitalFields.classList.toggle('d-none', this.value !== 'ya');
    });
});
</script>

<style>
    .rounded-4 { border-radius: 1rem !important; }
    .bg-light-info { background-color: #f0faff; }
</style>

@endsection