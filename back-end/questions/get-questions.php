<?php
require dirname(__DIR__) . '/connection.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

$skill_id = $_GET['skill_id'];

// prepare and execute a SELECT statement
$stmt = $dbh->prepare("SELECT a.id as a_id, a.question_id as a_question_id, a.title as a_title, a.image as a_image, a.audio as a_audio, q.id as q_id, q.title as q_title, q.description as q_description, q.answer as q_answer, q.image as q_image, q.audio as q_audio, q.template_name as q_template_name FROM questions q left join answers a  on a.question_id = q.id WHERE skill_id=:skill_id");
$stmt->bindParam(':skill_id', $skill_id);
$stmt->execute();
// fetch the results as an associative array
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$results) {
    echo "No results found";
    exit;
}

// output the results as a JSON object
header('Content-Type: application/json');
echo json_encode($results);
?>