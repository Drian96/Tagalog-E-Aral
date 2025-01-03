<?php include('header.php')?>

<body>

    <header>
        <div class="mini-title">
            <a href="upload.php">
                <div class="title-content">
                    <img src="../image/backArrow.png" alt="back-button">
                    <h1>Back</h1>
                </div>
            </a>
        </div>
    </header>
    
    <div class="upload">
        <div class="upload-menu" id="uploadMenu">
            <form action="learnUpload.php" method="post" enctype="multipart/form-data">
                
                <label for="item_name">Item Name:</label>
                <input type="text" name="item_name" id="item_name" required>
                <br><br>

                <label for="image">Select Image:</label>
                <input type="file" name="image" id="image" required>
                <br>

                <label for="audio">Select Audio:</label>
                <input type="file" name="audio" id="audio" required>
                <br>

                <label for="page_value">Upload Location:</label>
                <select name="page_value" id="page_value" required>
                    <option value="1">Letters</option>
                    <option value="2">Numbers</option>
                    <option value="3">Colors</option>
                    <option value="4">Explore</option>
                    <option value="5">Animals</option>
                </select>
                <br><br>

                <div class="correctChoice">
                <label>Stars Value (1 to 3):</label>
                <input type="number" name="starsValue" min="1" max="3" required><br><br>
                </div>

                <br><br>
                <div class="uploadButton">
                    <input type="submit" value="Upload">
                </div>
            </form>
        </div>
    </div>

</body>
</html>