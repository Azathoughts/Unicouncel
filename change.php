<?php
include 'config.php';

session_start(); // Start session

$error = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    // Reset messages on each form submission
    unset($_SESSION['error']);
    unset($_SESSION['success_message']);

    // Check if the username exists in the database
    $check_user = "SELECT * FROM accounts WHERE username = '$uname'";
    $result = mysqli_query($conn, $check_user);
    if (mysqli_num_rows($result) == 0) {
        $_SESSION['error'] = 'Incorrect Username'; // Store error message in session
    } else {
        if ($password != $cpassword) {
            $_SESSION['error'] = 'Passwords do not match!'; // Store error message in session
        } else {
            $update = "UPDATE accounts SET password = '$password' WHERE username = '$uname'";
            mysqli_query($conn, $update);
            $_SESSION['success_message'] = 'Password Changed Successfully'; // Store success message in session
            header("Location: landing_page.php"); // Redirect to landing page
            exit(); // Exit script
        }
    }
}

// Fetch error and success messages if the form was submitted
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="shortcut icon" type="image/png" href="images/Icon.png">
    <link rel="stylesheet" href="style.css">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Sans:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">

    <!-- css file link -->
    <link rel="stylesheet" href="style.css">
    <!-- font awesome cdn link 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> -->
    <!-- bootstrap cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
</head>

<body>
    <div class="form-container">
        <div class="login d-flex justify-content-center">
        <form method="post" action="">
        <h1 class="fw-normal text-center">Change Password</h1><br>
        <?php if ($error) : ?>
                <div id="message">
                    <span class="error-msg"><?php echo $error; ?></span>
                </div>
            <?php elseif ($success_message) : ?>
                <div id="message">
                    <span class="success-msg"><?php echo $success_message; ?></span>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <input type="text" class="form-control border border-dark" name="uname" id="uname" placeholder="Username" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text border border-dark">
                    <input class="form-check-input mt-0" type="checkbox" id="showPasswords" onclick="togglePasswordVisibility('password','cpassword')">
                </div>
                <input type="password" class="form-control border border-dark" name="password" id="password" placeholder="New password" required minlength="8" maxlength="20" size="20">
            </div>

            <div class="mb-3">
                <input type="password" class="form-control border border-dark" name="cpassword" id="cpassword" placeholder="Re-type new password" required minlength="8" maxlength="20" size="20">
            </div>
            <button type="submit" class="update">Change password</button>
            </form>
    </div>
    </div>
        


    <!-- <div class="form-container">
        <form method="post" action="">
            <h3>Change Password</h3>
            <h2>Enter the required credentials to change your password.</h2>
            <?php if ($error) : ?>
                <div id="message">
                    <span class="error-msg"><?php echo $error; ?></span>
                </div>
            <?php elseif ($success_message) : ?>
                <div id="message">
                    <span class="success-msg"><?php echo $success_message; ?></span>
                </div>
            <?php endif; ?>
            <div class="others">
                <input type="text" name="uname" id="uname" placeholder="Enter username" required><br>
                <div class="row g-3 mb-3">
                    <input type="password" name="password" id="password" placeholder="Enter password" minlength="8" maxlength="20" required><br>
                    <input type="password" name="cpassword" id="cpassword" placeholder="Confirm password" minlength="8" maxlength="20" required><br>
                    <input type="checkbox" id="showPasswords" onclick="togglePasswordVisibility('password','cpassword')">
                    <label for="showPasswords">Show Passwords</label>
                </div>
            </div>
            <button type="submit" class="update">Change Password</button>
        </form>
    </div> -->

    <script>
        function togglePasswordVisibility(field1, field2) {
            var passwordField = document.getElementById(field1);
            var cpasswordField = document.getElementById(field2);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                cpasswordField.type = "text";
            } else {
                passwordField.type = "password";
                cpasswordField.type = "password";
            }
        }
    </script>
</body>

</html>
