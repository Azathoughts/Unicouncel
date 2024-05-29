<?php
// Include config.php and establish database connection
include 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'id' parameter is set
    if (isset($_POST['id'])) {
        // Sanitize the input to prevent SQL injection
        $id = mysqli_real_escape_string($conn, $_POST['id']);

        // Update the 'enabled' field to 0 for the specified account
        $sql = "UPDATE accounts SET enabled = 0 WHERE id = $id";

        // Execute the SQL query
        if (mysqli_query($conn, $sql)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "ID parameter not set.";
    }
} else {
    echo "No request sent.";
}

// Close database connection
mysqli_close($conn);
