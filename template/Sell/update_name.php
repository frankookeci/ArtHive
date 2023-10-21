<?php
session_start();
if(isset($_SESSION["user_id"])){
    $mySqli = require __DIR__ . "../../LogInBackEnd/database.php";
$sql = "SELECT * FROM artist_table WHERE artist_id = {$_SESSION["user_id"]}";
$result = $mySqli->query($sql);

$user = $result->fetch_assoc();
}

$name = $_POST['name'];
$bio = $_POST['bio'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arthive_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$artistID = $user['artist_id'];

var_dump($artistID);


// Assuming you have a table named "users" with columns "id" and "artist_name"
// Update the user's name in the database based on the logged-in user's ID
$sql = "UPDATE artist_table SET artist_name = '$name' WHERE artist_id = '$artistID'"; // Replace 'id' with the appropriate column name and the corresponding user ID

if ($conn->query($sql) === TRUE) {
    // Successful update
    echo "success";
  } else {
    // Error updating record
    echo "Error updating record: " . $conn->error;
  }



$sql = "UPDATE artist_table SET artist_bio = '$bio' WHERE artist_id = '$artistID'";

if ($conn->query($sql) === TRUE) {
  // Successful update
  echo "success";
} else {
  // Error updating record
  echo "Error updating record: " . $conn->error;
}
echo "Artist ID: " . $artistID;
// Close the database connection
$conn->close();
?>
