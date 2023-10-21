<?php

if(empty($_POST["name"]))
{
    echo "lot";
    die("Please enter a name") ;
}

if(empty($_POST["email"]))
{
    echo "Please enter an Email";
}

if(empty($_POST["password"]))   
{
    echo "Please enter a Password";
}


$pass_hash=password_hash($_POST["password"], PASSWORD_DEFAULT);

$mySQL=require __DIR__ . "/database.php";

if(!$mySQL)
{
    die("Failed to connect to the database");
}

$sql="INSERT INTO artist_table(artist_name,artist_email,artist_password) VALUES (?,?,?)";

$stmt = $mySQL->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL Error: " . $stmt->error);
}


$stmt->bind_param("sss", $_POST["name"], $_POST["email"], $pass_hash);

try {
    if ($stmt->execute()) {
        header("location:  ../index.php");
    } else {
        echo "Failed to insert data.";
    }
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) {
        die("Email already exists");
    } else {
        die("SQL Error: " . $e->getMessage());
    }
}


 ?>