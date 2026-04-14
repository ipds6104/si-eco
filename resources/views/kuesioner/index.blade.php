@extends('layouts.app')

@section('content')

<div class="container" style="margin-top:90px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-lg-9">
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

                    <form method="POST" action="{{ route('kues.store') }}" id="formKuesioner">
                        @csrf

                        <!-- STEP 1: INFORMASI RESPONDEN -->
                        <div class="step-content">
                            <div class="section-title mb-4">
                                <h5 class="fw-bold text-dark"><i class="fas fa-id-card me-2 text-warning"></i>I. INFORMASI RESPONDEN</h5>
                                <p class="text-muted small">Silakan lengkapi data diri Anda sesuai dengan identitas resmi.</p>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" data-required="true">
                                        <label for="nama">Nama Lengkap</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK (16 Digit)" maxlength="16" minlength="16" data-required="true">
                                        <label for="nik">NIK (16 Digit)</label>
                                        <div class="invalid-feedback">NIK harus 16 digit angka.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="tel" name="no_hp" id="no_hp" class="form-control" placeholder="No HP/WhatsApp" maxlength="14" data-required="true">
                                        <label for="no_hp">Nomor HP / WhatsApp</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select name="kategori_responden" id="kategori_responden" class="form-select" data-required="true">
                                            <option value="">Pilih Kategori</option>
                                            <option value="Mahasiswa">Mahasiswa</option>
                                            <option value="Wiraswasta">Wiraswasta / Pemilik Usaha</option>
                                            <option value="Pegawai Negeri">Pegawai Negeri / BUMN</option>
                                            <option value="Pegawai Swasta">Pegawai Swasta</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        <label for="kategori_responden">Kategori / Pekerjaan Responden</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card bg-light border-0 rounded-3 p-3">
                                        <label class="fw-bold mb-2">Apakah Anda memiliki usaha (offline atau online)?</label>
                                        <select name="punya_usaha" id="punya_usaha" class="form-select form-select-lg border-warning shadow-sm" data-required="true">
                                            <option value="">Pilih Jawaban</option>
                                            <option value="ya">Ya, saya memiliki usaha</option>
                                            <option value="tidak">Tidak, saya tidak memiliki usaha</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-5">
                                <button type="button" class="btn btn-warning btn-lg px-5 text-white fw-bold shadow-sm next-btn">
                                    Lanjut <i class="fas fa-chevron-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- STEP 2: KARAKTERISTIK USAHA -->
                        <div class="step-content d-none">
                            <div class="section-title mb-4">
                                <h5 class="fw-bold text-dark"><i class="fas fa-store me-2 text-warning"></i>II. KARAKTERISTIK USAHA</h5>
                                <p class="text-muted small">Berikan informasi mendasar mengenai operasional usaha Anda.</p>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase">Kegiatan Utama Usaha</label>
                                        <input type="text" name="kegiatan_utama" class="form-control form-control-lg" placeholder="Contoh: Produksi Kripik Pisang, Jasa Desain Grafis" data-required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase">Jenis Usaha</label>
                                        <select name="jenis_usaha" class="form-select" data-required="true">
                                            <option value="">Pilih Jenis</option>
                                            <option value="1">Produksi Barang Sendiri</option>
                                            <option value="2">Reselling / Perdagangan</option>
                                            <option value="3">Kuliner (Makan & Minum)</option>
                                            <option value="4">Penyediaan Jasa lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase">Lokasi Usaha Utama</label>
                                        <select name="alamat_usaha" class="form-select" data-required="true">
                                            <option value="">Pilih Lokasi</option>
                                            <option value="rumah">Rumah Tinggal</option>
                                            <option value="ruko">Ruko / Mal / Bangunan Toko</option>
                                            <option value="keliling">Keliling / Kaki Lima</option>
                                            <option value="online">Hanya Daring (Online)</option>
                                            <option value="pasar">Pasar Tradisional</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase text-primary"><i class="fas fa-globe me-1"></i> Platform Digital yang Digunakan</label>
                                        <div class="row mt-2 bg-light p-3 rounded-3 g-2 mx-0">
                                            <div class="col-md-6">
                                                <div class="form-check"><input class="form-check-input" type="checkbox" name="platform_digital[]" value="Social Media"> <label class="form-check-label">Media Sosial (IG/WA/FB/TikTok)</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox" name="platform_digital[]" value="Marketplace"> <label class="form-check-label">Marketplace (Shopee/Tokopedia)</label></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check"><input class="form-check-input" type="checkbox" name="platform_digital[]" value="Website"> <label class="form-check-label">Website Sendiri</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox" name="platform_digital[]" value="On-demand"> <label class="form-check-label">Ojek/Food Delivery Online</label></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase">Omset Rata-rata per Bulan</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-white border-end-0">Rp</span>
                                            <input type="number" name="omzet" class="form-control border-start-0" placeholder="0" data-required="true">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-outline-secondary btn-lg px-4 prev-btn"><i class="fas fa-chevron-left me-2"></i> Kembali</button>
                                <button type="button" class="btn btn-warning btn-lg px-5 text-white fw-bold shadow-sm next-btn">Lanjut <i class="fas fa-chevron-right ms-2"></i></button>
                            </div>
                        </div>

                        <!-- STEP 3: EKONOMI DIGITAL DEEP-DIVE -->
                        <div class="step-content d-none">
                            <div class="section-title mb-4">
                                <h5 class="fw-bold text-dark"><i class="fas fa-laptop-code me-2 text-warning"></i>III. PENETRASI EKONOMI DIGITAL</h5>
                                <p class="text-muted small">Detail pemanfaatan teknologi informasi dalam bisnis Anda.</p>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase d-block mb-2">Proporsi Pendapatan dari Transaksi Online</label>
                                        <div class="btn-group w-100 shadow-sm" role="group">
                                            <input type="radio" name="proporsi_pendapatan_digital" value="0%" class="btn-check" id="prop0" autocomplete="off" checked>
                                            <label class="btn btn-outline-warning py-3" for="prop0">0%</label>
                                            
                                            <input type="radio" name="proporsi_pendapatan_digital" value="1-25%" class="btn-check" id="prop25" autocomplete="off">
                                            <label class="btn btn-outline-warning py-3" for="prop25">1-25%</label>
                                            
                                            <input type="radio" name="proporsi_pendapatan_digital" value="26-50%" class="btn-check" id="prop50" autocomplete="off">
                                            <label class="btn btn-outline-warning py-3" for="prop50">26-50%</label>
                                            
                                            <input type="radio" name="proporsi_pendapatan_digital" value="51-75%" class="btn-check" id="prop75" autocomplete="off">
                                            <label class="btn btn-outline-warning py-3" for="prop75">51-75%</label>
                                            
                                            <input type="radio" name="proporsi_pendapatan_digital" value="76-100%" class="btn-check" id="prop100" autocomplete="off">
                                            <label class="btn btn-outline-warning py-3" for="prop100">76-100%</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-warning">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase mb-2"><i class="fas fa-credit-card me-1"></i> Metode Pembayaran Digital</label>
                                        <div class="bg-light p-3 rounded-3 border-start border-warning border-4">
                                            <div class="form-check mb-1"><input class="form-check-input" type="checkbox" name="metode_pembayaran_digital[]" value="QRIS"> <label class="form-check-label">QRIS / LinkAja</label></div>
                                            <div class="form-check mb-1"><input class="form-check-input" type="checkbox" name="metode_pembayaran_digital[]" value="Transfer Bank"> <label class="form-check-label">Mobile/Internet Banking</label></div>
                                            <div class="form-check mb-1"><input class="form-check-input" type="checkbox" name="metode_pembayaran_digital[]" value="E-wallet"> <label class="form-check-label">Dana / OVO / Gopay</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="metode_pembayaran_digital[]" value="Payment Gateway"> <label class="form-check-label">Midtrans / Xendit</label></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-warning">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase mb-2"><i class="fas fa-desktop me-1"></i> Software Operasional</label>
                                        <div class="bg-light p-3 rounded-3 border-start border-warning border-4">
                                            <div class="form-check mb-1"><input class="form-check-input" type="checkbox" name="software_operasional[]" value="POS"> <label class="form-check-label">Kasir / POS (Point of Sale)</label></div>
                                            <div class="form-check mb-1"><input class="form-check-input" type="checkbox" name="software_operasional[]" value="Accounting"> <label class="form-check-label">Akuntansi / Keuangan</label></div>
                                            <div class="form-check mb-1"><input class="form-check-input" type="checkbox" name="software_operasional[]" value="Inventory"> <label class="form-check-label">Manajemen Stok</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="software_operasional[]" value="Analytics"> <label class="form-check-label">Data Analytics / CRM</label></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase">Ingin bergabung/sudah bergabung komunitas digital?</label>
                                        <select name="ikut_komunitas" id="ikut_komunitas" class="form-select">
                                            <option value="tidak">Belum / Tidak Bergabung</option>
                                            <option value="ya">Sudah Bergabung</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 d-none" id="nama_komunitas_wrapper">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold text-muted small text-uppercase">Nama Komunitas</label>
                                        <input type="text" name="nama_komunitas" class="form-control" placeholder="Tuliskan nama komunitas bisnis Anda">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-outline-secondary btn-lg px-4 prev-btn"><i class="fas fa-chevron-left me-2"></i> Kembali</button>
                                <button type="button" class="btn btn-warning btn-lg px-5 text-white fw-bold shadow-sm next-btn">Lanjut <i class="fas fa-chevron-right ms-2"></i></button>
                            </div>
                        </div>

                        <!-- STEP 4: PRODUSER DIGITAL & FINAL -->
                        <div class="step-content d-none">
                            <div class="section-title mb-4">
                                <h5 class="fw-bold text-dark"><i class="fas fa-rocket me-2 text-warning"></i>IV. PRODUSER & KONFIRMASI</h5>
                                <p class="text-muted small">Tahap akhir klasifikasi dan pengiriman data.</p>
                            </div>

                            <div class="card mb-4 border-dashed border-2">
                                <div class="card-body bg-light-warning">
                                    <label class="fw-bold h6 mb-3">Apakah usaha Anda menghasilkan/membuat produk dalam bentuk digital?</label>
                                    <p class="text-muted small mb-3">Pilih "Ya" jika Anda membuat: Software, Aplikasi mobile, Website builder, Jasa Desain Grafis Digital, Kreator Konten Video/Musik/Ilustrasi.</p>
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_producer" value="1" id="prodYa">
                                            <label class="form-check-label fw-bold" for="prodYa">Ya, Kami Produser Digital</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_producer" value="0" id="prodTidak" checked>
                                            <label class="form-check-label fw-bold" for="prodTidak">Bukan Produser Digital</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center p-4 bg-white border rounded-4 mt-5">
                                <div class="display-6 text-success mb-3"><i class="fas fa-check-circle"></i></div>
                                <h5 class="fw-bold">Data Anda Siap Dikirim</h5>
                                <p class="text-muted mb-0">Terima kasih telah berpartisipasi dalam pemetaan ekonomi digital ini.</p>
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-outline-secondary btn-lg px-4 prev-btn"><i class="fas fa-chevron-left me-2"></i> Kembali</button>
                                <button type="submit" class="btn btn-success btn-lg px-5 fw-bold shadow ripple-effect" id="btnSubmit">KIRIM KUESIONER <i class="fas fa-paper-plane ms-2"></i></button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let currentStep = 0;
    let historyStep = [];
    const stepContents = document.querySelectorAll(".step-content");
    const indicatorItems = document.querySelectorAll(".step-item");
    const kuesForm = document.getElementById("formKuesioner");

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
            const progressPercent = ((targetStep + 1) / stepContents.length) * 100;
            progressBar.style.width = progressPercent + "%";
        }
        
        currentStep = targetStep;
        toggleFieldsRequirement(targetStep);
    }

    function toggleFieldsRequirement(activeStepIdx) {
        stepContents.forEach((step, idx) => {
            const inputs = step.querySelectorAll("input, select, textarea");
            inputs.forEach(input => {
                if (idx === activeStepIdx && input.dataset.required === "true") {
                    input.setAttribute("required", "required");
                } else {
                    input.removeAttribute("required");
                }
            });
        });
    }

    function validateCurrentStep() {
        const activeContainer = stepContents[currentStep];
        const requiredInputs = activeContainer.querySelectorAll("[required]");
        
        for (let input of requiredInputs) {
            if (!input.value.trim()) {
                Swal.fire({ icon: 'warning', title: 'Data Belum Lengkap', text: 'Mohon isi semua field yang wajib diisi.' });
                input.classList.add('is-invalid');
                input.focus();
                return false;
            }
            input.classList.remove('is-invalid');

            // NIK specifically
            if (input.id === 'nik') {
                const nikVal = input.value.trim();
                if (!/^\d{16}$/.test(nikVal)) {
                    Swal.fire({ icon: 'error', title: 'NIK Tidak Valid', text: 'NIK harus berisi tepat 16 digit angka.' });
                    input.classList.add('is-invalid');
                    return false;
                }
            }
        }
        return true;
    }

    // Step Navigation
    document.querySelectorAll(".next-btn").forEach(btn => {
        btn.addEventListener("click", function() {
            if (validateCurrentStep()) {
                historyStep.push(currentStep);
                
                // Shortcut Logic
                if (currentStep === 0) {
                    const statusUsaha = document.getElementById("punya_usaha").value;
                    if (statusUsaha === 'tidak') {
                        updateStep(stepContents.length - 1);
                        return;
                    }
                }
                
                updateStep(currentStep + 1);
            }
        });
    });

    document.querySelectorAll(".prev-btn").forEach(btn => {
        btn.addEventListener("click", function() {
            if (historyStep.length > 0) {
                const prev = historyStep.pop();
                updateStep(prev);
            }
        });
    });

    // Dynamic field behavior
    const ikutKomunitas = document.getElementById("ikut_komunitas");
    if (ikutKomunitas) {
        ikutKomunitas.addEventListener("change", function() {
            document.getElementById("nama_komunitas_wrapper").classList.toggle("d-none", this.value !== 'ya');
        });
    }

    // Submission Handler
    kuesForm.addEventListener("submit", function(e) {
        e.preventDefault();
        
        if (!validateCurrentStep()) return;

        Swal.fire({
            title: "Konfirmasi Kirim",
            text: "Pastikan semua data sudah terisi dengan benar. Kirim sekarang?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#f79039",
            cancelButtonColor: "#aaa",
            confirmButtonText: "Ya, Kirim!",
            cancelButtonText: "Periksa Lagi"
        }).then((res) => {
            if (res.isConfirmed) {
                kuesForm.submit();
            }
        });
    });

    // Initial setup
    updateStep(0);
});
</script>

