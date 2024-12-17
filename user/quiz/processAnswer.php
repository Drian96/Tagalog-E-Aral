<?php
session_start();

// Validate session variables
if (!isset($_SESSION['quiz_questions']) || !isset($_SESSION['current_question_index'])) {
    header("Location: initQuiz.php");
    exit();
}

$questions = $_SESSION['quiz_questions'];
$currentIndex = $_SESSION['current_question_index'];
$currentQuestion = $questions[$currentIndex];

// Initialize correct answers if not set
if (!isset($_SESSION['correct_answers'])) {
    $_SESSION['correct_answers'] = 0;
}

// Validate choice
$userChoice = isset($_GET['choice']) ? intval($_GET['choice']) : null;
if ($userChoice === intval($currentQuestion['correctChoice'])) {
    $_SESSION['total_score'] += intval($currentQuestion['starsValue']); // Add stars if correct
    $_SESSION['correct_answers']++; // Increment correct answers count
}

// Move to the next question
$_SESSION['current_question_index']++;

// Redirect to the quiz page or results page if finished
if ($_SESSION['current_question_index'] >= count($questions)) {
    header("Location: quizResult.php");
} else {
    header("Location: quiz.php");
}
exit();
?>
