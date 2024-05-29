<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account</title>
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

    <!-- CSS file link -->
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container form .error-msg {
            margin: 10px 0;
            display: block;
            background: crimson;
            color: white;
            border-radius: 5px;
            font-size: 20px;
            padding: 10px;
        }
        .form-container form .success-msg {
            margin: 10px 0;
            display: block;
            background: #65B741;
            color: white;
            border-radius: 5px;
            font-size: 20px;
            padding: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var cpasswordField = document.getElementById("cpassword");
            var checkbox = document.getElementById("showPassword");

            if (checkbox.checked) {
                passwordField.type = "text";
                cpasswordField.type = "text";
            } else {
                passwordField.type = "password";
                cpasswordField.type = "password";
            }
        }

        $(document).ready(function() {
            $('#accountForm').on('submit', function(e) {
                e.preventDefault(); 

                var isValid = true;
                var errorMessage = "";

                $('#accountForm input').each(function() {
                    var minLength = $(this).attr('minlength');
                    var maxLength = $(this).attr('maxlength');
                    var valueLength = $(this).val().length;

                    if (minLength && valueLength < minLength) {
                        isValid = false;
                        errorMessage += $(this).attr('placeholder') + " must be at least " + minLength + " characters long.\n";
                    }

                    if (maxLength && valueLength > maxLength) {
                        isValid = false;
                        errorMessage += $(this).attr('placeholder') + " must be less than " + maxLength + " characters long.\n";
                    }

                    if ($(this).attr('type') === 'email' && !isValidEmail($(this).val())) {
                        isValid = false;
                        errorMessage += "Check your email.\n";
                    }
                });

                if (isValid) {
                    // Perform AJAX request
                    $.ajax({
                        type: 'POST',
                        url: 'create.php',
                        data: $('#accountForm').serialize(),
                        success: function(response) {
                            if (response.includes('Email is already registered')) {
                                $('#message').html('<div class="error-msg">Email is already registered</div>');
                            } else if (response.includes('Username already taken')) {
                                $('#message').html('<div class="error-msg">Username already taken</div>');
                            } else if (response.includes('Passwords do not match')) {
                                $('#message').html('<div class="error-msg">Passwords do not match</div>');
                            } else if (response === 'success') {
                                $('#message').html('<div class="success-msg">Account Created</div>');
                                setTimeout(function() {
                                    window.location.href = 'landing_page.php';
                                }, 3000); // 3 seconds delay
                            } else {
                                $('#message').html('<div class="error-msg">Error: ' + response + '</div>');
                            }
                        },
                        error: function(xhr, status, error) {
                            $('#message').html('<div class="error-msg">Error: ' + xhr.responseText + '</div>');
                        }
                    });
                } else {
                    $('#message').html('<div class="error-msg">' + errorMessage + '</div>');
                }
            });
        });


        function isValidEmail(email) {
            var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return pattern.test(email);
        }
    </script>
</head>

<body>
    <div class="form-container ">
    <div class="login d-flex justify-content-center">
        <form id="accountForm" action="" method="post">
            <h1 class= "fw-normal text-center">Create account</h1><br>

            <div id="message"></div>

            <div class="mb-3">
                <input type="text" class="form-control border border-dark" name="fname" id="fname" placeholder="First name" required maxlength="20" size="20">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control border border-dark" name="lname" id="lname" placeholder="Last name" required maxlength="20" size="20">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control border border-dark" name="email" id="email" placeholder="Email" required maxlength="50" size="20">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control border border-dark" name="uname" id="uname" placeholder="Username" required maxlength="20" size="20">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-text border border-dark">
                    <input class="form-check-input mt-0" type="checkbox" id="showPassword" onchange="togglePassword()">
                </div>
                <input type="password" class="form-control border border-dark" name="password" id="password" placeholder="Enter password" required minlength="8" maxlength="20" size="20">
            </div>

            <div class="mb-3">
                <input type="password" class="form-control border border-dark" name="cpassword" id="cpassword" placeholder="Re-type password" required minlength="8" maxlength="20" size="20">
            </div>
            
            <div class="mb-3">
                <input class="form-control border border-dark" name="role" id="role" type="text" value="student" aria-label="Student" readonly>            
            </div>
            <div class="mb-3">
            <select class="form-select border border-dark" name="SQuestion" id="SQuestion" aria-placeholder="Security Question" required>
                <option value="" disabled selected hidden>-- Select one (1) security question --</option>
                <option value="Nickname">Nickname</option>
                <option value="Birthplace">Birthplace</option>
                <option value="Pet's Name">Pet's Name</option>
            </select>
            </div>
            <div class="mb-3 pt-2">
                <input type="text" class="form-control border border-dark" name="SQAnswer" id="SQAnswer" placeholder="Security answer" required maxlength="20" size="20">
            </div>
            

            <button type="submit" class="btn-create">Create account</button>
            <p>Already have an account? <a href="login.php">Login</a></p>

            <!-- <select class="form-select" name="role" id="role" aria-placeholder="Student" required>
                <option value="" disabled selected hidden>-- Select your role --</option>
                <option value="student">Student</option>
            </select> -->

            <!-- <div class="name-inputs">
                <input type="text" name="fname" id="fname" placeholder="First name" required maxlength="20" size="20">
                <input type="text" name="lname" id="lname" placeholder="Last name" required maxlength="20" size="20">
            </div>
            <div class="others">
                <input type="email" name="email" id="email" placeholder="Email" required maxlength="50" size="20"><br>
                <input type="text" name="uname" id="uname" placeholder="Username" required maxlength="20" size="20"><br>
                <input type="password" name="password" id="password" placeholder="Enter password" required minlength="8" maxlength="20" size="20"><br>
                <input type="password" name="cpassword" id="cpassword" placeholder="Re-type password" required minlength="8" maxlength="20" size="20"><br>
                <select name="role" id="role" aria-placeholder="Student" required>
                    <option value="" disabled selected hidden>-- Select your role --</option>
                    <option value="student">Student</option>
                </select>
                <select name="SQuestion" id="SQuestion" aria-placeholder="Security Question" required>
                    <option value="" disabled selected hidden>-- Select one (1) security question --</option>
                    <option value="Nickname">Nickname</option>
                    <option value="Birthplace">Birthplace</option>
                    <option value="Pet's Name">Pet's Name</option>
                </select>
                <input type="text" name="SQAnswer" id="SQAnswer" placeholder="Security answer" required maxlength="20" size="20"><br>
                <input type="checkbox" id="showPassword" onchange="togglePassword()"> -->
                <!-- <label for="showPassword">Show Password</label> -->
        </form>
    </div>
    </div>
</body>

</html>
