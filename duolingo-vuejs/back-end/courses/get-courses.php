<?php
require dirname(__DIR__) . '/connection.php';


// prepare and execute a SELECT statement
$stmt = $dbh->prepare("SELECT id, code, title FROM courses");
$stmt->execute();

// fetch the results as an associative array
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// output the results as a JSON object
header('Content-Type: application/json');
echo json_encode($results);

// <?php
// header('Cache-Control: no-cache');
// header('Content-Type: application/json');
// // database credentials
// $host = "duolingo.cyfy53duasbw.ap-southeast-2.rds.amazonaws.com";
// $dbname = "duolingo";
// $user = "locmysqldb";
// $password = "Kieutrongloc123";


// $conn = mysqli_connect($servername, $username, $password);

// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }

// mysqli_select_db($conn, "duolingo");

// $sql = "SELECT id, question_id, title FROM answers";

// $result = mysqli_query($conn, $sql);

// if (mysqli_num_rows($result) > 0) {
//   while($row = mysqli_fetch_assoc($result)) {
//     echo "id: " . $row["id"]. " - Question ID: " . $row["question_id"]. " - Title: " . $row["title"]. " - Image: " . $row["image"]. "<br>";
//   }
// } else {
//   echo "0 results";
// }
// mysqli_close($conn);
// ?>