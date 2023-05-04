<?php
require dirname(__DIR__) . '/connection.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

$age = $_POST['age'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['pw'];
$current_course_id = 1;
$current_unit = 1;
$current_lesson = 1;

$stmt = $dbh->prepare("SELECT * FROM user_account WHERE userid = ?");
$stmt->execute([$email]);
if ($stmt->rowCount() > 0) {
  $message = "email error"; 
  echo json_encode(['msg' => $message]);
  die();
}

$stmt = $dbh->prepare("INSERT INTO user_account (age, user_name, userid, userpw, current_course_id, current_unit, current_lesson)
  VALUES (?, ?, ?, ?, ?, ?, ?)");
if ($stmt->execute([$age, $name, $email, $password, $current_course_id, $current_unit, $current_lesson])) {
  $message = "ok";
  $user = [];
  $stmt = $dbh->prepare("SELECT * FROM user_account WHERE userid = ?");
  $stmt->execute([$email]);
  if ($stmt->rowCount() > 0) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  unset($user['userpw']);
  echo json_encode(['msg' => $message, 'user' => $user]); die;
} else {
  echo "Error: " . implode(", ", $stmt->errorInfo());
}
?>