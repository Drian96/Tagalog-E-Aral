<?php
include '../../p/db.php';  // Include the database connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$page_value = 2;
$stars_value = 1; // Add starsValue condition stars value means difficulty value of that obj
$sql = "SELECT * FROM learn WHERE pageValue = $page_value AND starsValue = $stars_value";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagalog E-Aral Admin</title>
    <link rel="stylesheet" href="../../css/style.css">
    <style>
        body {
            background-image: url("../../image/explore-bg.jpg");
            background-position: center;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            position: relative;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            max-width: 80%;
            margin: 0 auto;
        }
        .overlay {
            position: fixed;
            display: none;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(10px);
        }
        .overlay img {
            max-width: 90%;
            max-height: 90%;
        }
        .overlay.active {
            display: flex;
        }
    </style>
</head>

<body>
    <header>
        <div class="mini-title">
            <a href="easyModule.php">
                <div class="title-content">
                    <img src="../../image/backArrow.png" alt="back-button">
                    <h1>Tagalog E-Aral</h1>
                </div>
            </a>
        </div>
    </header>
    
    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Adjust the path by prepending an additional ../
                $imagePath = '../../' . ltrim($row['imagePath'], './'); // Remove leading ./ or ../ before prepending
                $audioPath = '../../' . ltrim($row['audioPath'], './'); // Adjust audio path
                $item_name = htmlspecialchars($row['name']); // Escape special characters for safety

                echo '<div class="clickable-image">';
                echo '<div class="image-wrapper"><img src="'.$imagePath.'" alt="Media Image" onclick="handleImageClick(this, \''.$audioPath.'\')"></div>';
                echo '<div class="image-name"><p>'.$item_name.'</p></div>'; 
                echo '</div>';
            }
        } else {
            echo "No records found.";
        }
        ?>
    </div>

    <div id="overlay" class="overlay" onclick="closePopup()">
        <img src="" alt="Zoomed Image" id="zoomedImage">
    </div>
    
    <audio id="audioPlayer">
        <source src="" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    
    <script src="../../js/Alearn.js"></script>
</body>
</html>
