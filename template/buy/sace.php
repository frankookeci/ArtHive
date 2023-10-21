<?php
$data = file_get_contents('php://input');
file_put_contents('debug.txt', $data);

require_once 'conn1.php';

// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');

// Decode the JSON data
$items = json_decode($jsonData, true);

// Check if decoding was successful
if ($items !== null) {
    // Connect to the database
    $conn = connectDB();

    // Prepare the SQL statement
    $sql = "INSERT INTO buyy (name, image, price) VALUES (?, ?, ?)";

    // Prepare a statement object
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters to the statement
    mysqli_stmt_bind_param($stmt, 'ssd', $name, $image, $price);

    // Iterate over the items
    foreach ($items as $item) {
        $name = $item['name'];
        $image = $item['image'];
        $price = $item['price'];

        // Check if the item already exists in the database
        $checkSql = "SELECT id FROM buyy WHERE name = ?";
        $checkStmt = mysqli_prepare($conn, $checkSql);
        mysqli_stmt_bind_param($checkStmt, 's', $name);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        // If the item does not exist, execute the insert statement
        if (mysqli_stmt_num_rows($checkStmt) === 0) {
            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Display the saved item details
            echo "Item ID: " . mysqli_insert_id($conn) . "<br>";
            echo "Name: " . $name . "<br>";
            echo "Image: " . $image . "<br>";
            echo "Price: " . $price . "<br>";
            echo "<br>";
        }

        // Close the check statement
        mysqli_stmt_close($checkStmt);
    }

    // Close the insert statement and the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Send a success response
    echo "Items saved successfully!";
} else {
    // Send an error response
    echo "Error: Failed to decode JSON data.";
}

?>
