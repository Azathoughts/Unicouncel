<?php
session_start();
include 'config.php'; // Assuming this file includes your database connection

// Check if the user's first name is set in the session
if (isset($_SESSION['firstname'])) {
    // Get the first name from the session
    $firstname = mysqli_real_escape_string($conn, $_SESSION['firstname']);

    // Fetch the user ID from the accounts table based on the first name
    $selectQuery = "SELECT id FROM accounts WHERE firstname = '$firstname'";
    $result = mysqli_query($conn, $selectQuery);

    if (mysqli_num_rows($result) == 1) {
        // Fetch the user ID
        $row = mysqli_fetch_assoc($result);
        $userId = $row['id'];

        // Fetch data from the history_table based on user_id
        $selectHistory = "SELECT * FROM history_table WHERE user_id = '$userId'";
        $resultHistory = mysqli_query($conn, $selectHistory);

        echo "<div class='container-fluid mt-4'>";
        echo "<div class='row-fluid'>";

        echo "<div class='col-xs-6 '>";
        echo "<div class='table-responsive mx-2'>";

        echo "<table class='table table-hover'> ";

        echo "<thead>";
        echo "<tr class='table-info'>";
        echo "<th>Priority</th>";
        echo "<th>Student Name</th>";
        echo "<th>Student Number</th>";
        echo "<th>Date</th>";
        echo "<th>Time</th>";
        echo "<th>Program</th>";
        echo "<th>Year</th>";
        echo "<th>Section</th>";
        echo "<th>Contact Number</th>";
        echo "<th>Email</th>";
        echo "<th>Comment</th>";
        echo "<th>Mode of Communication</th>";
        echo "</tr>";
        echo "</thead>";

        if (mysqli_num_rows($resultHistory) > 0) {
            // Display the data from history_table
            while ($rowHistory = mysqli_fetch_assoc($resultHistory)) {
                echo "<tr>";
                echo "<td>" . $rowHistory['priority'] . "</td>";
                echo "<td>" . $rowHistory['student_name'] . "</td>";
                echo "<td>" . $rowHistory['student_number'] . "</td>";
                echo "<td>" . $rowHistory['date'] . "</td>";
                echo "<td>" . $rowHistory['time'] . "</td>";
                echo "<td>" . $rowHistory['program'] . "</td>";
                echo "<td>" . $rowHistory['year'] . "</td>";
                echo "<td>" . $rowHistory['section'] . "</td>";
                echo "<td>" . $rowHistory['contactnumber'] . "</td>";
                echo "<td>" . $rowHistory['email'] . "</td>";
                echo "<td class='w-35 text-break'>" . $rowHistory['comment'] . "</td>";
                echo "<td>" . $rowHistory['communication'] . "</td>";
                echo "</tr>";
            }
            echo "</table>"; // Close the table
            echo "</div>"; // Close the table-responsive div
            echo "</div>"; // Close the col-xs-6 div
            echo "</div>"; // Close the row-fluid div
            echo "</div>"; // Close the container-fluid div
        } else {
            echo "No appointments found for this user.";
        }
    } else {
        echo "User ID not found.";
    }
} else {
    // First name not set in session
    echo "First name not found in session.";
}

mysqli_close($conn);
