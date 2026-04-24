@extends('layouts.app')

@section('content')

<div class="container" style="margin-top:90px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            @if(session('success'))
                <div class="card shadow-lg border-0 rounded-4 animate__animated animate__fadeIn">
                    <div class="card-body p-5 text-center">
                        <div class="display-1 text-success mb-4"><i class="fas fa-check-circle"></i></div>
                        <h2 class="fw-bold text-dark">Terima Kasih!</h2>
                        <p class="lead text-muted">{{ session('success') }}</p>
                        <hr class="my-4">
                        <a href="{{ route('welcome') }}" class="btn btn-warning btn-lg px-5 text-white fw-bold shadow-sm">Kembali ke Beranda</a>
                    </div>
                </div>
            @else
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white py-3" style="background: linear-gradient(135deg, #f79039 0%, #fbad6d 100%);">
                    <div class="d-flex align-items-center">
                        <div class="bg-white rounded-circle p-2 me-3 shadow-sm">
                            <i class="fas fa-poll-h fa-lg" style="color: #f79039;"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-uppercase tracking-wider">Identifikasi Ekonomi Digital</h4>
                            <small class="opacity-75">Formulir Pendataan Pelaku Usaha & Potensi Digital</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
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
                    <div class="progress mb-5" style="height: 6px; border-radius: 10px;">
                        <div id="progressBar" class="progress-bar bg-warning" role="progressbar" style="width: 25%; transition: width 0.4s ease;"></div>
                    </div>

                    <form method="POST" action="{{ route('kues.store') }}" id="formKuesioner" enctype="multipart/form-data">
                        @csrf

                        <!-- STEP 1: INFORMASI RESPONDEN -->
                        <div class="step-content">
                            <div class="section-title mb-4">
                                <h5 class="fw-bold text-dark"><i class="fas fa-id-card me-2 text-warning"></i>I. INFORMASI RESPONDEN</h5>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" required>
                                        <label for="nama">Nama Lengkap</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK" maxlength="16" required>
                                        <label for="nik">NIK (16 Digit)</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="tel" name="no_hp" id="no_hp" class="form-control" placeholder="No HP" required>
                                        <label for="no_hp">Nomor HP / WhatsApp</label>
                                    </div>
                                </div>

                                <!-- WILAYAH -->
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select id="kecamatan_id" name="kecamatan_id" class="form-select" required disabled>
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                        <label>Kecamatan</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select id="desa_id" name="desa_id" class="form-select" required disabled>
                                            <option value="">Pilih Desa</option>
                                        </select>
                                        <label>Desa</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select name="pekerjaan" id="pekerjaan" class="form-select" required>
                                            <option value="">Pilih Pekerjaan</option>
                                            <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                            <option value="Wiraswasta">Wiraswasta</option>
                                            <option value="Pegawai Negeri/BUMN">Pegawai Negeri / BUMN</option>
                                            <option value="Lainnya">Lainnya (Sebutkan)</option>
                                        </select>
                                        <label>Pekerjaan Utama</label>
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
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="fw-bold text-muted small text-uppercase mb-0">Alamat & Geotagging</label>
                                            <button type="button" class="btn btn-sm btn-primary shadow-sm" id="btn-lokasi-saya"><i class="fas fa-map-marker-alt me-1"></i> Gunakan Lokasi Saya</button>
                                        </div>
                                        <textarea name="alamat_usaha" class="form-control mb-3" rows="2" placeholder="Tuliskan alamat lengkap... (atau klik Gunakan Lokasi Saya)"></textarea>
                                        
                                        <!-- MAP PICKER -->
                                        <div id="map" style="height: 300px; border-radius: 12px; border: 2px solid #eee;" class="mb-2"></div>
                                        <p class="small text-muted"><i class="fas fa-info-circle me-1"></i> Geser pin atau klik pada peta untuk menentukan lokasi tepat Anda.</p>
                                        
                                        <input type="hidden" name="latitude" id="lat">
                                        <input type="hidden" name="longitude" id="lng">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="card bg-light border-0 rounded-3 p-3">
                                        <label class="fw-bold mb-2">Apakah Anda memiliki usaha (offline atau online)?</label>
                                        <select name="punya_usaha" id="punya_usaha" class="form-select form-select-lg border-warning" required>
                                            <option value="">Pilih Jawaban</option>
                                            <option value="ya">Ya, saya memiliki usaha</option>
                                            <option value="tidak">Tidak, saya tidak memiliki usaha</option>
                                        </select>
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
                                        <label class="fw-bold text-muted small text-uppercase">Kegiatan Utama Usaha</label>
                                        <input type="text" name="kegiatan_utama" class="form-control form-control-lg" placeholder="Contoh: Produksi Kripik Pisang">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase">Jenis Usaha</label>
                                        <select name="jenis_usaha" class="form-select">
                                            <option value="">Pilih Jenis</option>
                                            <option value="Affiliate Marketing">Affiliate Marketing</option>
                                            <option value="Jasa Digital">Jasa Digital (Desain, Admin, dll)</option>
                                            <option value="Content Creator">Content Creator</option>
                                            <option value="Produksi Barang Sendiri">Produksi Barang Sendiri</option>
                                            <option value="Reselling / Perdagangan">Reselling / Perdagangan</option>
                                            <option value="Kuliner">Kuliner (Makan & Minum)</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase">Omset Rata-rata per Bulan</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0">Rp</span>
                                            <input type="number" name="omzet" class="form-control" placeholder="0">
                                        </div>
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

                            <div class="row g-3">
                                <!-- SUMBER PENGHASILAN -->
                                <div class="col-12">
                                    <label class="fw-bold text-muted small text-uppercase mb-2">Sumber Penghasilan Digital (Bisa pilih lbih dari satu)</label>
                                    <div class="bg-light p-3 rounded-3 border-start border-warning border-4">
                                        @foreach(['Penjualan Barang', 'Komisi Affiliate', 'Iklan (Adsense, dll)', 'Jasa', 'Live Streaming', 'Lainnya'] as $item)
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox" name="sumber_penghasilan_digital[]" value="{{ $item }}" id="income_{{ $loop->index }}">
                                            <label class="form-check-label" for="income_{{ $loop->index }}">{{ $item }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- PLATFORM -->
                                <div class="col-12 py-2">
                                    <label class="fw-bold text-muted small text-uppercase mb-2">Platform Digital yang Digunakan</label>
                                    <div class="bg-light p-3 rounded-3 border-start border-warning border-4">
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox" name="platform_digital_v2[]" value="Marketplace">
                                            <label class="form-check-label">Marketplace (Shopee, Tokopedia, dll)</label>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox" name="platform_digital_v2[]" value="Social Media">
                                            <label class="form-check-label">Media Sosial (Instagram, TikTok, dll)</label>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox" name="platform_digital_v2[]" value="Freelance">
                                            <label class="form-check-label">Platform Freelance (Fiverr, Upwork, dll)</label>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox" name="platform_digital_v2[]" value="WhatsApp">
                                            <label class="form-check-label">WhatsApp / Pribadi</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="platform_digital_v2[]" value="Lainnya">
                                            <label class="form-check-label">Lainnya</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- UPDATE DIGITAL -->
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold text-muted small text-uppercase mb-2">Lama Menjalankan Aktivitas (Dalam bulan)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-warning"></i></span>
                                        <input type="number" name="lama_aktivitas_digital" class="form-control border-start-0" placeholder="Misal: 12" min="1">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold text-muted small text-uppercase mb-2">Apakah Aktivitas ini Menambah Penghasilan?</label>
                                    <select name="tambah_penghasilan_digital" class="form-select border-start border-warning border-4">
                                        <option value="">Pilih</option>
                                        <option value="ya">Ya, menambah</option>
                                        <option value="tidak">Tidak</option>
                                    </select>
                                </div>

                                <!-- PEMBAYARAN -->
                                <div class="col-12 py-2">
                                    <label class="fw-bold text-muted small text-uppercase mb-2">Metode Pembayaran Digital</label>
                                    <div class="bg-light p-3 rounded-3 border-start border-warning border-4">
                                        @foreach(['QRIS/Link Aja', 'Mobile/Internet Banking', 'Dana/OVO/GoPay', 'Lainnya'] as $item)
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox" name="metode_pembayaran_digital[]" value="{{ $item }}" id="pay_{{ $loop->index }}">
                                            <label class="form-check-label" for="pay_{{ $loop->index }}">{{ $item }}</label>
                                        </div>
                                        @endforeach
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
                                    <label class="fw-bold mb-3 d-block">Unggah Foto Rumah (Tampak Depan)</label>
                                    <div class="upload-zone text-center p-4 border rounded-3 bg-light">
                                        <i class="fas fa-camera fa-3x text-muted mb-2 me-3"></i>
                                        <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                        <div class="mt-3">
                                            <input type="file" name="foto_rumah" class="form-control" accept="image/*" required id="foto_rumah_input">
                                        </div>
                                        <p class="small text-muted mt-2">Pilih file dari galeri atau gunakan <b>Kamera Langsung</b> pada HP Anda (Format: JPG, PNG Maks 2MB)</p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-outline-secondary btn-lg px-4 prev-btn">Kembali</button>
                                <button type="submit" class="btn btn-success btn-lg px-5 fw-bold shadow">KIRIM KUESIONER <i class="fas fa-paper-plane ms-2"></i></button>
                            </div>
                        </div>

                    </form>
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

    // Initialize Map
    let map, marker;
    function initMap() {
        if (map) return;
        
        // Default coordinates (Mempawah/Pontianak area)
        const defaultLat = -0.0247;
        const defaultLng = 109.3404;

        map = L.map('map').setView([defaultLat, defaultLng], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        marker = L.marker([defaultLat, defaultLng], {draggable: true}).addTo(map);
        
        document.getElementById('lat').value = defaultLat;
        document.getElementById('lng').value = defaultLng;

        function updateLocation(lat, lng) {
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
            
            // Reverse Geocoding via Nominatim
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(res => res.json())
                .then(data => {
                    const alamatInput = document.querySelector('textarea[name="alamat_usaha"]');
                    if (alamatInput) {
                        let baseAddress = (data && data.display_name) ? data.display_name : '';
                        alamatInput.value = `${baseAddress}\n(Lat: ${lat}, Lng: ${lng})`;
                    }
                })
                .catch(err => {
                    console.error("Geocoding error:", err);
                    const alamatInput = document.querySelector('textarea[name="alamat_usaha"]');
                    if (alamatInput) alamatInput.value = `(Lat: ${lat}, Lng: ${lng})`;
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

        // Handle "Gunakan Lokasi Saya" button
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
                        map.setView([lat, lng], 16);
                        marker.setLatLng([lat, lng]);
                        updateLocation(lat, lng);

                        this.innerHTML = '<i class="fas fa-check me-1"></i> Lokasi Ditemukan';
                        setTimeout(() => {
                            this.innerHTML = btnOrigText;
                            this.disabled = false;
                        }, 2000);
                    }, error => {
                        alert("Gagal mengakses lokasi. Pastikan izin lokasi (GPS) aktif di browser/HP Anda.");
                        this.innerHTML = btnOrigText;
                        this.disabled = false;
                    });
                } else {
                    alert("Browser Anda tidak mendukung Geolokasi.");
                    this.innerHTML = btnOrigText;
                    this.disabled = false;
                }
            });
        }

        // Try auto-geolocate on first load
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                map.setView([lat, lng], 16);
                marker.setLatLng([lat, lng]);
                updateLocation(lat, lng);
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
        
        // Init map if visible
        if (targetStep === 1) {
            setTimeout(initMap, 500); // Small delay for rendering
        }
    }

    // Region Dropdowns logic
    const kabSelect = document.getElementById('kabupaten_id');
    const kecSelect = document.getElementById('kecamatan_id');
    const desaSelect = document.getElementById('desa_id');

    if (kabSelect) {
        kabSelect.addEventListener('change', function() {
            loadRegions(this.value, kecSelect, 'Pilih Kecamatan');
            desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
            desaSelect.disabled = true;
        });
    }

    if (kecSelect) {
        kecSelect.addEventListener('change', function() {
            loadRegions(this.value, desaSelect, 'Pilih Desa');
        });
    }

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
    if (pekerjaanSelect) {
        pekerjaanSelect.addEventListener('change', function() {
            document.getElementById('pekerjaan_lainnya_wrapper').classList.toggle('d-none', this.value !== 'Lainnya');
        });
    }

    // Navigation logic
    document.querySelectorAll(".next-btn").forEach(btn => {
        btn.addEventListener("click", function() {
            // Basic validation
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

            historyStep.push(currentStep);
            
            // Skip logic if No Business
            if (currentStep === 0 && document.getElementById('punya_usaha').value === 'tidak') {
                updateStep(3); // Jump to final
                return;
            }

            updateStep(currentStep + 1);
        });
    });

    document.querySelectorAll(".prev-btn").forEach(btn => {
        btn.addEventListener("click", function() {
            if (historyStep.length > 0) {
                updateStep(historyStep.pop());
            }
        });
    });

    // Handle initial state
    if (document.getElementById('formKuesioner')) updateStep(0);
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