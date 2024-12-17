<?php
session_start();
include("../../p/db.php");

// Check if the session variables exist
if (!isset($_SESSION['quiz_questions']) || !isset($_SESSION['current_question_index'])) {
    header("Location: initQuiz.php"); // Redirect to initialize the quiz if session is missing
    exit();
}

$questions = $_SESSION['quiz_questions'];
$currentIndex = $_SESSION['current_question_index'];

// Check if there are more questions
if ($currentIndex >= count($questions)) {
    header("Location: quizResult.php"); // Redirect to results if no more questions
    exit();
}

$currentQuestion = $questions[$currentIndex];
?>

<?php include('header.php')?>

<body>
    <header>
        <div class="mini-title">
            <a href="startA.php">
                <div class="title-content">
                    <img src="../../image/backArrow.png" alt="back-button">
                    <h1>Tagalog E-Aral</h1>
                </div>
            </a>
        </div>

        <div class="star-container">
            <div class="star-item">
                <span class="star-text"><?php echo $_SESSION['total_score']; ?></span>
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
            <button class="choice-btn1" id="choice1" onclick="checkAnswer(1)">
                <h2><?php echo $currentQuestion['choice1']; ?></h2>
            </button>
            <button class="choice-btn2" id="choice2" onclick="checkAnswer(2)">
                <h2><?php echo $currentQuestion['choice2']; ?></h2>
            </button>
            <button class="choice-btn3" id="choice3" onclick="checkAnswer(3)">
                <h2><?php echo $currentQuestion['choice3']; ?></h2>
            </button>
        </div>
    </div>

    <div id="popup"></div>

    <script>
        function checkAnswer(selectedChoice) {
            const correctChoice = "<?php echo $currentQuestion['correctChoice']; ?>";
            const popup = document.getElementById("popup");
            const correctAudio = new Audio('../../uploads/questions/audio/correct.m4a');
            const wrongAudio = new Audio('../../uploads/questions/audio/wrong.m4a');

            if (selectedChoice == correctChoice) {
                correctAudio.play(); // Play correct audio
                popup.innerHTML = '<span class="correct">Tama! +' + <?php echo $currentQuestion['starsValue']; ?> + '⭐</span><br>Tap to proceed...';
                popup.className = 'correct';
                popup.style.display = "block";
                popup.onclick = function () {
                    window.location.href = "processAnswer.php?choice=" + selectedChoice;
                };
            } else {
                wrongAudio.play(); // Play wrong audio
                popup.innerHTML = '<span class="wrong">Mali! ❌</span>';
                popup.className = 'wrong';
                popup.style.display = "block";
                setTimeout(function () {
                    window.location.href = "processAnswer.php?choice=" + selectedChoice;
                }, 1500);
            }
        }

        function playAudio() {
            const audio = document.getElementById('audio');
            audio.play();
        }
    </script>

</body>
</html>
