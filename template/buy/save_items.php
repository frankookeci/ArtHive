<?php
require_once 'conn1.php';

// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');

// Decode the JSON data
$items = json_decode($jsonData, true);

// Check if decoding was successful
if ($items !== null) {
    // Connect to the database
    $conn = connectDB();

    // Get the user ID from the session
    session_start();
    $user_id = $_SESSION['user_id'];

    // Prepare the SQL statements
    $productSql = "INSERT INTO products (category, price, image) VALUES (?, ?, ?)";
    $mergeSql = "INSERT INTO merge (u_id, p_id) VALUES (?, ?)";

    // Prepare statement objects
    $productStmt = mysqli_prepare($conn, $productSql);
    $mergeStmt = mysqli_prepare($conn, $mergeSql);

    // Bind parameters to the product statement
    mysqli_stmt_bind_param($productStmt, 'sds', $category, $price, $image);

    // Iterate over the items
    foreach ($items as $item) {
        $category = $item['name'];
        $price = $item['price'];
        $image = $item['image'];

        // Check if the item is already added for the current user
        $checkSql = "SELECT products.id FROM products
                     INNER JOIN merge ON products.id = merge.p_id
                     WHERE products.category = ? AND products.price = ? AND products.image = ? AND merge.u_id = ?";
        $checkStmt = mysqli_prepare($conn, $checkSql);
        mysqli_stmt_bind_param($checkStmt, 'ssdi', $category, $price, $image, $user_id);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) === 0) {
            // Execute the product statement
            mysqli_stmt_execute($productStmt);
            $product_id = mysqli_insert_id($conn);

            // Execute the merge statement
            mysqli_stmt_bind_param($mergeStmt, 'ii', $user_id, $product_id);
            mysqli_stmt_execute($mergeStmt);

            // Display the saved item details
            echo "User ID: " . $user_id . "<br>";
            echo "Product ID: " . $product_id . "<br>";
            echo "Category: " . $category . "<br>";
            echo "Price: " . $price . "<br>";
            echo "Image: " . $image . "<br>";
            echo "<br>";
        }

        // Close the check statement
        mysqli_stmt_close($checkStmt);
    }

    // Close the statements and the database connection
    mysqli_stmt_close($productStmt);
    mysqli_stmt_close($mergeStmt);
    mysqli_close($conn);

    // Send a success response
    echo "Items saved successfully!";
} else {
    // Print the JSON decoding error
    echo "JSON Error: " . json_last_error_msg();

    // Send an error response
    echo "Error: Failed to decode JSON data.";
}
?>
