<?php
include('head.php');
include('../../p/db.php'); // Include your database connection

session_start();
$userId = $_SESSION['id'];
$date = date('Y-m-d');

// Check if the Easy Daily Quiz has been taken
$easyQuizTaken = false;
$queryEasy = "SELECT * FROM daily_quiz_history WHERE userId = ? AND difficultyLevel = 'easy' AND date = ?";
$stmtEasy = $conn->prepare($queryEasy);
$stmtEasy->bind_param("is", $userId, $date);
$stmtEasy->execute();
$resultEasy = $stmtEasy->get_result();
if ($resultEasy->num_rows > 0) {
    $easyQuizTaken = true;
}

// Check if the Average Daily Quiz has been taken
$averageQuizTaken = false;
$queryAverage = "SELECT * FROM daily_quiz_history WHERE userId = ? AND difficultyLevel = 'average' AND date = ?";
$stmtAverage = $conn->prepare($queryAverage);
$stmtAverage->bind_param("is", $userId, $date);
$stmtAverage->execute();
$resultAverage = $stmtAverage->get_result();
if ($resultAverage->num_rows > 0) {
    $averageQuizTaken = true;
}

// Check if the Hard Daily Quiz has been taken
$hardQuizTaken = false;
$queryHard = "SELECT * FROM daily_quiz_history WHERE userId = ? AND difficultyLevel = 'hard' AND date = ?";
$stmtHard = $conn->prepare($queryHard);
$stmtHard->bind_param("is", $userId, $date);
$stmtHard->execute();
$resultHard = $stmtHard->get_result();
if ($resultHard->num_rows > 0) {
    $hardQuizTaken = true;
}
?>

<body>
    <header>
        <div class="mini-title">
            <a href="hardMain.php">
                <div class="title-content">
                    <img src="../../image/backArrow.png" alt="back-button">
                    <h1>Tagalog E-Aral</h1>
                </div>
            </a>
        </div>
    </header>

    <div class="main-container">
        <div class="explore-container">
            <div class="explore">
                <?php if ($easyQuizTaken): ?>
                    <!-- Easy Daily Quiz button with pop-up -->
                    <img src="../../image/easy.jpg" alt="Explore Image" class="explore-image">
                    <button class="explore-button" id="easyQuizButton">Easy Daily Quiz</button>
                <?php else: ?>
                    <!-- Redirect button if Easy quiz not taken -->
                    <a href="initDailyQuiz.php">
                        <img src="../../image/easy.jpg" alt="Explore Image" class="explore-image">
                        <button class="explore-button">Easy Daily Quiz</button>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="explore-container">
            <div class="explore">
                <?php if ($averageQuizTaken): ?>
                    <!-- Average Daily Quiz button with pop-up -->
                    <img src="../../image/average.png" alt="Explore Image" class="colors-image">
                    <button class="colors-button" id="averageQuizButton">Average Daily Quiz</button>
                <?php else: ?>
                    <!-- Redirect button if Average quiz not taken -->
                    <a href="initAverageQuiz.php">
                        <img src="../../image/average.png" alt="Explore Image" class="colors-image">
                        <button class="colors-button">Average Daily Quiz</button>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="explore-container">
            <div class="explore">
                <?php if ($hardQuizTaken): ?>
                    <!-- Hard Daily Quiz button with pop-up -->
                    <img src="../../image/hard.jpg" alt="Explore Image" class="animals-image">
                    <button class="animals-button" id="hardQuizButton">Hard Daily Quiz</button>
                <?php else: ?>
                    <!-- Redirect button if Hard quiz not taken -->
                    <a href="initHardQuiz.php">
                        <img src="../../image/hard.jpg" alt="Explore Image" class="animals-image">
                        <button class="animals-button">Hard Daily Quiz</button>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Pop-up elements -->
    <div class="popup-overlay" id="popupOverlay"></div>
    <div class="popup" id="popupMessage">
        <p id="popupText"></p>
        <p id="countdownText"></p> <!-- Countdown will be displayed here -->
        <button id="closePopup">Okay</button>
    </div>

    <script>
        const popupOverlay = document.getElementById('popupOverlay');
        const popupMessage = document.getElementById('popupMessage');
        const popupText = document.getElementById('popupText');
        const countdownText = document.getElementById('countdownText');
        const closePopup = document.getElementById('closePopup');

        // Button IDs for already-taken quizzes
        const easyQuizButton = document.getElementById('easyQuizButton');
        const averageQuizButton = document.getElementById('averageQuizButton');
        const hardQuizButton = document.getElementById('hardQuizButton');

        // Show popup with custom message
        const showPopup = (message) => {
            popupText.textContent = message;
            popupOverlay.style.display = 'block';
            popupMessage.style.display = 'block';
            startCountdown(); // Start the countdown timer
        };

        // Pop-up logic for Easy Daily Quiz already taken
        if (easyQuizButton) {
            easyQuizButton.addEventListener('click', () => {
                showPopup('You have already taken the Easy Daily Quiz today. Please try again tomorrow!');
            });
        }

        // Pop-up logic for Average Daily Quiz already taken
        if (averageQuizButton) {
            averageQuizButton.addEventListener('click', () => {
                showPopup('You have already taken the Average Daily Quiz today. Please try again tomorrow!');
            });
        }

        // Pop-up logic for Hard Daily Quiz already taken
        if (hardQuizButton) {
            hardQuizButton.addEventListener('click', () => {
                showPopup('You have already taken the Hard Daily Quiz today. Please try again tomorrow!');
            });
        }

        // Close the pop-up
        closePopup.addEventListener('click', () => {
            popupOverlay.style.display = 'none';
            popupMessage.style.display = 'none';
        });

        // Close the pop-up when the overlay is clicked
        popupOverlay.addEventListener('click', () => {
            popupOverlay.style.display = 'none';
            popupMessage.style.display = 'none';
        });

        // Countdown Timer Logic
        const startCountdown = () => {
            const now = new Date();
            const midnight = new Date();
            midnight.setHours(24, 0, 0, 0); // Set time to midnight
            const diff = midnight - now;

            const updateCountdown = () => {
                const remainingTime = midnight - new Date();
                if (remainingTime <= 0) {
                    countdownText.textContent = "The quiz is now available!";
                    clearInterval(timer);
                } else {
                    const hours = Math.floor(remainingTime / (1000 * 60 * 60));
                    const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
                    countdownText.textContent = `Next quiz available in: ${hours}h ${minutes}m ${seconds}s`;
                }
            };

            updateCountdown();
            const timer = setInterval(updateCountdown, 1000); // Update every second
        };
    </script>

    <style>
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 10;
        }

        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 11;
            text-align: center;
        }

        .popup button {
            margin-top: 10px;
            padding: 5px 10px;
            border: none;
            background-color: #007BFF;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .popup button:hover {
            background-color: #0056b3;
        }
    </style>
</body>
