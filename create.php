<?php

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $SQ = mysqli_real_escape_string($conn, $_POST['SQuestion']);
    $SQA = md5($_POST['SQAnswer']); // Pass the actual value of SQAnswer

    $selectEmail = "SELECT * FROM accounts WHERE email = '$email'";
    $selectUsername = "SELECT * FROM accounts WHERE username = '$uname'";

    $resultEmail = mysqli_query($conn, $selectEmail);
    $resultUsername = mysqli_query($conn, $selectUsername);

    if (mysqli_num_rows($resultEmail) > 0) {
        echo 'Email is already registered';
    } elseif (mysqli_num_rows($resultUsername) > 0) {
        echo 'Username already taken';
    } else {
        if ($password != $cpassword) {
            echo 'Passwords do not match';
        } else {
            $insert = "INSERT INTO accounts (firstname, lastname, email, username, password, role, SQ, SQA) VALUES ('$fname','$lname','$email','$uname','$password','$role', '$SQ', '$SQA')";
            if (mysqli_query($conn, $insert)) {
                echo 'success';
            } else {
                echo 'Error: ' . mysqli_error($conn);
            }
        }
    }
}
