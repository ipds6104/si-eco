<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuesioner extends Model
{
     use HasFactory;

    protected $table = 'kuesioners';

    protected $fillable = [

        // BLOK I
         'nama',
        'npm',
        'no_hp',
        'fakultas',
        'punya_usaha',

        // BLOK II
         'kegiatan_utama',
        'jenis_usaha',
        'alamat_usaha',
        'link_maps_usaha',
        'input_usaha',
        'proses_usaha',
        'produk_utama',
        'nib',
        'sertif_halal',
        'omzet',
        'link_medsos_usaha',
        'ikut_komunitas',

        // BLOK C
        'nama_komunitas',
        'media_komunitas',
        'media_komunitas_detail',
         'link_medsos_komunitas',
        'manfaat_komunitas',

        // BLOK D
        'usaha_teman',

        // BLOK E
        'nama_teman',
        'no_hp_teman',
        'kegiatan_utama_teman',
        'jenis_usaha_teman',
        'alamat_usaha_teman',
        'link_maps_teman',
        'input_teman',
        'proses_teman',
        'produk_utama_teman',
        'nib_teman',
        'sertif_halal_teman',
        'omzet_teman',
        'socmed_teman',

    ];
}
