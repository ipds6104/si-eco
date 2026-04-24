<?php
require 'vendor/autoload.php';
$file = 'database/Rekap MasterSLS(2025261,2025_2).xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
$sheet = $spreadsheet->getActiveSheet();
$data = $sheet->toArray(null, true, true, true);
for($i=1; $i<=20; $i++) {
    echo "ROW $i: " . ($data[$i]['E'] ?? 'EMPTY') . " | " . ($data[$i]['F'] ?? 'EMPTY') . " | " . ($data[$i]['G'] ?? 'EMPTY') . "\n";
}
