<?php
include 'config.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization');
header('Access-Control-Allow-Methods: *');

// aws
$host = "duolingo.cyfy53duasbw.ap-southeast-2.rds.amazonaws.com";
$dbname = "duolingo";
$user = "locmysqldb";
//create file named config.php in the same folder with this file and add $db_password = "MY PASSWORD"
$password = $db_password;

try {
  $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
  die();
}
?>