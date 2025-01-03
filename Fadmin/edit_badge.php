<?php
include('header.php');
include("../p/db.php");

// Check if the record ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the badge record from the database
    $query = "SELECT * FROM badges WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $badge = mysqli_fetch_assoc($result);
    } else {
        echo "Badge not found.";
        exit;
    }
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $requiredStars = intval($_POST['requiredStars']);

    $updateQuery = "UPDATE badges SET name = '$name', requiredStars = $requiredStars WHERE id = $id";
    
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: badges.php?message=Badge updated successfully.");
        exit;
    } else {
        echo "Error updating badge: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Badge</title>
</head>
<body>
    <div class="upload">
        <div class="upload-menu">
            
            <h2>Edit Badge</h2>
            <br>
            <form method="POST">
                <div class="badgeName">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($badge['name']); ?>" required>
                </div>
                <br>
                
                <div class="correctChoice">
                    <label for="requiredStars">Required Stars:</label>
                    <input type="number" id="requiredStars" name="requiredStars" value="<?php echo $badge['requiredStars']; ?>" required>
                </div>
                <br>
                
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</body>
</html>
