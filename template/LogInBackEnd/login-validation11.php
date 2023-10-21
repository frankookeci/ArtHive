<?php
$mySqli = require __DIR__ . "/database.php";
$sql = sprintf("SELECT * FROM artist_table WHERE artist_email = '%s'", $mySqli->real_escape_string($_GET["email"]));
$result = $mySqli->query($sql);

$user = $result->fetch_assoc();

$isAvailable1 = false;

$value = trim($_GET["password"], '"');
if ($user) {
    if (password_verify($value, $user["artist_password"])) {
        $isAvailable1 = true;
        header("Content-type: application/json");
        echo json_encode(["available" => $isAvailable1]);
        exit;
    }
}
else{
    header("Content-type: application/json");
echo json_encode(["available" => $isAvailable1]);
}