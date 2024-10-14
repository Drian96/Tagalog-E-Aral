<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge</title>
  
    <style>
        <?php include('../css/style.css'); ?>

        .main-container {
            display: flex;
            gap: 40px;
            padding: 20px;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            width: 80%;
            height: 80%;
        }
        .container {
            padding: 20px;
            text-align: center;
            max-width: 300px;
            width: 100%;
            transition: transform 0.3s;
        }
        .container:hover{
            transform: scale(1.05);
        }
        .container-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .container-button {
            border: none;
            padding: 20px 20px;
            font-size: 1.5em;
            color: white;
            background-color:var(--red-color);
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.25s;
        }
        .card-button:hover {
            background-color: #b81010;
        }

        .upload-icon{
            margin: 10px;
            width: 50px;
            height: auto;
        }
        .upload-menu {
            display: none; /* Hidden by default */
            position: absolute;
            top: 100%; /* Position right below the profile */
            left: 50%;
            transform: translateX(-50%);
            background-color: #e0e0e0;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            z-index: 1; /* Ensure it's above other elements */
        }
        .dropdown-menu a {
            display: block;
            color: black;
            text-decoration: none;
            font-weight: bold;
            margin: 10px 0;
        }

        .dropdown-menu a:hover {
            color: var(--red-color);
        }
        input[type="text"] {
            width: 500px;
            height: 40px;
            padding: 10px;   /* Add padding for spacing inside the input */
            font-size: 15px; 
            text-align: center;
        }
        .upload-menu button{
            width: 100px;
            height: 40px;
            margin-right: 50%;
            align-items: center;
            margin-left: 40%;
        }

        .choices {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 10px;
        }
        .choice-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .choice-group label {
            margin-right: 10px; 
        }
        .choice-group input[type="text"] {
            width: 150px;
            height: 15px;
            padding: 7px;
            font-size: 15px;
        }

    </style>

</head>
<body>

    <header>
        <div class="mini-title">
            <a href="Amain.php">
                <div class="title-content">
                    <img src="../image/backArrow.png" alt="back-button">
                    <h1>Tagalog E-Aral</h1>
                </div>
            </a>
        </div>

        <div class="upload">
            <img class="upload-icon" src="../image/upload-icon.png" alt="upload-icon" onclick="toggleMenu()"/>
            <div class="upload-menu" id="uploadMenu">
                <form action="ChallengeUpload.php" method="post" enctype="multipart/form-data">
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

                        <div class="choice-group">
                            <label>Choice 4:</label>
                            <input type="text" name="choice4" required>
                        </div>
                    </div>

                    <label>Correct Choice (1 to 4):</label>
                    <input type="number" name="correct_choice" min="1" max="4" required><br><br>

                    <label>Stars Value (1 to 3):</label>
                    <input type="number" name="stars_value" min="1" max="3" required><br><br>

                    <button type="submit">Upload</button>
                </form>
            </div>
        </div>
    </header>


    <div class="main-container">

        <div class="container">
            <a href="Aeasy.php">
                <img src="../image/easy.jpg" alt="Easy-Image" class="container-image">
                <button class="container-button">Easy</button>
            </a>
        </div>

        <div class="container">
            <a href="Aaverage.php">
                <img src="../image/average.jpg" alt="Average-Image" class="container-image">
                <button class="container-button">Average</button>
            </a>
        </div>
        
        <div class="container">
            <a href="Ahard.php">
                <img src="../image/hard.jpg" alt="Hard-image" class="container-image">
                <button class="container-button">Hard</button>
            </a>
        </div>

    </div>

    <script src="../Alearn.js"></script>
    
</body>
</html>