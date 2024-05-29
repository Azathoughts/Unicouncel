<?php
include 'config.php';

$sql = "SELECT id, firstname, lastname, email, username, role, enabled FROM accounts";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    echo "<div class='container-fluid mt-4'>";
    echo "<div class='row-fluid'>";

    echo "<div class='col-xs-6 '>";

    echo "<div class='table-responsive mx-2'>";
    echo "<table class='table table-hover'> ";
    echo "<thead>";
    echo "<tr class='table-info'>";
    echo "<th>ID</th>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>Email</th>";
    echo "<th>Username</th>";
    echo "<th>Role</th>";
    echo "<th>Enabled</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["firstname"] . "</td>";
        echo "<td>" . $row["lastname"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["role"] . "</td>";
        echo "<td>" . $row["enabled"] . "</td>";
        echo "<td>";
        echo "<button class='btn btn-success mx-3' onclick='enableAccount(" . $row['id'] . ")'>Enable</button>"; // Enable button
        echo "<button class='btn border-danger' onclick='disableAccount(" . $row['id'] . ")'>Disable</button>"; // Disable button
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "<p>No results found.</p>";
}

mysqli_close($conn);
