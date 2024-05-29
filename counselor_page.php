<?php
include 'config.php';
session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION['user_id'])) {
    header("Location: landing_page.php");
    exit();
}

$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unicounsel | Guidance Counselor</title>
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

</head>

<body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="counselor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

            if (isLoggedIn) {
                window.history.pushState(null, "", window.location.href);
                window.onpopstate = function() {
                    window.history.pushState(null, "", window.location.href);
                };
            }
        });

        $(document).ready(function() {
            // Load and update table content for all sections
            loadAllTableContent();

            // Set interval to reload all table contents every 5 seconds
            setInterval(loadAllTableContent, 1000); // 5000 milliseconds = 5 seconds
        });

        function loadAllTableContent() {
            loadTableContent("pending");
            loadTableContent("scheduled");
            loadTableContent("cancelled");
            loadTableContent("history");
        }
    </script>

    <!-- sidebar start-->
    <section id="sidebar">
        <div class="cname">
            <span class="name"><?php echo $firstname . " " . $lastname; ?></span>
            <h4>Guidance Counselor</h4>
        </div>

        <ul class="side-menu top">
            <li class="active">
                <a href="#" onclick="showSection(event, 'dashboardgc')">
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
                <a href="#" onclick="showSection(event, 'pending')">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span class="text">Pending Appointments</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showSection(event, 'scheduled')">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span class="text">Scheduled Appointments</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showSection(event, 'cancelled')">
                    <i class="fa-solid fa-calendar-xmark"></i>
                    <span class="text">Cancelled Appointments</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showSection(event, 'history')">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span class="text">Appointments History</span>
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
        <section id="dashboardgc" class="active">
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                </div>
            </div>
            <div class="row g-3 mb-3 mt-4 justify-content-md-center">
                <div class="col-5">
                    <div class="card text-center card border-success border border-4 ms-5" style="width: 30rem;">
                        <div class="card-body">
                            <ul class="box-info">
                                <li>
                                    <span class="text">
                                        <h1 class="text-center"><span id="pendingRowCount">Loading...</span></h1><br>
                                        <p class="fs-3"> <i class="fa-solid fa-clipboard-list"></i> Pending Appoinments</p>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <div class="card text-center card border-success border border-4" style="width: 30rem;">
                        <div class="card-body">
                            <ul class="box-info">
                                <li>
                                    <span class="text">
                                        <h1 class="text-center"><span id="scheduledAppointmentCount">Loading...</span></h1><br>
                                        <p class="fs-3"> <i class="fa-solid fa-calendar-days"></i> Scheduled Appointments</p>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <div class="card text-center card border-success border border-4 ms-5" style="width: 30rem;">
                        <div class="card-body">
                            <ul class="box-info">
                                <li>

                                    <span class="text">
                                        <h1 class="text-center"><span id="cancelledAppointmentCount">Loading...</span></h1><br>
                                        <p class="fs-3"> <i class="fa-solid fa-calendar-xmark"></i> Cancelled Appointments </p>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <div class="card text-center card border-success border border-4" style="width: 30rem;">
                        <div class="card-body">
                            <ul class="box-info">
                                <li>
                                    <span class="text">
                                        <h1 class="text-center"><span id="historyAppointmentCount">Loading...</span></h1><br>
                                        <p class="fs-3"> <i class="fa-solid fa-clock-rotate-left"></i> Appointments History</p>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- dashboard end -->

        <!--pending start-->
        <section id="pending">
            <h1>PENDING APPOINTMENTS</h1>
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
                            url: "pending_table_data.php",
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

                function cancelAppointment(appointmentId) {
                    $.ajax({
                        url: "cancel_appointment.php",
                        type: "POST",
                        data: {
                            appointment_id: appointmentId
                        },
                        success: function(response) {
                            console.log(response);
                            loadTableContent(); // Reload table content after canceling appointment
                            loadCancelledTable();
                        },
                        error: function(xhr, status, error) {
                            console.error("Failed to cancel appointment. Status: " + status + ", Error: " + error);
                        }
                    });
                }

                function approveAppointment(appointmentId) {
                    $.ajax({
                        url: "approve_appointment.php",
                        type: "POST",
                        data: {
                            appointment_id: appointmentId
                        },
                        success: function(response) {
                            console.log(response);
                            loadTableContent();
                            loadScheduledContent();
                        },
                        error: function(xhr, status, error) {
                            console.error("Failed to approve appointment. Status: " + status + ", Error: " + error);
                        }
                    });
                }
            </script>

        </section>
        <!--pending end-->


        <!--scheduled start-->
        <section id="scheduled">
            <h1>SCHEDULED APPOINTMENTS</h1>
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
                            url: "scheduled_table_data.php",
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

                function FinishedAppointment(appointmentId) {
                    $.ajax({
                        url: "appointment_history.php",
                        type: "POST",
                        data: {
                            appointment_id: appointmentId
                        },
                        success: function(response) {
                            console.log(response); // Log the response for debugging
                            if (response === "success") {
                                loadScheduledContent(); // Reload scheduled appointments
                                loadHistoryTable(); // Reload history table
                            } else {
                                console.error("Failed to complete appointment. Unexpected response: " + response);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Failed to complete appointment. Status: " + status + ", Error: " + error);
                        }
                    });
                }
            </script>

        </section>
        <!--scheduled end-->


        <!--cancelled start-->
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
                            url: "cancelled_table_data.php",
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
        <!--cancelled end-->


        <!--history start-->
        <section id="history">
            <h1>APPOINTMENTS HISTORY</h1>
            <div class="Row" style="display: flex; justify-content: left; margin-left: 20px;">
                <button onclick="searchAppointments()" style="width: 120px; height: 30px; font-weight: bold; font-size: 16px;">Search</button>
                <input type="text" id="searchInput" placeholder="Search appointments" style="width: 300px; height: 30px; margin-left: 10px;">
            </div>




            <div id="historyTableContainer">
                <!-- Table content will be loaded dynamically here -->
            </div>

            <!-- Include jQuery library if not already included -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <!-- JavaScript code for updating the history table content -->
            <script>
                $(document).ready(function() {
                    loadHistoryTable(); // Load history table when the page is ready
                });

                function loadHistoryTable() {
                    var tableContainer = $("#historyTableContainer");
                    if (tableContainer.length > 0) {
                        $.ajax({
                            url: "history_table_data.php",
                            type: "POST",
                            success: function(response) {
                                tableContainer.html(response); // Update the table content in the container
                            },
                            error: function(xhr, status, error) {
                                console.error("Failed to load history table data. Status: " + status + ", Error: " + error);
                            }
                        });
                    } else {
                        console.error("History table container not found.");
                    }
                }

                function searchAppointments() {
                    var searchQuery = $("#searchInput").val().trim(); // Get the search query
                    if (searchQuery !== '') {
                        $.ajax({
                            url: "search_appointments.php", // Replace with your PHP file for searching appointments
                            type: "POST",
                            data: {
                                search_query: searchQuery
                            }, // Send the search query to the server
                            success: function(response) {
                                $("#historyTableContainer").html(response); // Update the table content with search results
                                $("#searchInput").val(''); // Clear the input field
                            },
                            error: function(xhr, status, error) {
                                console.error("Failed to search appointments. Status: " + status + ", Error: " + error);
                            }
                        });
                    } else {
                        loadHistoryTable(); // If search query is empty, reload the entire history table
                    }
                }
            </script>
        </section>
        <!--history end-->
    </div>

</body>

</html>
