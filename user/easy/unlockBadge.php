<?php
session_start();
include("../../p/config.php");

if (!isset($_SESSION['id']) || !isset($_POST['badgeId']) || !isset($_POST['requiredStars'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit();
}

$userId = $_SESSION['id'];
$badgeId = intval($_POST['badgeId']);
$requiredStars = intval($_POST['requiredStars']);

// Check if the user has enough stars
$query = $con->prepare("SELECT totalStars FROM users WHERE Id = ?");
$query->bind_param("i", $userId);
$query->execute();
$query->bind_result($totalStars);
$query->fetch();
$query->close();

if ($totalStars < $requiredStars) {
    echo json_encode(['success' => false, 'message' => 'Not enough stars to unlock this badge.']);
    exit();
}

// Deduct stars and add the badge to the user
$con->begin_transaction();

try {
    $updateStars = $con->prepare("UPDATE users SET totalStars = totalStars - ? WHERE Id = ?");
    $updateStars->bind_param("ii", $requiredStars, $userId);
    $updateStars->execute();

    $addBadge = $con->prepare("INSERT INTO user_badges (userId, badgeId) VALUES (?, ?)");
    $addBadge->bind_param("ii", $userId, $badgeId);
    $addBadge->execute();

    $con->commit();
    echo json_encode(['success' => true, 'message' => 'Badge unlocked successfully!']);
} catch (Exception $e) {
    $con->rollback();
    echo json_encode(['success' => false, 'message' => 'An error occurred while unlocking the badge.']);
}
?>
