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
    // Add stars to the total score
    $_SESSION['daily_total_score'] += intval($currentQuestion['starsValue']);
    // Increment the correct answers count
    if (!isset($_SESSION['daily_correct_answers'])) {
        $_SESSION['daily_correct_answers'] = 0;
    }
    $_SESSION['daily_correct_answers']++;
}

// Move to the next question
$_SESSION['current_daily_question_index']++;

if ($_SESSION['current_daily_question_index'] >= count($questions)) {
    // Redirect to the correct result page based on quiz difficulty
    if ($currentQuestion['starsValue'] == 1) {
        header("Location: dailyQuizResult.php"); // Easy quiz
    } elseif ($currentQuestion['starsValue'] == 2) {
        header("Location: dailyQuizResultAverage.php"); // Average quiz
    } else {
        header("Location: dailyQuizResultHard.php"); // Hard quiz
    }
} else {
    header("Location: dailyQuiz.php");
}
exit();
