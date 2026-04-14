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
                                <label class="fw-bold small text-muted text-uppercase mb-1">Kegiatan Utama Usaha</label>
                                <input type="text" name="kegiatan_utama" class="form-control" value="{{ $data->kegiatan_utama }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Jenis Usaha</label>
                                <select name="jenis_usaha" class="form-select">
                                    <option value="1" {{ $data->jenis_usaha == '1' ? 'selected' : '' }}>Produksi Barang Sendiri</option>
                                    <option value="2" {{ $data->jenis_usaha == '2' ? 'selected' : '' }}>Perdagangan / Reseller</option>
                                    <option value="3" {{ $data->jenis_usaha == '3' ? 'selected' : '' }}>Kuliner (Makan/Minum)</option>
                                    <option value="4" {{ $data->jenis_usaha == '4' ? 'selected' : '' }}>Penyediaan Jasa Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Lokasi Usaha</label>
                                <input type="text" name="alamat_usaha" class="form-control" value="{{ $data->alamat_usaha }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Estimasi Omset per Bulan (Rp)</label>
                                <input type="number" name="omzet" class="form-control" value="{{ $data->omzet }}">
                            </div>
                        </div>
                    </div>

                    {{-- SECTION III: EKONOMI DIGITAL --}}
                    <div class="section-title mb-4 bg-light p-3 border-start border-info border-5 rounded-end shadow-sm">
                        <h5 class="mb-0 fw-bold text-dark">III. PENETRASI EKONOMI DIGITAL</h5>
                    </div>

                    <div class="row g-3 mb-5">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Platform Digital (Pisahkan dengan koma)</label>
                                <input type="text" name="platform_digital" class="form-control" value="{{ $data->platform_digital }}" placeholder="Contoh: Shopee, TikTok, Instagram">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Proporsi Transaksi Online</label>
                                <select name="proporsi_pendapatan_digital" class="form-select">
                                    <option value="0%" {{ $data->proporsi_pendapatan_digital == '0%' ? 'selected' : '' }}>0%</option>
                                    <option value="1-25%" {{ $data->proporsi_pendapatan_digital == '1-25%' ? 'selected' : '' }}>1-25%</option>
                                    <option value="26-50%" {{ $data->proporsi_pendapatan_digital == '26-50%' ? 'selected' : '' }}>26-50%</option>
                                    <option value="51-75%" {{ $data->proporsi_pendapatan_digital == '51-75%' ? 'selected' : '' }}>51-75%</option>
                                    <option value="76-100%" {{ $data->proporsi_pendapatan_digital == '76-100%' ? 'selected' : '' }}>76-100%</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Metode Pembayaran Digital</label>
                                <input type="text" name="metode_pembayaran_digital" class="form-control" value="{{ $data->metode_pembayaran_digital }}" placeholder="Contoh: QRIS, Transfer, OVO">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Software Operasional</label>
                                <input type="text" name="software_operasional" class="form-control" value="{{ $data->software_operasional }}" placeholder="Contoh: Moka POS, Zahir Accounting">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card border-info bg-light-info">
                                <div class="card-body">
                                    <label class="fw-bold mb-2">Produser Produk Digital?</label>
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_producer" value="1" id="radYa" {{ $data->is_producer ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="radYa">Ya, Pembuat Produk/Konten Digital</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_producer" value="0" id="radTidak" {{ !$data->is_producer ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="radTidak">Bukan Produser</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SECTION IV: KOMUNITAS --}}
                    <div class="section-title mb-4 bg-light p-3 border-start border-secondary border-5 rounded-end shadow-sm">
                        <h5 class="mb-0 fw-bold text-dark">IV. ASPEK SOSIAL</h5>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Ikut Komunitas?</label>
                                <select name="ikut_komunitas" id="ikut_komunitas" class="form-select">
                                    <option value="ya" {{ $data->ikut_komunitas == 'ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="tidak" {{ $data->ikut_komunitas == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 {{ $data->ikut_komunitas == 'tidak' ? 'd-none' : '' }}" id="komunitas_wrapper">
                            <div class="form-group mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-1">Nama Komunitas</label>
                                <input type="text" name="nama_komunitas" class="form-control" value="{{ $data->nama_komunitas }}">
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
        if(this.value === 'ya') {
            usahaSection.classList.remove('d-none');
        } else {
            usahaSection.classList.add('d-none');
        }
    });

    const komunitasSelect = document.getElementById('ikut_komunitas');
    const komunitasWrapper = document.getElementById('komunitas_wrapper');
    
    komunitasSelect.addEventListener('change', function() {
        if(this.value === 'ya') {
            komunitasWrapper.classList.remove('d-none');
        } else {
            komunitasWrapper.classList.add('d-none');
        }
    });
});
</script>

<style>
    .rounded-4 { border-radius: 1rem !important; }
    .bg-light-info { background-color: #f0faff; }
</style>

@endsection