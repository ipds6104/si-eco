@extends('layouts.app')

@section('content')

<div class="container-fluid px-4" style = "margin-top:90px;">

    <h3 class="mb-4">Detail Jawaban Responden</h3>

    <div class="card shadow">

    <div class="card-body">

{{-- BLOK I --}}
<h5 class="mb-3">BLOK I. INFORMASI UMUM</h5>

<div class="row mb-2">
    <div class="col-md-3">
        <b>Nama</b>
    </div>
    <div class="col-md-9">{{ $data->nama }}</div>
</div>

<div class="row mb-2">
    <div class="col-md-3">
        <b>NPM</b>
    </div>
    <div class="col-md-9">{{ $data->npm }}</div>
</div>

<div class="row mb-2">
    <div class="col-md-3">
        <b>No HP</b>
    </div>
    <div class="col-md-9">{{ $data->no_hp }}</div>
</div>

<div class="row mb-2">
    <div class="col-md-3">
        <b>Fakultas</b>
    </div>
    <div class="col-md-9">{{ $data->fakultas }}</div>
</div>

<div class="row mb-2">
    <div class="col-md-3">
        <b>Kepemilikan Usaha</b>
    </div>
    <div class="col-md-9">
            @if($data->punya_usaha == 'ya')
            <span class="badge bg-success">Ya</span>
            @else
            <span class="badge bg-secondary">Tidak</span>
            @endif
    </div>
</div>

