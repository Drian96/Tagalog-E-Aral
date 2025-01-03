<?php
include('header.php'); 
include("../p/db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE Id = $id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $totalStars = $_POST['totalStars'];

    $updateQuery = "UPDATE users SET Username='$username', Email='$email', totalStars=$totalStars WHERE Id=$id";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: users.php");
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
}
?>

    <header>
        <div class="mini-title">
            <a href="users.php">
                <div class="title-content">
                    <img src="../image/backArrow.png" alt="back-button">
                    <h1>Back</h1>
                </div>
            </a>
        </div>
    </header>

<body>
    <div class="upload">
        <div class="upload-menu">

            <form method="POST">

                <div class="badgeName">
                    <label>Username:</label>
                    <input type="text" name="username" value="<?php echo $user['Username']; ?>" required>
                </div>
                <br>

                <div class="emailInput">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?php echo $user['Email']; ?>" required>
                </div>
                <br>

                <div class="correctChoice">
                    <label>Total Stars:</label>
                    <input type="number" name="totalStars" value="<?php echo $user['totalStars']; ?>" required>
                </div>
                <br>

                <button type="submit">Update</button>
            </form>

        </div>
    </div>
</body>
</html>