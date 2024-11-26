<?php
session_start();
include("../p/db.php");

// Function to fetch random questions based on starsValue
function fetchQuestions($conn, $starsValue, $limit) {
    $stmt = $conn->prepare("SELECT * FROM questions WHERE starsValue = ? ORDER BY RAND() LIMIT ?");
    $stmt->bind_param("ii", $starsValue, $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $questions = [];
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
    $stmt->close();
    return $questions;
}

// Fetch required questions
$questionsStars1 = fetchQuestions($conn, 1, 3);
$questionsStars2 = fetchQuestions($conn, 2, 2);
$questionsStars3 = fetchQuestions($conn, 3, 1);

// Merge all questions
$allQuestions = array_merge($questionsStars1, $questionsStars2, $questionsStars3);

// Shuffle the questions to randomize their order
shuffle($allQuestions);

// Store questions and initialize session variables
$_SESSION['quiz_questions'] = $allQuestions;
$_SESSION['current_question_index'] = 0;
$_SESSION['score'] = 0;

// Redirect to the quiz page
header("Location: startA.php");
exit();
?>
