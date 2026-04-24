<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan tabel role agar tidak duplikat saat dijalankan ulang
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $filePath = database_path('seeders/data/role.csv');

        if (!File::exists($filePath)) {
            $this->command->error("File role.csv tidak ditemukan.");
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $header = array_shift($data);

        foreach ($data as $row) {
            DB::table('role')->insert([
                'id' => $row[0],
                'role' => $row[1],
            ]);
        }

        $this->command->info("Data role berhasil diimpor.");
    }
}
