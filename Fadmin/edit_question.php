<?php
include('header.php');
include("../p/db.php");

// Check if the record ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the record from the database
    $query = "SELECT * FROM questions WHERE id = $id";
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
    $questionText = mysqli_real_escape_string($conn, $_POST['questionText']);
    $choice1 = mysqli_real_escape_string($conn, $_POST['choice1']);
    $choice2 = mysqli_real_escape_string($conn, $_POST['choice2']);
    $choice3 = mysqli_real_escape_string($conn, $_POST['choice3']);
    $correctChoice = intval($_POST['correctChoice']);
    $starsValue = intval($_POST['starsValue']);

    $updateQuery = "UPDATE questions 
                    SET questionText = '$questionText', 
                        choice1 = '$choice1', 
                        choice2 = '$choice2', 
                        choice3 = '$choice3', 
                        correctChoice = $correctChoice, 
                        starsValue = $starsValue 
                    WHERE id = $id";
    
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: questions.php?message=Record updated successfully.");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

    <header>
        <div class="mini-title">
            <a href="questions.php">
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

            <h2>Edit Question</h2>
            <br>
            <form method="POST">
                <div class="qText">
                    <label for="questionText">Question Text:</label>
                    <input type="text" id="questionText" name="questionText" value="<?php echo htmlspecialchars($record['questionText']); ?>" required>
                </div>   
                <br>
                
                <div class="correctChoice">
                    <label for="choice1">Choice 1:</label>
                    <input type="text" id="choice1" name="choice1" value="<?php echo htmlspecialchars($record['choice1']); ?>" required>
                </div>
                <br>
                
                <div class="correctChoice">
                    <label for="choice2">Choice 2:</label>
                    <input type="text" id="choice2" name="choice2" value="<?php echo htmlspecialchars($record['choice2']); ?>" required>
                </div>
                <br>
                
                <div class="correctChoice">
                    <label for="choice3">Choice 3:</label>
                    <input type="text" id="choice3" name="choice3" value="<?php echo htmlspecialchars($record['choice3']); ?>" required>
                </div>
                <br>
                
                <div class="correctChoice">
                    <label for="correctChoice">Correct Choice (1, 2, or 3):</label>
                    <input type="number" id="correctChoice" name="correctChoice" min="1" max="3" value="<?php echo $record['correctChoice']; ?>" required>
                </div>
                <br>
                
                <div class="correctChoice">
                    <label for="starsValue">Stars Value (1–3):</label>
                    <input type="number" id="starsValue" name="starsValue" min="1" max="3" value="<?php echo $record['starsValue']; ?>" required>
                </div>
                <br>
                
                <button type="submit">Update</button>
            </form>
        </div>
    </div>

</body>
</html>
