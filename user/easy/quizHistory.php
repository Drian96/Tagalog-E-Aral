<?php
session_start();
include("../../p/config.php");

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['id'];

// Fetch the user's quiz history
$query = "SELECT score, starsEarned, difficultyLevel, createdAt 
          FROM quiz_history WHERE userId = ? ORDER BY createdAt DESC";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz History</title>
    <link rel="stylesheet" href="../styles/quiz.css">
</head>
<body>
    <h1>Assessment History</h1>
    <table border="1">
        <tr>
            <th>Score</th>
            <th>Stars Earned</th>
            <th>Knowledge Level</th>
            <th>Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['score']; ?></td>
                <td><?php echo $row['starsEarned']; ?></td>
                <td><?php echo ucfirst($row['difficultyLevel']); ?></td>
                <td><?php echo date("F j, Y, g:i a", strtotime($row['createdAt'])); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
