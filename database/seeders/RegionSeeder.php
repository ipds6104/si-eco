<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $filePath = database_path('Rekap MasterSLS(2025161,2025_1).xlsx');
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

        $kabupatens = [];
        $kecamatans = [];
        $desas = [];
        $sls_list = [];

        $lastKab = '';
        $lastKec = '';

        foreach ($rows as $index => $row) {
            if ($index == 1) continue; // Skip header

            $kabName = strtoupper(trim($row['G'] ?? ''));
            $kecName = strtoupper(trim($row['F'] ?? ''));
            $slsName = strtoupper(trim($row['C'] ?? ''));
            $code    = trim($row['B'] ?? '');

            // Carry over if empty
            if (empty($kabName)) $kabName = $lastKab; else $lastKab = $kabName;
            if (empty($kecName)) $kecName = $lastKec; else $lastKec = $kecName;

            if (!$kabName || !$kecName || !$code) continue;

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

            // Extract Desa Code (Digits 8-10)
            // Example: 61040800010001 -> '001'
            $desaCode = substr($code, 7, 3);
            if (empty($desaCode)) $desaCode = '000';

            // Handle Desa
            $desaKey = $kecId . '|' . $desaCode;
            if (!isset($desas[$desaKey])) {
                // Check if Column E has a value now (it shouldn't, based on our peek, but for future proofing)
                $desaNameFromExcel = strtoupper(trim($row['E'] ?? ''));
                $actualDesaName = $desaNameFromExcel ?: "DESA " . $desaCode;

                $id = DB::table('regions')->insertGetId([
                    'name' => $actualDesaName,
                    'type' => 'DESA',
                    'parent_id' => $kecId,
                    'code' => $desaCode,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $desas[$desaKey] = $id;
            }
            $desaId = $desas[$desaKey];

            // Handle SLS (RT)
            if (!empty($slsName)) {
                // BPS Code Pattern: Digits 11-12 represent SLS Type.
                // '00' = Standard Residential SLS (RT/RW). 
                // Others (10, 20, etc) = Non-SLS (Forests, Islands, Special Areas).
                $slsType = substr($code, 10, 2);
                
                if ($slsType === '00') {
                    $slsKey = $desaId . '|' . $slsName;
                    if (!isset($sls_list[$slsKey])) {
                        DB::table('regions')->insert([
                            'name' => $slsName,
                            'type' => 'SLS',
                            'parent_id' => $desaId,
                            'code' => substr($code, 10, 4), // SLS Code
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        $sls_list[$slsKey] = true;
                    }
                }
            }
        }
        
        $this->command->info("Impor selesai. " . count($desas) . " Desa dan " . count($sls_list) . " SLS berhasil diimpor.");
    }
}
