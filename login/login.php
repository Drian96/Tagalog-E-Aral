<?php session_start(); ?>
<?php include('head.php'); ?>

<body">

<div class="container">
    <div class="box form-box">

    <?php 
        include("../p/config.php");
        if(isset($_POST['submit'])){
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = mysqli_real_escape_string($con, $_POST['password']);

            // Fetch the user with the provided email
            $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email'") or die("Select Error");
            $row = mysqli_fetch_assoc($result);

            if($row){
                // Verify the provided password with the stored hashed password
                if(password_verify($password, $row['Password'])){
                    // Password is correct, start the session
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['id'] = $row['Id'];
                    $_SESSION['is_admin'] = $row['is_admin']; // Store admin status in session
                    
                    // Fetch user's total stars and store in the session
                    $userId = $row['Id'];
                    $starsQuery = "SELECT totalStars FROM users WHERE Id='$userId'";
                    $starsResult = mysqli_query($con, $starsQuery);
                    $starsRow = mysqli_fetch_assoc($starsResult);
                    $_SESSION['totalStars'] = $starsRow['totalStars']; // Store total stars in session

                    // Reset the question counter when the user logs in
                    $_SESSION['current_question'] = 0; // This ensures the quiz starts fresh

                    // Redirect based on user role
                    if($row['isAdmin'] == 1){
                        header("Location: ../Fadmin/main.php"); // Admin area
                    } else {
                        header("Location: ../user/quiz/startA.php"); // Regular user area
                    }
                    exit(); // Make sure no further code is executed after redirection
                } else {
                    // Password is incorrect
                    echo "<div class='message'>
                            <p>Wrong Username or Password</p>
                          </div> <br>";
                    echo "<a href='login.php'><button class='btn'>Go Back</button>";
                }
            } else {
                // User not found
                echo "<div class='message'>
                        <p>Wrong Username or Password</p>
                      </div> <br>";
                echo "<a href='login.php'><button class='btn'>Go Back</button>";
            }
        } else {
    ?>

    <header>Login</header>
    <form action="" method="post">
        <div class="field input">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" autocomplete="off" required>
        </div>

        <div class="field input">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" autocomplete="off" required>
        </div>

        <div class="field">
            <input type="submit" class="btn" name="submit" value="Login" required>
        </div>
        <div class="links">
            Don't have an account? <a href="register.php">Sign Up Now</a>
        </div>
    </form>
</div>
<?php } ?>
</div>

</body>
</html>
