@extends('layouts.app')

@section('content')

<div class="container-fluid px-4" style="margin-top:90px; margin-bottom: 50px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Dashboard Statistik Ekonomi Digital</h3>
            <p class="text-muted small mb-0">Visualisasi data responden dan penetrasi industri digital.</p>
        </div>
        <div class="bg-white p-2 rounded shadow-sm border text-end">
            <span class="text-muted small"><i class="fas fa-calendar-alt me-1"></i> Data Terkini: {{ date('d M Y') }}</span>
        </div>
    </div>

    <!-- SHARE LINK SECTION -->
    <div class="card border-0 shadow-sm rounded-4 mb-5 overflow-hidden">
        <div class="card-body p-0">
            <div class="row g-0">
                <div class="col-md-4 bg-warning d-flex align-items-center justify-content-center p-4 text-white">
                    <div class="text-center">
                        <div class="display-4 mb-2"><i class="fab fa-whatsapp"></i></div>
                        <h5 class="fw-bold mb-0">Bagikan Kuesioner</h5>
                    </div>
                </div>
                <div class="col-md-8 p-4">
                    <p class="text-muted mb-3">Gunakan link di bawah ini untuk menyebarkan kuesioner ke responden melalui WhatsApp atau media sosial lainnya.</p>
                    <div class="input-group mb-3 shadow-sm">
                        <input type="text" id="publicLink" class="form-control bg-light border-0 py-3" value="{{ route('kues.index') }}" readonly>
                        <button class="btn btn-dark px-4" type="button" onclick="copyLink()">
                            <i class="fas fa-copy me-2"></i> Salin Link
                        </button>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="https://wa.me/?text={{ urlencode('Halo! Mohon kesediaannya untuk mengisi kuesioner Identifikasi Ekonomi Digital (CAIKUE) melalui link berikut: ' . route('kues.index')) }}" 
                           target="_blank" 
                           class="btn btn-success rounded-pill px-4">
                            <i class="fab fa-whatsapp me-2"></i> Kirim ke WhatsApp
                        </a>
                        <span id="copyMsg" class="text-success small align-self-center d-none animated fadeIn">
                            <i class="fas fa-check me-1"></i> Link tersalin!
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI CARDS -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(45deg, #281C59, #403080);">
                <div class="card-body p-4 text-white">
                    <div class="d-flex justify-content-between mb-3">
                        <i class="fas fa-users-cog fa-2x opacity-50"></i>
                    </div>
                    <h6 class="text-uppercase small fw-bold opacity-75">Total Responden</h6>
                    <h2 class="display-6 fw-bold mb-0">{{ $total }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(45deg, #4E8D9C, #5fb3c4);">
                <div class="card-body p-4 text-white">
                    <div class="d-flex justify-content-between mb-3">
                        <i class="fas fa-store fa-2x opacity-50"></i>
                    </div>
                    <h6 class="text-uppercase small fw-bold opacity-75">Pelaku Usaha</h6>
                    <h2 class="display-6 fw-bold mb-0">{{ $punyaUsaha }}</h2>
                    <div class="mt-2 small"><i class="fas fa-arrow-up me-1"></i> {{ $total > 0 ? round(($punyaUsaha/$total)*100, 1) : 0 }}% dari total</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(45deg, #f79039, #fbad6d);">
                <div class="card-body p-4 text-white">
                    <div class="d-flex justify-content-between mb-3">
                        <i class="fas fa-microchip fa-2x opacity-50"></i>
                    </div>
                    <h6 class="text-uppercase small fw-bold opacity-75">Produser Digital</h6>
                    <h2 class="display-6 fw-bold mb-0">{{ $isProducer }}</h2>
                    <div class="mt-2 small"><i class="fas fa-check-circle me-1"></i> {{ $punyaUsaha > 0 ? round(($isProducer/$punyaUsaha)*100, 1) : 0 }}% pelaku usaha</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(45deg, #85C79A, #96e0ad);">
                <div class="card-body p-4 text-white">
                    <div class="d-flex justify-content-between mb-3">
                        <i class="fas fa-user-circle fa-2x opacity-50"></i>
                    </div>
                    <h6 class="text-uppercase small fw-bold opacity-75">Bukan Pelaku Usaha</h6>
                    <h2 class="display-6 fw-bold mb-0">{{ $tidakUsaha }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- CHARTS -->
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="fw-bold text-dark mb-0"><i class="fas fa-chart-bar me-2 text-warning"></i>Karakteristik Usaha</h5>
                </div>
                <div class="card-body">
                    <canvas id="jenisUsahaChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-light">
                <div class="card-header bg-transparent py-3 border-0">
                    <h5 class="fw-bold text-dark mb-0"><i class="fas fa-info-circle me-2 text-warning"></i>Informasi Singkat</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush bg-transparent">
                        <li class="list-group-item bg-transparent border-0 px-0 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="p-2 bg-white rounded shadow-sm me-3 text-warning"><i class="fas fa-users"></i></div>
                                <div>
                                    <p class="mb-0 small text-muted">Ikut Komunitas</p>
                                    <h6 class="mb-0 fw-bold">{{ $ikutKomunitas }} Responden</h6>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item bg-transparent border-0 px-0 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="p-2 bg-white rounded shadow-sm me-3 text-success"><i class="fas fa-shopping-bag"></i></div>
                                <div>
                                    <p class="mb-0 small text-muted">Produksi Mandiri</p>
                                    <h6 class="mb-0 fw-bold">{{ $jenis1 }} Responden</h6>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item bg-transparent border-0 px-0 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="p-2 bg-white rounded shadow-sm me-3 text-primary"><i class="fas fa-utensils"></i></div>
                                <div>
                                    <p class="mb-0 small text-muted">Bidang Kuliner</p>
                                    <h6 class="mb-0 fw-bold">{{ $jenis3 }} Responden</h6>
                                </div>
                            </div>
                        </li>
                    </ul>
                    
                    <div class="alert alert-warning border-0 shadow-sm mt-4 small">
                        <i class="fas fa-lightbulb me-2"></i>
                        Data ini digunakan untuk memetakan potensi ekonomi digital di wilayah survei.
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('assets/js/plugin/chart.min.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('jenisUsahaChart');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Produksi Barang', 
                    'Reselling/Dagang', 
                    'Kuliner', 
                    'Jasa Lainnya'
                ],
                datasets: [{
                    label: 'Jumlah Responden',
                    data: [
                        {{ $jenis1 }}, {{ $jenis2 }}, {{ $jenis3 }}, {{ $jenis4 }}
                    ],
                    backgroundColor: [
                        '#2D3C59', 
                        '#4E8D9C', 
                        '#f79039', 
                        '#85C79A'
                    ],
                    borderRadius: 8,
                    barThickness: 25,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { display: false },
                        ticks: { stepSize: 1 }
                    },
                    y: {
                        grid: { display: false }
                    }
                }
            }
        });
    });

    function copyLink() {
        const copyText = document.getElementById("publicLink");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
        
        const msg = document.getElementById("copyMsg");
        msg.classList.remove("d-none");
        setTimeout(() => {
            msg.classList.add("d-none");
        }, 2000);
    }
</script>

<style>
    .rounded-4 { border-radius: 1rem !important; }
    .card { transition: transform 0.2s ease-in-out; }
    .card:hover { transform: translateY(-3px); }
</style>

@endsection