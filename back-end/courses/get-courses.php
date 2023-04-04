<?php
require dirname(__DIR__) . '/connection.php';

// prepare and execute a SELECT statement
$stmt = $dbh->prepare("SELECT id, code, image, title FROM courses");
$stmt->execute();

// fetch the results as an associative array
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as &$result) {
    if ($result['image']) {
      $result['image'] = base64_encode($result['image']);
    }
}

// output the results as a JSON object
header('Content-Type: application/json');
echo json_encode($results);
?>