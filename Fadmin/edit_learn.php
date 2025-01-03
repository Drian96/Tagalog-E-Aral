<?php
include('header.php');
include("../p/db.php");

// Check if the record ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the record from the database
    $query = "SELECT * FROM learn WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $record = mysqli_fetch_assoc($result);
    } else {
        echo "Record not found.";
        exit;
    }
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $pageValue = intval($_POST['pageValue']);
    $starsValue = intval($_POST['starsValue']);

    $updateQuery = "UPDATE learn SET name = '$name', pageValue = $pageValue, starsValue = $starsValue WHERE id = $id";
    
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: learn.php?message=Record updated successfully.");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

    <header>
        <div class="mini-title">
            <a href="learn.php">
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
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($record['name']); ?>" required>
                </div>
                <br>
                
                <div class="correctChoice">
                    <label for="pageValue">Category (Page Value):</label>
                    <input type="number" id="pageValue" name="pageValue" value="<?php echo $record['pageValue']; ?>" required>
                </div>
                <br>
                
                <div class="correctChoice">
                    <label for="starsValue">Difficulty Level (Stars Value):</label>
                    <input type="number" id="starsValue" name="starsValue" value="<?php echo $record['starsValue']; ?>" required>
                </div>
                <br>
                
                <button type="submit">Update</button>
            </form>

        </div>
    </div>
</body>
</html>
