<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "../../LogInBackEnd/database.php";
    $sql = "SELECT * FROM artist_table WHERE artist_id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}


// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the artwork attributes from the request
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name']; // Assuming the input file field has the name 'image'

    echo "Title: " . $title . "\n";
    echo "Description: " . $description . "\n";

    // Database connection
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'arthive_db';

    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement to insert the artwork attributes into the 'artwork' table
    $stmt = $pdo->prepare('INSERT INTO artwork (artwork_name, artwork_category, artwork_description, artwork_price, artwork_image) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$title, $category, $description, $price, $image]);

    // Retrieve the last inserted artwork_id
    $artwork_id = $pdo->lastInsertId();

    // Prepare the SQL statement to insert the artist and artwork association into the 'artist_artwork' table
    $mergeSql = "INSERT INTO artist_artwork (artistJoin_id, artworkJoin_id) VALUES (?, ?)";
    $stmt1 = $pdo->prepare($mergeSql);
    $stmt1->execute([$user['artist_id'], $artwork_id]);

    // Move the uploaded image file to a desired location
    $targetDir = __DIR__ . '/artworks/'; // Specify the directory where you want to save the uploaded images
    $targetFile = $targetDir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

    // Send a response back to the client
    echo 'Artwork saved successfully';
}
?>