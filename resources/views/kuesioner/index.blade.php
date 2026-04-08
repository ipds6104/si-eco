@extends('layouts.app')

@section('content')

<div class="container" style="margin-top:90px;">

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card shadow">

            <div class="card-header text-white" style="background-color:#f79039;">

                <h4 class="mb-0">IDENTIFIKASI USAHA EKONOMI (OFFLINE DAN ONLINE)</h4>

            </div>

            <div class="card-body">
                <!-- STEP INDICATOR -->
                <div class="step-indicator">

                    <div class="step-item active">I</div>
                    <div class="step-item">II</div>
                    <div class="step-item">III</div>
                    <div class="step-item">IV</div>
                    <div class="step-item">V</div>

                </div>

                <!-- PROGRESS BAR -->
                <div class="progress mb-4">
                    <div
                        class="progress-bar"
                        id="progressBar"
                        style="width:20%; background-color:#f79039; "></div>
                </div>

                <form method="POST" action="{{ route('kues.store') }}" id="formKuesioner">
                    @csrf

                    <!-- BLOK I -->
                    <div class="step">

                        <h4>BLOK I. INFORMASI UMUM</h4>

                        <div class="form-group mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" data-required="true"></div>
                            <div class="form-group mb-3">
                                <label>Nomor Pokok Mahasiswa (NPM)</label>
                                <input
                                    type="text"
                                    name="npm"
                                    class="form-control"
                                    maxlength="11" minlength="11"
                                    data-required="true"></div>
                                <div class="form-group mb-3">
                                    <label>Nomor HP</label>
                                    <input
                                        type="tel"
                                        name="no_hp"
                                        class="form-control"
                                        placeholder="e.g: 08xxxxxxxxxx"
                                        maxlength="13"
                                        data-required="true"></div>

                                    <div class="form-group mb-3">
                                        <label>Asal fakultas</label>
                                        <select name="fakultas" class="form-control" data-required="true">
                                            <option value="FE">Fakultas Ekonomi</option>
                                            <option value="FPT">Fakultas Pertanian</option>
                                            <option value="FH">Fakultas Hukum</option>
                                            <option value="FIP">Fakultas Keguruan dan Ilmu Pendidikan</option>
                                            <option value="FT">Fakultas Teknik</option>
                                            <option value="Pasca">Program Pascasarjana</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Apakah Anda memiliki usaha (offline atau online)?</label>
                                        <select
                                            name="punya_usaha"
                                            id="punya_usaha"
                                            class="form-control"
                                            data-required="true">
                                            <option value="">Pilihan</option>
                                            <option value="ya">Ya</option>
                                            <option value="tidak">Tidak</option>
                                        </select>
                                    </div>

                                    <div class="d-flex justify-content-between mt-3">
                                        <button
                                            type="button"
                                            class="btn text-white next"
                                            style="background-color:#ff8b5a;">
                                            Next
                                        </button>
                                    </div>

                                </div>

                                <!-- BLOK II -->
                                <div class="step d-none">

                                    <h4>BLOK II. INFORMASI PELAKU USAHA EKONOMI</h4>

                                    <div class="form-group mb-3">
                                        <label>Apa kegiatan utama usaha/perusahaan</label>
                                        <blockquote class="text-muted">(ketika memiliki usaha lebih dari satu, pilih yang memiliki omset paling banyak. Contoh: membuat sosis dari ikan, jasa kunci duplikat)</blockquote>

                                        <input
                                            type="text"
                                            name="kegiatan_utama"
                                            class="form-control"
                                            data-required="true"></div>

                                        <div class="form-group mb-3">
                                            <label>Pilih salah satu sesuai usaha Anda</label>
                                            <!-- Jenis Usaha -->
                                            <select
                                                name="jenis_usaha"
                                                id="jenis_usaha"
                                                class="form-control"
                                                data-required="true">
                                                <option value="">Pilih Jenis Usaha</option>
                                                <option value="1">a. produksi barang/menjual barang yang diproduksi sendiri</option>
                                                <option value="2">b. penjualan barang uang dibeli dari usaha/perusahaan/pihak lain</option>
                                                <option value="3">c. penyediaan jasa makanan minuman yang siap disantap ditempat
                                                    atau dibawa pulang</option>
                                                <option value="4">d. penyediaan jasa lainnya</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">

                                            <label>Dimana usaha tersebut biasa dilakukan?</label>

                                            <select
                                                name="alamat_usaha"
                                                id="alamat_usaha"
                                                class="form-control"
                                                data-required="true">

                                                <option value="">Pilih Tempat</option>
                                                <option value="rumah">a. rumah</option>
                                                <option value="ruko mal">b. ruko mal</option>
                                                <option value="bangunan toko">c. bangunan toko</option>
                                                <option value="keliling di jalan">d. keliling di jalan</option>
                                                <option value="lewat internet/daring">e. lewat internet/daring</option>
                                                <option value="pasar">f. pasar</option>
                                                <option value="pinggir jalan/kaki lima">g. pinggir jalan/kaki lima</option>
                                                <option value="lainnya">h. lainnya</option>

                                            </select>

                                            <input
                                                type="text"
                                                id="alamat_lainnya"
                                                class="form-control mt-2 d-none"
                                                placeholder="Tuliskan tempat usaha lainnya"></div>
                                            <div class="form-group mb-3">
                                                <label>Link Google Maps Usaha</label>
                                                <input
                                                    type="text"
                                                    name="link_maps_usaha"
                                                    class="form-control"
                                                    data-required="true"></div>

                                                <div class="form-group mb-3">
                                                    <label>Apa input yang digunakan?</label>
                                                    <blockquote class="text-muted">(Contoh: bambu; jagung pipil; kaca; kain; kulit
                                                        sapi; kayu bulat; rotan; kunci polos)</blockquote>
                                                    <input type="text" name="input_usaha" class="form-control" data-required="true"></div>

                                                    <div class="form-group mb-3">
                                                        <label>Bagaimana proses mengubah input menjadi produk output (beserta alatnya)?</label>
                                                        <blockquote class="text-muted">(Contoh: beli sosis mentah lalu digoreng sesuai
                                                            pesanan dan disajikan ke pembeli;penggaraman)</blockquote>
                                                        <input type="text" name="proses_usaha" class="form-control" data-required="true"></div>

                                                        <div class="form-group mb-3">
                                                            <label>Apa produk utama yang dihasilkan/dijual?</label>
                                                            <blockquote class="text-muted">(Contoh: sosis ikan; jasa perdagangan besar mobil
                                                                bekas; jasa penyediaan makan minum; jasa telekomunikasi internet tanpa kabel )</blockquote>
                                                            <input type="text" name="produk_utama" class="form-control" data-required="true"></div>

                                                            <div class="form-group mb-3">
                                                                <label>NIB (Nomor Induk Berusaha)?</label>
                                                                <blockquote class="text-muted">(Jika tidak memiliki diisi "-")</blockquote>
                                                                <input type="text" name="nib" class="form-control" maxlength="13" data-required="true"></div>

                                                                <div class="form-group mb-3">
                                                                    <label>Nomor sertifikat halal</label>
                                                                    <blockquote class="text-muted">(Jika tidak memiliki diisi "-")</blockquote>
                                                                    <input type="text" name="sertif_halal" class="form-control" data-required="true"></div>

                                                                    <div class="form-group mb-3">
                                                                        <label>Omset per bulan</label>
                                                                        <input type="text" name="omzet" class="form-control" placeholder="e.g: 1000000" data-required="true"></div>

                                                                        <div class="form-group mb-3">
                                                                            <label>Link media sosial</label>
                                                                            <input
                                                                                type="text"
                                                                                name="link_medsos_usaha"
                                                                                class="form-control"
                                                                                data-required="true"></div>

                                                                            <div class="form-group mb-3">
                                                                                <label>Apakah bergabung dengan suatu komunitas yang berkaitan dengan usaha
                                                                                    berbasis digital?</label>
                                                                                <select
                                                                                    name="ikut_komunitas"
                                                                                    id="ikut_komunitas"
                                                                                    class="form-control"
                                                                                    data-required="true">
                                                                                    <option value="">Pilihan</option>
                                                                                    <option value="ya">Ya</option>
                                                                                    <option value="tidak">Tidak</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="d-flex justify-content-between mt-3">

                                                                                <button
                                                                                    type="button"
                                                                                    class="btn text-white back"
                                                                                    style="background-color:#978a8a;">
                                                                                    Back
                                                                                </button>

                                                                                <button
                                                                                    type="button"
                                                                                    class="btn text-white next"
                                                                                    style="background-color:#ff8b5a;">
                                                                                    Next
                                                                                </button>

                                                                            </div>

                                                                        </div>

                                                                        <!-- BLOK III -->
                                                                        <div class="step d-none">

                                                                            <h4>BLOK III. KOMUNITAS USAHA</h4>

                                                                            <div class="form-group mb-3">
                                                                                <label>Nama Komunitas yang diikuti</label>
                                                                                <input
                                                                                    type="text"
                                                                                    name="nama_komunitas"
                                                                                    class="form-control"
                                                                                    data-required="true"></div>

                                                                                <div class="form-group mb-3">

                                                                                    <label>Media apa yang digunakan dalam komunitas tersebut untuk berkomunikasi?</label>

                                                                                    <!-- Whatsapp -->
                                                                                    <div class="form-check">
                                                                                        <input type="checkbox" id="wa_check" name="media_komunitas[]" value="Whatsapp">
                                                                                            WhatsApp</input>

                                                                                    </div>
                                                                                    <input
                                                                                        type="text"
                                                                                        id="wa_input"
                                                                                        name="wa_input"
                                                                                        class="form-control mb-2 d-none"
                                                                                        placeholder="Masukkan link grup / nomor Whatsapp">

                                                                                        <!-- Telegram -->
                                                                                        <div class="form-check">
                                                                                            <input type="checkbox" id="tg_check" name="media_komunitas[]" value="Telegram">
                                                                                                Telegram</input>

                                                                                        </div>
                                                                                        <input
                                                                                            type="text"
                                                                                            name="tg_input"
                                                                                            id="tg_input"
                                                                                            class="form-control mb-2 d-none"
                                                                                            placeholder="Masukkan username / link Telegram">

                                                                                            <!-- Discord -->
                                                                                            <div class="form-check">
                                                                                                <input type="checkbox" id="dc_check" name="media_komunitas[]" value="Discord">
                                                                                                    Discord</input>

                                                                                            </div>
                                                                                            <input
                                                                                                type="text"
                                                                                                id="dc_input"
                                                                                                name="dc_input"
                                                                                                class="form-control mb-2 d-none"
                                                                                                placeholder="Masukkan link server Discord">

                                                                                                <!-- Facebook -->
                                                                                                <div class="form-check">
                                                                                                    <input type="checkbox" id="fb_check" name="media_komunitas[]" value="Facebook">
                                                                                                        Facebook</input>

                                                                                                </div>
                                                                                                <input
                                                                                                    type="text"
                                                                                                    id="fb_input"
                                                                                                    name="fb_input"
                                                                                                    class="form-control mb-2 d-none"
                                                                                                    placeholder="Masukkan link Facebook">

                                                                                                    <!-- Instagram -->
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" id="ig_check" name="media_komunitas[]" value="Instagram">
                                                                                                            Instagram</input>

                                                                                                    </div>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        id="ig_input"
                                                                                                        name="ig_input"
                                                                                                        class="form-control mb-2 d-none"
                                                                                                        placeholder="Masukkan username Instagram">

                                                                                                        <!-- X -->
                                                                                                        <div class="form-check">
                                                                                                            <input type="checkbox" id="x_check" name="media_komunitas[]" value="X">
                                                                                                                X</input>

                                                                                                        </div>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            id="x_input"
                                                                                                            name="x_input"
                                                                                                            class="form-control mb-2 d-none"
                                                                                                            placeholder="Masukkan username X">

                                                                                                            <!-- Website -->
                                                                                                            <div class="form-check">
                                                                                                                <input type="checkbox" id="web_check" name="media_komunitas[]" value="Website">
                                                                                                                    Website</input>

                                                                                                            </div>
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                id="web_input"
                                                                                                                name="web_input"
                                                                                                                class="form-control mb-2 d-none"
                                                                                                                placeholder="Masukkan link website">

                                                                                                                <!-- Pertemuan Offline -->
                                                                                                                <div class="form-check">
                                                                                                                    <input type="checkbox" name="media_komunitas[]" value="Pertemuan Offline">
                                                                                                                        Pertemuan Offline</input>

                                                                                                                </div>

                                                                                                                <!-- Lainnya -->
                                                                                                                <div class="form-check">
                                                                                                                    <input type="checkbox" id="lain_check" name="media_komunitas[]" value="Lainnya">
                                                                                                                        Lainnya</input>

                                                                                                                </div>
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    id="lain_input"
                                                                                                                    name="lain_input"
                                                                                                                    class="form-control mt-2 d-none"
                                                                                                                    placeholder="Tuliskan media lainnya">

                                                                                                                    <!-- Hidden untuk detail -->
                                                                                                                    <input type="hidden" name="media_komunitas_detail" id="media_detail"></div>

                                                                                                                    <div class="form-group mb-3">
                                                                                                                        <label>Manfaat Komunitas</label>
                                                                                                                        <input type="text" name="manfaat_komunitas" class="form-control"></div>

                                                                                                                        <div class="d-flex justify-content-between mt-3">
                                                                                                                            <button
                                                                                                                                type="button"
                                                                                                                                class="btn text-white back"
                                                                                                                                style="background-color:#978a8a;">Back</button>
                                                                                                                            <button
                                                                                                                                type="button"
                                                                                                                                class="btn text-white next"
                                                                                                                                style="background-color:#ff8b5a;">Next</button>
                                                                                                                        </div>
                                                                                                                    </div>

                                                                                                                </div>

                                                                                                                <!-- BLOK IV -->
                                                                                                                <div class="step d-none px-3">

                                                                                                                    <h4>Blok IV. INFORMASI TAMBAHAN</h4>

                                                                                                                    <div class="form-group mb-3">
                                                                                                                        <label>
                                                                                                                            Apakah memiliki teman/saudara yang memiliki usaha berbasis digital?
                                                                                                                        </label>
                                                                                                                        <select id="usaha_teman" name="usaha_teman" class="form-control" data-required="true">
                                                                                                                            <option value="">Pilihan</option>
                                                                                                                            <option value="ya">Ya</option>
                                                                                                                            <option value="tidak">Tidak</option>
                                                                                                                        </select>

                                                                                                                        <div class="d-flex justify-content-between mt-3">
                                                                                                                            <button
                                                                                                                                type="button"
                                                                                                                                class="btn text-white back"
                                                                                                                                style="background-color:#978a8a;">
                                                                                                                                Back
                                                                                                                            </button>

                                                                                                                            <button
                                                                                                                                type="button"
                                                                                                                                class="btn text-white next"
                                                                                                                                style="background-color:#ff8b5a;">
                                                                                                                                Next
                                                                                                                            </button>
                                                                                                                        </div>
                                                                                                                    </div>

                                                                                                                </div>

                                                                                                                <!-- BLOK V -->
                                                                                                                <div class="step d-none px-3">

                                                                                                                    <h4>BLOK V. INFORMASI UMUM TAMBAHAN</h4>

                                                                                                                    <div class="form-group mb-3">
                                                                                                                        <label>Nama teman/saudara</label>
                                                                                                                        <input type="text" name="nama_teman" class="form-control" data-required="true"></div>

                                                                                                                        <div class="form-group mb-3">
                                                                                                                            <label>No HP teman/saudara</label>
                                                                                                                            <input
                                                                                                                                type="text"
                                                                                                                                name="no_hp_teman"
                                                                                                                                class="form-control"
                                                                                                                                placeholder="e.g: 08xxxxxxxxxx"
                                                                                                                                maxlength="13"
                                                                                                                                data-required="true"></div>

                                                                                                                            <div class="form-group mb-3">
                                                                                                                                <label>Apa kegiatan utama usaha/perusahaan</label>
                                                                                                                                <blockquote class="text-muted">(ketika memiliki usaha lebih dari satu, pilih yang memiliki omset paling banyak. Contoh: membuat sosis dari ikan, jasa kunci duplikat)</blockquote>
                                                                                                                                <input type="text" name="kegiatan_utama_teman" class="form-control"></div>

                                                                                                                                <div class="form-group mb-3">
                                                                                                                                    <label>Pilih salah satu sesuai usaha Anda</label>
                                                                                                                                    <!-- Jenis Usaha -->
                                                                                                                                    <select
                                                                                                                                        name="jenis_usaha_teman"
                                                                                                                                        id="jenis_usaha_teman"
                                                                                                                                        class="form-control"
                                                                                                                                        data-required="true">
                                                                                                                                        <option value="">Pilih Jenis Usaha</option>
                                                                                                                                        <option value="1">a. produksi barang/menjual barang yang diproduksi sendiri</option>
                                                                                                                                        <option value="2">b. penjualan barang uang dibeli dari usaha/perusahaan/pihak lain</option>
                                                                                                                                        <option value="3">c. penyediaan jasa makanan minuman yang siap disantap ditempat
                                                                                                                                            atau dibawa pulang</option>
                                                                                                                                        <option value="4">d. penyediaan jasa lainnya</option>
                                                                                                                                    </select>
                                                                                                                                </div>

                                                                                                                                <!-- Alamat -->
                                                                                                                                <div class="form-group mb-3">
                                                                                                                                    <label>Dimana usaha tersebut biasa dilakukan?</label>

                                                                                                                                    <select name="alamat_usaha_teman" id="alamat_usaha_teman" class="form-control">

                                                                                                                                        <option value="">Pilih Tempat</option>
                                                                                                                                        <option value="rumah">a. rumah</option>
                                                                                                                                        <option value="ruko mal">b. ruko/mal</option>
                                                                                                                                        <option value="bangunan toko">c. bangunan toko</option>
                                                                                                                                        <option value="keliling di jalan">d. keliling di jalan</option>
                                                                                                                                        <option value="lewat internet/daring">e. lewat internet/daring</option>
                                                                                                                                        <option value="pasar">f. pasar</option>
                                                                                                                                        <option value="pinggir jalan/kaki lima">g. pinggir jalan/kaki lima</option>
                                                                                                                                        <option value="lainnya">h. lainnya</option>

                                                                                                                                    </select>
                                                                                                                                    <input
                                                                                                                                        type="text"
                                                                                                                                        id="alamat_lainnya"
                                                                                                                                        class="form-control mt-2 d-none"
                                                                                                                                        placeholder="Tuliskan alamat usaha lainnya"></div>

                                                                                                                                    <div class="form-group mb-3">
                                                                                                                                        <label>Link Google Maps Usaha</label>
                                                                                                                                        <input type="text" name="link_maps_teman" class="form-control"></div>

                                                                                                                                        <div class="form-group mb-3">
                                                                                                                                            <label>Apa input yang digunakan?</label>
                                                                                                                                            <blockquote class="text-muted">(Contoh: bambu; jagung pipil; kaca; kain; kulit
                                                                                                                                                sapi; kayu bulat; rotan; kunci polos)</blockquote>
                                                                                                                                            <input type="text" name="input_teman" class="form-control"></div>

                                                                                                                                            <div class="form-group mb-3">
                                                                                                                                                <label>Bagaimana proses mengubah input menjadi produk output (beserta alatnya)?</label>
                                                                                                                                                <blockquote class="text-muted">(Contoh: beli sosis mentah lalu digoreng sesuai
                                                                                                                                                    pesanan dan disajikan ke pembeli;penggaraman)</blockquote>
                                                                                                                                                <input type="text" name="proses_teman" class="form-control"></div>

                                                                                                                                                <div class="form-group mb-3">
                                                                                                                                                    <label>Apa produk utama yang dihasilkan/dijual?</label>
                                                                                                                                                    <blockquote class="text-muted">(Contoh: sosis ikan; jasa perdagangan besar mobil
                                                                                                                                                        bekas; jasa penyediaan makan minum; jasa telekomunikasi internet tanpa kabel; )</blockquote>
                                                                                                                                                    <input type="text" name="produk_utama_teman" class="form-control"></div>

                                                                                                                                                    <div class="form-group mb-3">
                                                                                                                                                        <label>NIB (Nomor Induk Berusaha)?</label>
                                                                                                                                                        <blockquote class="text-muted">(Jika tidak memiliki diisi "-")</blockquote>
                                                                                                                                                        <input type="text" name="nib_teman" class="form-control"></div>

                                                                                                                                                        <div class="form-group mb-3">
                                                                                                                                                            <label>Nomor sertifikat halal</label>
                                                                                                                                                            <blockquote class="text-muted">(Jika tidak memiliki diisi "-")</blockquote>
                                                                                                                                                            <input type="text" name="sertif_halal_teman" class="form-control"></div>

                                                                                                                                                            <div class="form-group mb-3">
                                                                                                                                                                <label>Omset per bulan?</label>
                                                                                                                                                                <input type="text" name="omzet_teman" placeholder="e.g: 1000000" class="form-control"></div>

                                                                                                                                                                <div class="form-group mb-3">
                                                                                                                                                                    <label>Link media sosial</label>
                                                                                                                                                                    <input type="text" name="socmed_teman" class="form-control"></div>

                                                                                                                                                                    <div class="d-flex justify-content-between mt-3">
                                                                                                                                                                        <button
                                                                                                                                                                            type="button"
                                                                                                                                                                            class="btn text-white back"
                                                                                                                                                                            style="background-color:#978a8a;">Back</button>
                                                                                                                                                                        <button
                                                                                                                                                                            type="button"
                                                                                                                                                                            class="btn text-white next"
                                                                                                                                                                            style="background-color:#ff8b5a;">
                                                                                                                                                                            Next
                                                                                                                                                                        </button>

                                                                                                                                                                    </div>

                                                                                                                                                                    
                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                            <div class="step d-none px-3">

                                                                                                                                <h4>TERIMA KASIH</h4>

                                                                                                                                <div class="form-group mb-3">
                                                                                                                                    <label>
                                                                                                                                        Apakah Anda sudah yakin dengan isian tersebut?
                                                                                                                                    </label>
                                                                                                                                   

                                                                                                                                    <div class="d-flex justify-content-between mt-3">
                                                                                                                                        <button
                                                                                                                                            type="button"
                                                                                                                                            class="btn text-white back"
                                                                                                                                            style="background-color:#978a8a;">
                                                                                                                                            Back
                                                                                                                                        </button>

                                                                                                                                        <button
                                                                                                                                            type="submit"
                                                                                                                                            id="btnSubmit"
                                                                                                                                            class="btn text-white next"
                                                                                                                                            style="background-color:#978a8a;">Submit</button>
                                                                                                                                    </div>
                                                                                                                                </div>

                                                                                                                            </div>

                                                                                                                                                            </div>

                                                                                                                                                            
                                                                                                                                                        </div>

                                                                                                                                                    </div>
                                                                                                                                                    

                                                                                                                                                </div>
                                                                                                                                                
                                                                                                                                            </div>
                                                                                                                                        </div>

                                                                                                                                    </div>
                                                                                                                                </div>

                                                                                                                            </div>

                                                                                                                        </form>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                            

                                                                                                            @endsection
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>                                                                                                           
                                                                                                            <script>
