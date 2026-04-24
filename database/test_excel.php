<?php
require 'vendor/autoload.php';
$s = \PhpOffice\PhpSpreadsheet\IOFactory::load('database/Rekap MasterSLS(2025261,2025_2).xlsx');
$names = $s->getSheetNames();
print_r($names);
