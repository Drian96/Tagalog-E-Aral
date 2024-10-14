<?php
session_start();
include("../p/db.php");

// Check if the session variable for the hard quiz is set
if (!isset($_SESSION['current_question_hard'])) {
    $_SESSION['current_question_hard'] = 0; // Set default value for hard quiz if not set
}

// Fetch questions for the hard quiz (stars_value = 3)
$questionQuery = "SELECT * FROM questions WHERE stars_value = 3 ORDER BY id ASC LIMIT 1 OFFSET {$_SESSION['current_question_hard']}";
$questionResult = mysqli_query($conn, $questionQuery);

if (!$questionResult) {
    die("Query failed: " . mysqli_error($conn));
}

$question = mysqli_fetch_assoc($questionResult);

if (!$question) {
    // Handle the case when no more questions are available
    echo 'No more questions available in the Hard quiz. <a href="challenge.php"><button>Go Back</button></a>';
    exit();
}


// Now retrieve question data safely
$question_text = isset($question['question_text']) ? $question['question_text'] : 'No question text available';
$image_data = isset($question['image']) ? base64_encode($question['image']) : ''; // Handle if image is null
$audio_data = isset($question['audio']) ? base64_encode($question['audio']) : ''; // Handle if audio is null
$choice1 = isset($question['choice1']) ? $question['choice1'] : 'Choice 1';
$choice2 = isset($question['choice2']) ? $question['choice2'] : 'Choice 2';
$choice3 = isset($question['choice3']) ? $question['choice3'] : 'Choice 3';
$choice4 = isset($question['choice4']) ? $question['choice4'] : 'Choice 4';
$correct_choice = isset($question['correct_choice']) ? $question['correct_choice'] : 1;
$question_id = isset($question['id']) ? $question['id'] : null; // Handle if id is not set

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Game</title>

    <style>
        <?php include("../css/quiz-style.css"); ?>
        
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
        .choice-btn1 {
            background-color: var(--blue-color);
        }
        .choice-btn2 {
            background-color: var(--red-color);
        }
        .choice-btn3 {
            background-color: #10c510;
        }
        .choice-btn4 {
            background-color: #d1bc00;
        }
        .choice-btn1 h2, .choice-btn2 h2, .choice-btn3 h2, .choice-btn4 h2 {
            color: white;
        }

    </style>

    <script>
        // Function to check the answer
        function checkAnswer(selectedChoice) {
            const correctChoice = "<?php echo $correct_choice; ?>";
            const popup = document.getElementById("popup");

            if (selectedChoice == correctChoice) {
                popup.innerHTML = '<span class="correct">Correct! +3⭐</span><br>Tap to proceed...';
                popup.style.display = "block";
                popup.onclick = function() {
                    window.location.href = "nextQhard.php";
                };
            } else {
                popup.innerHTML = '<span class="wrong">Wrong! ❌</span>';
                popup.style.display = "block";
                setTimeout(function() {
                    popup.style.display = "none";
                }, 1500);
            }
        }

        // Function to play the audio when the image is clicked
        function playAudio() {
            const audio = document.getElementById('audio');
            audio.play();
        }
    </script>

</head>
<body>

    <header>
        <div class="mini-title">
            <a href="challenge.php">
                <div class="title-content">
                    <img src="../image/backArrow.png" alt="back-button">
                    <h1>Tagalog E-Aral</h1>
                </div>
            </a>
        </div>

        <div class="star-container">
            <div class="star-item">
                <span class="star-text">0</span>
            </div>
            <div class="star-item">
                <img src="../image/star.png" alt="Star Icon" class="star-icon">
            </div>
        </div>
    </header>

    <div class="quiz-container">
        <div class="question">
            <p><?php echo $question_text; ?></p>
        </div>
        <div class="image-container">
            <!-- Display image by converting BLOB to base64 and using a data URI -->
            <img src="data:image/jpeg;base64,<?php echo $image_data; ?>" alt="Image" id="image-click" onclick="playAudio()">
        </div>
        
        <!-- Audio element with base64 data URI for the audio file -->
        <audio id="audio" src="data:audio/mp3;base64,<?php echo $audio_data; ?>"></audio>

        <div class="choices">
            <button class="choice-btn1" id="choice1" data-choice="1" onclick="checkAnswer(1)"><h2><?php echo $choice1; ?></h2></button>
            <button class="choice-btn2" id="choice2" data-choice="2" onclick="checkAnswer(2)"><h2><?php echo $choice2; ?></h2></button>
            <button class="choice-btn3" id="choice3" data-choice="3" onclick="checkAnswer(3)"><h2><?php echo $choice3; ?></h2></button>
            <button class="choice-btn4" id="choice4" data-choice="4" onclick="checkAnswer(4)"><h2><?php echo $choice4; ?></h2></button>
        </div>
    </div>

    <!-- Popup for correct/wrong answer -->
    <div id="popup"></div>

</body>
</html>
