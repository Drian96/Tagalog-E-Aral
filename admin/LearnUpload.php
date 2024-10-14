<?php
include '../db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $conn->real_escape_string($_POST['item_name']);
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $audio = addslashes(file_get_contents($_FILES['audio']['tmp_name']));
    $page_value = intval($_POST['page_value']);  

    $sql = "INSERT INTO learn (name, image, audio, page_value) VALUES ('$item_name', '$image', '$audio', '$page_value')";

    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
