function showSection(event, sectionId) {
    event.preventDefault();
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
        section.classList.remove('active');
    });
    document.getElementById(sectionId).classList.add('active');

    document.querySelectorAll('#sidebar li').forEach(li => li.classList.remove('active'));
    document.querySelector(`#sidebar li a[href="#${sectionId}"]`).parentElement.classList.add('active');
}

    $(document).ready(function() {
        // Function to load and display the count of pending table rows
        function loadPendingRowCount() {
            $.ajax({
                url: "count_pending_rows.php",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    // Update the count in the HTML element with id "pendingRowCount"
                    $("#pendingRowCount").text(response.count);
                },
                error: function(xhr, status, error) {
                    console.error("Failed to load pending row count. Status: " + status + ", Error: " + error);
                }
            });
        }

        // Load pending row count when the page is ready
        loadPendingRowCount();

        // Set interval to reload the count every 10 seconds (adjust as needed)
        setInterval(loadPendingRowCount, 10000); // 10000 milliseconds = 10 seconds
    });

      $(document).ready(function() {
        // Function to load and display the count of cancelled appointments
        function loadCancelledAppointmentCount() {
            $.ajax({
                url: "count_cancelled_appointments.php", // Your PHP script to count cancelled appointments
                type: "GET",
                dataType: "json",
                success: function(response) {
                    $("#cancelledAppointmentCount").text(response.count); // Update count in HTML element
                },
                error: function(xhr, status, error) {
                    console.error("Failed to load cancelled appointment count. Status: " + status + ", Error: " + error);
                }
            });
        }

        // Load cancelled appointment count when the page is ready
        loadCancelledAppointmentCount();

        // Set interval to reload the count every 60 seconds (adjust as needed)
        setInterval(loadCancelledAppointmentCount, 60000); // 60000 milliseconds = 60 seconds
    });

    $(document).ready(function() {
    // Function to load and display the count of scheduled appointments
    function loadScheduledAppointmentCount() {
        $.ajax({
            url: "count_scheduled.php", // Your PHP script to count scheduled appointments
            type: "GET",
            dataType: "json",
            success: function(response) {
                $("#scheduledAppointmentCount").text(response.count); // Update count in HTML element
            },
            error: function(xhr, status, error) {
                console.error("Failed to load scheduled appointment count. Status: " + status + ", Error: " + error);
            }
        });
    }

    // Load scheduled appointment count when the page is ready
    loadScheduledAppointmentCount();

    // Set interval to reload the count every 60 seconds (adjust as needed)
    setInterval(loadScheduledAppointmentCount, 60000); // 60000 milliseconds = 60 seconds
});

$(document).ready(function() {
    // Function to load and display the count of appointments in history
    function loadHistoryAppointmentCount() {
        $.ajax({
            url: "count_history.php", // Your PHP script to count appointments in history
            type: "GET",
            dataType: "json",
            success: function(response) {
                $("#historyAppointmentCount").text(response.count); // Update count in HTML element
            },
            error: function(xhr, status, error) {
                console.error("Failed to load history appointment count. Status: " + status + ", Error: " + error);
            }
        });
    }

    // Load history appointment count when the page is ready
    loadHistoryAppointmentCount();

    // Set interval to reload the count every 60 seconds (adjust as needed)
    setInterval(loadHistoryAppointmentCount, 60000); // 60000 milliseconds = 60 seconds
});
