<?php
session_start();
include("../../p/config.php");

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['badgeId'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit();
}

$userId = $_SESSION['id'];
$badgeId = intval($data['badgeId']);

// Check if badge is already unlocked
$badgeUnlockedQuery = "SELECT 1 FROM user_badges WHERE userId = ? AND badgeId = ?";
$stmt = $con->prepare($badgeUnlockedQuery);
$stmt->bind_param("ii", $userId, $badgeId);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Badge is already unlocked.']);
    $stmt->close();
    exit();
}
$stmt->close();

// Fetch badge details
$badgeQuery = "SELECT requiredStars, imagePath FROM badges WHERE id = ?";
$stmt = $con->prepare($badgeQuery);
$stmt->bind_param("i", $badgeId);
$stmt->execute();
$stmt->bind_result($requiredStars, $imagePath);
$stmt->fetch();
$stmt->close();

if (!$requiredStars) {
    echo json_encode(['success' => false, 'message' => 'Badge not found.']);
    exit();
}

// Check user's stars
$userStarsQuery = "SELECT totalStars FROM users WHERE id = ?";
$stmt = $con->prepare($userStarsQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($totalStars);
$stmt->fetch();
$stmt->close();

if ($totalStars < $requiredStars) {
    echo json_encode(['success' => false, 'message' => 'Not enough stars.']);
    exit();
}

// Unlock badge and deduct stars
$con->begin_transaction();
try {
    $unlockQuery = "INSERT INTO user_badges (userId, badgeId, isUnlocked) VALUES (?, ?, 1)";
    $stmt = $con->prepare($unlockQuery);
    $stmt->bind_param("ii", $userId, $badgeId);
    $stmt->execute();

    $updateStarsQuery = "UPDATE users SET totalStars = totalStars - ? WHERE id = ?";
    $stmt = $con->prepare($updateStarsQuery);
    $stmt->bind_param("ii", $requiredStars, $userId);
    $stmt->execute();

    $con->commit();
    echo json_encode(['success' => true, 'newImagePath' => '../../' . $imagePath]);
} catch (Exception $e) {
    $con->rollback();
    echo json_encode(['success' => false, 'message' => 'Failed to unlock badge.']);
}
