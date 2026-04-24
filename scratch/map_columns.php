<?php
require 'vendor/autoload.php';
$file = 'database/Rekap MasterSLS(2025261,2025_2).xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
$sheet = $spreadsheet->getActiveSheet();
$highestColumn = $sheet->getHighestColumn();
$data = $sheet->rangeToArray('A1:' . $highestColumn . '2', null, true, true, true);
echo "COLUMN MAPPING ROW 1 (HEADER):\n";
print_r($data[1]);
echo "\nCOLUMN MAPPING ROW 2:\n";
print_r($data[2]);
