<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Galindo', cursive;
            list-style: none;
            text-decoration: none;
        }
        :root{      /*color palette*/
            --blue-color: #0D1282;
            --red-color: #D71313;
            --yellow-color: #F0DE36;
            --white-color: #EEEDED;
        }
        body {
            background-image: url("../Image/BGG.png");
            background-position: center;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        header{
            position: fixed;
            width: 100%;
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 100px;
        }
        .mini-title{
            margin-left: 10%;
        }
        .mini-title h1{
            color: var(--yellow-color);
            -webkit-text-stroke: 0.8px black;
        }
        /********star design*******/
        .star-container {
            display: flex;
            align-items: center;
            padding: 5px 5px;
            border: 1px solid black;
            border-radius: 10px;
        }
        .star-item {
            display: flex;
            align-items: center;
            margin-left: 15px;
            margin-right: 15px;
        }
        .star-icon {
            width: 28px; 
            height: auto; 
            margin-right: 10px;
        }
        .star-text {
            font-size: 25px;
            color: var(--yellow-color);
            -webkit-text-stroke: 0.8px black;
        }
        /******profile design******/
        .profile{
            display: flex;
            align-items: center;
            
        }
        .profile h2{
            font-size: 30px;
            color: var(--yellow-color);
            font-weight: 900;
            -webkit-text-stroke: 0.8px black;
        }
        .profile-icon {
            width: 45px;
            height: auto;
        }
        /* Main Container for learn and challenge*/
        .main-container {
            display: flex;
            gap: 40px;
            padding: 20px;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
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
        .challenge-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
            margin-top: 30px;
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
        .container-button:hover{
            filter: brightness(0.80);
        }
        .challenge-button{
            border: none;
            padding: 20px 20px;
            font-size: 1.5em;
            color: white;
            background-color:var(--red-color);
            border-radius: 10px;
            margin-top: 40px;
            cursor: pointer;
            transition: background-color 0.25s;
        }
        .challenge-button:hover{
            filter: brightness(0.80);
        }

        .mini-title {
            margin-left: 10%;
        }
        .mini-title img {
            margin-top: 5px;
            width: 70px;
            height: auto;
        }
    </style>
</head>
<body>

    <header>
        <div class="mini-title">
            <h1>Tagalog E-Aral</h1>
        </div>

        <div class="star-container">
            <div class="star-item">
                <span class="star-text">0</span>
            </div>
            <div class="star-item">
                <img src="../image/star.png" alt="Star Icon" class="star-icon">
            </div>
        </div>
        
        <a href="Aboy.php">
            <div class="profile">
                <img class="profile-icon" src="../image/PLogo.png" alt="Profile Icon"/>
                <h2>Profile</h2>   
            </div>
        </a>
    </header>


    <div class="main-container">
        <div class="container">
            <a href="Alearn.php">
                <img src="../image/bbook.png" alt="Learn Image" class="container-image">
                <button class="container-button">Learn</button>
            </a>
        </div>

        <div class="container">
            <a href="Achallenge.php">
                <img src="../image/pen.png" alt="Challenge Image" class="challenge-image">
                <button class="challenge-button">Challenge</button>
            </a>
        </div>
    </div>
    
</body>
</html>