@extends('layouts.app')

@section('content')

<div class="container-fluid px-4" style="margin-top:90px;"> <h3 class="mb-4">Dashboard Statistik Kuesioner</h3>

<div class="row">

    <div class="col-md-3">
        <div class="card text-white shadow" style="background-color:#281C59;">
            <div class="card-body">
                <h5>Total Responden</h5>
                <h2>{{ $total }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white shadow" style="background-color:#4E8D9C">
            <div class="card-body">
                <h5>Punya Usaha</h5>
                <h2>{{ $punyaUsaha }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white shadow" style="background-color:#85C79A">
            <div class="card-body">
                <h5>Tidak Punya Usaha</h5>
                <h2>{{ $tidakUsaha }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white shadow" style="background-color:#FAB95B;">
            <div class="card-body">
                <h5>Ikut Komunitas</h5>
                <h2>{{ $ikutKomunitas }}</h2>
            </div>
        </div>
    </div>

</div>

<br>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header" style="font-weight:bold;">
                    Jenis Usaha Responden
                </div>

                <div class="card-body">

                    <canvas id="jenisUsahaChart"></canvas>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    document.addEventListener("DOMContentLoaded", function () {

        const ctx = document.getElementById('jenisUsahaChart');

        new Chart(ctx, {

            type: 'pie',

            data: {

                labels: [
                    'Produksi Barang Sendiri', 'Penjualan Barang dari Pihak Lain', 'Penyediaan Jasa Makanan Minuman', 'Penyediaan Jasa Lainnya'
                ],

                datasets: [
                    {

                        data: [
                            {{ $jenis1 }}, {{ $jenis2 }}, {{ $jenis3 }}, {{ $jenis4 }}
                        ],

                        backgroundColor: ['#2D3C59', '#94A378', '#E5BA41', '#D1855C']

                    }
                ]

            }

        });

    });
</script>

@endsection