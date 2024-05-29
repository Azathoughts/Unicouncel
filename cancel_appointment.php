<?php
include 'config.php'; // Assuming this file includes your database connection

// Check if appointment_id is set in the POST request
if (isset($_POST['appointment_id'])) {
    // Sanitize the input
    $appointmentId = mysqli_real_escape_string($conn, $_POST['appointment_id']);

    // Fetch the appointment details from the pending_table
    $selectQuery = "SELECT * FROM pending_table WHERE id = '$appointmentId'";
    $result = mysqli_query($conn, $selectQuery);

    if (mysqli_num_rows($result) == 1) {
        // Fetch the appointment details
        $row = mysqli_fetch_assoc($result);

        // Insert the appointment details into the cancelled_table with user_id
        $insertQuery = "INSERT INTO cancelled_table (user_id, priority, student_name, student_number, date, time, program, year, section, contactnumber, email, comment, communication) 
                        VALUES ('" . $row['user_id'] . "', '" . $row['priority'] . "', '" . $row['student_name'] . "', '" . $row['student_number'] . "', '" . $row['date'] . "', '" . $row['time'] . "', '" . $row['program'] . "', '" . $row['year'] . "', '" . $row['section'] . "', '" . $row['contactnumber'] . "', '" . $row['email'] . "', '" . $row['comment'] . "', '" . $row['communication'] . "')";
        if (mysqli_query($conn, $insertQuery)) {
            // Delete the appointment from pending_table
            $deleteQuery = "DELETE FROM pending_table WHERE id = '$appointmentId'";
            if (mysqli_query($conn, $deleteQuery)) {
                // Appointment cancelled successfully
                echo "success";
            } else {
                // Failed to delete appointment from pending_table
                echo "error_delete";
            }
        } else {
            // Failed to insert appointment into cancelled_table
            echo "error_insert";
        }
    } else {
        // Appointment not found in pending_table
        echo "not_found";
    }
} else {
    // appointment_id not set in POST request
    echo "invalid_request";
}
