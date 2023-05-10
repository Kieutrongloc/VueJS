<?php

require dirname(__DIR__) . '/connection.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
// use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

$fileName = 'sample-learn.xlsx';
$spreadsheet = IOFactory::load($fileName);

// Check if the file was loaded successfully
if ($spreadsheet instanceof PhpOffice\PhpSpreadsheet\Spreadsheet) {

    // Get an array of all sheet names
    $sheetNames = $spreadsheet->getSheetNames();
    $sheetOrder = ['skills', 'questions', 'answers'];
    $skillsArray = [];
    $questionsArray = [];

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
        $columnIndexes = array(); // to store column indexes for each field

        if ($sheetName === 'skills') {
            
            // Get the first row
            $firstRow = $worksheet->getRowIterator(1, 1)->current();

            // Loop through each cell in the first row
            foreach ($firstRow->getCellIterator() as $cell) {
                $cellValue = $cell->getValue();
                $columnIndex = $cell->getColumn();

                // Check cell value and assign column index accordingly
                if ($cellValue == 'id') {
                    $columnIndexes['id'] = $columnIndex;
                } elseif ($cellValue == 'course_id') {
                    $columnIndexes['course_id'] = $columnIndex;
                } elseif ($cellValue == 'lesson_id') {
                    $columnIndexes['lesson_id'] = $columnIndex;
                } elseif ($cellValue == 'title') {
                    $columnIndexes['title'] = $columnIndex;
                } elseif ($cellValue == 'image') {
                    $columnIndexes['image'] = $columnIndex;
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
                
                // insert data into database
                $stmt = $dbh->prepare("INSERT INTO skills (course_id, lesson_id, title, image) VALUES (?, ?, ?, ?)");
                if (!$stmt->execute([$courseId, $lessonId, $title, $image])) {
                    echo "Error: " . implode(", ", $stmt->errorInfo());
                }
                
                //get the skill id in the database
                $stmt = $dbh->prepare("SELECT id FROM skills WHERE title=:title");
                $stmt->bindParam(':title', $title);
                $stmt->execute();
                $db_row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if(count($db_row)!==1){
                    $stmt = $dbh->prepare("DELETE FROM skills WHERE id=:id"); //delete the duplicated skill
                    $stmt->bindParam(':id', end($db_row)['id']);
                    $stmt->execute();
                    $message="skill '$title' did exist in the database";
                    echo json_encode(['msg' => $message]); die;
                }
                
                $skillsArray[] = ['id' => $id, 'db_id' => $db_row[0]['id'], 'title' => $title];
            }
            
        } 
        else if ($sheetName === 'questions') {

            // Get the first row
            $firstRow = $worksheet->getRowIterator(1, 1)->current();

            // Loop through each cell in the first row
            foreach ($firstRow->getCellIterator() as $cell) {
                $cellValue = $cell->getValue();
                $columnIndex = $cell->getColumn();

                // Check cell value and assign column index accordingly
                if ($cellValue == 'id') {
                    $columnIndexes['id'] = $cell->getColumn();
                } elseif ($cellValue == 'unit_id') {
                    $columnIndexes['unit_id'] = $cell->getColumn();
                } elseif ($cellValue == 'lesson_id') {
                    $columnIndexes['lesson_id'] = $cell->getColumn();
                } elseif ($cellValue == 'skill_id') {
                    $columnIndexes['skill_id'] = $cell->getColumn();
                } elseif ($cellValue == 'title') {
                    $columnIndexes['title'] = $cell->getColumn();
                } elseif ($cellValue == 'description') {
                    $columnIndexes['description'] = $cell->getColumn();
                } elseif ($cellValue == 'answer') {
                    $columnIndexes['answer'] = $cell->getColumn();
                } elseif ($cellValue == 'image') {
                    $columnIndexes['image'] = $cell->getColumn();
                } elseif ($cellValue == 'audio') {
                    $columnIndexes['audio'] = $cell->getColumn();
                } elseif ($cellValue == 'template_name') {
                    $columnIndexes['template_name'] = $cell->getColumn();
                }
            }

            foreach ($skillsArray as $skill) {
                
                // loop through each row starting from the second row
                for ($rowIndex = 2; $rowIndex <= $worksheet->getHighestRow(); $rowIndex++) {
                    // get values for each field using column indexes
                    $skill_id = $worksheet->getCell($columnIndexes['skill_id'] . $rowIndex)->getValue();
                    
                    if($skill_id === $skill['id']) {
                        
                        $id = $worksheet->getCell($columnIndexes['id'] . $rowIndex)->getValue();
                        $unit_id = $worksheet->getCell($columnIndexes['unit_id'] . $rowIndex)->getValue();
                        $lesson_id = $worksheet->getCell($columnIndexes['lesson_id'] . $rowIndex)->getValue();
                        $title = $worksheet->getCell($columnIndexes['title'] . $rowIndex)->getValue();
                        $description = $worksheet->getCell($columnIndexes['description'] . $rowIndex)->getValue() === null ? '' : $worksheet->getCell($columnIndexes['description'] . $rowIndex)->getValue();
                        $answer = $worksheet->getCell($columnIndexes['answer'] . $rowIndex)->getValue();
                        $image = $worksheet->getCell($columnIndexes['image'] . $rowIndex)->getValue() === null ? '' : $worksheet->getCell($columnIndexes['image'] . $rowIndex)->getValue();
                        $audio = $worksheet->getCell($columnIndexes['audio'] . $rowIndex)->getValue() === null ? '' : $worksheet->getCell($columnIndexes['audio'] . $rowIndex)->getValue();
                        $template_name = $worksheet->getCell($columnIndexes['template_name'] . $rowIndex)->getValue();
                        
                        // insert data into database
                        $stmt = $dbh->prepare("INSERT INTO questions (unit_id, lesson_id, skill_id, title, description, answer, image, audio, template_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        if (!$stmt->execute([$unit_id, $lesson_id, $skill['db_id'], $title, $description, $answer, $image, $audio, $template_name])) {
                            echo "Error: " . implode(", ", $stmt->errorInfo());
                        }
                        
                        //get the question id in the database
                        $stmt = $dbh->prepare("SELECT id FROM questions WHERE title=:title");
                        $stmt->bindParam(':title', $title);
                        $stmt->execute();
                        $db_row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if(count($db_row)!==1){
                            $stmt = $dbh->prepare("DELETE FROM questions WHERE id=:id"); //delete the duplicated question
                            $stmt->bindParam(':id', end($db_row)['id']);
                            $stmt->execute();
                            $message="question '$title' did exist in the database";
                            echo json_encode(['msg' => $message]); die;
                        }
                        
                        $questionsArray[] = ['id' => $id, 'db_id' => $db_row[0]['id'], 'title' => $title];
                    }

                }

            }
        }
        else if ($sheetName === 'answers') {

            // Get the first row
            $firstRow = $worksheet->getRowIterator(1, 1)->current();

            // Loop through each cell in the first row
            foreach ($firstRow->getCellIterator() as $cell) {
                $cellValue = $cell->getValue();
                $columnIndex = $cell->getColumn();

                // Check cell value and assign column index accordingly
                if ($cellValue == 'id') {
                    $columnIndexes['id'] = $cell->getColumn();
                } elseif ($cellValue == 'question_id') {
                    $columnIndexes['question_id'] = $cell->getColumn();
                } elseif ($cellValue == 'title') {
                    $columnIndexes['title'] = $cell->getColumn();
                } elseif ($cellValue == 'image') {
                    $columnIndexes['image'] = $cell->getColumn();
                } elseif ($cellValue == 'audio') {
                    $columnIndexes['audio'] = $cell->getColumn();
                }
            }

            foreach ($questionsArray as $question) {
                
                // loop through each row starting from the second row
                for ($rowIndex = 2; $rowIndex <= $worksheet->getHighestRow(); $rowIndex++) {
                    // get values for each field using column indexes
                    $question_id = $worksheet->getCell($columnIndexes['question_id'] . $rowIndex)->getValue();
                    
                    if($question_id === $question['id']) {
                        
                        $title = $worksheet->getCell($columnIndexes['title'] . $rowIndex)->getValue();
                        $image = $worksheet->getCell($columnIndexes['image'] . $rowIndex)->getValue() === null ? '' : $worksheet->getCell($columnIndexes['image'] . $rowIndex)->getValue();
                        $audio = $worksheet->getCell($columnIndexes['audio'] . $rowIndex)->getValue() === null ? '' : $worksheet->getCell($columnIndexes['audio'] . $rowIndex)->getValue();
                        
                        // insert data into database
                        $stmt = $dbh->prepare("INSERT INTO answers (question_id, title, image, audio) VALUES (?, ?, ?, ?)");
                        if (!$stmt->execute([$question['db_id'], $title, $image, $audio])) {
                            echo "Error: " . implode(", ", $stmt->errorInfo());
                        }
                    }
                }
            }
        }
    }
    $message="Successfully updated in the database";
    echo json_encode(['msg' => $message]); die;
} else {
    // The file could not be loaded
    echo "Error loading file: $fileName";
}

?>
