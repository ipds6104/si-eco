<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuesioner;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $stats = Kuesioner::selectRaw("
            COUNT(*) as total,
            SUM(CASE WHEN punya_usaha = 'ya' THEN 1 ELSE 0 END) as punyaUsaha,
            SUM(CASE WHEN punya_usaha = 'tidak' THEN 1 ELSE 0 END) as tidakUsaha,
            SUM(CASE WHEN ikut_komunitas = 'ya' THEN 1 ELSE 0 END) as ikutKomunitas,
            SUM(CASE WHEN is_producer = 1 THEN 1 ELSE 0 END) as isProducer,
            SUM(CASE WHEN jenis_usaha = '1' THEN 1 ELSE 0 END) as jenis1,
            SUM(CASE WHEN jenis_usaha = '2' THEN 1 ELSE 0 END) as jenis2,
            SUM(CASE WHEN jenis_usaha = '3' THEN 1 ELSE 0 END) as jenis3,
            SUM(CASE WHEN jenis_usaha = '4' THEN 1 ELSE 0 END) as jenis4
        ")->first();

        return view('dashboard', [
            'total' => $stats->total ?? 0,
            'punyaUsaha' => $stats->punyaUsaha ?? 0,
            'tidakUsaha' => $stats->tidakUsaha ?? 0,
            'ikutKomunitas' => $stats->ikutKomunitas ?? 0,
            'isProducer' => $stats->isProducer ?? 0,
            'jenis1' => $stats->jenis1 ?? 0,
            'jenis2' => $stats->jenis2 ?? 0,
            'jenis3' => $stats->jenis3 ?? 0,
            'jenis4' => $stats->jenis4 ?? 0,
        ]);
    }
}