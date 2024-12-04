<?php
session_start();
include("../p/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $badgeId = $data['badgeId'];
    $userId = $_SESSION['id'];

    // Fetch badge details
    $badgeQuery = "SELECT requiredStars FROM badges WHERE id = ?";
    $stmt = $con->prepare($badgeQuery);
    $stmt->bind_param("i", $badgeId);
    $stmt->execute();
    $badgeResult = $stmt->get_result();

    if ($badgeResult->num_rows > 0) {
        $badge = $badgeResult->fetch_assoc();
        $requiredStars = $badge['requiredStars'];

        // Check user's current stars
        $userQuery = "SELECT totalStars FROM users WHERE id = ?";
        $stmt = $con->prepare($userQuery);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $userResult = $stmt->get_result();

        if ($userResult->num_rows > 0) {
            $user = $userResult->fetch_assoc();
            $totalStars = $user['totalStars'];

            if ($totalStars >= $requiredStars) {
                // Deduct stars and unlock badge
                $newStars = $totalStars - $requiredStars;

                $con->begin_transaction();

                try {
                    // Update user stars
                    $updateStarsQuery = "UPDATE users SET totalStars = ? WHERE id = ?";
                    $stmt = $con->prepare($updateStarsQuery);
                    $stmt->bind_param("ii", $newStars, $userId);
                    $stmt->execute();

                    // Insert into user_badges
                    $insertBadgeQuery = "INSERT INTO user_badges (userId, badgeId) VALUES (?, ?)";
                    $stmt = $con->prepare($insertBadgeQuery);
                    $stmt->bind_param("ii", $userId, $badgeId);
                    $stmt->execute();

                    $con->commit();
                    echo json_encode(['success' => true]);
                } catch (Exception $e) {
                    $con->rollback();
                    echo json_encode(['success' => false, 'message' => 'Transaction failed.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Not enough stars.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Badge not found.']);
    }
}
?>
