<?php

require dirname(__DIR__) . '/connection.php';
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
    $sheetOrder = ['skills', 'questions', 'answers'];
    $skillArray = [];
    $count = 0;

    // Sort $sheetNames based on order in $sheetOrder
    $commonSheets = array_intersect($sheetNames, $sheetOrder);

    $sortedSheets = [];
    foreach ($sheetOrder as $sheet) {
        if (in_array($sheet, $commonSheets)) {
            $sortedSheets[] = $sheet;
        }
    }
    $otherSheets = array_diff($sheetNames, $sortedSheets);
    sort($otherSheets);
    $sheetNames = array_merge($sortedSheets, $otherSheets);

    // loop through all the sheets available
    foreach ($sheetNames as $sheetName) {
        // Get the worksheet object by its name
        $worksheet = $spreadsheet->getSheetByName($sheetName);

        switch ($sheetName) {

            case 'skills':

                $columnIndexes = array(); // to store column indexes for each field
                // loop through first row to get column indexes for each field
                foreach ($worksheet->getRowIterator(1, 1) as $row) {
                    foreach ($row->getCellIterator() as $cell) {
                        $cellValue = $cell->getValue();
                        if ($cellValue == 'id') {
                            $columnIndexes['id'] = $cell->getColumn();
                        } elseif ($cellValue == 'course_id') {
                            $columnIndexes['course_id'] = $cell->getColumn();
                        } elseif ($cellValue == 'lesson_id') {
                            $columnIndexes['lesson_id'] = $cell->getColumn();
                        } elseif ($cellValue == 'title') {
                            $columnIndexes['title'] = $cell->getColumn();
                        } elseif ($cellValue == 'image') {
                            $columnIndexes['image'] = $cell->getColumn();
                        }
                    }
                }

                // loop through each row starting from the second row
                for ($rowIndex = 2; $rowIndex <= $worksheet->getHighestRow(); $rowIndex++) {
                    // get values for each field using column indexes
                    $id = $worksheet->getCell($columnIndexes['id'] . $rowIndex)->getValue();
                    $courseId = $worksheet->getCell($columnIndexes['course_id'] . $rowIndex)->getValue();
                    $lessonId = $worksheet->getCell($columnIndexes['lesson_id'] . $rowIndex)->getValue();
                    $title = $worksheet->getCell($columnIndexes['title'] . $rowIndex)->getValue();
                    $image = $worksheet->getCell($columnIndexes['image'] . $rowIndex)->getValue() === null ? '' : $worksheet->getCell($columnIndexes['image'] . $rowIndex)->getValue();
                    
                    $skillArray[] = ['id' => $id, 'title' => $title];

                    // insert data into database
                    // $stmt = $dbh->prepare("INSERT INTO skills (course_id, lesson_id, title, image) VALUES (?, ?, ?, ?)");
                    // if ($stmt->execute([$courseId, $lessonId, $title, $image])) {
                    //     // $message = "ok";
                    // } else {
                    //     echo "Error: " . implode(", ", $stmt->errorInfo());
                    // }
                }
                
                echo json_encode($skillArray);
                echo $count++;
            case 'questions':

            case 'answers':

            default:
                break;
        }

    }

} else {
    // The file could not be loaded
    echo "Error loading file: $fileName";
}

?>
