<?php
session_start();
include("../../p/config.php");

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['id'];

// Fetch the user's total stars
$starsQuery = "SELECT totalStars FROM users WHERE Id = ?";
$stmt = $con->prepare($starsQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($totalStars);
$stmt->fetch();
$stmt->close();

// Fetch the user's quiz history
$quizHistoryQuery = "SELECT score, starsEarned, difficultyLevel, createdAt 
                     FROM quiz_history 
                     WHERE userId = ? 
                     ORDER BY createdAt DESC";
$stmt = $con->prepare($quizHistoryQuery);

if ($stmt) {
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "<p>Error preparing statement: " . $con->error . "</p>";
}

// Fetch the user's daily quiz history
$dailyQuizHistoryQuery = "SELECT score, starsEarned, difficultyLevel, createdAt 
                          FROM daily_quiz_history 
                          WHERE userId = ? 
                          ORDER BY createdAt DESC";
$stmt = $con->prepare($dailyQuizHistoryQuery);

if ($stmt) {
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $dailyQuizResult = $stmt->get_result();
} else {
    echo "<p>Error preparing statement: " . $con->error . "</p>";
}

// Fetch username for the profile
$query = $con->prepare("SELECT Username FROM users WHERE Id = ?");
$query->bind_param("i", $userId);
$query->execute();
$query->bind_result($res_Uname);
$query->fetch();
$query->close();

// Fetch all badges
$badgesQuery = "SELECT id, name, requiredStars, imagePath FROM badges";
$badgesResult = $con->query($badgesQuery);

$lockedBadgeImage = "../../uploads/badges/locked.jpg"; // Default locked badge image
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <header>
        <div class="mini-title">
            <a href="averageMain.php">
                <div class="title-content">
                    <img src="../../image/backArrow.png" alt="back-button">
                    <h1>Tagalog E-Aral</h1>
                </div>
            </a>
        </div>

        <div class="star-container">
            <div class="star-item">
                <span class="star-text"><?php echo $totalStars; ?></span>
            </div>
            <div class="star-item">
                <img src="../../image/str.png" alt="Star Icon" class="star-icon">
            </div>
        </div>

        <a href="girl.php">
            <img class="girl-icon" src="../../image/GirlIcon.png" alt="girl-icon">
        </a>

        <div class="menu">
            <img class="menu-icon" src="../../image/menu-icon.png" alt="menu-icon" onclick="toggleMenu()"/>
            <div class="dropdown-menu" id="profileMenu">
                <a href="../../login/edit.php">Edit Profile</a>
                <a href="../../p/logout.php">Logout</a>
            </div>
        </div>
    </header>

    <div class="main-profile">
        <div class="content-wrapper">
            <div class="profile-pic">
                <div class="username">
                    <h1><?php echo htmlspecialchars($res_Uname); ?></h1>
                </div>
                <img src="../../image/boy.png" alt="Boy" id="boy">
            </div>

            <div class="achievements-and-badges">
                <div class="badges">
                    <h3>Badges</h3>
                    <div class="badge-container">
                        <?php while ($badge = $badgesResult->fetch_assoc()): 
                            $userHasBadgeQuery = "SELECT 1 FROM user_badges WHERE userId = ? AND badgeId = ?";
                            $stmt = $con->prepare($userHasBadgeQuery);
                            $stmt->bind_param("ii", $userId, $badge['id']);
                            $stmt->execute();
                            $stmt->store_result();
                            $hasBadge = $stmt->num_rows > 0;
                            $stmt->close();
                        ?>
                            <div class="container" 
                                 data-badge-id="<?php echo $badge['id']; ?>" 
                                 data-badge-name="<?php echo htmlspecialchars($badge['name']); ?>" 
                                 data-required-stars="<?php echo $badge['requiredStars']; ?>" 
                                 data-unlocked="<?php echo $hasBadge ? 'true' : 'false'; ?>"
                                 onclick="openBadgeModal(this)">
                                <img src="<?php echo $hasBadge ? '../../' . $badge['imagePath'] : $lockedBadgeImage; ?>" 
                                     alt="<?php echo htmlspecialchars($badge['name']); ?>" 
                                     class="container-image" />
                                <h4><?php echo htmlspecialchars($badge['name']); ?></h4>
                                <div class="text-with-star">
                                    <h2 class="container-button"><?php echo $badge['requiredStars']; ?></h2>
                                    <img src="../../image/str.png" alt="star" class="star">
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="assessment-history">
            <h3>Knowledge Check History</h3>
            <div class="table-container">
                <table border="1">
                    <tr>
                        <th>Score</th>
                        <th>Stars Earned</th>
                        <th>Knowledge Level</th>
                        <th>Date</th>
                    </tr>
                    <?php if ($result): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['score']; ?>/10</td>
                                <td><?php echo $row['starsEarned']; ?></td>
                                <td><?php echo ucfirst($row['difficultyLevel']); ?></td>
                                <td><?php echo date("F j, Y, g:i a", strtotime($row['createdAt'])); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>

        <div class="assessment-history">
            <h3>Daily Quiz History</h3>
            <div class="table-container">
                <table border="1">
                    <tr>
                        <th>Score</th>
                        <th>Stars Earned</th>
                        <th>Difficulty Level</th>
                        <th>Date</th>
                    </tr>
                    <?php if ($dailyQuizResult): ?>
                        <?php while ($row = $dailyQuizResult->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['score']; ?>/5</td>
                                <td><?php echo $row['starsEarned']; ?></td>
                                <td><?php echo ucfirst($row['difficultyLevel']); ?></td>
                                <td><?php echo date("F j, Y, g:i a", strtotime($row['createdAt'])); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <div id="badgeModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeBadgeModal()">&times;</span>
            <h2 id="modalBadgeName"></h2>
            <p id="modalBadgeStars"></p>
            <button id="unlockButton" onclick="unlockBadge()">Unlock</button>
            <p>Press the unlock button to unlock the badge.</p>
        </div>
    </div>

    <div id="popupContainer"></div> <!-- Popup container for dynamic popups -->

    <script src="../../js/profile.js"></script>
</body>
</html>
