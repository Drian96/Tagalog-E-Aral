<?php
include '../../p/db.php';  // Include the database connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$page_value = 1;
$stars_value = 3; // Add starsValue condition stars value means difficulty value of that obj
$sql = "SELECT * FROM learn WHERE pageValue = $page_value AND starsValue = $stars_value";
$result = $conn->query($sql);
?>

<?php include('moduleHead.php')?>

<style>
    body {
    background-image: url("../../Image/abc.png");
    background-position: center;
    background-size: cover;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>

<body>
    <header>
        <div class="mini-title">
            <a href="hardModule.php">
                <div class="title-content">
                    <img src="../../image/backArrow.png" alt="back-button">
                    <h1>Tagalog E-Aral</h1>
                </div>
            </a>
        </div>
    </header>
    
    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Adjust the path by prepending an additional ../
                $imagePath = '../../' . ltrim($row['imagePath'], './'); // Remove leading ./ or ../ before prepending
                $audioPath = '../../' . ltrim($row['audioPath'], './'); // Adjust audio path
                $item_name = htmlspecialchars($row['name']); // Escape special characters for safety

                echo '<div class="clickable-image">';
                echo '<div class="image-wrapper"><img src="'.$imagePath.'" alt="Media Image" onclick="handleImageClick(this, \''.$audioPath.'\')"></div>';
                echo '<div class="image-name"><p>'.$item_name.'</p></div>'; 
                echo '</div>';
            }
        } else {
            echo "No records found.";
        }
        ?>
    </div>

    <div id="overlay" class="overlay" onclick="closePopup()">
        <img src="" alt="Zoomed Image" id="zoomedImage">
    </div>
    
    <audio id="audioPlayer">
        <source src="" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    
    <script src="../../js/Alearn.js"></script>
</body>
</html>
