<?php
include '../p/db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $item_name = $conn->real_escape_string($_POST['item_name']);
    $page_value = $conn->real_escape_string($_POST['page_value']); // Handle string input for pageValue
    $stars_value = intval($_POST['starsValue']); // Ensure starsValue is an integer

    // Define upload directories
    $image_dir = '../uploads/learn/images/';
    $audio_dir = '../uploads/learn/audio/';

    // Handle image upload
    $image_file = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_path = $image_dir . basename($image_file);

    if (move_uploaded_file($image_tmp_name, $image_path)) {
        $imagePath = $conn->real_escape_string($image_path);
    } else {
        die("Error uploading image.");
    }

    // Handle audio upload
    $audio_file = $_FILES['audio']['name'];
    $audio_tmp_name = $_FILES['audio']['tmp_name'];
    $audio_path = $audio_dir . basename($audio_file);

    if (move_uploaded_file($audio_tmp_name, $audio_path)) {
        $audioPath = $conn->real_escape_string($audio_path);
    } else {
        die("Error uploading audio.");
    }

    // Insert data into the database
    $sql = "INSERT INTO learn (name, imagePath, audioPath, pageValue, starsValue) 
            VALUES ('$item_name', '$imagePath', '$audioPath', '$page_value', '$stars_value')";

    if ($conn->query($sql) === TRUE) {
        echo 'Success <a href="uploadLearn.php"><button>Go Back</button></a>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
