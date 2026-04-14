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
        // 1. Rename NIK first
        Schema::table('kuesioners', function (Blueprint $table) {
            $table->renameColumn('npm', 'nik');
        });

        // 2. Drop old columns
        Schema::table('kuesioners', function (Blueprint $table) {
            $table->dropColumn([
                'usaha_teman',
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
                'socmed_teman'
            ]);
        });

        // 3. Add new columns
        Schema::table('kuesioners', function (Blueprint $table) {
            $table->string('kategori_responden')->nullable()->after('nik');
            $table->text('platform_digital')->nullable()->after('ikut_komunitas');
            $table->string('proporsi_pendapatan_digital')->nullable()->after('platform_digital');
            $table->text('metode_pembayaran_digital')->nullable()->after('proporsi_pendapatan_digital');
            $table->text('software_operasional')->nullable()->after('metode_pembayaran_digital');
            $table->boolean('is_producer')->default(false)->after('software_operasional');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kuesioners', function (Blueprint $table) {
            $table->renameColumn('nik', 'npm');

            $table->boolean('usaha_teman')->nullable();
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

            $table->dropColumn([
                'kategori_responden',
                'platform_digital',
                'proporsi_pendapatan_digital',
                'metode_pembayaran_digital',
                'software_operasional',
                'is_producer'
            ]);
        });
    }
};
