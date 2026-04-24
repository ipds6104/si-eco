<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Memastikan data wilayah hanya berisi SLS standar (RT/RW) 
     * dengan menghapus entri Non-SLS (Hutan, Pulau, dsb) jika terdeteksi.
     */
    public function up(): void
    {
        // Cek apakah masih ada kode SLS yang tidak diawali '00' (indikator Non-SLS)
        $hasNonSls = DB::table('regions')
            ->where('type', 'SLS')
            ->where('code', 'NOT LIKE', '00%')
            ->exists();

        if ($hasNonSls) {
            try {
                echo "Non-SLS areas (Forests/Islands) detected. Cleaning up and re-seeding...\n";
                
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                DB::table('regions')->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                Artisan::call('db:seed', [
                    '--class' => 'RegionSeeder',
                    '--force' => true
                ]);
                
                echo "Successfully cleaned up non-residential areas.\n";
            } catch (\Exception $e) {
                echo "⚠️  Cleanup failed: " . $e->getMessage() . "\n";
            }
        }
    }

    public function down(): void
    {
    }
};
