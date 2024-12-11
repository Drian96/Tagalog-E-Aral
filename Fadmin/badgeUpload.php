<?php include('header.php')?>

<body>
    <div class = upload>

        <form action="uploadBadge.php" method="POST" enctype="multipart/form-data">
            <label for="name">Badge Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="requiredStars">Required Stars:</label>
            <input type="number" name="requiredStars" id="requiredStars" required>

            <label for="image">Badge Image:</label>
            <input type="file" name="image" id="image" accept="image/*" required>

            <button type="submit">Upload Badge</button>
        </form>
    </div>
</body>
</html>
