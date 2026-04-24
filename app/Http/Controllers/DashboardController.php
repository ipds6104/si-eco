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
            SUM(CASE WHEN jenis_usaha LIKE '%Produksi%' THEN 1 ELSE 0 END) as jenis1,
            SUM(CASE WHEN jenis_usaha LIKE '%Perdagangan%' OR jenis_usaha LIKE '%reseller%' THEN 1 ELSE 0 END) as jenis2,
            SUM(CASE WHEN jenis_usaha LIKE '%Kuliner%' THEN 1 ELSE 0 END) as jenis3,
            SUM(CASE WHEN jenis_usaha LIKE '%Jasa non-digital%' OR jenis_usaha LIKE '%Pertanian%' OR jenis_usaha LIKE '%Lainnya%' THEN 1 ELSE 0 END) as jenis4,
            SUM(CASE WHEN jenis_usaha LIKE '%Jasa digital%' THEN 1 ELSE 0 END) as jenis5,
            SUM(CASE WHEN jenis_usaha LIKE '%Kreator%' THEN 1 ELSE 0 END) as jenis6,
            
            SUM(CASE WHEN platform_digital_v2 LIKE '%WhatsApp%' THEN 1 ELSE 0 END) as p_wa,
            SUM(CASE WHEN platform_digital_v2 LIKE '%Facebook%' THEN 1 ELSE 0 END) as p_fb,
            SUM(CASE WHEN platform_digital_v2 LIKE '%Instagram%' THEN 1 ELSE 0 END) as p_ig,
            SUM(CASE WHEN platform_digital_v2 LIKE '%TikTok%' THEN 1 ELSE 0 END) as p_tiktok,
            SUM(CASE WHEN platform_digital_v2 LIKE '%Shopee%' OR platform_digital_v2 LIKE '%Tokopedia%' OR platform_digital_v2 LIKE '%Lazada%' THEN 1 ELSE 0 END) as p_market,
            SUM(CASE WHEN platform_digital_v2 LIKE '%Grab%' OR platform_digital_v2 LIKE '%Gojek%' OR platform_digital_v2 LIKE '%Maxim%' THEN 1 ELSE 0 END) as p_ojol,

            SUM(CASE WHEN kendala LIKE '%Modal%' THEN 1 ELSE 0 END) as k_modal,
            SUM(CASE WHEN kendala LIKE '%internet%' OR kendala LIKE '%sinyal%' THEN 1 ELSE 0 END) as k_internet,
            SUM(CASE WHEN kendala LIKE '%literasi%' OR kendala LIKE '%Kemampuan%' THEN 1 ELSE 0 END) as k_literasi,
            SUM(CASE WHEN kendala LIKE '%pembeli%' THEN 1 ELSE 0 END) as k_pembeli,
            SUM(CASE WHEN kendala LIKE '%Persaingan%' THEN 1 ELSE 0 END) as k_persaingan
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
            'jenis5' => $stats->jenis5 ?? 0,
            'jenis6' => $stats->jenis6 ?? 0,
            'platforms' => [
                'WA' => $stats->p_wa ?? 0,
                'FB' => $stats->p_fb ?? 0,
                'IG' => $stats->p_ig ?? 0,
                'TikTok' => $stats->p_tiktok ?? 0,
                'Marketplace' => $stats->p_market ?? 0,
                'Ojol' => $stats->p_ojol ?? 0,
            ],
            'kendalas' => [
                'Modal' => $stats->k_modal ?? 0,
                'Internet' => $stats->k_internet ?? 0,
                'Literasi' => $stats->k_literasi ?? 0,
                'Sepi Pembeli' => $stats->k_pembeli ?? 0,
                'Persaingan' => $stats->k_persaingan ?? 0,
            ]
        ]);
    }
}