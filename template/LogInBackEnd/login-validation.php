<?php
$mySqli = require __DIR__ . "/database.php";
$sql = sprintf("SELECT * FROM user_data WHERE email = '%s'", $mySqli->real_escape_string($_GET["email"]));
$result = $mySqli->query($sql);

$user = $result->fetch_assoc();

$isAvailable1 = false;

$value = trim($_GET["password"], '"');
if ($user) {
    if (password_verify($value, $user["password"])) {
        $isAvailable1 = true;
        header("Content-type: application/json");
        echo json_encode(["available" => $isAvailable1]);
        exit;
    }
}
header("Content-type: application/json");
echo json_encode(["available" => $isAvailable1]);
