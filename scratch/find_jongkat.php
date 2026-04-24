<?php
require 'vendor/autoload.php';
$file = 'database/Rekap MasterSLS(2025261,2025_2).xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
$sheet = $spreadsheet->getActiveSheet();
$data = $sheet->toArray(null, true, true, true);
$count = 0;
foreach($data as $idx => $row) {
    if(in_array('JONGKAT', $row)) {
        echo "ROW $idx: " . implode(' | ', array_filter($row)) . "\n";
        $count++;
        if($count > 10) break;
    }
}
