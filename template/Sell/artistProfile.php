<?php
session_start();

if (isset($_SESSION["user_id"])) {
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

if (isset($_FILES['profile-upload'])) {
    $file = $_FILES['profile-upload'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];
    echo 'Era';
    if ($fileError === UPLOAD_ERR_OK) {
        // Define the secure directory to store profile pictures (outside of web root)
        
        $uploadDir = __DIR__ . '/profile-pics/';

        // Generate a unique filename
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $extension;

        // Move the uploaded file to the secure directory
        $destination = $uploadDir . $fileName;
        echo 'Hello';
        print_r ($destination);
        if (move_uploaded_file($fileTmpName, $destination)) {
            $fileName = basename($fileName); // Extract only the file name from the full path
            // Update the artist_table with the new profile picture
            $sql = "UPDATE artist_table SET artist_profilepic = '$fileName' WHERE artist_id = $artistID";
            echo $sql;
           

            if ($conn->query($sql) === TRUE) {

                // Successful update
                $_SESSION['profile_picture'] = $fileName;
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
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Profile</title>

    <style type="text/css">
        @font-face {
            font-family: fontG;
            font-style: normal;
            font-weight: normal;
            src: url('GlacialIndifference-Regular.woff') format('woff');
        }

        @font-face {
            font-family: fontGBold;
            font-style: normal;
            font-weight: normal;
            src: url('GlacialIndifference-Bold.woff') format('woff');
        }


    </style>

    <!--CSS files here-->
    <link rel="stylesheet" href="./artist_profile.css" />
    <link rel="stylesheet" href="../Sell/Sell_css/create.css">
    <link rel="stylesheet" href="../Sell/Sell_css/artworkNew.css">


<body>


    <div class="artistProfile-rectangle"></div>
    <div class="artistProfile-circle"></div>

    <form id="profile-form" enctype="multipart/form-data">
    <div class="profile-pic-container">
        <div class="profile-pic">
            <!-- Display the uploaded profile picture here -->
            <?php if (!empty($user["artist_profilepic"])): ?>
                <img id="profile-img" src="./profile-pics/<?=$user["artist_profilepic"] ?>" alt="Profile Picture">
            <?php else: ?>
                <img id="profile-img" src="uploadLogo-removebg-preview.png" alt="Default Profile Picture">
            <?php endif; ?>
        </div>
        <input type="file" id="profile-upload" accept="image/*">
        <label for="profile-upload" id="upload-label">
            <i class="fas fa-upload">
            
                <span class="icon"></span>
            </i>
        </label>
    </div>
</form>


    <div id="artistContainer">
        <div id="artistName"><?=$user["artist_name"] ?></div>
        <!-- <div id="artistSurname"></div> -->
    </div>
    <p id="bioText"><?=$user["artist_bio"] ?></p>
    <button id="edit-profile-btn">Edit Profile</button>

    <div id="nameContainer" style="display: none;">
        <input type="text" id="nameInput" placeholder="Name">
    </div>

    <div id="bioContainer" style="display: none;">
        <textarea id="bioInput" placeholder="Bio"></textarea>
    </div>

    <button id="save-profile-btn" style="display: none;">Save</button>

    <hr class="circle-line">


    <div class="artist-navBar">

        <div class="artworksBar" onclick="toggleSection(artworksLink, artworksSection)"><a href="#artworksL" id="artworksLink">Artworks</a></div>


        <div class="createBar" onclick="toggleSection(createLink, createSection)"><a href="#createL" id="createLink">Create</a></div>


        <div class="profitBar" onclick="toggleSection(profitLink, profitSection)"><a href="#profitL" id="profitLink">Profit</a></div>


        <div class="logoutBar" onclick="toggleSection(logoutLink, logoutSection)"><a href="#logoutL" id="logoutLink">Log Out</a></div>


    </div>

    <!-- <div id="artworksSection" class="section">

        <div class="new-artist-div">
                <div class="motivation">
                "Start creating. Inspire the world."
                </div>
        </div>

        <button id="get-started-btn">Get Started</button>

    </div> -->

    <div id="artworksSection" class="section">

        <div class="container">
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
        </div>

    </div>


    <div id="createSection" class="section">
        <div class="create-container" style="margin-left: 25em; height: 400px; margin-right: 5em; margin-top: -10em">
            <div class="inputs">
                <input type="text" placeholder="Title" name="sell-title" id="sell-title">
                <select name="sell-category" id="sell-category">
                    <option value="" disabled selected hidden>Category</option>
                    <option value="painting">Painting</option>
                    <option value="photography">Photography</option>
                    <option value="sculpture">Sculpture</option>
                    <option value="pottery">Pottery</option>
                    <option value="quilling">Quilling</option>
                </select>
                <textarea placeholder="Description" name="sell-description" id="sell-description" rows="5"></textarea>
            
                <input type="text" placeholder="Price" name="sell_price" id="sell_price">
                <button id="sell_save-button">Save</button>
            </div>
            <div class="product-upload-photo">
                <img src="../Sell/Sell_image/upload-icon.png" id="profileImage" alt="Profile Picture">
                <input type="file" id="imageUpload" accept="image/*">
            </div>
            <p class="uploadImagePara"></p>
        </div>
    </div>


    <div id="profitSection" class="section">
    <!-- Profit section content -->
    </div>


    <div id="logoutSection" class="section">
    <!-- Logout section -->
    </div>



    <!--JS files here-->
    <script src="./artist_profileJS.js"></script>
    <script src="./saveName.js"></script>
    <script src="./updateName.js"></script>
    <script src="../Sell/Sell_js/upload.js"></script>
    <script src="../Sell/Sell_js/showCreate.js"></script>
</body>

</html>