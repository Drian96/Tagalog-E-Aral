<?php
session_start();
include("../../p/db.php");

// Fetch 5 random questions with starsValue = 1 (easy)
$query = "SELECT * FROM questions WHERE starsValue = 1 ORDER BY RAND() LIMIT 5";
$result = mysqli_query($conn, $query);

$questions = [];
while ($row = mysqli_fetch_assoc($result)) {
    $questions[] = $row;
}

// Store questions and initialize session variables
$_SESSION['daily_quiz_questions'] = $questions;
$_SESSION['current_daily_question_index'] = 0;
$_SESSION['daily_total_score'] = 0;

header("Location: dailyQuiz.php"); // Redirect to the quiz page
exit();
?>
