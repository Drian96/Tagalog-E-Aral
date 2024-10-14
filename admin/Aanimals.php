<?php
// admin_upload.php
include '../p/db.php';  // Include the database connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM learn";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

    <style>
        <?php include('../css/style.css'); ?>

        body {
            background-image: url("../image/animals-bg.jpg");
            background-position: center;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            position: relative;
            align-items: center;
            text-align: center;
            justify-content: center;
            display: flex;
            max-width: 80%;
            height: 80%;
            flex-wrap: wrap;
        }

        .overlay {
            position: fixed;
            display: none;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent dark background */
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(10px); /* Background blur effect */
        }
        .overlay img {
            max-width: 90%;
            max-height: 90%;
        }
        .overlay.active {
            display: flex;
        }

    </style>

<body>

    <header>
        <div class="mini-title">
            <a href="Alearn.php">
                <div class="title-content">
                    <img src="../image/backArrow.png" alt="back-button">
                    <h1>Tagalog E-Aral</h1>
                </div>
            </a>
        </div>
    </header>
    
    <div class="container">

    <?php
    $page_value = 3;

    $sql = "SELECT * FROM learn WHERE page_value = $page_value";
    $result = $conn->query($sql);
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
    
    <header>
        <div class="mini-title">
            <a href="Alearn.php">
                <div class="title-content">
                    <img src="../image/backArrow.png" alt="back-button">
                    <h1>Tagalog E-Aral</h1>
                </div>
            </a>
        </div>
    </header>
    
    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $image = 'data:image/jpeg;base64,' . base64_encode($row['image']);
                $audio = 'data:audio/mpeg;base64,' . base64_encode($row['audio']);
                $item_name = htmlspecialchars($row['name']);  // Escape special characters for safety

                echo '<div class="clickable-image">';
                echo '<div class="image-wrapper"><img src="'.$image.'" alt="Media Image" onclick="handleImageClick(this, \''.$audio.'\')"></div>';
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
    
    <script src="../Alearn.js"></script>
    
    </body>
    </html>