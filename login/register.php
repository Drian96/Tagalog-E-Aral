<?php include ('head.php')?> 

<body>
    <div class="container">
        <div class="box form-box">

        <?php 
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require '../vendor/autoload.php'; // Adjust the path to autoload.php

        include("../p/config.php");

        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

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
                    // Password validation: minimum 5 characters, at least one uppercase letter and one number
                    if(strlen($password) >= 5 && preg_match('/^(?=.*[A-Z])(?=.*\d).+$/', $password)){
                        // Hash the password using bcrypt
                        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                        $verificationCode = rand(100000, 999999); // Generate a random 6-digit code

                        // Insert user into the database with the hashed password and verification code
                        $insert_query = "INSERT INTO users (Username, Email, Password, verificationCode) VALUES ('$username', '$email', '$hashed_password', '$verificationCode')";

                        if(mysqli_query($con, $insert_query)){
                            // Send verification email
                            $mail = new PHPMailer(true);
                            try {
                                // SMTP Configuration
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'earaltagalog@gmail.com'; // Your Gmail
                                $mail->Password = 'ecsq vvgg askj nsbv'; // App password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Port = 587;

                                // Email settings
                                $mail->setFrom('earaltagalog@gmail.com', 'Tagalog E-Aral'); // Sender
                                $mail->addAddress($email); // Recipient

                                $mail->isHTML(true);
                                $mail->Subject = 'Email Verification';
                                $mail->Body = "<h1>Email Verification</h1>
                                               <p>Your verification code is: <strong>$verificationCode</strong></p>";

                                $mail->send();

                                echo "<div class='message'>
                                          <p>Registration successful! Please check your email for the verification code.</p>
                                      </div> <br>";
                                echo "<a href='../login/verify.php'><button class='btn'>Verify Now</button>";

                            } catch (Exception $e) {
                                echo "<div class='message'>
                                          <p>Registration successful, but the email could not be sent. Error: {$mail->ErrorInfo}</p>
                                      </div> <br>";
                                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                            }
                        } else {
                            echo "Error: " . mysqli_error($con);
                        }

                    } else {
                        echo "<div class='message'>
                                  <p>Password must be at least 5 characters long, contain at least one uppercase letter, and one number!</p>
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
                <div id="password-warning" class="validation-warning"></div>
            </div>

            <div class="field input">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" autocomplete="off" required>
                <span class="toggle-password" onclick="togglePassword('confirm_password')">👁️</span>
                <div id="confirm-password-warning" class="validation-warning"></div>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Register">
            </div>
            <div class="links">
                Already have an account? <a href="login.php">Sign In</a>
            </div>
        </form>
        </div>

        <?php } ?>

    </div>

    <script>
        function togglePassword(id) {
            const passwordField = document.getElementById(id);
            const type = passwordField.type === "password" ? "text" : "password";
            passwordField.type = type;
        }

        // Client-side password validation
        const passwordInput = document.getElementById("password");
        const passwordWarning = document.getElementById("password-warning");

        passwordInput.addEventListener("input", () => {
            const password = passwordInput.value;
            if (password.length < 5) {
                passwordWarning.textContent = "Password must be at least 5 characters.";
            } else if (!/[A-Z]/.test(password) || !/\d/.test(password)) {
                passwordWarning.textContent = "Password must contain at least one uppercase letter and one number.";
            } else {
                passwordWarning.textContent = "";
            }
        });
    </script>
</body>
</html>
