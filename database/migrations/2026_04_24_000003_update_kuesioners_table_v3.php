<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kuesioners', function (Blueprint $table) {
            // Region & Address
            if (!Schema::hasColumn('kuesioners', 'kabupaten_id')) {
                $table->unsignedBigInteger('kabupaten_id')->nullable()->after('no_hp');
            }
            if (!Schema::hasColumn('kuesioners', 'kecamatan_id')) {
                $table->unsignedBigInteger('kecamatan_id')->nullable()->after('kabupaten_id');
            }
            if (!Schema::hasColumn('kuesioners', 'desa_id')) {
                $table->unsignedBigInteger('desa_id')->nullable()->after('kecamatan_id');
            }
            if (!Schema::hasColumn('kuesioners', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable()->after('link_maps_usaha');
            }
            if (!Schema::hasColumn('kuesioners', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            }
            if (!Schema::hasColumn('kuesioners', 'geotag')) {
                $table->text('geotag')->nullable()->after('longitude');
            }
            
            // Pekerjaan
            if (!Schema::hasColumn('kuesioners', 'pekerjaan')) {
                $table->string('pekerjaan')->nullable()->after('kategori_responden');
            }
            if (!Schema::hasColumn('kuesioners', 'pekerjaan_lainnya')) {
                $table->string('pekerjaan_lainnya')->nullable()->after('pekerjaan');
            }
            
            if (!Schema::hasColumn('kuesioners', 'sumber_penghasilan_digital')) {
                $table->text('sumber_penghasilan_digital')->nullable()->after('software_operasional');
            }
            if (!Schema::hasColumn('kuesioners', 'platform_digital_v2')) {
                $table->text('platform_digital_v2')->nullable()->after('sumber_penghasilan_digital');
            }
            
            // Final
            if (!Schema::hasColumn('kuesioners', 'foto_rumah')) {
                $table->string('foto_rumah')->nullable()->after('is_producer');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kuesioners', function (Blueprint $table) {
            $table->dropColumn([
                'kabupaten_id', 'kecamatan_id', 'desa_id', 
                'latitude', 'longitude', 'geotag',
                'pekerjaan', 'pekerjaan_lainnya',
                'sumber_penghasilan_digital', 'platform_digital_v2',
                'foto_rumah'
            ]);
        });
    }
};
