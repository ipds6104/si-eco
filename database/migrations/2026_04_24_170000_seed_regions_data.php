<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Menjalankan Seeder Regions secara otomatis saat migrasi.
     * Menggunakan pengecekan agar hanya berjalan jika tabel kosong.
     */
    public function up(): void
    {
        // Seeding dipindahkan sepenuhnya ke RegionSeeder 
        // untuk menghindari crash memori saat proses migrasi (Master SLS sangat berat).
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Opsional: Kosongkan tabel jika ingin rollback
        // DB::table('regions')->truncate();
    }
};
