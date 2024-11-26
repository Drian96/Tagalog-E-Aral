<?php
include('header.php');
session_start();
include("../../p/config.php");

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../../p/login.php");
    exit();
}

// Fetch the user's total stars from the session or database
$totalStars = $_SESSION['totalStars'] ?? 0; // Use session if already set
if ($totalStars === 0) {
    // If not in session, fetch from the database
    $userId = $_SESSION['id'];
    $query = "SELECT totalStars FROM users WHERE Id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($totalStarsFromDB);
    $stmt->fetch();
    $stmt->close();
    $totalStars = $totalStarsFromDB;

    // Update session to avoid querying repeatedly
    $_SESSION['totalStars'] = $totalStars;
}
?>

<body>
    <header>
        <div class="mini-title">
            <div class="title-content">
                <h1>Tagalog E-Aral</h1>
            </div>
        </div>

        <div class="star-container">
            <div class="star-item">
                <span class="star-text"><?php echo $totalStars; ?></span> <!-- Display dynamic stars -->
            </div>

            <div class="star-item">
                <img src="../../image/star.png" alt="Star Icon" class="star-icon">
            </div>
        </div>

        <div class="menu">
            <img class="menu-icon" src="../../image/menu-icon.png" alt="menu-icon" onclick="toggleMenu()"/>
            <!-- Dropdown Menu -->
            <div class="dropdown-menu" id="profileMenu">
                <a href="../../p/logout.php">Logout</a>
            </div>
        </div>
    </header>

    <a href="quiz.php">
        <div class="start">
            <h1>Start Assessment!</h1>
        </div>
    </a>
    <script src="profile.js"></script>

</body>
</html>
