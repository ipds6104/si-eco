<?php
require 'vendor/autoload.php';

$file = 'database/Pegawai menurut Unit Organisasi  Prov.  -  BPS Kabupaten_Kota_20250815142206.xls';

try {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray(null, true, true, true);
    
    echo "COLUMNS FOUND:\n";
    print_r(array_keys($data[1]));
    
    echo "\nFIRST 10 ROWS:\n";
    print_r(array_slice($data, 0, 15));
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
