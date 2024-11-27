<?php
session_start();
include("../../p/config.php");

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php"); // Redirect to login if not logged in
    exit();
}

// Get the total score/stars from the session (from the quiz)
$totalStarsEarned = $_SESSION['total_score']; // Assuming total_score contains the stars earned in the quiz
$userId = $_SESSION['id'];

// Update the totalStars in the database
$updateStarsQuery = "UPDATE users SET totalStars = totalStars + ? WHERE Id = ?";
$stmt = $con->prepare($updateStarsQuery);
$stmt->bind_param("ii", $totalStarsEarned, $userId);
$stmt->execute();

// Update the session variable for totalStars
$_SESSION['totalStars'] += $totalStarsEarned;

// Determine the next page and message based on the score
if ($totalStarsEarned <= 3) {
    $nextPage = "../../user/easy/easyMain.php";
    $levelMessage = "Welcome to Easy Level";
    $difficultyLevel = 'easy';
} elseif ($totalStarsEarned <= 7) {
    $nextPage = "../../user/average/averageMain.php";
    $levelMessage = "Welcome to Average Level";
    $difficultyLevel = 'average';
} else {
    $nextPage = "../../user/hard/hard.php";
    $levelMessage = "Welcome to Hard Level";
    $difficultyLevel = 'hard';
}

// Insert the quiz result into the quiz_history table
$insertQuery = "INSERT INTO quiz_history (userId, score, starsEarned, difficultyLevel) 
                VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($insertQuery);
$stmt->bind_param("iiis", $userId, $totalStarsEarned, $totalStarsEarned, $difficultyLevel);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="quiz.css">
    <style>
        .quiz-result-container {
            text-align: center;
            margin: 50px auto;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            width: 80%;
            max-width: 400px;
            background-color: white;
        }
        .continue-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1.2rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }
        .continue-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="quiz-result-container">
        <h1>Assessment Completed!</h1>
        <p>Your score is <strong><?php echo $totalStarsEarned; ?>/10</strong>.</p>
        <p><strong><?php echo $levelMessage; ?></strong></p>
        <p>You earned <strong><?php echo $totalStarsEarned; ?></strong> stars!</p>
        <p>Your total stars: <strong><?php echo $_SESSION['totalStars']; ?></strong></p>
        <a href="<?php echo $nextPage; ?>" class="continue-btn">Continue</a>
    </div>
</body>
</html>
