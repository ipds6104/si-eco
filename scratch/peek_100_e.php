<?php
require 'vendor/autoload.php';
$file = 'database/Rekap MasterSLS(2025261,2025_2).xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
$sheet = $spreadsheet->getActiveSheet();
$data = $sheet->toArray(null, true, true, true);
for($i=1; $i<=100; $i++) {
    $val = trim($data[$i]['E'] ?? '');
    if ($val) echo "ROW $i [E]: $val\n";
}
