<?php
include("../p/db.php");

// Check if the record ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete the record from the database
    $deleteQuery = "DELETE FROM learn WHERE id = $id";

    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: learn.php?message=Record deleted successfully.");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
