<?php
session_start();
$_SESSION['current_question_easy'] += 1;  // Increment to go to the next question
header("Location: easy.php");  // Redirect back to the quiz
exit();
?>
