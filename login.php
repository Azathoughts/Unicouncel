<?php
session_start();
include 'config.php';

$error = ""; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    // Get user's IP address
    $ipAddress = $_SERVER['REMOTE_ADDR'];

    $query = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if ($row['enabled'] == 1) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];

            // Insert login history data
            $userId = $row['id'];
            $loginTime = date("Y-m-d H:i:s");
            $insertQuery = "INSERT INTO login_history (user_id, login_time, ip_address) VALUES ('$userId', '$loginTime', '$ipAddress')";
            mysqli_query($conn, $insertQuery);

            switch ($_SESSION['role']) {
                case 'admin':
                    header('Location: admin_page.php');
                    break;
                case 'student':
                    header('Location: student_page.php');
                    break;
                case 'guidance_counselor':
                    header('Location: counselor_page.php');
                    break;
                default:
                    break;
            }
        } else {
            $error = "Account is disabled. Contact your admin";
        }
    } else {
        $error = "Incorrect username or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unicounsel</title>
    <link rel="shortcut icon" type="image/png" href="images/Icon.png">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Sans:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">

    <!-- css file link -->
    <link rel="stylesheet" href="lStyle.css">
    <!-- font awesome cdn link 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> -->
    <!-- bootstrap cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            
        }
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login form {
            width: 400px;
            border-radius: .5rem;
            background-color: white;
            padding: 2rem;
            box-shadow: 0px 16px 48px 0px rgba(0,0,0,0.176);
        }
        .login form, .box {
            width: 70%;
            margin-top: 1rem;
            margin-bottom: 2rem;
            border-radius: 28px;
            padding: 30px 30px;
            font-size: 20px;
            color: black;
            text-transform: none;
        }
        .login input {
            padding: 10px 15px;
            width: 100%;
            margin-bottom: 15px;
            border-style: solid;
            border-color: #333;
            border-width: 1px;
        }
        .login .passinput {
            margin-bottom: .3rem;
        }

        .login hr {
            margin: 1.5rem 0;
        }
        .loginbtn {
            margin-bottom: .5rem;
            font-size: 20px;
            font-weight: 400;
            height: 3rem;
            width: 100%;
            border-radius: 0.5rem;
            background-color: #65B741;;
            color: white;
        }
        .loginbtn:hover{
            font-weight: 700;
        }
        .login .forgotlink {
            display: block;
            text-align: center;
            margin-top: 1rem;
        }

        
    </style>
</head>
<body>
    <div class="form-container">
        <!-- login form start-->
        <div class="login d-flex justify-content-center">
            <form action="" method="post">
                <h1 class="fw-normal text-center">Login</h1><br>
                <?php if (!empty($error)) : ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <input class="mb-4 rounded" type="text" name="username" id="username" placeholder="Username" required class="box">
                <input class="passinput rounded" type="password" name="password" id="password" placeholder="Password" required class="box">
                <a class="forgotlink fs-6 mb-4" href="forgot_pass.php">Forgot password?</a>
                <button type="submit" name="submit" class="loginbtn">Log in</button>
                <!-- <hr width="100%" size="3" color="black"> -->
                <p class="fs-6 text-center mt-2">Don't have an account yet?<a href="create_account.php"> Create</a> one today!</p>
            </form>
        </div>
        <!-- login form end-->
    </div>
</body>
</html>
