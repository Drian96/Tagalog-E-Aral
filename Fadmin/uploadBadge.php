<?php
session_start();
include("../p/config.php");

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form inputs
    $name = trim($_POST['name']);
    $requiredStars = intval($_POST['requiredStars']);
    $image = $_FILES['image'];

    // Validate inputs
    if (empty($name) || $requiredStars <= 0 || !isset($image)) {
        die("All fields are required, and the required stars must be a positive number.");
    }

    // Handle image upload
    $targetDir = "../uploads/badges/"; // Relative to `capstone` directory
    $absoluteTargetDir = __DIR__ . "/../uploads/badges/"; // Absolute path for saving
    $fileName = basename($image['name']);
    $targetFilePath = $absoluteTargetDir . $fileName;

    // Check if the directory exists; if not, create it
    if (!is_dir($absoluteTargetDir)) {
        mkdir($absoluteTargetDir, 0777, true);
    }

    // Validate image file type
    $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($imageFileType, $validExtensions)) {
        die("Only JPG, JPEG, PNG, and GIF files are allowed.");
    }

    // Move the uploaded file
    if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
        // Save badge info to the database
        $imagePath = "uploads/badges/" . $fileName; // Relative path for database storage
        $query = "INSERT INTO badges (name, requiredStars, imagePath) VALUES (?, ?, ?)";
        $stmt = $con->prepare($query);

        if ($stmt) {
            $stmt->bind_param("sis", $name, $requiredStars, $imagePath);
            if ($stmt->execute()) {
                echo "Badge uploaded successfully!";
            } else {
                echo "Error inserting badge into the database: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Database error: " . $con->error;
        }
    } else {
        echo "Failed to upload the image. Please try again.";
    }
}
?>
