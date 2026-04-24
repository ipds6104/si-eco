@extends('layouts.app')

@section('content')

{{-- ===================================================
     Dashboard Statistik Ekonomi Digital
     CSS Strategy:
     - CSS custom properties (variables) untuk semua warna & spacing
     - Semua styling via class, BUKAN inline style
     - Tidak ada penggunaan class Bootstrap yang di-override
     - Hover & animasi via class, bukan inline
     - Clipboard API modern (tidak deprecated)
     =================================================== --}}

<div class="dashboard-wrapper">

    {{-- ─── HEADER ─── --}}
    <div class="dashboard-header">
        <div>
            <h3 class="dashboard-title">Dashboard Statistik Ekonomi Digital</h3>
            <p class="dashboard-subtitle">Visualisasi data responden dan penetrasi industri digital.</p>
        </div>
        <div class="dashboard-date-badge">
            <i class="fas fa-calendar-alt"></i>
            <span>Data Terkini: {{ date('d M Y') }}</span>
        </div>
    </div>

    {{-- ─── SHARE LINK ─── --}}
    <div class="share-card">
        <div class="share-card__aside">
            <i class="fab fa-whatsapp share-card__icon"></i>
            <h5 class="share-card__heading">Bagikan Kuesioner</h5>
        </div>
        <div class="share-card__body">
            <p class="share-card__desc">
                Gunakan link di bawah ini untuk menyebarkan kuesioner ke responden melalui WhatsApp atau media sosial lainnya.
            </p>
            <div class="share-input-group">
                <input type="text"
                       id="publicLink"
                       class="share-input"
                       value="{{ route('kues.index') }}"
                       readonly
                       aria-label="Link kuesioner">
                <button class="share-copy-btn" type="button" onclick="copyLink()">
                    <i class="fas fa-copy"></i> Salin Link
                </button>
            </div>
            <div class="share-actions">
                <a href="https://wa.me/?text={{ urlencode('Halo! Mohon kesediaannya untuk mengisi kuesioner Identifikasi Ekonomi Digital (CAIKUE) melalui link berikut: ' . route('kues.index')) }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="btn-wa">
                    <i class="fab fa-whatsapp"></i> Kirim ke WhatsApp
                </a>
                <span id="copyMsg" class="copy-success" aria-live="polite" hidden>
                    <i class="fas fa-check"></i> Link tersalin!
                </span>
            </div>
        </div>
    </div>

    {{-- ─── KPI CARDS ─── --}}
    <div class="kpi-grid">

        <div class="kpi-card kpi-card--purple">
            <i class="fas fa-users-cog kpi-card__icon"></i>
            <span class="kpi-card__label">Total Responden</span>
            <strong class="kpi-card__value">{{ $total }}</strong>
        </div>

        <div class="kpi-card kpi-card--teal">
            <i class="fas fa-store kpi-card__icon"></i>
            <span class="kpi-card__label">Pelaku Usaha</span>
            <strong class="kpi-card__value">{{ $punyaUsaha }}</strong>
            <span class="kpi-card__note">
                <i class="fas fa-arrow-up"></i>
                {{ $total > 0 ? round(($punyaUsaha / $total) * 100, 1) : 0 }}% dari total
            </span>
        </div>

        <div class="kpi-card kpi-card--orange">
            <i class="fas fa-microchip kpi-card__icon"></i>
            <span class="kpi-card__label">Produser Digital</span>
            <strong class="kpi-card__value">{{ $isProducer }}</strong>
            <span class="kpi-card__note">
                <i class="fas fa-check-circle"></i>
                {{ $punyaUsaha > 0 ? round(($isProducer / $punyaUsaha) * 100, 1) : 0 }}% pelaku usaha
            </span>
        </div>

        <div class="kpi-card kpi-card--green">
            <i class="fas fa-user-circle kpi-card__icon"></i>
            <span class="kpi-card__label">Bukan Pelaku Usaha</span>
            <strong class="kpi-card__value">{{ $tidakUsaha }}</strong>
        </div>

    </div>

    {{-- ─── CHART ROW 1 ─── --}}
    <div class="chart-grid chart-grid--7-5">

        <div class="chart-card">
            <div class="chart-card__header">
                <h5 class="chart-card__title">
                    <i class="fas fa-chart-bar chart-card__title-icon chart-card__title-icon--warning"></i>
                    Karakteristik Usaha
                </h5>
            </div>
            <div class="chart-card__body">
                <canvas id="jenisUsahaChart" aria-label="Grafik karakteristik usaha" role="img"></canvas>
            </div>
        </div>

        <div class="chart-card chart-card--muted">
            <div class="chart-card__header">
                <h5 class="chart-card__title">
                    <i class="fas fa-info-circle chart-card__title-icon chart-card__title-icon--warning"></i>
                    Informasi Singkat
                </h5>
            </div>
            <div class="chart-card__body">
                <ul class="info-list">
                    <li class="info-list__item">
                        <span class="info-list__icon info-list__icon--warning"><i class="fas fa-users"></i></span>
                        <div>
                            <p class="info-list__label">Ikut Komunitas</p>
                            <strong class="info-list__value">{{ $ikutKomunitas }} Responden</strong>
                        </div>
                    </li>
                    <li class="info-list__item">
                        <span class="info-list__icon info-list__icon--success"><i class="fas fa-shopping-bag"></i></span>
                        <div>
                            <p class="info-list__label">Produksi Mandiri</p>
                            <strong class="info-list__value">{{ $jenis1 }} Responden</strong>
                        </div>
                    </li>
                    <li class="info-list__item">
                        <span class="info-list__icon info-list__icon--primary"><i class="fas fa-utensils"></i></span>
                        <div>
                            <p class="info-list__label">Bidang Kuliner</p>
                            <strong class="info-list__value">{{ $jenis3 }} Responden</strong>
                        </div>
                    </li>
                    <li class="info-list__item">
                        <span class="info-list__icon info-list__icon--info"><i class="fas fa-laptop-code"></i></span>
                        <div>
                            <p class="info-list__label">Jasa Digital/Creator</p>
                            <strong class="info-list__value">{{ $jenis5 + $jenis6 }} Responden</strong>
                        </div>
                    </li>
                </ul>

                <div class="info-alert">
                    <i class="fas fa-lightbulb"></i>
                    Data ini digunakan untuk memetakan potensi ekonomi digital di wilayah survei.
                </div>
            </div>
        </div>

    </div>

    {{-- ─── CHART ROW 2 ─── --}}
    <div class="chart-grid chart-grid--equal">

        <div class="chart-card">
            <div class="chart-card__header">
                <h5 class="chart-card__title">
                    <i class="fas fa-layer-group chart-card__title-icon chart-card__title-icon--info"></i>
                    Platform Digital Terpopuler
                </h5>
            </div>
            <div class="chart-card__body">
                <canvas id="platformChart" aria-label="Grafik platform digital" role="img"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-card__header">
                <h5 class="chart-card__title">
                    <i class="fas fa-exclamation-triangle chart-card__title-icon chart-card__title-icon--danger"></i>
                    Hambatan Utama
                </h5>
            </div>
            <div class="chart-card__body">
                <canvas id="kendalaChart" aria-label="Grafik hambatan utama" role="img"></canvas>
            </div>
        </div>

    </div>

