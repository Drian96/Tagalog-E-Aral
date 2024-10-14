<?php 
   session_start();

   include("../p/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn</title>

    <style>
        <?php include("../css/style.css"); ?>
    
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
        /********************explore**************/
        .explore-container {
            display: flex;
            gap: 40px;
            padding: 20px;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s;
        }
        .explore-container:hover{
            transform: scale(1.05);
        }
        /* Card Styling */
        .explore {
            padding: 20px;
            text-align: center;
            max-width: 300px;
            width: 100%;
            transition: transform 0.5s;
        }
        .explore-image, .colors-image, .animals-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .colors-image {
            margin-top: 55px;
        }
        .animals-image {
            margin-top: 42px;
        }
        /* Button Styling */
        .explore-button, .colors-button, .animals-button {
            border: none;
            padding: 20px 20px;
            font-size: 1.5em;
            color: white;
            background-color:var(--red-color);
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.25s;
        }
        .explore-button:hover, .animals-button:hover, .colors-button:hover {
            background-color: #b81010;
        }
        .colors-button {
            margin-top: 55px;
        }
        .animals-button {
            margin-top: 42px;
        }
        /**********************inside explore****************************/
        .container {
            position: relative;
            align-items: center;
            text-align: center;
        }

        .clickable-image {
            width: 300px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .clickable-image:hover {
            transform: scale(1.05);
        }
        .overlay {
            position: fixed;
            display: none;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color:var(--white-color);
            justify-content: center;
            align-items: center;
        }
        .overlay img {
            max-width: 90%;
            max-height: 90%;
        }
        .overlay.active {
            display: flex;
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
            left: 90%;
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
            <!-- upload Menu -->
            <div class="upload-menu" id="uploadMenu">
            <form action="LearnUpload.php" method="post" enctype="multipart/form-data">
                
                <label for="item_name">Item Name:</label>
                <input type="text" name="item_name" id="item_name" required>
                <br><br>

                <label for="image">Select Image:</label>
                <input type="file" name="image" id="image" required>
                <br><br>

                <label for="audio">Select Audio:</label>
                <input type="file" name="audio" id="audio" required>
                <br><br>

                <label for="page_value">Upload Location:</label>
                <select name="page_value" id="page_value" required>
                    <option value="1">Explore</option>
                    <option value="2">Colors</option>
                    <option value="3">Animals</option>
                </select>
                <br><br>

                <input type="submit" value="Upload">
            </form>

            </div>
        </div>

    </header>

    <div class="main-container">

        <div class="explore-container">
            <div class="explore">
                <a href="Aexplore.php">
                    <img src="../image/explore.png" alt="Explore Image" class="explore-image">
                    <button class="explore-button">Explore</button>
                </a>
            </div>
        </div>

        <div class="explore-container">
            <div class="explore">
                <a href="Acolors.php">
                    <img src="../image/colors.png" alt="Explore Image" class="colors-image">
                    <button class="colors-button">Colors</button>
                </a>
            </div>
        </div>

        <div class="explore-container">
            <div class="explore">
                <a href="Aanimals.php">
                    <img src="../image/animals.png" alt="Explore Image" class="animals-image">
                    <button class="animals-button">Animals</button>
                </a>
            </div>
        </div>

    </div>

    <script src="../js/Alearn.js"></script>
</body>
</html>