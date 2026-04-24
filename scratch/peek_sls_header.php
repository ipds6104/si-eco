<?php
require 'vendor/autoload.php';

$file = 'database/Rekap MasterSLS(2025261,2025_2).xlsx';

try {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray(null, true, true, true);
    
    echo "\nROWS 1-5:\n";
    print_r(array_slice($data, 0, 5));
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
