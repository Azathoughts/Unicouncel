<?php
include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: landing_page.php");
    exit();
}

$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];

$query = "SELECT COUNT(*) AS counselor_count FROM accounts WHERE role = 'guidance_counselor'";
$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if ($result) {
    // Fetch the count from the result
    $row = mysqli_fetch_assoc($result);
    $counselor_count = $row['counselor_count'];
} else {
    // Error handling if the query fails
    $counselor_count = 0;
}

$student_count = 0;

// Query to count registered student accounts
$sql = "SELECT COUNT(*) AS student_count FROM accounts WHERE role = 'student'";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Fetch the count
    $row = mysqli_fetch_assoc($result);
    $student_count = $row['student_count'];
} else {
    // Error handling
    echo "Error: " . mysqli_error($conn);
}
// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unicounsel | admin</title>

    <link rel="shortcut icon" type="image/png" href="images/Icon.png">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Sans:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- css file link -->
    <link rel="stylesheet" href="student.css">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- bootstrap cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>

<body>

    <!-- sidebar start-->
    <section id="sidebar">
        <div class="cname">
            <span class="name"><?php echo $firstname . " " . $lastname; ?></span>
            <h4>admin</h4>
        </div>

        <ul class="side-menu top">
            <li class="active">
                <a href="#" onclick="showSection(event, 'dashboardadmin')">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="#" onclick="showSection(event, 'manage_acc')">
                    <i class='bx bxs-user-account'></i>
                    <span class="text">Manage Accounts</span>
                </a>
            </li>

            <li>
                <a href="#" onclick="showSection(event, 'create_acc')">
                    <i class='bx bxs-user-account'></i>
                    <span class="text">Create Account</span>
                </a>
            </li>

            <li>
                <a href="logout.php">
                    <i class='bx bxs-log-out'></i>
                    <span class="text">Log out</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- sidebar end-->

    <!-- navbar -->
    <nav>
        <h2 class="logo"><span>U</span> n i c o u n s e l</h2>
    </nav>
    <!-- navbar-->

    <div class="content">
        <!-- dashboard start -->
        <section id="dashboardadmin" class="active">
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                </div>
            </div>
            <div class="row g-3 mb-3 mt-4 justify-content-md-center">
                <div class="col-6">
                    <div class="card text-center border-success border border-4 ms-5" style="width: 45rem;">
                        <div class="card-body">
                            <ul class="box-info">
                                <li>
                                    <span class="text">
                                        <h1 class="text-center"><?php echo $counselor_count; ?></h1><br>
                                        <p class="fs-3"> <i class="fa-solid fa-user-check "></i> Registered Guidance Counselor Accounts </p>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card text-center border-success border border-4 ms-5" style="width: 35rem;">
                        <div class="card-body">
                            <ul class="box-info">
                                <li>
                                    <span class="text">
                                        <h1 class="text-center"><?php echo $student_count; ?></h1><br>
                                        <p class="fs-3 text-center"> <i class="fa-solid fa-user-check"></i> Registered Student Accounts</p>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <h3 class="ms-4">LOGIN HISTORY</h3>
            <div id="loginHistoryTable">
                <!-- The table content will be loaded dynamically here -->
            </div>

            <!-- Your JavaScript code for updating the table content goes here -->
            <script>
                $(document).ready(function() {
                    loadLoginHistory(); // Load login history when the page is ready
                });

                function loadLoginHistory() {
                    var tableContainer = $("#loginHistoryTable");
                    if (tableContainer.length > 0) {
                        $.ajax({
                            url: "login_history_data.php", // PHP script to fetch login history data
                            type: "POST",
                            success: function(response) {
                                tableContainer.html(response);
                            },
                            error: function(xhr, status, error) {
                                console.error("Failed to load login history data. Status: " + status + ", Error: " + error);
                            }
                        });
                    } else {
                        console.error("Login history table container not found.");
                    }
                }
            </script>
        </section>
        <!-- dashboard end -->


        <!--manage start-->
        <section id="manage_acc">
            <h1>MANAGE ACCOUNTS</h1>
            <!-- HTML code -->
            <div id="accountsTableContainer"></div>

            <script>
                $(document).ready(function() {
                    loadAccountsTable(); // Load accounts table when the page is ready
                });

                function loadAccountsTable() {
                    var tableContainer = $("#accountsTableContainer");
                    if (tableContainer.length > 0) {
                        $.ajax({
                            url: "account_table_data.php",
                            type: "POST",
                            success: function(response) {
                                tableContainer.html(response); // Update the table content in the container
                            },
                            error: function(xhr, status, error) {
                                console.error("Failed to load accounts table data. Status: " + status + ", Error: " + error);
                            }
                        });
                    } else {
                        console.error("Accounts table container not found.");
                    }
                }

                function disableAccount(id) {
                    $.ajax({
                        url: "disabled.php",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            if (response === "success") {
                                loadAccountsTable();
                            } else {
                                console.error("Failed to disable account.");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Failed to disable account. Status: " + status + ", Error: " + error);
                        }
                    });
                }

                function enableAccount(id) {
                    $.ajax({
                        url: "enabled.php",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            if (response === "success") {
                                // Reload the table or do any other action if needed
                                loadAccountsTable();
                            } else {
                                console.error("Failed to enable account.");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Failed to enable account. Status: " + status + ", Error: " + error);
                        }
                    });
                }
            </script>

        </section>
        <!--manage end-->

        <!--create start-->
        <section id="create_acc">
            <h1>CREATE ACCOUNT (For Admin and Guidance Counselor)</h1>
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
                $SQA = md5($_POST['SQAnswer']);

                $select = "SELECT * FROM accounts WHERE email = '$email' && password = '$password' ";

                $result = mysqli_query($conn, $select);

                if (mysqli_num_rows($result) > 0) {
                    $error[] = 'Account already exists!';
                } else {
                    if ($password != $cpassword) {
                        $error[] = 'Passwords do not match!';
                    } else {
                        $insert = "INSERT INTO accounts (firstname, lastname, email, username, password, role, SQ, SQA) VALUES ('$fname','$lname','$email','$uname','$password','$role', '$SQ', '$SQA')";
                        mysqli_query($conn, $insert);
                        header('location:landing_page.php');
                    }
                }
            };
            ?>
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
            </script>
            </head>

            <body>

                <div class="container mt-5 mx-5 my-5 ">
                    <form action="" method="post">
                        <?php
                        if (isset($error)) {
                            foreach ($error as $error) {
                                echo '<span class="error-msg">', $error . '</span>';
                            };
                        };
                        ?>
                        <div class="row g-3 mb-3">
                            <div class="col-4">
                                <label for="fname" class="form-label fw-bold">First name</label>
                                <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter first name" required minlength="1" maxlength="20" size="20">
                            </div>

                            <div class="col-4">
                                <label for="lname" class="form-label fw-bold">Last name</label>
                                <input type="text" name="lname" id="lname" class="form-control" placeholder=" Enter last name" required minlength="1" maxlength="20" size="20">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-4">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter valid email" required minlength="1" maxlength="50" size="20">
                            </div>

                            <div class="col-4">
                                <label for="uname" class="form-label fw-bold">Username</label>
                                <input type="text" name="uname" id="uname" class="form-control" placeholder="Enter username" required minlength="8" maxlength="10" size="10">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-4">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required minlength="8" maxlength="10" size="10">
                                <input type="checkbox" id="showPassword" class="ms-2 mt-2" onchange="togglePassword()">
                                <label for="showPassword"> Show Passwords</label>
                            </div>

                            <div class="col-4">
                                <label for="cpassword" class="form-label fw-bold">Confirm password</label>
                                <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm password" required minlength="8" maxlength="10" size="10">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-2">
                                <label for="role" class="form-label fw-bold">Role</label>
                                <select name="role" id="role" class="form-select" placeholder="-- Select --" required>
                                    <option value="" disabled selected hidden>Select Role</option>
                                    <option value="guidance_counselor">Guidance Counselor</option>
                                    <option value="admin">admin</option>
                                </select>
                            </div>

                            <div class="col-2">
                                <label for="SQuestion" class="form-label fw-bold">Security question</label>
                                <select name="SQuestion" id="SQuestion" class="form-select" placeholder="-- Select --" required>
                                    <option value="" disabled selected hidden>Security Question</option>
                                    <option value="Nickname">Nickname</option>
                                    <option value="Birthplace">Birthplace</option>
                                    <option value="Pet's name">Pet's name</option>
                                </select>
                            </div>

                            <div class="col-4">
                                <label for="SQAnswer" class="form-label fw-bold">Security answer</label>
                                <input type="SQA" name="SQAnswer" id="SQAnswer" class="form-control" placeholder="Enter security answer" required minlength="1" maxlength="20" size="20">
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-block">
                            <button class="btn btn-secondary" type="button"><a href="#" onclick="showSection(event, 'dashboardadmin')">Cancel</a></button>
                            <button type="submit" class="btn btn-primary">Create account</button>
                        </div>
                    </form>
                </div>
        </section>
        <!--create end-->
    </div>

    <script src="admin_js.js"></script>

</body>

</html>