<hr>

    {{-- BLOK II --}}
    <h5 class="mb-3">BLOK II. INFORMASI PELAKU USAHA EKONOMI</h5>

    <div class="row mb-2">
        <div class="col-md-3">
            <b>Kegiatan Utama</b>
        </div>
        <div class="col-md-9">{{ $data->kegiatan_utama }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-md-3">
            <b>Jenis Usaha</b>
        </div>
        <div class="col-md-9">
            @if($data->jenis_usaha == '1')
            <span>1. produksi barang/menjual barang yang diproduksi sendiri</span>
            @elseif($data->jenis_usaha == '2')
            <span>2. penjualan barang uang dibeli dari usaha/perusahaan/pihak lain</span>
            @elseif($data->jenis_usaha == '3')
            <span>3. penyediaan jasa makanan minuman yang siap disantap ditempat atau dibawa pulang</span>
            @elseif($data->jenis_usaha == '4')
            <span>4. penyediaan jasa lainnya</span>
            @endif
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-3">
            <b>Alamat Usaha</b>
        </div>
        <div class="col-md-9">{{ $data->alamat_usaha }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-md-3">
            <b>Link Maps Usaha</b>
        </div>
        <div class="col-md-9">{{ $data->link_maps_usaha }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-md-3">
            <b>Input Usaha</b>
        </div>
        <div class="col-md-9">{{ $data->input_usaha }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-md-3">
            <b>Proses Usaha</b>
        </div>
        <div class="col-md-9">{{ $data->proses_usaha }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-md-3">
            <b>Produk Utama</b>
        </div>
        <div class="col-md-9">{{ $data->produk_utama }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-md-3">
            <b>NIB</b>
        </div>
        <div class="col-md-9">{{ $data->nib }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-md-3">
            <b>Nomor Sertifikat Halal</b>
        </div>
        <div class="col-md-9">{{ $data->sertif_halal }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-md-3">
            <b>Omzet</b>
        </div>
        <div class="col-md-9">{{ $data->omzet }}</div>
    </div>

     <div class="row mb-2">
        <div class="col-md-3">
            <b>Link Medsos</b>
        </div>
        <div class="col-md-9">{{ $data->link_medsos_usaha }}</div>
    </div>

     <div class="row mb-2">
        <div class="col-md-3">
            <b>Keikutsertaan Komunitas</b>
        </div>
        <div class="col-md-9">
            @if($data->ikut_komunitas == 'ya')
            <span class="badge bg-success">Ya</span>
            @else
            <span class="badge bg-secondary">Tidak</span>
            @endif
        </div>
    </div>

    <hr>

        {{-- BLOK III --}}
        <h5 class="mb-3">BLOK III. KOMUNITAS USAHA</h5>

        <div class="row mb-2">
            <div class="col-md-3">
                <b>Nama Komunitas</b>
            </div>
            <div class="col-md-9">{{ $data->nama_komunitas }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">
                <b>Media Komunitas</b>
            </div>
            <div class="col-md-9">{{ $data->media_komunitas }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">
                <b>Link Medsos Detail</b>
            </div>
            <div class="col-md-9">{{ $data->media_komunitas_detail }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">
                <b>Manfaat Komunitas</b>
            </div>
            <div class="col-md-9">{{ $data->manfaat_komunitas }}</div>
        </div>

        <hr>

            {{-- BLOK IV --}}
            <h5 class="mb-3">BLOK IV. INFORMASI TAMBAHAN</h5>

        <div class="row mb-2">
            <div class="col-md-3">
                <b>Kepemilikan Usaha Teman/Saudara</b>
            </div>
            <div class="col-md-9">
                @if($data->usaha_teman == 'ya')
                <span class="badge bg-success">Ya</span>
                @else
                <span class="badge bg-secondary">Tidak</span>
                @endif
            </div>
        </div>
<hr>
            {{-- BLOK V --}}
            <h5 class="mb-3">BLOK V. INFORMASI UMUM TAMBAHAN</h5>

            <div class="row mb-2">
                <div class="col-md-3">
                    <b>Nama Teman/Saudara</b>
                </div>
                <div class="col-md-9">{{ $data->nama_teman }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3">
                    <b>No HP Teman</b>
                </div>
                <div class="col-md-9">{{ $data->no_hp_teman }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3">
                    <b>Kegiatan Usaha Teman</b>
                </div>
                <div class="col-md-9">{{ $data->kegiatan_utama_teman }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3">
                    <b>Jenis Usaha Teman</b>
                </div>
                <div class="col-md-9">
                    @if($data->jenis_usaha_teman == '1')
                    <span>1. produksi barang/menjual barang yang diproduksi sendiri</span>
                    @elseif($data->jenis_usaha_teman == '2')
                    <span>2. penjualan barang uang dibeli dari usaha/perusahaan/pihak lain</span>
                    @elseif($data->jenis_usaha_teman == '3')
                    <span>3. penyediaan jasa makanan minuman yang siap disantap ditempat atau dibawa
                        pulang</span>
                    @elseif($data->jenis_usaha_teman == '4')
                    <span>4. penyediaan jasa lainnya</span>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3">
                    <b>Alamat Usaha Teman</b>
                </div>
                <div class="col-md-9">{{ $data->alamat_usaha_teman }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3">
                    <b>Link Maps Usaha</b>
                </div>
                <div class="col-md-9">{{ $data->link_maps_teman }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3">
                    <b>Input Usaha</b>
                </div>
                <div class="col-md-9">{{ $data->input_teman }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3">
                    <b>Proses Usaha</b>
                </div>
                <div class="col-md-9">{{ $data->proses_teman }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3">
                    <b>Produk Utama</b>
                </div>
                <div class="col-md-9">{{ $data->produk_utama_teman }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3">
                    <b>NIB</b>
                </div>
                <div class="col-md-9">{{ $data->nib_teman }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3">
                    <b>Nomor Sertifikat Halal</b>
                </div>
                <div class="col-md-9">{{ $data->sertif_halal_teman }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3">
                    <b>Omzet</b>
                </div>
                <div class="col-md-9">{{ $data->omzet_teman }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3">
                    <b>Link Medsos</b>
                </div>
                <div class="col-md-9">{{ $data->socmed_teman }}</div>
            </div>

            <hr>

            <a href="{{ route('kues.jawaban') }}" class="btn btn-secondary" style="background-color:#978a8a;">
                                                            Kembali
                                                        </a>


            </div>

        </div>

</div>

@endsection