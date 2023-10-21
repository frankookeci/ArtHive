<?php
session_start();
if(isset($_SESSION["user_id"])){
    $mySqli = require __DIR__ . "../../LogInBackEnd/database.php";
$sql = "SELECT * FROM artist_table WHERE artist_id = {$_SESSION["user_id"]}";
$result = $mySqli->query($sql);

$user = $result->fetch_assoc();
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arthive_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$artistID = $user['artist_id'];

if (isset($_FILES['profilePic'])) {
    $file = $_FILES['profilePic'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];

    if ($fileError === UPLOAD_ERR_OK) {
        // Define the secure directory to store profile pictures (outside of web root)
        $uploadDir = '/profile-pics/';

        // Generate a unique filename
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $extension;

        // Move the uploaded file to the secure directory
        $destination = $uploadDir . $fileName;

        if (move_uploaded_file($fileTmpName, $destination)) {
            // Update the artist_table with the new profile picture
            $sql = "UPDATE artist_table SET artist_profilepic = '$destination' WHERE artist_id = '$artistID'";

            if ($conn->query($sql) === TRUE) {
                // Successful update
                echo "success";
            } else {
                // Error updating record
                echo "Error updating record: " . $conn->error;
            }
        } else {
            // Error moving the uploaded file
            echo "Error moving the uploaded file.";
        }
    } else {
        // Error uploading file
        echo "Error uploading file";
    }
}

// Close the database connection
$conn->close();
