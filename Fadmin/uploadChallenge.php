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
            <form action="challengeUpload.php" method="post" enctype="multipart/form-data">
                <label>Question:</label>
                <input type="text" name="questionText" required><br><br>

                <div class="file">
                    <label>Image:</label>
                    <input type="file" name="image" accept="image/*" required><br>

                    <label>Audio:</label>
                    <input type="file" name="audio" accept="audio/*" required><br>
                </div>
                <div class="choices">
                    <div class="choice-group">
                        <label>Choice 1:</label>
                        <input type="text" name="choice1" required>
                    </div>

                    <div class="choice-group">
                        <label>Choice 2:</label>
                        <input type="text" name="choice2" required>
                    </div>

                    <div class="choice-group">
                        <label>Choice 3:</label>
                        <input type="text" name="choice3" required>
                    </div>
                </div>

                <div class="correctChoice">
                    <label>Correct Choice (1 to 3):</label>
                    <input type="number" name="correctChoice" min="1" max="3" required><br><br>

                    <label>Stars Value (1 to 3):</label>
                    <input type="number" name="starsValue" min="1" max="3" required><br><br>
                </div>

                <button type="submit">Upload</button>
            </form>
        </div>
    </div>    

</body>
</html>