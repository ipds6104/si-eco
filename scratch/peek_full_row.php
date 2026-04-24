<?php
require 'vendor/autoload.php';
$file = 'database/Rekap MasterSLS(2025261,2025_2).xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
$sheet = $spreadsheet->getActiveSheet();
$highestColumn = $sheet->getHighestColumn();
$data = $sheet->rangeToArray('A2:' . $highestColumn . '2', null, true, true, true);
echo "FULL ROW 2 DATA:\n";
print_r($data[2]);
