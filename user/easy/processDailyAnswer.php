<?php
session_start();

if (!isset($_SESSION['daily_quiz_questions']) || !isset($_SESSION['current_daily_question_index'])) {
    header("Location: initDailyQuiz.php");
    exit();
}

$questions = $_SESSION['daily_quiz_questions'];
$currentIndex = $_SESSION['current_daily_question_index'];
$currentQuestion = $questions[$currentIndex];

// Check if the answer is correct
$isCorrect = isset($_GET['correct']) && $_GET['correct'] == 1;
if ($isCorrect) {
    $_SESSION['daily_total_score'] += intval($currentQuestion['starsValue']);
}

// Move to the next question
$_SESSION['current_daily_question_index']++;

if ($_SESSION['current_daily_question_index'] >= count($questions)) {
    header("Location: dailyQuizResult.php");
} else {
    header("Location: dailyQuiz.php");
}
exit();
?>
