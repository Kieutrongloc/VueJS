<?php
require dirname(__DIR__) . '/connection.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

$unit_id = $_GET['unit_id'];
$lesson_id = $_GET['lesson_id'];
$skill_id = $_GET['skill_id'];
$count = $_GET['count'];

// prepare and execute a SELECT statement
$stmt = $dbh->prepare("SELECT * FROM questions WHERE unit_id=:unit_id AND lesson_id=:lesson_id AND skill_id=:skill_id LIMIT :count");
$stmt->bindParam(':unit_id', $unit_id);
$stmt->bindParam(':lesson_id', $lesson_id);
$stmt->bindParam(':skill_id', $skill_id);
$stmt->bindParam(':count', $count, PDO::PARAM_INT);
$stmt->execute();

// fetch the results as an associative array
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$results) {
    echo "No results found";
    exit;
}
foreach ($results as &$result) {
    // encode image data as Base64 string
    if ($result['image']) {
        $result['image'] = base64_encode($result['image']);
    }

    // encode audio data as Base64 string
    if ($result['audio']) {
        $result['audio'] = base64_encode($result['audio']);
    }
    unset($result['answer']);
}

// output the results as a JSON object
header('Content-Type: application/json');
echo json_encode($results);
?>
