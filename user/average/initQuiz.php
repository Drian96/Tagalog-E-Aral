<?php
session_start();
include("../../p/db.php");

// Fetch 3 random questions with starsValue = 1
$easyQuery = "SELECT * FROM questions WHERE starsValue = 1 ORDER BY RAND() LIMIT 3";
$easyQuestions = mysqli_query($conn, $easyQuery);

// Fetch 2 random questions with starsValue = 2
$mediumQuery = "SELECT * FROM questions WHERE starsValue = 2 ORDER BY RAND() LIMIT 2";
$mediumQuestions = mysqli_query($conn, $mediumQuery);

// Fetch 1 random question with starsValue = 3
$hardQuery = "SELECT * FROM questions WHERE starsValue = 3 ORDER BY RAND() LIMIT 1";
$hardQuestions = mysqli_query($conn, $hardQuery);

// Merge and shuffle all questions
$questions = [];
while ($row = mysqli_fetch_assoc($easyQuestions)) $questions[] = $row;
while ($row = mysqli_fetch_assoc($mediumQuestions)) $questions[] = $row;
while ($row = mysqli_fetch_assoc($hardQuestions)) $questions[] = $row;

shuffle($questions);

// Store questions and initialize session variables
$_SESSION['quiz_questions'] = $questions;
$_SESSION['current_question_index'] = 0;
$_SESSION['total_score'] = 0;

header("Location: quiz.php"); // Redirect to the quiz page
exit();
?>
