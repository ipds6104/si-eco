@extends('layouts/app')

@section('content')
<style>
    .hero-section {
        background: linear-gradient(135deg, #ef620bef 0%, #efae4d 100%);
        border-radius: 20px;
        padding: 3rem 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 40px rgba(139, 0, 0, 0.3);
    }
    
    .hero-section h2 {
        color: white;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }
    
    .hero-section p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
    }
    
    .description-box {
        background: linear-gradient(to right, #f8f9fa, #ffffff);
        border-left: 4px solid #8B0000;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    
    .value-card {
        border-radius: 20px;
        transition: all 0.3s ease;
        border: none;
        background: white;
        position: relative;
        overflow: hidden;
    }
    
    .value-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: var(--card-color);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .value-card:hover::before {
        transform: scaleX(1);
    }
    
    .value-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }
    
    .icon-wrapper {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--icon-bg);
        transition: all 0.3s ease;
    }
    
    .value-card:hover .icon-wrapper {
        transform: scale(1.1) rotate(5deg);
    }
    
    .value-card h5 {
        color: #2d3748;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }
    
    .value-card p {
        color: #718096;
        line-height: 1.6;
    }
    
    .section-title {
        position: relative;
        display: inline-block;
        margin-bottom: 3rem;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(to right, #eb691d, #e79e32);
        border-radius: 2px;
    }
    
    /* Layout untuk 7 cards */
    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }
    
    @media (min-width: 768px) {
        .values-grid {
            grid-template-columns: repeat(3, 1fr);
        }
        
        .values-grid .value-card:nth-child(7) {
            grid-column: 2;
        }
    }
    
    @media (min-width: 992px) {
        .values-grid {
            grid-template-columns: repeat(4, 1fr);
        }
        
        .values-grid .value-card:nth-child(5),
        .values-grid .value-card:nth-child(6),
        .values-grid .value-card:nth-child(7) {
            grid-column: auto;
        }
        
        .values-grid .value-card:nth-child(5) {
            grid-column: 1 / 2;
        }
        
        .values-grid .value-card:nth-child(6) {
            grid-column: 2 / 3;
        }
        
        .values-grid .value-card:nth-child(7) {
            grid-column: 3 / 4;
        }
    }
</style>

<div class="container">
    <div class="page-inner">
        <!-- Hero Section -->
        <div class="hero-section text-center">
            <h2 class="fw-bold">Selamat Datang di CAIKUE</h2>
            <p class="mb-0"><strong>C</strong>atatan <strong>I</strong>ndustri dan <strong>Kue</strong>sioner <strong>E</strong>konomi Digital</p>
        </div>

        <!-- Deskripsi -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="description-box">
                    <p class="lead mb-0">
                        <strong>CAIKUE</strong> merupakan akronim dari <strong>C</strong>atatan <strong>I</strong>ndustri dan <strong>Kue</strong>sioner <strong>E</strong>konomi Digital yang merupakan alat untuk <strong>Identifikasi dan Pemetaan</strong> profil industri digital, guna menjaring pelaku usaha ekonomi digital yang belum terdata secara komprehensif.
                    </p>
                </div>
            </div>
        </div>

<div class="row justify-content-center">

    <div class="row justify-content-center mt-4">

    <div class="col-md-4">

        <a href="{{ route('kues.index') }}" style="text-decoration:none;">

            <div class="card text-center text-white shadow-lg"
                 style="background: linear-gradient(135deg, #F79039, #FF6A00); border-radius:20px;">

                <div class="card-body py-5">

                    <!-- ICON -->
                    <div class="mb-3">
                        <i class="bi bi-clipboard-data"
                           style="font-size:50px; background:white; color:#F79039; padding:15px; border-radius:50%;"></i>
                    </div>

                    <!-- TEXT -->
                    <h5 class="fw-bold mb-2">
                        Mulai Isi Kuesioner
                    </h5>

                    <p style="font-size:14px; opacity:0.9;" class="mb-3">
                        Klik untuk mengisi data responden
                    </p>

                    <div class="badge bg-white text-dark rounded-pill px-3 py-2 shadow-sm" style="font-size: 12px; font-weight: bold;">
                        <i class="far fa-clock text-warning me-1"></i> Hanya ± 3 Menit
                    </div>

                </div>

            </div>

        </a>

    </div>

</div>

</div>
    </div>
 
        <!--Footer Note-->
        <div class="text-center mt-4 mb-5">
            <p class="text-muted">
                <i class="bi bi-info-circle me-2"></i>
                Mari Sukseskan Sensus Ekonomi 2026
            </p>
            @guest
                <a href="{{ route('login') }}" class="text-muted small text-decoration-none mt-2 d-inline-block"><i class="fas fa-lock me-1"></i> Login Admin</a>
            @endguest
        </div>

    </div>
</div>
@endsection

@section('script')
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
@endsection