document.addEventListener("DOMContentLoaded", function () {

    let currentStep = 0;
    let historyStep = [];

    const steps = document.querySelectorAll(".step");
    const indicators = document.querySelectorAll(".step-item");
    const form = document.getElementById("formKuesioner");

    /* ======================
    SHOW STEP
    ====================== */
    function showStep(step) {

        steps.forEach((s, i) => {
            s.classList.toggle("d-none", i !== step);
        });

        toggleRequired(step);
        indicators.forEach((ind, i) => {
                ind
                    .classList
                    .toggle("active", i <= step);
            });

            document
                .getElementById("progressBar")
                .style
                .width = ((step + 1) / steps.length * 100) + "%";

        
    }

    /* ======================
    REQUIRED DINAMIS (SOLUSI MASALAHMU)
    ====================== */
    function toggleRequired(activeStep) {

        steps.forEach((step, index) => {

            const inputs = step.querySelectorAll("input, select, textarea");

            inputs.forEach(input => {

                if (index === activeStep) {
                    if (input.dataset.required === "true") {
                        input.setAttribute("required", "required");
                    }
                } else {
                    input.removeAttribute("required");
                }

            });

        });
        

    }

    /* ======================
    VALIDASI
    ====================== */
    function validateStep(step) {

        const inputs = steps[step].querySelectorAll("[required]");

        for (let input of inputs) {
            if (!input.value) {
                alert("Silakan isi semua pertanyaan sebelum lanjut.");
                //Swal.fire("Error", "Harap isi semua field!", "warning");
                input.focus();
                return false;
            }
        }

        return true;
    }

    /* ======================
    NEXT BUTTON (ALUR FIX)
    ====================== */
    document.querySelectorAll(".next").forEach(btn => {

        btn.addEventListener("click", function () {

            if (!validateStep(currentStep)) return;

            historyStep.push(currentStep);

            /* ===== BLOK I ===== */
            if (currentStep === 0) {
                let val = document.getElementById("punya_usaha").value;

                currentStep = (val === "tidak") ? 3 : 1;
            }

            /* ===== BLOK II ===== */
            else if (currentStep === 1) {
                let val = document.getElementById("ikut_komunitas").value;

                currentStep = (val === "tidak") ? 3 : 2;
            }

            /* ===== BLOK III ===== */
            else if (currentStep === 2) {
                currentStep = 3;
            }

            /* ===== BLOK IV ===== */
            else if (currentStep === 3) {

                let el = document.getElementById("usaha_teman");

                if (!el) {
                    alert("ID usaha_teman tidak ditemukan");
                    return;
                }

                let val = el.value;

                if (val === "ya") {
                    currentStep = 4; // ke BLOK V
                } else if (val === "tidak") {
                    currentStep = steps.length - 1; // ke SUBMIT
                } else {
                    alert("Silakan pilih jawaban terlebih dahulu");
                    return;
                }
            }

            /* ===== BLOK V ===== */
            else if (currentStep === 4) {
                currentStep = steps.length - 1; // ke SUBMIT
            }

            showStep(currentStep);

        });

        console.log("Step:", currentStep);
        console.log("Value usaha_teman:", document.getElementById("usaha_teman")?.value);

    });

    /* ======================
    BACK BUTTON (PAKAI HISTORY)
    ====================== */
    document.querySelectorAll(".back").forEach(btn => {

        btn.addEventListener("click", function () {

            if (historyStep.length > 0) {
                currentStep = historyStep.pop();
                showStep(currentStep);
            }

        });

    });

    showStep(currentStep);

     /* ======================
    ALAMAT USAHA LAINNYA
    ====================== */

    const alamatUsaha = document.getElementById("alamat_usaha");

        if (alamatUsaha) {

            alamatUsaha.addEventListener("change", function () {

                let lainnyaInput = document.getElementById("alamat_lainnya");

                if (this.value === "Lainnya") {
                    lainnyaInput
                        .classList
                        .remove("d-none");
                } else {
                    lainnyaInput
                        .classList
                        .add("d-none");
                }

            });

        }

    /* ======================
    CHECKBOX MEDIA KOMUNITAS
    ====================== */
    function toggleInput(checkId, inputId) {

            const check = document.getElementById(checkId);
            const input = document.getElementById(inputId);

            if (!check) 
                return;
            
            check.addEventListener("change", function () {

                if (this.checked) {
                    input
                        .classList
                        .remove("d-none");
                } else {
                    input
                        .classList
                        .add("d-none");
                    input.value = "";
                }

            });

        }

        toggleInput("wa_check", "wa_input");
        toggleInput("tg_check", "tg_input");
        toggleInput("dc_check", "dc_input");
        toggleInput("fb_check", "fb_input");
        toggleInput("ig_check", "ig_input");
        toggleInput("x_check", "x_input");
        toggleInput("web_check", "web_input");
        toggleInput("lain_check", "lain_input");

        form.addEventListener("submit", function (e) {
             e.preventDefault();

            /* ======================
                                                                                                                                ALAMAT LAINNYA
                                                                                                                                ====================== */
            let select = document.getElementById("alamat_usaha");
             let lainnya = document.getElementById("alamat_lainnya");

             if (select && select.value === "Lainnya" && lainnya.value !== "") {
        select.value = lainnya.value;
    }

            /* ======================
                                                                                                                                MEDIA KOMUNITAS DETAIL
                                                                                                                                ====================== */
            let detail = [];

            const wa_input = document.getElementById("wa_input");
            const tg_input = document.getElementById("tg_input");
            const dc_input = document.getElementById("dc_input");
            const fb_input = document.getElementById("fb_input");
            const ig_input = document.getElementById("ig_input");
            const x_input = document.getElementById("x_input");
            const web_input = document.getElementById("web_input");
            const lain_input = document.getElementById("lain_input");

            if (wa_input && wa_input.value.trim() !== "") 
                detail.push("Whatsapp:" + wa_input.value);
            
            if (tg_input && tg_input.value.trim() !== "") 
                detail.push("Telegram:" + tg_input.value);
            
            if (dc_input && dc_input.value.trim() !== "") 
                detail.push("Discord:" + dc_input.value);
            
            if (fb_input && fb_input.value.trim() !== "") 
                detail.push("Facebook:" + fb_input.value);
            
            if (ig_input && ig_input.value.trim() !== "") 
                detail.push("Instagram:" + ig_input.value);
            
            if (x_input && x_input.value.trim() !== "") 
                detail.push("X:" + x_input.value);
            
            if (web_input && web_input.value.trim() !== "") 
                detail.push("Website:" + web_input.value);
            
            if (lain_input && lain_input.value.trim() !== "") 
                detail.push("Lainnya:" + lain_input.value);
            
            document
                .getElementById("media_detail")
                .value = detail.join("; ");

            /* ======================
    SWEET ALERT
    ====================== */
    Swal.fire({
        title: "Sudahkah Anda yakin?",
        text: "Pastikan data yang diisi sudah benar",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#F79039",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Ya, kirim",
        cancelButtonText: "Periksa lagi"
    }).then((result) => {

        if (result.isConfirmed) {
            form.submit(); // ✅ submit beneran
        }

    });

        });

    /* ======================
    DROPDOWN USAHA
    ====================== */

    function setupDropdown(kategoriId, jenisId) {

            const kategori = document.getElementById(kategoriId);
            const jenis = document.getElementById(jenisId);

            if (!kategori) 
                return;
            
            kategori.addEventListener("change", function () {

                let pilih = this.value;

                jenis.innerHTML = '<option value="">Pilih Jenis Usaha</option>';

                if (dataUsaha[pilih]) {

                    dataUsaha[pilih].forEach(function (item) {

                        let option = document.createElement("option");

                        option.value = item;
                        option.text = item;

                        jenis.appendChild(option);

                    });

                }

            });

        }

        setupDropdown("kategori", "jenis_usaha");
        setupDropdown("kategori_teman", "jenis_usaha_teman");

    });

    /* ======================
    SUBMIT + SWEETALERT (BENAR)
    ====================== */
               

                


