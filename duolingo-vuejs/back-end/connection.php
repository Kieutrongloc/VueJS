<?php
include 'config.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization');
header('Access-Control-Allow-Methods: *');

$host = "duolingo.cyfy53duasbw.ap-southeast-2.rds.amazonaws.com";
$dbname = "duolingo";
$user = "locmysqldb";
$password = $db_password;


try {
  $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
  die();
}
?>