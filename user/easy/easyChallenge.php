<?php
include('head.php');
include('../../p/db.php'); // Include your database connection

session_start();
$userId = $_SESSION['id'];
$date = date('Y-m-d');

// Check if the user has taken the Daily Quiz today
$quizTaken = false;
$query = "SELECT * FROM daily_quiz_history WHERE userId = ? AND difficultyLevel = 'easy' AND date = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $userId, $date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $quizTaken = true; // Quiz already taken
}
?>

<body>
    <header>
        <div class="mini-title">
            <a href="easyMain.php">
                <div class="title-content">
                    <img src="../../image/backArrow.png" alt="back-button">
                    <h1>Tagalog E-Aral</h1>
                </div>
            </a>
        </div>
    </header>

    <div class="main-container">
        <div class="easy-container">
            <div class="explore">
                <?php if ($quizTaken): ?>
                    <!-- Button with pop-up if quiz already taken -->
                    <img src="../../image/easy.jpg" alt="Explore Image" class="explore-image">
                    <button class="explore-button" id="dailyQuizButton">Easy Daily Quiz</button>
                <?php else: ?>
                    <!-- Redirect button if quiz not taken -->
                    <a href="initDailyQuiz.php">
                        <img src="../../image/easy.jpg" alt="Explore Image" class="explore-image">
                        <button class="explore-button">Easy Daily Quiz</button>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="explore-container">
            <div class="explore">
                <img src="../../image/average-locked.png" alt="Explore Image" class="colors-image">
                <button class="colors-button">Average Daily Quiz</button>
            </div>
        </div>

        <div class="explore-container">
            <div class="explore">
                <img src="../../image/hard-locked.png" alt="Explore Image" class="animals-image">
                <button class="animals-button">Hard Daily Quiz</button>
            </div>
        </div>
    </div>

    <!-- Pop-up elements -->
    <div class="popup-overlay" id="popupOverlay"></div>
    <div class="popup" id="popupMessage">
        <p>You have already taken the Easy Daily Quiz today. Please try again tomorrow!</p>
        <button id="closePopup">Okay</button>
    </div>

    <script>
        const popupOverlay = document.getElementById('popupOverlay');
        const popupMessage = document.getElementById('popupMessage');
        const dailyQuizButton = document.getElementById('dailyQuizButton');
        const closePopup = document.getElementById('closePopup');

        // Show the pop-up if the quiz button is clicked (only for taken quizzes)
        if (dailyQuizButton) {
            dailyQuizButton.addEventListener('click', () => {
                popupOverlay.style.display = 'block';
                popupMessage.style.display = 'block';
            });
        }

        // Close the pop-up when the user clicks "Okay"
        closePopup.addEventListener('click', () => {
            popupOverlay.style.display = 'none';
            popupMessage.style.display = 'none';
        });

        // Close the pop-up when the overlay is clicked
        popupOverlay.addEventListener('click', () => {
            popupOverlay.style.display = 'none';
            popupMessage.style.display = 'none';
        });
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
