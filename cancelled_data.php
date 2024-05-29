<?php
session_start();
include 'config.php'; 

// Check if the user's ID is set in the session
if (isset($_SESSION['user_id'])) {
    $userId = mysqli_real_escape_string($conn, $_SESSION['user_id']);

    $select = "SELECT * FROM cancelled_table WHERE user_id = '$userId'";
    $result = mysqli_query($conn, $select);

    echo "<div class='container-fluid mt-4'>";
    echo "<div class='row-fluid'>";
    echo "<div class='col-xs-6'>";
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
    echo "<tbody>"; // Added tbody for table body

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['priority'] . "</td>";
            echo "<td>" . $row['student_name'] . "</td>";
            echo "<td>" . $row['student_number'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['time'] . "</td>";
            echo "<td>" . $row['program'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['section'] . "</td>";
            echo "<td>" . $row['contactnumber'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td class='w-35 text-break'>" . $row['comment'] . "</td>";
            echo "<td>" . $row['communication'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='12'>No cancelled appointments</td></tr>"; // Message when no cancelled appointments
    }

    echo "</tbody>"; // Close tbody
    echo "</table>" ;
    echo "</div>"; // Close the table-responsive div
    echo "</div>"; // Close the col-xs-6 div
    echo "</div>"; // Close the row-fluid div
    echo "</div>"; // Close the container-fluid div

    mysqli_close($conn);
} else {
    // User ID not found in session
    echo "User ID not found in session.";
}
?>
