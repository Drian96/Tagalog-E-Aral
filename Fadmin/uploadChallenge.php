<?php include('header.php')?>

<body>
    <div class="upload">
        <div class="upload-menu" id="uploadMenu">
            <form action="challengeUpload.php" method="post" enctype="multipart/form-data">
                <label>Question:</label>
                <input type="text" name="question_text" required><br><br>

                <label>Image:</label>
                <input type="file" name="image" accept="image/*" required><br><br>

                <label>Audio:</label>
                <input type="file" name="audio" accept="audio/*" required><br><br>

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

                <label>Correct Choice (1 to 3):</label>
                <input type="number" name="correct_choice" min="1" max="3" required><br><br>

                <label>Stars Value (1 to 3):</label>
                <input type="number" name="stars_value" min="1" max="3" required><br><br>

                <button type="submit">Upload</button>
            </form>
        </div>
    </div>    

</body>
</html>