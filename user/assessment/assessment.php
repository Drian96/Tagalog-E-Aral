<?php
session_start();
include("../../p/db.php");

// Initialize score and current question index if not set
if (!isset($_SESSION['score'])) $_SESSION['score'] = 0;
if (!isset($_SESSION['currentIndex'])) $_SESSION['currentIndex'] = 0;

// Retrieve the questions from the database in the required pattern
if (!isset($_SESSION['questions'])) {
    // Fetch 3 random questions with starsValue = 1
    $easyQuestions = mysqli_query($conn, "SELECT * FROM questions WHERE starsValue = 1 ORDER BY RAND() LIMIT 3");

    // Fetch 2 random questions with starsValue = 2
    $averageQuestions = mysqli_query($conn, "SELECT * FROM questions WHERE starsValue = 2 ORDER BY RAND() LIMIT 2");

    // Fetch 1 random question with starsValue = 3
    $hardQuestion = mysqli_query($conn, "SELECT * FROM questions WHERE starsValue = 3 ORDER BY RAND() LIMIT 1");

    // Combine all questions into a single array
    $questions = array_merge(
        mysqli_fetch_all($easyQuestions, MYSQLI_ASSOC),
        mysqli_fetch_all($averageQuestions, MYSQLI_ASSOC),
        mysqli_fetch_all($hardQuestion, MYSQLI_ASSOC)
    );

    shuffle($questions); // Shuffle the questions for randomness
    $_SESSION['questions'] = $questions;
}

// Get the current question
$questions = $_SESSION['questions'];
$currentIndex = $_SESSION['currentIndex'];

if ($currentIndex >= count($questions)) {
    header("Location: submitAssessment.php"); // Redirect to results page
    exit();
}

$currentQuestion = $questions[$currentIndex];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Game</title>

    <style>
        <?php include("../../css/quiz-style.css"); ?>
        .choices {
            position: absolute;
            bottom: 0;
            margin-bottom: 1px;
            width: 100%;
            text-align: center;
        }
        .choices button {
            width: 24%;
            margin: 0 1px;
            padding: 30px;
            border-radius: 10px;
            border: none;
            transition: transform 0.5s, background-color 0.25s;
        }
        .choices button:hover {
            transform: scale(1.02);
            filter: brightness(0.80);
        }
        .choice-btn1 { background-color: var(--blue-color); }
        .choice-btn2 { background-color: var(--red-color); }
        .choice-btn3 { background-color: #10c510; }
        .choice-btn1 h2, .choice-btn2 h2, .choice-btn3 h2{ color: white; }
    </style>

    <script>
        function submitAnswer(selectedChoice) {
            const form = document.getElementById('answerForm');
            const choiceInput = document.getElementById('selectedChoice');
            choiceInput.value = selectedChoice;
            form.submit();
        }
    </script>
</head>
<body>

<header>
    <div class="mini-title">
        <div class="title-content">
            <h1>Tagalog E-Aral</h1>
        </div>
    </div>
    <div class="star-container">
        <div class="star-item">
            <span class="star-text"><?php echo $_SESSION['score']; ?></span>
        </div>
        <div class="star-item">
            <img src="../../image/star.png" alt="Star Icon" class="star-icon">
        </div>
    </div>
</header>

<div class="quiz-container">
    <div class="question">
        <p><?php echo $currentQuestion['questionText']; ?></p>
    </div>
    <div class="image-container">
        <img src="<?php echo $currentQuestion['imagePath']; ?>" alt="Image" id="image-click">
    </div>
    <audio id="audio" src="<?php echo $currentQuestion['audioPath']; ?>"></audio>

    <form id="answerForm" method="POST" action="processAnswer.php">
        <input type="hidden" id="selectedChoice" name="selectedChoice">
        <div class="choices">
            <button class="choice-btn1" onclick="submitAnswer(1)"><h2><?php echo $currentQuestion['choice1']; ?></h2></button>
            <button class="choice-btn2" onclick="submitAnswer(2)"><h2><?php echo $currentQuestion['choice2']; ?></h2></button>
            <button class="choice-btn3" onclick="submitAnswer(3)"><h2><?php echo $currentQuestion['choice3']; ?></h2></button>
        </div>
    </form>
</div>

</body>
</html>