</div>{{-- /.dashboard-wrapper --}}

@section('script')
<script>
(function () {
    'use strict';

    /* ── Copy Link ──────────────────────────────────────────── */
    window.copyLink = function () {
        const input = document.getElementById('publicLink');
        const msg   = document.getElementById('copyMsg');

        // Clipboard API modern — fallback ke execCommand bila perlu
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(input.value).then(showCopied);
        } else {
            input.select();
            document.execCommand('copy');
            showCopied();
        }

        function showCopied() {
            msg.hidden = false;
            setTimeout(function () { msg.hidden = true; }, 3000);
        }
    };

    /* ── Charts ─────────────────────────────────────────────── */
    document.addEventListener('DOMContentLoaded', function () {

        /* Shared defaults - resilient to version changes */
        if (typeof Chart !== 'undefined') {
            if (Chart.defaults.font) {
                Chart.defaults.font.family = "'Segoe UI', system-ui, sans-serif";
                Chart.defaults.color = '#6c757d';
            } else if (Chart.defaults.global) {
                Chart.defaults.global.defaultFontFamily = "'Segoe UI', system-ui, sans-serif";
                Chart.defaults.global.defaultFontColor = '#6c757d';
            }
        }

        /* CHART: Jenis Usaha */
        new Chart(document.getElementById('jenisUsahaChart'), {
            type: 'bar',
            data: {
                labels: ['Produksi', 'Dagang', 'Kuliner', 'Digital', 'Creator', 'Lainnya'],
                datasets: [{
                    label: 'Responden',
                    data: [
                        {{ $jenis1 }}, {{ $jenis2 }}, {{ $jenis3 }},
                        {{ $jenis5 }}, {{ $jenis6 }}, {{ $jenis4 }}
                    ],
                    backgroundColor: [
                        '#281C59', '#4E8D9C', '#f79039',
                        '#17a2b8', '#6610f2', '#85C79A'
                    ],
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                indexAxis:  'y',
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { color: 'rgba(0,0,0,.05)' } },
                    y: { grid: { display: false } }
                }
            }
        });

        /* CHART: Platform */
        new Chart(document.getElementById('platformChart'), {
            type: 'polarArea',
            data: {
                labels:   {!! json_encode(array_keys($platforms)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($platforms)) !!},
                    backgroundColor: [
                        '#25D366', '#1877F2', '#E4405F',
                        '#000000', '#FF5722', '#00B14F'
                    ],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { position: 'right' } }
            }
        });

        /* CHART: Kendala */
        new Chart(document.getElementById('kendalaChart'), {
            type: 'doughnut',
            data: {
                labels:   {!! json_encode(array_keys($kendalas)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($kendalas)) !!},
                    backgroundColor: [
                        '#dc3545', '#ffc107', '#17a2b8',
                        '#fd7e14', '#6f42c1'
                    ],
                }]
            },
            options: {
                cutout:    '60%',
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { position: 'right' } }
            }
        });

    });
}());
</script>
@endsection

