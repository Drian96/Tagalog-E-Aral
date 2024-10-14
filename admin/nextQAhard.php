<?php
session_start();
$_SESSION['current_question_hard'] += 1;  // Increment to go to the next question
header("Location: Ahard.php");  // Redirect back to the quiz
exit();
?>
