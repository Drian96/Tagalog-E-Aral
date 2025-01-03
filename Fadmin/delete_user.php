<?php
include("../p/db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $deleteQuery = "DELETE FROM users WHERE Id = $id";
    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: users.php");
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}
?>