{{-- ─── STYLES ─── --}}
<style>
/* ============================================================
   CSS Custom Properties — satu sumber kebenaran untuk warna,
   spacing, dan radius. Ubah di sini, berlaku ke seluruh halaman.
   ============================================================ */
:root {
    --db-radius:          1rem;
    --db-radius-sm:       .6rem;

    /* KPI card gradients */
    --db-kpi-purple-from: #281C59;
    --db-kpi-purple-to:   #403080;
    --db-kpi-teal-from:   #4E8D9C;
    --db-kpi-teal-to:     #5fb3c4;
    --db-kpi-orange-from: #f79039;
    --db-kpi-orange-to:   #fbad6d;
    --db-kpi-green-from:  #85C79A;
    --db-kpi-green-to:    #96e0ad;

    /* UI chrome */
    --db-card-bg:         #fff;
    --db-card-border:     rgba(0, 0, 0, .08);
    --db-shadow:          0 2px 12px rgba(0, 0, 0, .07);
    --db-muted-bg:        #f8f9fa;

    /* Icon accent colours */
    --db-warning:         #f79039;
    --db-info:            #17a2b8;
    --db-success:         #28a745;
    --db-primary:         #403080;
    --db-danger:          #dc3545;

    /* Share card */
    --db-wa-green:        #25D366;
    --db-wa-green-dark:   #1da851;
}

