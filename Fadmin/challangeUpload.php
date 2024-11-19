<?php
// adminUpload.php
include '../db.php';  // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $questionText = $_POST['questionText'];
    $choice1 = $_POST['choice1'];
    $choice2 = $_POST['choice2'];
    $choice3 = $_POST['choice3'];
    $correctChoice = $_POST['correctChoice'];
    $starsValue = $_POST['starsValue'];  // Get the stars value from the form

    // Directory for uploading files
    $imageDir = '../uploads/questions/images/';
    $audioDir = '../uploads/questions/audio/';

    // Handle image upload
    $imageName = basename($_FILES['image']['name']);
    $imagePath = $imageDir . $imageName;
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        die('Error uploading image file.');
    }

    // Handle audio upload
    $audioName = basename($_FILES['audio']['name']);
    $audioPath = $audioDir . $audioName;
    if (!move_uploaded_file($_FILES['audio']['tmp_name'], $audioPath)) {
        die('Error uploading audio file.');
    }

    // Insert into the database with file paths
    $query = "INSERT INTO questions (questionText, imagePath, audioPath, choice1, choice2, choice3, correctChoice, starsValue)
              VALUES ('$questionText', '$imagePath', '$audioPath', '$choice1', '$choice2', '$choice3', $correctChoice, $starsValue)";
    
    if (mysqli_query($conn, $query)) {
        echo 'Question uploaded successfully! <a href="uploadChallenge.php"><button>Go Back</button></a>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
