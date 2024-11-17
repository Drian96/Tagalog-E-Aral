<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge</title>

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
        .container-button:hover {
            background-color: #b81010;
        }

        .card-button:hover {
            background-color: #b81010;
        }
    </style>

</head>
<body>

    <header>
        <div class="mini-title">
            <a href="main.php">
                <div class="title-content">
                    <img src="../image/backArrow.png" alt="back-button">
                    <h1>Tagalog E-Aral</h1>
                </div>
            </a>
        </div>
    </header>


    <div class="main-container">

        <div class="container">
            <a href="easy.php">
                <img src="../image/easy.jpg" alt="Easy-Image" class="container-image">
                <button class="container-button">Easy<br>(Madali)</button>
            </a>
        </div>

        <div class="container">
            <a href="average.php">
                <img src="../image/average.png" alt="Average-Image" class="container-image">
                <button class="container-button">Average<br>(Katamtaman)</button>
            </a>
        </div>
        
        <div class="container">
            <a href="hard.php">
                <img src="../image/hard.jpg" alt="Hard-image" class="container-image">
                <button class="container-button">Hard<br>(Mahirap)</button>
            </a>
        </div>

    </div>
    
</body>
</html>