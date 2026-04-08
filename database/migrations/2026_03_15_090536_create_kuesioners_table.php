<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kuesioners', function (Blueprint $table) {
            $table->id();

             // BLOK A
            $table->string('nama');
            $table->string('npm');
            $table->string('no_hp');
            $table->string('fakultas')->nullable();
            $table->string('punya_usaha');
          

            // BLOK B
            $table->string('kegiatan_utama')->nullable();
            $table->string('jenis_usaha');
            $table->string('alamat_usaha');
            $table->string('link_maps_usaha')->nullable();
            $table->string('input_usaha')->nullable();
            $table->string('proses_usaha')->nullable();
            $table->string('produk_utama')->nullable();
            $table->string('nib')->nullable();
            $table->string('sertif_halal')->nullable();
            $table->string('omzet')->nullable();
            $table->string('link_medsos_usaha')->nullable();        
            $table->string('ikut_komunitas');

            // BLOK C
            $table->string('nama_komunitas');
            $table->string('media_komunitas')->nullable();
            $table->text('media_komunitas_detail')->nullable();
            $table->string('link_medsos_komunitas')->nullable();
            $table->string('manfaat_komunitas')->nullable();

            // BLOK D
            $table->boolean('usaha_teman')->nullable();

            // BLOK E
            $table->string('nama_teman')->nullable();
            $table->string('no_hp_teman')->nullable();
            $table->string('kegiatan_utama_teman')->nullable();
            $table->string('jenis_usaha_teman')->nullable();
            $table->string('alamat_usaha_teman')->nullable();
            $table->string('link_maps_teman')->nullable();
            $table->string('input_teman')->nullable();
            $table->string('proses_teman')->nullable();
            $table->string('produk_utama_teman')->nullable();
            $table->string('nib_teman')->nullable();
            $table->string('sertif_halal_teman')->nullable();
            $table->string('omzet_teman')->nullable();
            $table->string('socmed_teman')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuesioners');
    }
};