<style>
/* Modern Step UI */
.step-indicator {
    display: flex;
    justify-content: space-between;
    position: relative;
    z-index: 1;
}
.step-line {
    position: absolute;
    top: 20px;
    left: 40px;
    right: 40px;
    height: 3px;
    background: #e9ecef;
    z-index: -1;
}
.step-item {
    text-align: center;
    background: #fff;
    cursor: default;
    flex: 1;
}
.step-number {
    width: 40px;
    height: 40px;
    line-height: 36px;
    display: inline-block;
    border-radius: 50%;
    background: #fff;
    border: 2px solid #e9ecef;
    color: #adb5bd;
    font-weight: bold;
    margin-bottom: 5px;
    transition: all 0.3s ease;
}
.step-label {
    display: block;
    font-size: 11px;
    color: #adb5bd;
    text-transform: uppercase;
    font-weight: 600;
}
.step-item.active .step-number {
    border-color: #f79039;
    color: #f79039;
    box-shadow: 0 0 0 4px rgba(247, 144, 57, 0.1);
}
.step-item.active .step-label { color: #f79039; }
.step-item.completed .step-number {
    background: #f79039;
    border-color: #f79039;
    color: #fff;
}
.bg-light-warning { background-color: #fffaf0; }
.border-dashed { border-style: dashed !important; }
.tracking-wider { letter-spacing: 1px; }

/* Effects */
.ripple-effect:active { transform: scale(0.98); opacity: 0.9; }
</style>
@endsection