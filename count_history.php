<?php
// Include config.php and establish database connection
include 'config.php';

// Initialize count variable
$count = 0;

// Query to count rows in pending_table
$sql = "SELECT COUNT(*) AS count FROM history_table";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result) {
    // Fetch the count
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
} else {
    // Error handling
    echo "Error: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);

// Return the count as JSON
echo json_encode(['count' => $count]);
