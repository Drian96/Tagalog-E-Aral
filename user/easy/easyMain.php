<?php
session_start();
include("../../p/config.php");

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch the user's total stars from the database
$userId = $_SESSION['id'];
$query = "SELECT totalStars FROM users WHERE Id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($totalStars);
$stmt->fetch();
$stmt->close();
?>

<?php include('head.php')?>

<body>

    <header>
        <div class="mini-title">
            <div class="title-content">
                <img src="../../image/Tagalog.png" alt="back-button">
                <h1>Tagalog E-Aral</h1>
            </div>
        </div>

        <div class="star-container">
            <div class="star-item">
                <span class="star-text"><?php echo $totalStars; ?></span>
            </div>
            <div class="star-item">
                <img src="../../image/star.png" alt="Star Icon" class="star-icon">
            </div>
        </div>
        
        <a href="boy.php">
            <div class="profile">
                <img class="profile-icon" src="../../image/profile-logo.png" alt="Profile Icon"/>
                <h2>Profile</h2>   
            </div>
        </a>
    </header>

    <div class="main-container">
        <div class="container">
            <a href="learn.php">
                <img src="../../image/bbook.png" alt="Learn Image" class="container-image">
                <button class="container-button">Learn<br>(Matuto)</button>
            </a>
        </div>

        <div class="container">
            <a href="challenge.php">
                <img src="../../image/pen.png" alt="Challenge Image" class="challenge-image">
                <button class="challenge-button">Challenge<br>(Pagsubok)</button>
            </a>
        </div>
    </div>
    
</body>
</html>
