<?php
require 'vendor/autoload.php';

$file = 'database/Rekap MasterSLS(2025261,2025_2).xlsx';

try {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray(null, true, true, true);
    
    echo "COLUMNS FOUND:\n";
    print_r(array_keys($data[1]));
    
    echo "\nFIRST 15 ROWS:\n";
    // Check first 15 rows to find where data starts
    print_r(array_slice($data, 0, 15));
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