/* ── Wrapper / layout ──────────────────────────────────────── */
.dashboard-wrapper {
    padding: 90px 1.5rem 50px;
    max-width: 1400px;
    margin-inline: auto;
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

/* ── Header ────────────────────────────────────────────────── */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 1rem;
}

.dashboard-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1a1a2e;
    margin: 0 0 .25rem;
}

.dashboard-subtitle {
    font-size: .85rem;
    color: #6c757d;
    margin: 0;
}

.dashboard-date-badge {
    display: flex;
    align-items: center;
    gap: .4rem;
    background: var(--db-card-bg);
    border: 1px solid var(--db-card-border);
    border-radius: var(--db-radius-sm);
    padding: .5rem .9rem;
    box-shadow: var(--db-shadow);
    font-size: .8rem;
    color: #6c757d;
    white-space: nowrap;
}

/* ── Share Card ─────────────────────────────────────────────── */
.share-card {
    display: flex;
    flex-wrap: wrap;
    background: var(--db-card-bg);
    border-radius: var(--db-radius);
    box-shadow: var(--db-shadow);
    overflow: hidden;
}

.share-card__aside {
    flex: 0 0 auto;
    width: clamp(160px, 28%, 260px);
    background: var(--db-wa-green);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: .75rem;
    padding: 2rem 1.5rem;
    color: #fff;
}

.share-card__icon { font-size: 3rem; }

.share-card__heading {
    font-size: 1rem;
    font-weight: 700;
    margin: 0;
}

.share-card__body {
    flex: 1 1 0;
    padding: 1.5rem 2rem;
}

.share-card__desc {
    font-size: .9rem;
    color: #6c757d;
    margin-bottom: 1rem;
}

/* Share input group */
.share-input-group {
    display: flex;
    gap: 0;
    border-radius: var(--db-radius-sm);
    overflow: hidden;
    box-shadow: var(--db-shadow);
    margin-bottom: 1rem;
}

.share-input {
    flex: 1 1 auto;
    border: 1px solid var(--db-card-border);
    border-right: none;
    background: #f8f9fa;
    padding: .65rem 1rem;
    font-size: .875rem;
    outline: none;
    min-width: 0; /* flex shrink fix */
}

.share-copy-btn {
    flex: 0 0 auto;
    background: #1a1a2e;
    color: #fff;
    border: none;
    padding: .65rem 1.25rem;
    font-size: .875rem;
    cursor: pointer;
    transition: background .2s;
}

.share-copy-btn:hover  { background: #2d2d4e; }
.share-copy-btn:active { background: #0f0f1c; }

/* WhatsApp button */
.share-actions { display: flex; align-items: center; gap: 1rem; }

.btn-wa {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    background: var(--db-wa-green);
    color: #fff;
    text-decoration: none;
    border-radius: 999px;
    padding: .5rem 1.25rem;
    font-size: .875rem;
    font-weight: 600;
    transition: background .2s;
}

.btn-wa:hover  { background: var(--db-wa-green-dark); color: #fff; }

.copy-success {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    font-size: .85rem;
    color: var(--db-success);
    animation: fadeIn .25s ease;
}

@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

/* ── KPI Grid ───────────────────────────────────────────────── */
.kpi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.25rem;
}

/* Base KPI card */
.kpi-card {
    border-radius: var(--db-radius);
    padding: 1.5rem;
    color: #fff;
    display: flex;
    flex-direction: column;
    gap: .35rem;
    will-change: transform;
    transition: transform .2s ease, box-shadow .2s ease;
}

.kpi-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, .15);
}

/* Colour variants */
.kpi-card--purple { background: linear-gradient(135deg, var(--db-kpi-purple-from), var(--db-kpi-purple-to)); }
.kpi-card--teal   { background: linear-gradient(135deg, var(--db-kpi-teal-from),   var(--db-kpi-teal-to));   }
.kpi-card--orange { background: linear-gradient(135deg, var(--db-kpi-orange-from), var(--db-kpi-orange-to)); }
.kpi-card--green  { background: linear-gradient(135deg, var(--db-kpi-green-from),  var(--db-kpi-green-to));  }

