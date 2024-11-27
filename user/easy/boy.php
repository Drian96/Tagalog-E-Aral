<?php
session_start();
include("../../p/config.php");

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['id'];

// Fetch the user's total stars from the database
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
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Fetch username for the profile
$query = $con->prepare("SELECT Username FROM users WHERE Id = ?");
$query->bind_param("i", $userId);
$query->execute();
$query->bind_result($res_Uname);
$query->fetch();
$query->close();
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
            <a href="easyMain.php">
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
            <!-- Dropdown Menu -->
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
                    <h3>Achievements</h3>
                    <div class="badge-container">
                        <div class="container">
                            <img src="../../image/qCircle.jpg" alt="Learn Image" class="container-image">
                            <div class="easy-text">
                                <h2 class="container-button">Easy</h2>
                            </div>
                        </div>
                        <div class="container">
                            <img src="../../image/qCircle.jpg" alt="Challenge Image" class="container-image">
                            <div class="average-text">
                                <h2 class="container-button">Average</h2>
                            </div>
                        </div>
                        <div class="container">
                            <img src="../../image/qCircle.jpg" alt="Challenge Image" class="container-image">
                            <div class="hard-text">
                                <h2 class="container-button">Hard</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="badges">
                    <h3>Badges</h3>
                    <div class="badge-container">
                        <div class="container">
                            <img src="../../image/qCircle.jpg" alt="Learn Image" class="container-image">
                            <div class="text-with-star">
                                <h2 class="container-button">10</h2>
                                <img src="../../image/str.png" alt="star" class="star">
                            </div>
                        </div>
                        <div class="container">
                            <img src="../../image/qCircle.jpg" alt="Challenge Image" class="container-image">
                            <div class="text-with-star">
                                <h2 class="container-button">20</h2>
                                <img src="../../image/str.png" alt="star" class="star">
                            </div>
                        </div>
                        <div class="container">
                            <img src="../../image/qCircle.jpg" alt="Challenge Image" class="container-image">
                            <div class="text-with-star">
                                <h2 class="container-button">30</h2>
                                <img src="../../image/str.png" alt="star" class="star">
                            </div>
                        </div>
                        <div class="container">
                            <img src="../../image/qCircle.jpg" alt="Challenge Image" class="container-image">
                            <div class="text-with-star">
                                <h2 class="container-button">40</h2>
                                <img src="../../image/str.png" alt="star" class="star">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assessment History Section -->
        <div class="assessment-history">
            <h3>Assessment History</h3>
            <table border="1">
                <tr>
                    <th>Score</th>
                    <th>Stars Earned</th>
                    <th>Knowledge Level</th>
                    <th>Date</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['score']; ?>/10</td>
                        <td><?php echo $row['starsEarned']; ?></td>
                        <td><?php echo ucfirst($row['difficultyLevel']); ?></td>
                        <td><?php echo date("F j, Y, g:i a", strtotime($row['createdAt'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>

    <script src="../../js/profile.js"></script>
</body>
</html>
