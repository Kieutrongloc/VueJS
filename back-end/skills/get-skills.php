<?php
require dirname(__DIR__) . '/connection.php';

 $lesson_id = $_GET['lesson_id'];

// prepare and execute a SELECT statement
$stmt = $dbh->prepare("SELECT id, title, course_id, lesson_id FROM skills where lesson_id =:lesson_id");
$stmt->bindParam(':lesson_id', $lesson_id);
$stmt->execute();

// fetch the results as an associative array
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// output the results as a JSON object
header('Content-Type: application/json');
echo json_encode($results);
?>
