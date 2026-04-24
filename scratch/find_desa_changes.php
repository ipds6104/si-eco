<?php
require 'vendor/autoload.php';
$file = 'database/Rekap MasterSLS(2025261,2025_2).xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
$sheet = $spreadsheet->getActiveSheet();
$data = $sheet->toArray(null, true, true, true);
$lastDesa = '';
foreach($data as $idx => $row) {
    if($idx == 1) continue;
    $currentDesa = trim($row['E'] ?? '');
    if ($currentDesa && $currentDesa !== $lastDesa) {
        echo "NEW DESA AT ROW $idx: $currentDesa | KEC: " . $row['F'] . "\n";
        $lastDesa = $currentDesa;
    }
}