.kpi-card__icon  { font-size: 1.75rem; opacity: .5; margin-bottom: .25rem; }
.kpi-card__label { font-size: .7rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; opacity: .8; }
.kpi-card__value { font-size: 2.25rem; font-weight: 700; line-height: 1; }
.kpi-card__note  { font-size: .8rem; opacity: .85; }

/* ── Chart Grid ─────────────────────────────────────────────── */
.chart-grid {
    display: grid;
    gap: 1.25rem;
}

.chart-grid--7-5   { grid-template-columns: 7fr 5fr; }
.chart-grid--equal { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }

/* ── Chart Card ─────────────────────────────────────────────── */
.chart-card {
    background: var(--db-card-bg);
    border-radius: var(--db-radius);
    box-shadow: var(--db-shadow);
    display: flex;
    flex-direction: column;
    will-change: transform;
    transition: transform .2s ease;
}

.chart-card:hover { transform: translateY(-3px); }

.chart-card--muted { background: var(--db-muted-bg); }

.chart-card__header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--db-card-border);
}

.chart-card__title {
    font-size: 1rem;
    font-weight: 700;
    color: #1a1a2e;
    margin: 0;
    display: flex;
    align-items: center;
    gap: .5rem;
}

.chart-card__title-icon          { font-size: 1rem; }
.chart-card__title-icon--warning { color: var(--db-warning); }
.chart-card__title-icon--info    { color: var(--db-info);    }
.chart-card__title-icon--danger  { color: var(--db-danger);  }

.chart-card__body {
    padding: 1.25rem 1.5rem;
    flex: 1;
}

/* ── Info List ──────────────────────────────────────────────── */
.info-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: .75rem;
}

.info-list__item {
    display: flex;
    align-items: center;
    gap: .9rem;
}

.info-list__icon {
    flex: 0 0 auto;
    width: 38px;
    height: 38px;
    border-radius: var(--db-radius-sm);
    background: var(--db-card-bg);
    box-shadow: var(--db-shadow);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .95rem;
}

.info-list__icon--warning { color: var(--db-warning); }
.info-list__icon--success { color: var(--db-success); }
.info-list__icon--primary { color: var(--db-primary); }
.info-list__icon--info    { color: var(--db-info);    }

.info-list__label {
    font-size: .78rem;
    color: #6c757d;
    margin: 0 0 .1rem;
}

.info-list__value {
    font-size: .95rem;
    font-weight: 700;
    color: #1a1a2e;
}

.info-alert {
    display: flex;
    align-items: flex-start;
    gap: .6rem;
    margin-top: 1.25rem;
    padding: .85rem 1rem;
    background: rgba(247, 144, 57, .1);
    border-left: 3px solid var(--db-warning);
    border-radius: 0 var(--db-radius-sm) var(--db-radius-sm) 0;
    font-size: .82rem;
    color: #7c4a00;
}

.info-alert i { color: var(--db-warning); margin-top: .05rem; }

/* ── Responsive ─────────────────────────────────────────────── */
@media (max-width: 991.98px) {
    .chart-grid--7-5 {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 767.98px) {
    .dashboard-wrapper {
        padding-top: 70px;
        padding-inline: 1rem;
    }

    .share-card__aside {
        width: 100%;
    }

    .kpi-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 479.98px) {
    .kpi-grid {
        grid-template-columns: 1fr;
    }

    .share-input-group {
        flex-direction: column;
    }

    .share-input,
    .share-copy-btn {
        width: 100%;
        border-right: 1px solid var(--db-card-border);
        border-radius: var(--db-radius-sm);
    }

    .share-copy-btn {
        border-top: none;
    }
}
</style>

@endsection