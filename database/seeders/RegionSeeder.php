<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $filePath = database_path('Rekap MasterSLS(2025261,2025_2).xlsx');
        if (!file_exists($filePath)) {
            $this->command->error("File Excel tidak ditemukan di database/ folder.");
            return;
        }

        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        // Clear existing data
        $this->command->info("Menghapus data wilayah lama...");
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('regions')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info("Mulai membaca data dari Excel...");
        $this->command->info("Header Data (Baris 1):");
        if (isset($rows[1])) {
            print_r($rows[1]);
        } else {
            $this->command->error("Baris 1 tidak ditemukan!");
        }
        $this->command->info("Contoh data 5 baris pertama:");
        print_r(array_slice($rows, 0, 5, true));

        $kabupatens = [];
        $kecamatans = [];
        $desas = [];

        $lastKab = '';
        $lastKec = '';
        $lastDesa = '';

        foreach ($rows as $index => $row) {
            if ($index == 1) continue; // Skip header

            $kabName = strtoupper(trim($row['G'] ?? ''));
            $kecName = strtoupper(trim($row['F'] ?? ''));
            $desaName = strtoupper(trim($row['C'] ?? ''));

            // Carry over if empty (Grouped data handling for Kab/Kec)
            if (empty($kabName)) $kabName = $lastKab; else $lastKab = $kabName;
            if (empty($kecName)) $kecName = $lastKec; else $lastKec = $kecName;

            // FALLBACK FOR DESA CODE (just in case)
            if (empty($desaName)) {
                $code = trim($row['B'] ?? '');
                if (strlen($code) >= 10) {
                    $desaName = "KODE DESA " . substr($code, 7, 3);
                }
            }

            if (!$kabName || !$kecName || !$desaName) continue;

            // Handle Kabupaten
            if (!isset($kabupatens[$kabName])) {
                $id = DB::table('regions')->insertGetId([
                    'name' => $kabName,
                    'type' => 'KABUPATEN',
                    'parent_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $kabupatens[$kabName] = $id;
            }
            $kabId = $kabupatens[$kabName];

            // Handle Kecamatan
            $kecKey = $kabId . '|' . $kecName;
            if (!isset($kecamatans[$kecKey])) {
                $id = DB::table('regions')->insertGetId([
                    'name' => $kecName,
                    'type' => 'KECAMATAN',
                    'parent_id' => $kabId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $kecamatans[$kecKey] = $id;
            }
            $kecId = $kecamatans[$kecKey];

            // Handle Desa
            $desaKey = $kecId . '|' . $desaName;
            if (!isset($desas[$desaKey])) {
                DB::table('regions')->insert([
                    'name' => $desaName,
                    'type' => 'DESA',
                    'parent_id' => $kecId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $desas[$desaKey] = true;
            }
        }
    }
}
