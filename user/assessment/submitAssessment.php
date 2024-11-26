<?php
session_start();

// Check if session is active
if (!isset($_SESSION['questions']) || !isset($_SESSION['score'])) {
    header("Location: startA.php");
    exit();
}

$score = $_SESSION['score'];

// Clear session
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Results</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="result-container">
        <h1>Your Score: <?php echo $score; ?>/10</h1>
        <form action="redirect.php" method="POST">
            <button type="submit">Continue</button>
            <input type="hidden" name="score" value="<?php echo $score; ?>">
        </form>
    </div>
</body>
</html>
