<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuesioner extends Model
{
     use HasFactory;

    protected $table = 'kuesioners';

    protected $fillable = [
        'nama',
        'nik',
        'no_hp',
        'fakultas',
        'kategori_responden',
        'punya_usaha',
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
        'nama_komunitas',
        'media_komunitas',
        'media_komunitas_detail',
        'link_medsos_komunitas',
        'manfaat_komunitas',
        'platform_digital',
        'proporsi_pendapatan_digital',
        'metode_pembayaran_digital',
        'software_operasional',
        'is_producer',
    ];
}
