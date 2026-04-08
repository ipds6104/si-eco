@extends('layouts.app')

@section('content')

    <div class="container-fluid px-4" style = "margin-top:90px;">

    <h3 class="mb-4">Edit Data Responden</h3>

    <div class="card shadow">

    <div class="card-body">

    <form action="{{ route('kues.update',$data->id) }}" method="POST">

    @csrf
    @method('PUT')
{{-- BLOK I --}}
<h5 class="mb-3">BLOK I. INFORMASI UMUM</h5>

<div class="mb-3">
    <label>Nama</label>
    <input
        type="text"
        name="nama"
        class="form-control"
        value="{{ $data->nama }}"
        required="required"></div>

    <div class="mb-3">
        <label>NPM</label>
        <input type="text" name="npm" class="form-control" value="{{ $data->npm }}"></div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $data->no_hp }}"></div>

            <div class="mb-3">
                <label>Asal Fakultas</label>
                <input
                    type="text"
                    name="fakultas"
                    class="form-control"
                    value="{{ $data->fakultas }}"></div>

            <div class="mb-3">
                            <label>Apakah Anda memiliki usaha (offline atau online)?</label>
                            <select name="punya_usaha" class="form-control">

                                <option value="ya" {{ $data->punya_usaha == 'ya' ? 'selected' : '' }}>
                                    Ya
                                </option>

                                <option value="tidak" {{ $data->punya_usaha == 'tidak' ? 'selected' : '' }}>
                                    Tidak
                                </option>

                            </select>
                        </div>

               
                    <hr>

                        {{-- BLOK II --}}
                        <h5 class="mb-3">BLOK II. INFORMASI PELAKU USAHA EKONOMI</h5>

                         <div class="mb-3">
                        <label>Apa kegiatan utama usaha/perusahaan</label>
                        <input
                            type="text"
                            name="kegiatan_utama"
                            class="form-control"
                            value="{{ $data->kegiatan_utama }}"></div>


                        <div class="mb-3">
                            <label>Pilih salah satu sesuai usaha Anda</label>
                            <select name="jenis_usaha" class="form-control">

                                <option value="1" {{ $data->jenis_usaha == '1' ? 'selected' : '' }}>
                                    1. produksi barang/menjual barang yang diproduksi sendiri
                                </option>

                                <option value="2" {{ $data->punya_usaha == '2' ? 'selected' : '' }}>
                                    2. penjualan barang uang dibeli dari usaha/perusahaan/pihak lain
                                </option>

                                <option value="3" {{ $data->punya_usaha == '3' ? 'selected' : '' }}>
                                   3. penyediaan jasa makanan minuman yang siap disantap ditempat atau dibawa pulang
                                </option>

                                <option value="4" {{ $data->punya_usaha == '4' ? 'selected' : '' }}>
                                   4. penyediaan jasa lainnya
                                </option>
                            </select>
                        </div>

                            <div class="mb-3">
                            <label>Dimana usaha tersebut biasa dilakukan?</label>
                            <select name="alamat_usaha" class="form-control">

                                <option value="rumah" {{ $data->alamat_usaha == 'rumah' ? 'selected' : '' }}>
                                    rumah
                                </option>

                                <option value="ruko mal" {{ $data->alamat_usaha == 'ruko mal' ? 'selected' : '' }}>
                                    ruko mal
                                </option>

                                <option value="bangunan toko" {{ $data->alamat_usaha == 'bangunan toko' ? 'selected' : '' }}>
                                   bangunan toko
                                </option>

                                <option value="keliling di jalan" {{ $data->alamat_usaha == 'keliling di jalan' ? 'selected' : '' }}>
                                   keliling di jalan
                                </option>

                                <option value="lewat internet/daring" {{ $data->alamat_usaha == ' lewat internet/daring' ? 'selected' : '' }}>
                                    lewat internet/daring
                                </option>

                                <option value="pasar" {{ $data->alamat_usaha == 'pasar' ? 'selected' : '' }}>
                                   pasar
                                </option>

                                <option value="pinggir jalan/kaki lima" {{ $data->alamat_usaha == 'pinggir jalan/kaki lima' ? 'selected' : '' }}>
                                   pinggir jalan/kaki lima
                                </option>
                                <option value="lainnya" {{ $data->alamat_usaha == 'lainnya' ? 'selected' : '' }}>
                                   lainnya
                                </option>
                            </select>
                        </div>

                            <div class="mb-3">
                                <label>Link google maps usaha</label>
                                <input
                                    type="text"
                                    name="link_maps_usaha"
                                    class="form-control"
                                    value="{{ $data->link_maps_usaha }}"></div>

                            <div class="mb-3">
                                <label>Apa input yang digunakan?</label>
                                <input
                                    type="text"
                                    name="input_usaha"
                                    class="form-control"
                                    value="{{ $data->input_usaha}}"></div>

                             <div class="mb-3">
                                <label>Bagaimana proses mengubah input menjadi produk output (beserta alatnya)?</label>
                                <input
                                    type="text"
                                    name="proses_usaha"
                                    class="form-control"
                                    value="{{ $data->proses_usaha}}"></div>

                                <div class="mb-3">
                                <label>Produk Utama</label>
                                <input
                                    type="text"
                                    name="produk_utama"
                                    class="form-control"
                                    value="{{ $data->produk_utama }}"></div>
                                
                                    <div class="mb-3">
                                <label>NIB (Nomor Induk Berusaha)</label>
                                <input
                                    type="text"
                                    name="nib"
                                    class="form-control"
                                    value="{{ $data->nib }}"></div>

                                    <div class="mb-3">
                                <label>Nomor sertifikat halal</label>
                                <input
                                    type="text"
                                    name="sertif_halal"
                                    class="form-control"
                                    value="{{ $data->sertif_halal }}"></div>
                                

                                <div class="mb-3">
                                    <label>Berapa estimasi omzet yang dihasilkan per bulan?</label>
                                    <input type="text" name="omzet" class="form-control" value="{{ $data->omzet }}"></div>

                                    <div class="mb-3">
                                <label>Link sosial media</label>
                                <input
                                    type="text"
                                    name="link_medsos_usaha"
                                    class="form-control"
                                    value="{{ $data->link_medsos_usaha }}"></div>
                                  
                                    <div class="mb-3">
                                            <label>Ikut Komunitas</label>
                                            <select name="ikut_komunitas" class="form-control">

                                                <option value="ya" {{ $data->ikut_komunitas == 'ya' ? 'selected' : '' }}>
                                                    Ya
                                                </option>

                                                <option value="tidak" {{ $data->ikut_komunitas == 'tidak' ? 'selected' : '' }}>
                                                    Tidak
                                                </option>

                                            </select>
                                        </div>
                                    <hr>

                                        {{-- BLOK III --}}
                                        <h5 class="mb-3">BLOK III. KOMUNITAS USAHA</h5>

                                        <div class="mb-3">
                                            <label>Nama Komunitas yang diikuti</label>
                                            <input
                                                type="text"
                                                name="nama_komunitas"
                                                class="form-control"
                                                value="{{ $data->nama_komunitas }}"></div>

                                            <div class="mb-3">
                                                <label>Media Komunitas</label>
                                                <input
                                                    type="text"
                                                    name="media_komunitas"
                                                    class="form-control"
                                                    value="{{ $data->media_komunitas }}"></div>

                                                <div class="mb-3">
                                                    <label>Media Komunitas Lainnya</label>
                                                    <input
                                                        type="text"
                                                        name="media_komunitas_detail"
                                                        class="form-control"
                                                        value="{{ $data->media_komunitas_detail }}"></div>
                                                <div class="mb-3">
                                                    <label>Manfaat mengikuti komunitas usaha</label>
                                                    <input
                                                        type="text"
                                                        name="manfaat_komunitas"
                                                        class="form-control"
                                                        value="{{ $data->manfaat_komunitas }}"></div>

                                                    <hr>
                                                    {{-- BLOK IV --}}
                                                    <h5 class="mb-3">BLOK IV. INFORMASI TAMBAHAN</h5>
                                                    <div class="mb-3">
                                                    <label>Apakah memiliki teman/saudara yang memiliki usaha?</label>
                                                    <select name="usaha_teman" class="form-control">

                                                        <option value="ya" {{ $data->usaha_teman == 'ya' ? 'selected' : '' }}>
                                                            Ya
                                                        </option>

                                                        <option value="tidak" {{ $data->usaha_teman == 'tidak' ? 'selected' : '' }}>
                                                            Tidak
                                                        </option>

                                                    </select>
                                                </div>

                                                 <hr>
                                                    {{-- BLOK V --}}
                                                    <h5 class="mb-3">BLOK V. INFORMASI UMUM TAMBAHAN </h5>
                                                    <div class="mb-3">
                        <label>Nama teman/saudara</label>
                        <input
                            type="text"
                            name="nama_teman"
                            class="form-control"
                            value="{{ $data->nama_teman}}"></div>
                            <div class="mb-3">
                        <label>No HP</label>
                        <input
                            type="text"
                            name="no_hp_teman"
                            class="form-control"
                            value="{{ $data->no_hp_teman }}"></div>

                                                    <div class="mb-3">
                        <label>Apa kegiatan utama usaha/perusahaan</label>
                        <input
                            type="text"
                            name="kegiatan_utama_teman"
                            class="form-control"
                            value="{{ $data->kegiatan_utama_teman }}"></div>


                        <div class="mb-3">
                            <label>Pilih salah satu sesuai usaha Anda</label>
                            <select name="jenis_usaha_teman" class="form-control">

                                <option value="1" {{ $data->jenis_usaha_teman == '1' ? 'selected' : '' }}>
                                    1. produksi barang/menjual barang yang diproduksi sendiri
                                </option>

                                <option value="2" {{ $data->punya_usaha_teman == '2' ? 'selected' : '' }}>
                                    2. penjualan barang uang dibeli dari usaha/perusahaan/pihak lain
                                </option>

                                <option value="3" {{ $data->punya_usaha_teman == '3' ? 'selected' : '' }}>
                                   3. penyediaan jasa makanan minuman yang siap disantap ditempat atau dibawa pulang
                                </option>

                                <option value="4" {{ $data->punya_usaha_teman == '4' ? 'selected' : '' }}>
                                   4. penyediaan jasa lainnya
                                </option>
                            </select>
                        </div>

                            <div class="mb-3">
                            <label>Dimana usaha tersebut biasa dilakukan?</label>
                            <select name="alamat_usaha_teman" class="form-control">

                                <option value="rumah" {{ $data->alamat_usaha_teman == 'rumah' ? 'selected' : '' }}>
                                    rumah
                                </option>

                                <option value="ruko mal" {{ $data->alamat_usaha_teman == 'ruko mal' ? 'selected' : '' }}>
                                    ruko mal
                                </option>

                                <option value="bangunan toko" {{ $data->alamat_usaha_teman == 'bangunan toko' ? 'selected' : '' }}>
                                   bangunan toko
                                </option>

                                <option value="keliling di jalan" {{ $data->alamat_usaha_teman == 'keliling di jalan' ? 'selected' : '' }}>
                                   keliling di jalan
                                </option>

                                <option value="lewat internet/daring" {{ $data->alamat_usaha_teman == ' lewat internet/daring' ? 'selected' : '' }}>
                                    lewat internet/daring
                                </option>

                                <option value="pasar" {{ $data->alamat_usaha_teman == 'pasar' ? 'selected' : '' }}>
                                   pasar
                                </option>

                                <option value="pinggir jalan/kaki lima" {{ $data->alamat_usaha_teman == 'pinggir jalan/kaki lima' ? 'selected' : '' }}>
                                   pinggir jalan/kaki lima
                                </option>
                                <option value="lainnya" {{ $data->alamat_usaha_teman == 'lainnya' ? 'selected' : '' }}>
                                   lainnya
                                </option>
                            </select>
                        </div>

                            <div class="mb-3">
                                <label>Link google maps usaha</label>
                                <input
                                    type="text"
                                    name="link_maps_teman"
                                    class="form-control"
                                    value="{{ $data->link_maps_teman }}"></div>

                            <div class="mb-3">
                                <label>Apa input yang digunakan?</label>
                                <input
                                    type="text"
                                    name="input_teman"
                                    class="form-control"
                                    value="{{ $data->input_teman}}"></div>

                             <div class="mb-3">
                                <label>Bagaimana proses mengubah input menjadi produk output (beserta alatnya)?</label>
                                <input
                                    type="text"
                                    name="proses_teman"
                                    class="form-control"
                                    value="{{ $data->proses_teman}}"></div>

                                <div class="mb-3">
                                <label>Produk Utama</label>
                                <input
                                    type="text"
                                    name="produk_utama_teman"
                                    class="form-control"
                                    value="{{ $data->produk_utama_teman }}"></div>
                                
                                    <div class="mb-3">
                                <label>NIB (Nomor Induk Berusaha)</label>
                                <input
                                    type="text"
                                    name="nib_teman"
                                    class="form-control"
                                    value="{{ $data->nib_teman}}"></div>

                                    <div class="mb-3">
                                <label>Nomor sertifikat halal</label>
                                <input
                                    type="text"
                                    name="sertif_halal_teman"
                                    class="form-control"
                                    value="{{ $data->sertif_halal_teman}}"></div>
                                

                                <div class="mb-3">
                                    <label>Berapa estimasi omzet yang dihasilkan per bulan?</label>
                                    <input type="text" name="omzet_teman" class="form-control" value="{{ $data->omzet_teman }}"></div>

                                    <div class="mb-3">
                                <label>Link sosial media</label>
                                <input
                                    type="text"
                                    name="socmed_teman"
                                    class="form-control"
                                    value="{{ $data->socmed_teman }}"></div>
                                  
                                   
                                        <hr>


                                                        <button  class="btn text-white"
                                            style="background-color:#6984A9;">
                                                            Update Data
                                                        </button>

                                                        <a href="{{ route('kues.jawaban') }}" class="btn text-white" style="background-color:#978a8a;">
                                                            Back
                                                        </a>

                                                    </form>

                                                </div>

                                            </div>

                                        </div>

                                        @endsection