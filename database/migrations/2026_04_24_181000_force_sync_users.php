<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Migrasi ini memastikan daftar user di production selalu sinkron dengan users.json terbaru.
     */
    public function up(): void
    {
        // Cek apakah admin utama (abdul.karim) sudah ada atau belum
        $hasNewAdmin = DB::table('users')->where('username', 'abdul.karim')->exists();

        // Jika belum ada, paksa re-seed master data
        if (!$hasNewAdmin) {
            try {
                echo "Syncing master data (Roles, Pegawai & Users) from JSON/CSV...\n";
                
                // Pastikan role ada dulu
                if (DB::table('role')->count() == 0) {
                    Artisan::call('db:seed', [
                        '--class' => 'RoleSeeder',
                        '--force' => true
                    ]);
                }

                Artisan::call('db:seed', [
                    '--class' => 'PegawaiSeeder',
                    '--force' => true
                ]);

                Artisan::call('db:seed', [
                    '--class' => 'UserSeeder',
                    '--force' => true
                ]);

                echo "Successfully synced all master data.\n";
            } catch (\Exception $e) {
                echo "⚠️  User sync failed: " . $e->getMessage() . "\n";
            }
        }
    }

    public function down(): void
    {
    }
};
