<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            margin-top: -16px;
            background-color: #f1f1f1;
            padding-top: 42px;
            padding-bottom: 50px;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            texr-align:left;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f1f1f1;
        }

        .total-amount {
            font-size: 21px;
            margin-top: 30px;
            text-align: center;
            color: #333;
            font-family: fantasy;
        }
    </style>
</head>
<body>
    <h1>Product List</h1>
    <table>
        <tr>
            <th>Image</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Remove Item</th>
        </tr>
        <?php
        $sname = "localhost";
        $uname = "root";
        $pass = "";
        $db_name = "arthive_db";

        // Create the database connection
        $mysqli = mysqli_connect($sname, $uname, $pass, $db_name);

        // Check the connection
        if (!$mysqli) {
            die('Connection failed');
        }

        // Retrieve the user's name
        $user_id = $_SESSION["user_id"];
        $nameSql = "SELECT name FROM user_data WHERE id = $user_id";
        $nameResult = $mysqli->query($nameSql);
        $user_name = $nameResult->fetch_assoc()["name"];

        // Print the user's name
        echo "<p>Welcome : $user_name</p>";

        // Retrieve the products for the logged-in user without duplicates
        $sql = "SELECT DISTINCT p.id, p.category, p.image, p.price FROM products p
                INNER JOIN merge m ON m.p_id = p.id
                INNER JOIN user_data u ON m.u_id = u.id
                WHERE u.id = $user_id";
        $result = $mysqli->query($sql);

        $totalAmount = 0; // Variable to store the total amount

        // Check if any products exist
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productId = $row['id'];
                $category = $row['category'];
                $image = $row['image'];
                $price = $row['price'];

                // Add the price to the total amount
                $totalAmount += $price;

                echo "<tr>";
                echo "<td><img src='./image/$image' alt='Product Image' width='100'></td>";
                echo "<td>$$price</td>";
                echo "<td><input type='number' name='quantity-$productId' value='1' min='1' onchange='updateTotalPrice(this, $price)'></td>";
                echo "<td id='total-price-$productId'>$$price</td>";
                echo "<td><button onclick='removeItem($productId)'>Delete</button></td>";
                echo "</tr>";
                

            }
        } else {
            echo "<tr><td colspan='4'>No products found.</td></tr>";
        }

        // Remove the item from the merge table for the logged-in user
    // $removeSql = "DELETE FROM merge WHERE u_id = $user_id AND p_id = $productId";
    // $mysqli->query($removeSql);

        // Close the database connection
        mysqli_close($mysqli);
        ?>
    </table>

    <p class="total-amount">Total Amount: $<?php echo $totalAmount; ?></p>

    <script>
        function updateTotalPrice(input, price) {
            const quantity = parseInt(input.value);
            const total = quantity * price;
            const productId = input.name.split('-')[1];
            const totalPriceElement = document.getElementById('total-price-' + productId);
            totalPriceElement.textContent = '$' + total;
        }

//         function removeItem(productId) {
//     // Remove the row from the table
//     const row = document.getElementById('row-' + productId);
//     row.remove();
    
//     // Update the total amount
//     const totalPriceElement = document.getElementById('total-amount');
//     const currentTotalAmount = parseFloat(totalPriceElement.textContent.substr(1));
//     const priceElement = document.getElementById('total-price-' + productId);
//     const price = parseFloat(priceElement.textContent.substr(1));
//     const newTotalAmount = currentTotalAmount - price;
//     totalPriceElement.textContent = '$' + newTotalAmount.toFixed(2);
// }



    </script>
</body>
</html>
