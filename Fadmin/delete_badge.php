<?php
include("../p/db.php");

// Check if the badge ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete the badge record from the database
    $deleteQuery = "DELETE FROM badges WHERE id = $id";

    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: badges.php?message=Badge deleted successfully.");
        exit;
    } else {
        echo "Error deleting badge: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
