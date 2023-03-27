<?php
header('Cache-Control: no-cache');
header('Content-Type: application/json');
// database credentials
$host = "duolingo.cyfy53duasbw.ap-southeast-2.rds.amazonaws.com";
$dbname = "duolingo";
$user = "locmysqldb";
$password = "Kieutrongloc123";

// create a new PDO instance
try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

// prepare and execute a SELECT statement
$stmt = $dbh->prepare("SELECT id, code, title FROM courses");
$stmt->execute();

// fetch the results as an associative array
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// output the results as a JSON object
header('Content-Type: application/json');
echo json_encode($results);
