<?php
require 'vendor/autoload.php';
$file = 'database/Rekap MasterSLS(2025261,2025_2).xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
$sheet = $spreadsheet->getActiveSheet();
$data = $sheet->toArray(null, true, true, true);
foreach($data as $idx => $row) {
    foreach($row as $col => $val) {
        if(stripos($val, 'Wajok') !== false) {
            echo "MATCH AT ROW $idx, COL $col: $val\n";
            break 2;
        }
    }
}
