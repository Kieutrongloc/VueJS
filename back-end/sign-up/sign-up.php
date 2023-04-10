<?php
require dirname(__DIR__) . '/connection.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);


$age = $_POST['first_name'];
$email = $_POST['email'];
$password = $_POST['password'];



$sql = "SELECT * FROM user_account WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0){$message = "email error"; echo json_encode(['msg' => $message]);die;} else{

if ($first_name !==null && $last_name!==null && $birthday!==null && $email!==null && $password!==null &&$phone!==null){
$sql = "INSERT INTO user_account (first_name, last_name, country, birthday, email, password, phone, verify_with, announcements, ads)
  VALUES ('$first_name', '$last_name', '$country', '$birthday', '$email',  '$password', '$phone', '$verify_with', '$announcements', '$ads')";
} else {$message = "error"; echo json_encode(['msg' => $message]);die;}}

if ($conn->query($sql) === TRUE) {
    // echo "New record created successfully";
    // $user_account = [];
    // $sql = "SELECT * FROM user_account";
    // $result = $conn->query($sql);
    // if ($result->num_rows > 0) {
    //     while($row = $result->fetch_assoc()) {
    //         $user_account[] = $row;
    //     }
    // } 
    // echo json_encode($user_account); die;
    $message = "ok";
    echo json_encode(['msg' => $message]);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>