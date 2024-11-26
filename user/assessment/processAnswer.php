<?php
session_start();

// Check if session is active
if (!isset($_SESSION['questions']) || !isset($_POST['selectedChoice'])) {
    header("Location: startA.php");
    exit();
}

$questions = $_SESSION['questions'];
$currentQuestion = $_SESSION['currentQuestion'];
$selectedChoice = intval($_POST['selectedChoice']);
$correctChoice = intval($questions[$currentQuestion]['correctChoice']);
$starsValue = intval($questions[$currentQuestion]['starsValue']);

// Update score if answer is correct
if ($selectedChoice === $correctChoice) {
    $_SESSION['score'] += $starsValue;
}

// Move to next question
$_SESSION['currentQuestion']++;

header("Location: assessment.php");
exit();
