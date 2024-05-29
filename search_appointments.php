<?php
// Assuming you have a database connection established in your config.php file
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchQuery = $_POST['search_query'];

    // Check if the search query is not empty
    if (!empty($searchQuery)) {
        // Prepare the search query to avoid SQL injection
        $preparedSearchQuery = mysqli_real_escape_string($conn, $searchQuery);

        // Perform SQL query to search appointments in the 'history_table' based on search conditions
        $sql = "SELECT * FROM history_table 
                WHERE 
                (priority = '$preparedSearchQuery' AND priority NOT LIKE '$preparedSearchQuery%')
                OR student_name LIKE '%$preparedSearchQuery%'
                OR student_number LIKE '%$preparedSearchQuery%'
                OR date = '$preparedSearchQuery'
                OR time LIKE '%$preparedSearchQuery%'
                OR program LIKE '%$preparedSearchQuery%'
                OR year LIKE '%$preparedSearchQuery%'
                OR section LIKE '%$preparedSearchQuery%'
                OR contactnumber LIKE '%$preparedSearchQuery%'
                OR email LIKE '%$preparedSearchQuery%'
                OR comment LIKE '%$preparedSearchQuery%'
                OR communication LIKE '%$preparedSearchQuery%'";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Output search results
                echo "<div class='container-fluid mt-4'>";
                echo "<div class='row-fluid'>";
                echo "<div class='col-xs-6 '>";
                echo "<div class='table-responsive mx-2'>";
                echo "<table class='table table-hover'> ";
                echo "<thead>";
                echo "<tr><th>Priority</th><th>Student Name</th><th>Student Number</th><th>Date</th><th>Time</th><th>Program</th><th>Year</th><th>Section</th><th>Contact Number</th><th>Email</th><th>Comment</th><th>Mode of Communication</th></tr>";
                echo "</thead>";
                echo "<tbody>";
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
                echo "</tbody>";
                echo "</table>";
                echo "</div>"; // End of table-responsive div
                echo "</div>"; // End of col-xs-6 div
                echo "</div>"; // End of row-fluid div
                echo "</div>"; // End of container-fluid div
            } else {
                // No search results found
                echo "<div class='container-fluid mt-4'>";
                echo "<div class='row-fluid'>";
                echo "<p>No appointments found matching your search.</p>";
                echo "</div>"; // End of row-fluid div
                echo "</div>"; // End of container-fluid div
            }
        } else {
            // Error executing the SQL query
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Search query is empty, show all data
        $sql = "SELECT * FROM history_table";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Output all data
                // Your code to retrieve and display all data here
            } else {
                // No data found
                // Your code to handle no data here
            }
        } else {
            // Error executing the SQL query
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    // Invalid request method
    echo "<div class='container-fluid mt-4'>";
    echo "<div class='row-fluid'>";
    echo "<p>Invalid request.</p>";
    echo "</div>"; // End of row-fluid div
    echo "</div>"; // End of container-fluid div
}

// Close the database connection
mysqli_close($conn);
