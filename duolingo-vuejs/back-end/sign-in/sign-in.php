<?php
require dirname(__DIR__) . '/connection.php';

$userid = $_POST['id'];
$userpw = $_POST['pw'];

$sql = "SELECT * FROM user_account WHERE userid=:userid";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':userid', $userid);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
    if ($userpw == $row['userpw']) {
        $message = "ok";
        unset($row['userpw']);
        if ($row['avatar']) {
            $row['avatar'] = base64_encode($row['avatar']);
        }
        echo json_encode(['msg' => $message, 'user' => $row]);
        die;
    }
}

$message = "no";
echo json_encode(['msg' => $message]);
die;
?>
