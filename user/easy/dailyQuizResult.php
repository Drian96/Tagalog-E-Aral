<?php
session_start();
include("../../p/db.php");

if (!isset($_SESSION['daily_total_score'])) {
    header("Location: initDailyQuiz.php");
    exit();
}

$totalStarsEarned = $_SESSION['daily_total_score'];
$userId = $_SESSION['id'];
$date = date('Y-m-d');

// Insert quiz history
$query = "INSERT INTO daily_quiz_history (userId, score, starsEarned, difficultyLevel, date) 
          VALUES (?, ?, ?, 'easy', ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iiis", $userId, $totalStarsEarned, $totalStarsEarned, $date);
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
</head>
<body>
    <h1>Daily Quiz Completed!</h1>
    <p>Your score: <strong><?php echo $totalStarsEarned; ?>/5</strong></p>
    <p>Stars earned: <strong><?php echo $totalStarsEarned; ?></strong></p>
    <p>Total stars: <strong><?php echo $_SESSION['totalStars']; ?></strong></p>
    <a href="easyChallenge.php">Okay</a>
</body>
</html>
