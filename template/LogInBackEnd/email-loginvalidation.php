<?php

$mySqli = require __DIR__ . "/database.php";

$sql = sprintf("SELECT * FROM user_data WHERE email = '%s'", $mySqli->real_escape_string($_GET["email"]));
$result = $mySqli->query($sql);

// print_r($result);

$isAvailable = $result->num_rows === 0;

header ("Content-type: application/json");
echo json_encode(["available" => $isAvailable]);