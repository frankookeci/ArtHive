<?php
function connectDB()
{
    // dataBase concection
    $sname = "localhost";
    $uname = "root";
    $pass = "";
    $db_name = "arthive_db";

    // 1 create the database connection the db name is ->arthive_db
    $conn = mysqli_connect($sname, $uname, $pass, $db_name);

    // Check the connection
    if (!$conn) {
        die('Connection failed');
    }
    else{
        echo"bravoo";
    }

    return $conn;
}
connectDB();
?>