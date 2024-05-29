<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="shortcut icon" type="image/png" href="images/Icon.png">

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
        <form id="forgot_pass" method="post" action="">
            <h1 class="fw-normal text-center">Forgot Password</h1>
            <div id="message"></div>
            <br>

            <div class="mb-3">
                <input type="email" class="form-control border border-dark" name="email" id="email" placeholder="Email" required="20">
            </div>
            <div class="mb-3">
            <select class="form-select border border-dark" name="SQuestion" id="SQuestion" required>
                <option value="" disabled selected hidden>-- Select one (1) security question --</option>
                <option value="Nickname">Nickname</option>
                <option value="Birthplace">Birthplace</option>
                <option value="Pet's Name">Pet's Name</option>
            </select>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control border border-dark" name="SQAnswer" id="SQAnswer" placeholder="Security answer" required>
            </div>

            <!-- <div class="others">
                <input type="email" class="mb-2 rounded" name="email" id="email" placeholder="Enter email" required><br>
                <select name="SQuestion" id="SQuestion" required>
                    <option value="" disabled selected hidden>Security Question</option>
                    <option value="Nickname">Nickname</option>
                    <option value="Birthplace">Birthplace</option>
                    <option value="Pet's name">Pet's name</option>
                </select>
                <input type="text" name="SQAnswer" id="SQAnswer" placeholder="Enter Security Answer" required><br>
            </div> -->

            <button type="button" class="update" onclick="verifyData()">Verify</button>
            <p>Remembered your password? <a href="landing_page.php">Log in</a></p>
        </form>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        function verifyData() {
            var email = $("#email").val();
            var squestion = $("#SQuestion").val();
            var sqanswer = $("#SQAnswer").val();

            $.ajax({
                type: "POST",
                cache: false,
                url: 'verify_data.php', // Update with the actual PHP file for verification
                data: {
                    email: email,
                    SQuestion: squestion,
                    SQAnswer: sqanswer,
                    verify: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Display success message or perform further actions
                        if (response.message) {
                            $("#message").html('<span class="error-msg">' + response.message + '</span>').show();
                        }
                        // Add a 3-second delay before redirecting to change.php
                        setTimeout(function() {
                            window.location.href = 'change.php';
                        }, 3000); // 3-second delay
                    } else {
                        // Display error message
                        if (response.message) {
                            $("#message").html('<span class="error-msg">' + response.message + '</span>').show();
                        } else {
                            $("#message").html('').hide(); // No message, hide the message div
                        }
                        // Highlight incorrect input fields except for the message container
                        $("#email, #SQuestion, #SQAnswer").removeClass("error"); // Remove previous errors
                        if (response.errorFields) {
                            response.errorFields.forEach(function(fieldId) {
                                if (fieldId !== "message") { // Exclude the message container
                                    $("#" + fieldId).addClass("error");
                                }
                            });
                        }
                        // Show error red bar if there is an error message and it's not in #message
                        if (response.message && !$("#message").find('.error-msg').length) {
                            $("#message").addClass("error").show(); // Show the error message and red bar
                        }
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error: " + xhr.responseText);
                },
                complete: function() {
                    // Clear form inputs after processing
                    $("#email, #SQuestion, #SQAnswer").val('');
                }
            });
        }
    </script>
</body>

</html>
