<?php
require 'vendor/autoload.php';
$file = 'database/Rekap MasterSLS(2025261,2025_2).xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
$sheet = $spreadsheet->getActiveSheet();
$data = $sheet->toArray(null, true, true, true);
$found = 0;
foreach($data as $idx => $row) {
    if(!empty($row['E']) && $idx > 1) {
        echo "FOUND AT ROW $idx: " . $row['E'] . " | " . $row['F'] . " | " . $row['G'] . "\n";
        $found++;
        if($found > 5) break;
    }
}
if($found == 0) echo "NO DATA IN COLUMN E AT ALL";
