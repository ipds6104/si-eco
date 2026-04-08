<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuesioner;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // if (auth()->user()->id_role != 3) {
        //     abort(403, 'Unauthorized');
        // }

       $total = Kuesioner::count();

    $punyaUsaha = Kuesioner::where('punya_usaha','ya')->count();
    $tidakUsaha = Kuesioner::where('punya_usaha','tidak')->count();

    $ikutKomunitas = Kuesioner::where('ikut_komunitas','ya')->count();

    $jenis1 = Kuesioner::where('jenis_usaha','1')->count();
    $jenis2 = Kuesioner::where('jenis_usaha','2')->count();
    $jenis3 = Kuesioner::where('jenis_usaha','3')->count();
    $jenis4 = Kuesioner::where('jenis_usaha','4')->count();

    return view('dashboard', compact(
        'total',
        'punyaUsaha',
        'tidakUsaha',
        'ikutKomunitas',
        'jenis1',
        'jenis2',
        'jenis3',
        'jenis4'
    ));
    }
}