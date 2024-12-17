<?php include('header.php')?>

<style>
    /***badge upload********/
    form {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        background-color: var(--white-color);
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    form label {
        display: block;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px; /* Smaller gap between label and input */
    }
    
    form input[type="text"],
    form input[type="number"],
    form input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px; /* Space between input and the next label */
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        box-sizing: border-box;
    }
    
    form input[type="file"] {
        margin-bottom: 15px; /* Consistent spacing for file input */
        border: none;
        background-color: #fff;
    }
    

    form button {
        width: 100%;
        padding: 10px;
        background-color: var(--blue-color);
        border: none;
        border-radius: 4px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    form button:hover {
        background-color: rgb(44, 44, 180);
    }

    form input:focus {
        border-color: var(--blue-color);
        outline: none;
        box-shadow: 0 0 5px var(--blue-color);
    }
</style>

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
