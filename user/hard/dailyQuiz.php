<?php
session_start();
include("../../p/db.php");

// Check if the session variables exist
if (!isset($_SESSION['daily_quiz_questions']) || !isset($_SESSION['current_daily_question_index'])) {
    header("Location: initDailyQuiz.php"); // Redirect to initialize the Daily Quiz if session is missing
    exit();
}

$questions = $_SESSION['daily_quiz_questions'];
$currentIndex = $_SESSION['current_daily_question_index'];

// Check if there are more questions
if ($currentIndex >= count($questions)) {
    header("Location: dailyQuizResult.php"); // Redirect to results if no more questions
    exit();
}

$currentQuestion = $questions[$currentIndex];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Quiz</title>
    <style>
        <?php include("quiz.css"); ?>
        .choices {
            position: absolute;
            bottom: 0;
            margin-bottom: 1px;
            width: 100%;
            text-align: center;
        }
        .choices button {
            width: 32%;
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
        .choice-btn1 h2, .choice-btn2 h2, .choice-btn3 h2 { color: white; }

        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: #fff;
            border: 2px solid #000;
            text-align: center;
            z-index: 1000;
            font-size: 1.2rem;
            font-weight: bold;
        }
        #popup.correct { color: green; }
        #popup.wrong { color: red; }
    </style>
    <script>
        function checkAnswer(selectedChoice) {
            const correctChoice = "<?php echo $currentQuestion['correctChoice']; ?>";
            const popup = document.getElementById("popup");
            const correctAudio = new Audio('../../uploads/questions/audio/correct.m4a');
            const wrongAudio = new Audio('../../uploads/questions/audio/wrong.m4a');

            if (selectedChoice == correctChoice) {
                correctAudio.play(); // Play correct audio
                popup.innerHTML = '<span class="correct">Correct! +' + <?php echo $currentQuestion['starsValue']; ?> + '⭐</span><br>Tap to proceed...';
                popup.className = 'correct';
                popup.style.display = "block";
                popup.onclick = function () {
                    window.location.href = "processDailyAnswer.php?correct=1";
                };
            } else {
                wrongAudio.play(); // Play wrong audio
                popup.innerHTML = '<span class="wrong">Wrong! ❌</span>';
                popup.className = 'wrong';
                popup.style.display = "block";
                setTimeout(function () {
                    window.location.href = "processDailyAnswer.php?correct=0";
                }, 1500);
            }
        }

        function playAudio() {
            const audio = document.getElementById('audio');
            audio.play();
        }
    </script>
</head>

<body>
    <header>
        <div class="mini-title">
            <a href="easyChallenge.php">
                <div class="title-content">
                    <img src="../../image/backArrow.png" alt="back-button">
                    <h1>Tagalog E-Aral</h1>
                </div>
            </a>
        </div>
        <div class="star-container">
            <div class="star-item">
                <span class="star-text"><?php echo $_SESSION['daily_total_score']; ?></span>
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
            <img src="<?php echo '../' . $currentQuestion['imagePath']; ?>" alt="Question Image" onclick="playAudio()" id="image-click">
        </div>
        <audio id="audio" src="<?php echo '../' . $currentQuestion['audioPath']; ?>"></audio>

        <div class="choices">
            <button class="choice-btn1" onclick="checkAnswer(1)">
                <h2><?php echo $currentQuestion['choice1']; ?></h2>
            </button>
            <button class="choice-btn2" onclick="checkAnswer(2)">
                <h2><?php echo $currentQuestion['choice2']; ?></h2>
            </button>
            <button class="choice-btn3" onclick="checkAnswer(3)">
                <h2><?php echo $currentQuestion['choice3']; ?></h2>
            </button>
        </div>
    </div>
    <div id="popup"></div>
</body>
</html>
