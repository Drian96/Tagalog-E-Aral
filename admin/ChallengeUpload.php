<?php
// admin_upload.php
include '../db.php';  // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_text = $_POST['questionText'];
    $choice1 = $_POST['choice1'];
    $choice2 = $_POST['choice2'];
    $choice3 = $_POST['choice3'];
    $correct_choice = $_POST['correctChoice'];
    $stars_value = $_POST['starsValue'];  // Get the stars value from the form

    // Get file content as BLOB for image and audio
    $image_data = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $audio_data = addslashes(file_get_contents($_FILES['audio']['tmp_name']));

    // Insert into the database with BLOBs for image and audio
    $query = "INSERT INTO questions (questionText, image, audio, choice1, choice2, choice3, correctChoice, starsValue)
              VALUES ('$questionText', '$image_data', '$audio_data', '$choice1', '$choice2', '$choice3', $correctChoice, $starsValue)";
    
    if (mysqli_query($conn, $query)) {
        echo 'Question uploaded successfully!. <a href="Achallenge.php"><button>Go Back</button></a>';

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>