</script>

                                                                                                            <style>

                                                                                                                .step-indicator {
                                                                                                                    display: flex;
                                                                                                                    justify-content: space-between;
                                                                                                                    margin-bottom: 30px;
                                                                                                                }

                                                                                                                .step-item {
                                                                                                                    width: 40px;
                                                                                                                    height: 40px;
                                                                                                                    border-radius: 50%;
                                                                                                                    background: #fffae0;
                                                                                                                    display: flex;
                                                                                                                    align-items: center;
                                                                                                                    justify-content: center;
                                                                                                                    font-weight: bold;
                                                                                                                }

                                                                                                                .step-item.active {
                                                                                                                    background: #f79039;
                                                                                                                    color: white;
                                                                                                                }

                                                                                                                /* body{
                padding-top:80px;
            } */

                                                                                                                .card {
                                                                                                                    border-radius: 10px;
                                                                                                                }

                                                                                                                .card-body {
                                                                                                                    padding: 30px;
                                                                                                                }
                                                                                                                .card-header {
                                                                                                                    font-size: 20px;
                                                                                                                    font-weight: 600;
                                                                                                                }
                                                                                                                .form-group {
                                                                                                                    margin-bottom: 20px;
                                                                                                                }
                                                                                                                .form-group label {
                                                                                                                    display: block;
                                                                                                                    max-width: 600px;
                                                                                                                    word-wrap: break-word;
                                                                                                                    white-space: normal;
                                                                                                                }
                                                                                                            </style>