<?php

            include 'config.php'; // Assuming this file includes your database connection

            // Fetch data from the 'pending' table
            $select = "SELECT * FROM pending_table";
            $result = mysqli_query($conn, $select);

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
                echo "<th>Action</th>";
                echo "</tr>";
                echo "</thead>";

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
                    echo "<td>";
                    echo "<button type='button' class='btn btn-success mb-2' onclick=\"approveAppointment(" . $row['id'] . ")\">Approve</button>";
                    echo "<button type='button' class='btn border-danger' onclick=\"cancelAppointment(" . $row['id'] . ")\">Decline</button>";
                    echo "</td> </div>";
                    echo "</tr>";
                }
          
            } else {
                echo "No pending appointments";
            }

            echo "</table>" ;

            mysqli_close($conn);
            ?>
