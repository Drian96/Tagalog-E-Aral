<?php
session_start();
include("../../p/db.php");

if (!isset($_SESSION['daily_total_score']) || !isset($_SESSION['daily_correct_answers'])) {
    header("Location: initHardQuiz.php");
    exit();
}

$totalCorrectAnswers = $_SESSION['daily_correct_answers']; // Number of correct answers out of 5
$totalStarsEarned = $_SESSION['daily_total_score']; // Total stars earned (3 stars per correct answer)
$userId = $_SESSION['id'];
$date = date('Y-m-d');

// Insert quiz history
$query = "INSERT INTO daily_quiz_history (userId, score, starsEarned, difficultyLevel, date) 
          VALUES (?, ?, ?, 'hard', ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iiis", $userId, $totalCorrectAnswers, $totalStarsEarned, $date);
$stmt->execute();

// Update total stars
$updateQuery = "UPDATE users SET totalStars = totalStars + ? WHERE Id = ?";
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param("ii", $totalStarsEarned, $userId);
$stmt->execute();

// Update session totalStars
$_SESSION['totalStars'] += $totalStarsEarned;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daily Quiz Result</title>
    <link rel="stylesheet" href="quiz.css">
</head>
<body>
    <div class="dqResult">
        <h1>Hard Daily Quiz Completed!</h1>
        <p>Your score: <strong><?php echo $totalCorrectAnswers; ?>/5</strong></p> <!-- Correct answers -->
        <p>Stars earned: <strong><?php echo $totalStarsEarned; ?></strong></p> <!-- Stars earned -->
        <p>Total stars: <strong><?php echo $_SESSION['totalStars']; ?></strong></p>
        <a href="easyChallenge.php"><button>Okay</button></a>
    </div>
</body>
</html>
