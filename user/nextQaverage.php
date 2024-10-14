<?php
session_start();
$_SESSION['current_question_average'] += 1;  // Increment to go to the next question
header("Location: average.php");  // Redirect back to the quiz
exit();
?>
