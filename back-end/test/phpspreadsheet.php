<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

$fileName = 'sample-learn.xlsx';
$spreadsheet = IOFactory::load($fileName);

// Check if the file was loaded successfully
if ($spreadsheet instanceof PhpOffice\PhpSpreadsheet\Spreadsheet) {

    // Get an array of all sheet names
    $sheetNames = $spreadsheet->getSheetNames();

    foreach ($sheetNames as $sheetName) {

        if($sheetName === 'skills') {
            // Get the worksheet object by its name
            $worksheet = $spreadsheet->getSheetByName($sheetName);
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

            // Loop through each row and column to read the cell values
            for ($row = 1; $row <= $highestRow; ++$row) {

                for ($col = 1; $col <= $highestColumnIndex; ++$col) {

                    
                    $cellValue = $worksheet->getCell(Coordinate::stringFromColumnIndex($col) . $row)->getValue();

                    if($cellValue === 'id') {
                        
                        echo 'alo';
                        
                    }

                    // $columnName = Coordinate::stringFromColumnIndex($col);
        
                    // echo "Cell ($row, $columnName) value is: $cellValue<br/>";
                }
            }

        }




        // // Get the worksheet object by its name
        // $worksheet = $spreadsheet->getSheetByName($sheetName);

        // $highestRow = $worksheet->getHighestRow();
        // $highestColumn = $worksheet->getHighestColumn();
        // $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

        // // Loop through each row and column to read the cell values
        // for ($row = 1; $row <= $highestRow; ++$row) {
        //     for ($col = 1; $col <= $highestColumnIndex; ++$col) {
        //         $cellValue = $worksheet->getCell(Coordinate::stringFromColumnIndex($col) . $row)->getValue();
        //         $columnName = Coordinate::stringFromColumnIndex($col);
    
        //         echo "Cell ($row, $columnName) value is: $cellValue<br/>";
        //     }
        // }

    }

} else {
    // The file could not be loaded
    echo "Error loading file: $fileName";
}

?>
