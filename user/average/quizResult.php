<?php
session_start();

// Check if the session variables exist
if (!isset($_SESSION['total_score'])) {
    header("Location: initQuiz.php"); // Redirect to start the quiz if session is missing
    exit();
}

$totalScore = $_SESSION['total_score'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="../css/quiz-style.css">
</head>
<body>
    <header>
        <h1>Quiz Results</h1>
    </header>

    <main>
        <div class="result-container">
            <h2>Your Score: <?php echo $totalScore; ?> / 10</h2>
            <?php if ($totalScore >= 8): ?>
                <p>🎉 Excellent! You've done a great job!</p>
            <?php elseif ($totalScore >= 5): ?>
                <p>😊 Good effort! Try again for a higher score!</p>
            <?php else: ?>
                <p>😢 Better luck next time! Keep practicing!</p>
            <?php endif; ?>

            <a href="initQuiz.php"><button>Retry Quiz</button></a>
            <a href="challenge.php"><button>Back to Home</button></a>
        </div>
    </main>
</body>
</html>
