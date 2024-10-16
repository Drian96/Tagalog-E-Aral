<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>

    <style>
        <?php include("../css/style.css"); ?>
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
    /*mobile*/
    @media (max-width: 430px){
        .mini-title {
            margin-left: 5%;
        }
        .mini-title .title-content {
            display: flex;
            align-items: center; 
            gap: 10px;
            margin-left: 100%;
        }
        
        .mini-title h1 {
            display: none;
            color: var(--yellow-color);
            -webkit-text-stroke: 0.8px black;
            margin: 0; 
            font-size: 25px;
        }
        .mini-title img {
            margin-top: 5px;
            width: 50px;
            height: auto;
        }

        .star-container {
            margin-left: 30%;
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
            width: 20px; 
            height: auto; 
            margin-right: 5px;
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
            margin-left: 100%;
            
        }
        .profile h2{
            display: none;
            font-size: 30px;
            color: var(--yellow-color);
            font-weight: 900;
            -webkit-text-stroke: 0.8px black;
        }
        .profile-icon {
            width: 50px;
            height: auto;
        }
        /* Main Container for learn and challenge*/
        .main-container {
            height: 70%;
            display: flex;
            gap: 40px;
            padding: 20px;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
    }
    </style>
</head>
<body>

    <header>
        <div class="mini-title">
            <div class="title-content">
                <img src="../image/Tagalog.png" alt="back-button">
                <h1>Tagalog E-Aral</h1>
            </div>
        </div>

        <div class="star-container">
            <div class="star-item">
                <span class="star-text">0</span>
            </div>
            <div class="star-item">
                <img src="../image/star.png" alt="Star Icon" class="star-icon">
            </div>
        </div>
        
        <a href="boy.php">
            <div class="profile">
                <img class="profile-icon" src="../image/PLogo.png" alt="Profile Icon"/>
                <h2>Profile</h2>   
            </div>
        </a>
    </header>


    <div class="main-container">
        <div class="container">
            <a href="learn.php">
                <img src="../image/bbook.png" alt="Learn Image" class="container-image">
                <button class="container-button">Learn<br>(Matuto)</button>
            </a>
        </div>

        <div class="container">
            <a href="challenge.php">
                <img src="../image/pen.png" alt="Challenge Image" class="challenge-image">
                <button class="challenge-button">Challenge<br>(Pagsubok)</button>
            </a>
        </div>
    </div>
    
</body>
</html>