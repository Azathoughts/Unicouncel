<?php
include 'config.php';

$response = array(); // Initialize the response array

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $SQuestion = $_POST['SQuestion'];
    $SQAnswer = md5($_POST['SQAnswer']);

    $select = "SELECT * FROM accounts WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['SQA'] == $SQAnswer && $row['SQ'] == $SQuestion) {
            // Verification successful
            $response['success'] = true;
            $response['message'] = 'Verification successful.';
        } else {
            // Incorrect Security Question Answer
            $response['success'] = false;
            $response['message'] = 'Incorrect Security Question. Try again.';
            $_POST['SQuestion'] = ''; // Clear Security Question
            $_POST['SQAnswer'] = ''; // Clear Security Question Answer
            $response['errorFields'] = ['SQuestion', 'SQAnswer']; // Add fields with errors for highlighting
        }
    } else {
        // Email not found
        $response['success'] = false;
        $response['message'] = 'Email is not registered in our database.';
        $_POST['SQuestion'] = ''; // Clear Security Question
        $_POST['SQAnswer'] = ''; // Clear Security Question Answer
        $response['errorFields'] = ['email', 'SQuestion', 'SQAnswer']; // Add fields with errors for highlighting
    }
} else {
    // Invalid request
    $response['success'] = false;
    $response['message'] = 'Invalid request.';
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
