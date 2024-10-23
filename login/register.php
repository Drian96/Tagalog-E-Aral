<?php include ('head.php')?>

<body>
    
    <div class="container">
        <div class="box form-box">

        <?php 
        include("../p/config.php");

        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password']; // Get confirm password

            // Verifying the unique email
            $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");

            if(mysqli_num_rows($verify_query) != 0){
                echo "<div class='message'>
                          <p>This email is already in use, try another one please!</p>
                      </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
            } else {
                // Check if passwords match
                if($password !== $confirm_password){
                    echo "<div class='message'>
                              <p>Passwords do not match! Please try again.</p>
                          </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                } else {
                    // Password validation (must contain at least one uppercase letter and one number)
                    if(preg_match('/^(?=.*[A-Z])(?=.*\d).+$/', $password)){
                        // Hash the password using bcrypt
                        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                        // Insert the user into the database with the hashed password
                        $insert_query = "INSERT INTO users (Username, Email, Password) VALUES ('$username', '$email', '$hashed_password')";

                        if(mysqli_query($con, $insert_query)){
                            echo "<div class='message'>
                                      <p>Registration successful!</p>
                                  </div> <br>";
                            echo "<a href='../index.php'><button class='btn'>Login Now</button>";
                        } else {
                            echo "Error: " . mysqli_error($con);
                        }

                    } else {
                        echo "<div class='message'>
                                  <p>Password must contain at least one uppercase letter and one number!</p>
                              </div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                    }
                }
            }
        } else {
        ?>

        <header>Sign Up</header>
        <form action="" method="post" id="registrationForm">
            <div class="field input">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" autocomplete="off" required placeholder="Child Nickname">
            </div>

            <div class="field input">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off" required>
                <span class="toggle-password" onclick="togglePassword('password')">👁️</span>
                <div id="password-warning" class="validation-warning"></div> <!-- Real-time validation -->
            </div>

            <div class="field input">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" autocomplete="off" required>
                <span class="toggle-password" onclick="togglePassword('confirm_password')">👁️</span>
                <div id="confirm-password-warning" class="validation-warning"></div> <!-- Real-time match warning -->
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Register" required>
            </div>
            <div class="links">
                Already have an account? <a href="login.php">Sign In</a>
            </div>
        </form>
        </div>

        <?php } ?>

    </div>

    <script src="login.js"></script>

</body>
</html>
