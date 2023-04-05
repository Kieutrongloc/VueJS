<?php
require dirname(__DIR__) . '/connection.php';

$skill_id = $_GET['skill_id'];

// prepare and execute a SELECT statement
$stmt = $dbh->prepare("SELECT * FROM questions WHERE skill_id=:skill_id");
$stmt->bindParam(':skill_id', $skill_id);
$stmt->execute();

// fetch the results as an associative array
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
