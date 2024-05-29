<?php
include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: landing_page.php");
    exit();
}

$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION['form_submitted'])) {
    // Get user ID from accounts table
    $getUserIDQuery = "SELECT id FROM accounts WHERE firstname = '$firstname' AND lastname = '$lastname'";
    $result = mysqli_query($conn, $getUserIDQuery);
    if ($row = mysqli_fetch_assoc($result)) {
        $userId = $row['id']; // Assign the fetched user ID to $userId
    } else {
        // Handle the case where user ID is not found
        echo "Error: User ID not found.";
        exit(); // Stop further execution
    }

    // Process the form data
    $priority = mysqli_real_escape_string($conn, $_POST['priority']);
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $student_number = mysqli_real_escape_string($conn, $_POST['student_number']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $section = mysqli_real_escape_string($conn, $_POST['section']);
    $contactnumber = mysqli_real_escape_string($conn, $_POST['contactnumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $communication = mysqli_real_escape_string($conn, $_POST['communication']);

    // Check if there is a duplicate appointment time
    $checkDuplicateQuery = "SELECT id FROM pending_table WHERE time = '$time'";
    $duplicateResult = mysqli_query($conn, $checkDuplicateQuery);
    if (mysqli_num_rows($duplicateResult) > 0) {
        echo "Error: There is already an appointment scheduled at the specified time.";
        exit(); // Stop further execution
    }

    // Insert appointment with user ID
    $insert = "INSERT INTO pending_table (user_id, priority, student_name, student_number, date, time, program, year, section, contactnumber, email, comment, communication) 
               VALUES ('$userId', '$priority', '$student_name', '$student_number', '$date', '$time', '$program', '$year', '$section', '$contactnumber', '$email', '$comment', '$communication')";

    if (mysqli_query($conn, $insert)) {
        $_SESSION['form_submitted'] = true; // Mark the form as submitted
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $insert . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unicounsel | Student</title>
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
    <script src="student.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                timeFormat: "HH:mm",
                minDate: 0 // Allow selecting today and future dates only
            });
        });

        flatpickr("#datepicker", {
            enableTime: false, // Disable time selection
            dateFormat: "Y-m-d", // Date format (Year-Month-Day)
            minDate: "today" // Restrict selection to dates starting from today
        });
    </script>

</head>

<body>
    <script src="student.js"></script>
    <!-- sidebar start-->
    <section id="sidebar">
        <div class="cname">
            <span class="name"><?php echo $firstname . " " . $lastname; ?></span>
            <h4>Student</h4>
        </div>

        <ul class="side-menu top">
            <li class="active">
                <a href="#" onclick="showSection(event, 'dashboardstudent')">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="logout.php">
                    <i class='bx bxs-log-out'></i>
                    <span class="text">Log out</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <h5>APPOINTMENT</h5>
            <li>
                <a href="#" onclick="showSection(event, 'request')">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span class="text">Request an Appointment</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showSection(event, 'history')">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span class="text">Scheduled Appointments</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showSection(event, 'History')">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span class="text">Appointment History</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showSection(event, 'cancelled')">
                    <i class="fa-solid fa-calendar-xmark"></i>
                    <span class="text">Cancelled Appointments</span>
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
        <section id="dashboardstudent" class="active">
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                </div>
            </div>
            <div class="row mb-3 mt-4 justify-content-md-center">
                <div class="col-4">
                    <div class="card text-center border-success border border-4" style="width: 30rem;">
                        <div class="card-body">
                            <ul class="box-info">
                                <li>
                                    <span class="text">
                                        <h1 class="text-center"><span id="pendingRowCount">Loading...</span></h1><br>
                                        <p class="fs-3"> <i class="fa-solid fa-pen-to-square"></i> Pending Appoinments</p>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-center border-success border border-4" style="width: 32rem;">
                        <div class="card-body">
                            <ul class="box-info">
                                <li>
                                    <span class="text">
                                        <h1 class="text-center"> <span id="scheduledAppointmentCount">Loading...</span></h1><br>
                                        <p class="fs-3"> <i class="fa-solid fa-clock-rotate-left"></i> Scheduled Appointments</p>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
            <div id="appointmentTable">
                <!-- The table content will be loaded dynamically here -->
            </div>

            <!-- Your JavaScript code for updating the table content goes here -->
            <script>
                $(document).ready(function() {
                    loadTableContent(); // Load table content when the page is ready
                });

                function loadTableContent() {
                    var tableContainer = $("#appointmentTable");
                    if (tableContainer.length > 0) {
                        $.ajax({
                            url: "pending_table.php",
                            type: "POST",
                            success: function(response) {
                                tableContainer.html(response);
                            },
                            error: function(xhr, status, error) {
                                console.error("Failed to load table data. Status: " + status + ", Error: " + error);
                            }
                        });
                    } else {
                        console.error("Table container not found.");
                    }
                }
            </script>

        </section>
        <!-- dashboard end -->

        <!--request start-->
        <section id="request">
            <h1>REQUEST AN APPOINTMENT</h1>
            <h5>Please fill out all the fields to request an appointment</h5><br>
            <div class="container mt-3">
                <form action="" method="post">
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label for="priority" class="form-label fw-bold">Priority</label>
                            <select name="priority" id="priority" class="form-select" required>
                                <option value="" disabled selected hidden>-- Select --</option>
                                <option value="Low">Low - schedule when available</option>
                                <option value="High">High - schedule as soon as possible</option>
                                <option value="Emergency">Emergency - see now</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="communication" class="form-label fw-bold">Mode of Communication</label>
                            <select name="communication" id="communication" class="form-select" required>
                                <option value="" disabled selected hidden>-- Select --</option>
                                <option value="In person">In person - Counsel session at Guidance office</option>
                                <option value="Virtual">Virtual - via Zoom/Google Meet</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col md-6">
                            <label for="student_name" class="form-label fw-bold">Student Name</label>
                            <input type="text" name="student_name" id="student_name" class="form-control" placeholder="Enter student's name" minlength="1" maxlength="40" required>
                        </div>
                        <div class="col md-6">
                            <label for="student_number" class="form-label fw-bold">Student Number</label>
                            <input type="number" name="student_number" id="student_number" class="form-control" placeholder="Enter student number" minlength="1" maxlength="8" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-4">
                            <label for="college" class="form-label fw-bold">College</label>
                            <select class="form-select" name="college" id="college">
                                <option value="" disabled selected hidden>-- Select --</option>
                                <?php
                                $conn = new mysqli('localhost', 'root', '', 'unicounsel'); // Update with your actual database credentials
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $sql = "SELECT * FROM college";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['college_id'] . '">' . $row['college_name'] . '</option>';
                                    }
                                }
                                $conn->close();
                                ?>
                            </select>
                        </div>

                        <div class="col-4">
                            <label for="program" class="form-label fw-bold">Program</label>
                            <select class="form-select" name="program" id="show"> </select>
                        </div>

                        <div class="col-md-2">
                            <label for="year" class="form-label fw-bold">Year</label>
                            <select name="year" id="year" class="form-select" required>
                                <option value="" disabled selected hidden>-- Select --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="Section" class="form-label fw-bold">Section</label>
                            <select name="section" id="section" class="form-select" required>
                                <option value="" disabled selected hidden>-- Select --</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $('#college').change(function() {
                                var Stdid = $('#college').val();

                                $.ajax({
                                    type: 'POST',
                                    url: 'fetch.php',
                                    data: {
                                        id: Stdid
                                    },
                                    success: function(data) {
                                        $('#show').html(data);
                                    }
                                });
                            });
                        });
                    </script>
                    <!-- <div class="col md-2">
                            <label for="college" class="form-label fw-bold">College</label>
                            <input type="text" name="college" id="college" class="form-control" placeholder="Enter current college" required minlength="2" maxlength="20" required>
                        </div>
                        <div class="col md-2">
                            <label for="program" class="form-label fw-bold">Program</label>
                            <input type="text" name="program" id="program" class="form-control" placeholder="Enter current program" required minlength="2" maxlength="20" required>
                        </div>
                        <div class="col md-2">
                            <label for="year" class="form-label fw-bold">Year</label>
                            <input type="number" name="year" id="year" class="form-control" placeholder="Enter current year" required minlength="1" maxlength="1" required>
                        </div>
                        <div class="col md-2">
                            <label for="section" class="form-label fw-bold">Section</label>
                            <input type="text" name="section" id="section" class="form-control" placeholder="Enter current section" required minlength="1" maxlength="1" required>
                        </div> 
                        </div>-->


                    <div class="row g-3 mb-3">
                        <div class="col md-6">
                            <label for="date" class="form-label fw-bold">Select Date</label>
                            <input type="date" id="date" name="date" class="form-control" placeholder="Enter preferred date" required min="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col md-6">
                            <label for="time" class="form-label fw-bold">Select Time</label>
                            <input type="time" id="time" name="time" class="form-control" placeholder="Enter preferred time" required min="09:00" max="17:00">
                        </div>

                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col md-4">
                            <label for="contactnumber" class="form-label fw-bold">Contact Number</label>
                            <input type="tel" name="contactnumber" id="contactnumber" class="form-control" placeholder="Enter contact number" required>
                        </div>

                        <div class="col md-8">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" name="email" id="email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" placeholder="Enter valid email address" required size="30" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-12 mb-3">
                            <label for="comment" class="form-label fw-bold">Comment</label>
                            <textarea class="form-control" rows="2.5" id="comment" name="comment" placeholder="Enter comment" required maxlength="300"></textarea>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-secondary" type="button"><a href="#" onclick="showSection(event, 'dashboardstudent')">Cancel</a></button>
                        <button class="btn btn-primary" type="submit">Submit Request</button>
                    </div>

                </form>
            </div>
        </section>


        <!--history start-->
        <section id="history">
            <h1>Scheduled Appointment</h1>
            <div id="scheduledTableContainer">
                <!-- Table content will be loaded dynamically here -->
            </div>

            <!-- Include jQuery library if not already included -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <!-- Your JavaScript code for updating the table content -->
            <script>
                $(document).ready(function() {
                    loadScheduledContent(); // Load table content when the page is ready
                });

                function loadScheduledContent() {
                    var tableContainer = $("#scheduledTableContainer");
                    if (tableContainer.length > 0) {
                        $.ajax({
                            url: "scheduled_table.php",
                            type: "POST",
                            success: function(response) {
                                tableContainer.html(response);
                            },
                            error: function(xhr, status, error) {
                                console.error("Failed to load table data. Status: " + status + ", Error: " + error);
                            }
                        });
                    } else {
                        console.error("Table container not found.");
                    }
                }
            </script>
        </section>

        <section id="History">
            <h1>Appointment History</h1>
            <div id="HistoryTable"></div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <!-- Your JavaScript code for updating the table content -->
            <script>
                $(document).ready(function() {
                    LoadHistory(); // Load table content when the page is ready
                });

                function LoadHistory() {
                    var tableContainer = $("#HistoryTable");
                    if (tableContainer.length > 0) {
                        $.ajax({
                            url: "History_Table.php",
                            type: "POST",
                            success: function(response) {
                                tableContainer.html(response);
                            },
                            error: function(xhr, status, error) {
                                console.error("Failed to load table data. Status: " + status + ", Error: " + error);
                            }
                        });
                    } else {
                        console.error("Table container not found.");
                    }
                }
            </script>
        </section>

        <section id="cancelled">
            <h1>CANCELLED APPOINTMENTS</h1>
            <div id="cancelledTableContainer"></div>

            <script>
                $(document).ready(function() {
                    loadCancelledTable(); // Load cancelled appointments table when the page is ready
                });

                function loadCancelledTable() {
                    var tableContainer = $("#cancelledTableContainer");
                    if (tableContainer.length > 0) {
                        $.ajax({
                            url: "cancelled_data.php",
                            type: "POST",
                            success: function(response) {
                                tableContainer.html(response); // Update the table content in the container
                            },
                            error: function(xhr, status, error) {
                                console.error("Failed to load cancelled appointments table data. Status: " + status + ", Error: " + error);
                            }
                        });
                    } else {
                        console.error("Cancelled appointments table container not found.");
                    }
                }
            </script>
        </section>
        <!--history end-->
    </div>

</body>

</html>
