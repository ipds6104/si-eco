<?php
require 'vendor/autoload.php';

$file = 'database/Rekap MasterSLS(2025261,2025_2).xlsx';

try {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray(null, true, true, true);
    
    echo "\nROWS 20-40:\n";
    print_r(array_slice($data, 19, 21));
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
