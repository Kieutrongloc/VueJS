<?php
require dirname(__DIR__) . '/connection.php';

$course_id = $_GET['course_id'];

// prepare and execute a SELECT statement
$stmt = $dbh->prepare("SELECT * FROM units WHERE course_id=:course_id");
$stmt->bindParam(':course_id', $course_id);
$stmt->execute();

// fetch the results as an associative array
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// output the results as a JSON object
header('Content-Type: application/json');
echo json_encode($results);
?>
