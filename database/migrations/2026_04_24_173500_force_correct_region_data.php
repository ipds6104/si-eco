<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Migrasi ini memaksa seeding ulang data wilayah jika terdeteksi data "DESA 001"
     * yang merupakan indikasi penggunaan file Excel yang lama/salah.
     */
    public function up(): void
    {
        // Logika seeding dipindahkan ke seeder utama untuk menghindari
        // error Connection Refused akibat kehabisan memori saat proses migrasi.
    }

    public function down(): void
    {
        // No rollback needed for data correction
    }
};
