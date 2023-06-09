<?php
require dirname(__DIR__) . '/connection.php';

$lesson_id = $_GET['lesson_id'];
$unit_id = $_GET['unit_id'];

// prepare and execute a SELECT statement
$stmt = $dbh->prepare("SELECT * FROM answers WHERE lesson_id=:lesson_id AND unit_id=:unit_id");
$stmt->bindParam(':lesson_id', $lesson_id);
$stmt->bindParam(':unit_id', $unit_id);
$stmt->execute();

// fetch the results as an associative array
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// output the results as a JSON object
header('Content-Type: application/json');
echo json_encode($results);
?>
