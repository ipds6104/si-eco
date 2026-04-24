<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuesioner extends Model
{
     use HasFactory;

    protected $table = 'kuesioners';

    protected $fillable = [
        'status_pengisi',
        'nama',
        'nik',
        'no_hp',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'sls_id',
        'fakultas',
        'kategori_responden',
        'pekerjaan',
        'pekerjaan_lainnya',
        'punya_usaha',
        'kegiatan_utama',
        'jenis_usaha',
        'alamat_usaha',
        'link_maps_usaha',
        'latitude',
        'longitude',
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
        'platform_digital_v2',
        'proporsi_pendapatan_digital',
        'sumber_penghasilan_digital',
        'metode_pembayaran_digital',
        'software_operasional',
        'is_producer',
        'foto_rumah',
        'lama_aktivitas_digital',
        'tambah_penghasilan_digital',
        'accuracy',
        'jumlah_tk',
        'tahun_mulai',
        'legalitas',
        'kendala',
        'se2026_visit',
        'use_digital',
    ];

    public function kabupaten() { return $this->belongsTo(Region::class, 'kabupaten_id'); }
    public function kecamatan() { return $this->belongsTo(Region::class, 'kecamatan_id'); }
    public function desa() { return $this->belongsTo(Region::class, 'desa_id'); }
    public function sls() { return $this->belongsTo(Region::class, 'sls_id'); }

}
