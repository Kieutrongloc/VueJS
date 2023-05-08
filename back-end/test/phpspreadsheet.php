<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

$fileName = 'demo.xlsx';
$spreadsheet = IOFactory::load($fileName);

if ($spreadsheet instanceof PhpOffice\PhpSpreadsheet\Spreadsheet) {
    // The file was loaded successfully

    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();
    $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

    // Loop through each row and column to read the cell values
    for ($row = 1; $row <= $highestRow; ++$row) {
        for ($col = 1; $col <= $highestColumnIndex; ++$col) {
            $cellValue = $sheet->getCell('A1')->getValue();
            $columnName = Coordinate::stringFromColumnIndex($col);

            echo "Cell ($row, $columnName) value is: $cellValue<br/>";
        }
    }
} else {
    // The file could not be loaded
    echo "Error loading file: $fileName";
}

?>
