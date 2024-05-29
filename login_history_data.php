<?php
// Include config.php and establish database connection
include 'config.php';

// Query to fetch data from accounts and login_history tables
$query = "SELECT accounts.id, accounts.username, accounts.firstname, accounts.lastname, login_history.login_time, login_history.ip_address
          FROM accounts
          JOIN login_history ON accounts.id = login_history.user_id";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    // Display table header with Bootstrap table classes for styling

    echo "<div class='container-fluid mt-4'>";
    echo "<div class='row-fluid'>";

    echo "<div class='col-xs-6 '>";

    echo "<div class='table-responsive mx-2'>";
    echo "<table class='table table-hover'> ";
    echo "<thead>";
    echo "<tr class='table-info'>";
    echo "<th>User ID</th>";
    echo "<th>Username</th>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>Login Time</th>";
    echo "<th>IP Address</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Fetch and display data row by row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['firstname'] . "</td>";
        echo "<td>" . $row['lastname'] . "</td>";
        echo "<td>" . $row['login_time'] . "</td>";
        echo "<td>" . $row['ip_address'] . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    // Close table
    echo "</table>";
    echo "</div>";
} else {
    echo "No data found.";
}

// Close database connection
mysqli_close($conn);
