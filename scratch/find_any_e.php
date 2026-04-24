<?php
require 'vendor/autoload.php';
$file = 'database/Rekap MasterSLS(2025261,2025_2).xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
$sheet = $spreadsheet->getActiveSheet();
$data = $sheet->toArray(null, true, true, true);
foreach($data as $idx => $row) {
    if($idx == 1) continue;
    $val = trim($row['E'] ?? '');
    if ($val) {
        echo "FOUND AT ROW $idx: $val\n";
        break;
    }
}
