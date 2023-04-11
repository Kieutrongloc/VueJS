<?php
require dirname(__DIR__) . '/connection.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

$skill_id = $_GET['skill_id'];

$stmt = $dbh->prepare("SELECT * FROM questions WHERE skill_id=:skill_id");
$stmt->bindParam(':skill_id', $skill_id);
$stmt->execute();
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$questions) {
    echo "No question found";
    exit;
}

// loop through the questions and get answers for each question
$questionAnswers = array();
foreach ($questions as $question) {
    $stmt = $dbh->prepare("SELECT * FROM answers WHERE question_id=:question_id");
    $stmt->bindParam(':question_id', $question['id']);
    $stmt->execute();
    $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // encode image/audio data as Base64 string
    if ($question['image']) {
        $question['image'] = base64_encode($question['image']);
    }

    if ($question['audio']) {
        $question['audio'] = base64_encode($question['audio']);
    }

    foreach ($answers as &$answer) {
        if ($answer['image']) {
            $answer['image'] = base64_encode($answer['image']);
        }

        if ($answer['audio']) {
            $answer['audio'] = base64_encode($answer['audio']);
        }
    }

    // add the question and answers to the array
    $newQuestions[] = array(
        "question" => $question,
        "answers" => $answers
    );
}

header('Content-Type: application/json');
echo json_encode($newQuestions);
?>
