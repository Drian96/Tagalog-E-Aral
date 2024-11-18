<?php include('head.php')?>

<?php
include("../p/config.php");
$message = ""; // Initialize the message variable
$isError = false; // To track success or error state
$email = isset($_POST['email']) ? $_POST['email'] : ''; // Retain email value

if (isset($_POST['verify'])) {
    $code = $_POST['code'];

    // Check if the code matches
    $query = "SELECT * FROM users WHERE email='$email' AND verificationCode='$code'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Update the user as verified
        $update_query = "UPDATE users SET verified=true, verificationCode=NULL WHERE email='$email'";
        if (mysqli_query($con, $update_query)) {
            $message = "Email verified successfully! You can now login.";
        } else {
            $message = "An error occurred during verification. Please try again.";
            $isError = true;
        }
    } else {
        $message = "Invalid verification code. Please try again.";
        $isError = true;
    }
}
?>

<body>
    <div class="container">
        <div class="box form-box">
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>

                    <label for="code">Verification Code</label>
                    <input type="text" name="code" required><br>

                    <input type="submit" class="btn" name="verify" value="Verify">
                </div>
            </form>
        </div>
    </div>

    <!-- Popup Modal -->
    <div id="popup" class="popup <?php echo !empty($message) ? 'show' : ''; ?>">
        <div class="popup-content">
            <p id="popup-message"><?php echo $message; ?></p>
            <button id="popup-action">
                <?php echo $isError ? 'Retry' : 'Okay'; ?>
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const popup = document.getElementById('popup');
            const actionButton = document.getElementById('popup-action');
            const isError = <?php echo json_encode($isError); ?>;

            // Close popup and redirect based on success or failure
            actionButton.addEventListener('click', () => {
                if (isError) {
                    popup.classList.remove('show');
                } else {
                    window.location.href = "../login/login.php";
                }
            });
        });
    </script>
</body>
</html>
