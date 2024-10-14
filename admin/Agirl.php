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
    <title>Profile</title>

    <style>
        <?php include('../css/style.css'); ?>
        body{
            background-image: url("../image/girl-bg.jpg");
            background-position: center;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /********star design*******/
        .star-container {
            display: flex;
            align-items: center;
            padding: 5px 5px;
            border: 1px solid black;
            border-radius: 10px;
            background-color: #FFA1A1;
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
        /******theme & menu******/
        .girl-icon{
            width: 70px;
            height: auto;
        }
        .menu-icon{
            width: 30px;
            height: auto;
        }
        /*******profile*******/
        .main-profile {
            padding: 100px;
            /*border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);*/
            text-align: left;
            width: 60%;
            height: auto;
            margin-top: 10px;
        }
        .profile-pic h1{
            text-align: center;
            margin-bottom: 15px;
        }
        .content-wrapper {
            display: flex;
            align-items: center;
        }
        .profile-pic img {
            width: 200px;
            height: auto;
            margin-right: 20px;
        }
        .username{
            margin-bottom: 30px;
        }
        .badges h3, .profile-pic h1{
            color: #EB00D3;
            margin-bottom: 5px;
        }
        .badges {
            margin-top: 10px;
        }
        .badge-container {
            background-color: #b44799;
            border-radius: 15px;
            display: flex;
            gap: 30px;
            padding: 10px;
            flex-wrap: wrap;
            align-items: center;
            width: auto; 
            box-sizing: border-box;
        }
        .container {
            padding: 7px;
            text-align: center;
            max-width: 300px;
            width: 20%;
            transition: transform 0.3s;
            color: var(--yellow-color);
        }
        .container:hover{
            transform: scale(1.05);
        }
        .container-image {
            width: 80%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .star{
            width: 25px;
            height: auto;
        }
        .text-with-star {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .text-with-star h2 {
            margin: 0;
            margin-right: 5px;
        }

    </style>

</head>
<body>
    <header>
        <div class="mini-title">
            <a href="Amain.php">
                <h1>Tagalog E-Aral</h1>
            </a>
        </div>

        <div class="star-container">
            <div class="star-item">
                <span class="star-text">0</span>
            </div>
            <div class="star-item">
                <img src="../image/str.png" alt="Star Icon" class="star-icon">
            </div>
        </div>

        <a href="Aboy.php">
            <img class="girl-icon" src="../image/BoyIcon.png" alt="girl-icon">
        </a>

        <div class="menu">
            <img class="menu-icon" src="../image/menu-icon.png" alt="menu-icon" onclick="toggleMenu()"/>
        <!-- Dropdown Menu -->
            <div class="dropdown-menu" id="profileMenu">
                <a href="../login/editAdmin.php">Edit Profile</a>
                <a href="../p/logout.php">Logout</a>
            </div>
        </div>
    </header>

    <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['Username'];
            }
            ?>

    <div class="main-profile">
        <div class="content-wrapper">
            <div class="profile-pic">
                <div class="username">
                    <h1><?php echo $res_Uname ?></h1>
                </div>
                <img src="../image/girl.webp" alt="Boy" id="boy">
            </div>
            <div class="achievements-and-badges">
                <div class="badges">
                    <h3>Achievements</h3>
                    <div class="badge-container">

                        <div class="container">
                            <img src="../image/qCircle.jpg" alt="Learn Image" class="container-image">
                            <div class="easy-text">
                                <h2 class="container-button">Easy</h2>
                            </div>
                        </div>
                            
                        <div class="container">
                            <img src="../image/qCircle.jpg" alt="Challenge Image" class="container-image">
                            <div class="average-text">
                                <h2 class="container-button">Average</h2>                                    
                            </div>
                        </div>

                        <div class="container">
                            <img src="../image/qCircle.jpg" alt="Challenge Image" class="container-image">
                            <div class="hard-text">
                                <h2 class="container-button">Hard</h2>              
                            </div>
                        </div>

                    </div>
                </div>

                <div class="badges">
                    <h3>Badges</h3>
                    <div class="badge-container">

                        <div class="container">
                            <img src="../image/qCircle.jpg" alt="Learn Image" class="container-image">
                            <div class="text-with-star">
                                <h2 class="container-button">10</h2>
                                <img src="../image/str.png" alt="star" class="star"> 
                            </div>
                        </div>
                            
                        <div class="container">
                            <img src="../image/qCircle.jpg" alt="Challenge Image" class="container-image">
                            <div class="text-with-star">
                                <h2 class="container-button">20</h2>
                                <img src="../image/str.png" alt="star" class="star">                
                            </div>
                        </div>

                        <div class="container">
                            <img src="../image/qCircle.jpg" alt="Challenge Image" class="container-image">
                            <div class="text-with-star">
                                <h2 class="container-button">30</h2>
                                <img src="../image/str.png" alt="star" class="star">                
                            </div>
                        </div>

                        <div class="container">
                            <img src="../image/qCircle.jpg" alt="Challenge Image" class="container-image">
                            <div class="text-with-star">
                                <h2 class="container-button">40</h2>
                                <img src="../image/str.png" alt="star" class="star">                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/profile.js"></script>

</body>
</html>
