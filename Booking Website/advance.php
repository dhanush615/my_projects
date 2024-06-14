<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advance Booking</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Additional Custom Styles */
        body {
            padding: 20px;
        }
        .time-slot-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .time-slot-card {
            width: calc(25% - 20px);
            margin-bottom: 20px;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .time-slot-card {
                width: calc(50% - 20px);
            }
        }
        @media (max-width: 576px) {
            .time-slot-card {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">Select a Date and Time</h2>
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="customDate">Select Date:</label>
                <input type="date" class="form-control" id="customDate" name="custom_date" required>
            </div>
            <div class="form-group">
                <label for="customTime">Select Time:</label>
                <input type="time" class="form-control" id="customTime" name="custom_time" required>
            </div>
            <button type="submit" class="btn btn-primary">Show Slots</button>
        </form>

        <!-- Display available time slots -->
        <div class='time-slot-container' id="timeSlotsContainer">
            <?php
            // Connect to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "book";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Define available time slots
            $timeSlots = array(
                "9:00 AM - 10:00 AM",
                "10:00 AM - 11:00 AM",
                "11:00 AM - 12:00 PM",
                "12:00 PM - 1:00 PM",
                "1:00 PM - 2:00 PM",
                "2:00 PM - 3:00 PM",
                "3:00 PM - 4:00 PM",
                "4:00 PM - 5:00 PM",
                "5:00 PM - 6:00 PM",
                "7:00 PM - 8:00 PM"
            );

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["custom_date"]) && isset($_GET["custom_time"])) {
                $selectedDate = $_GET["custom_date"];
                $selectedTime = $_GET["custom_time"];

                echo "<h3 class='mt-4'>Available Slots for $selectedTime on $selectedDate</h3>";

                // Get current booking counts for each time slot and date
                $bookingCounts = array();
                foreach ($timeSlots as $slot) {
                    $sql = "SELECT COUNT(*) AS bookings FROM bookings WHERE date = ? AND time_slot = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $selectedDate, $slot);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $bookingCounts[$slot] = $row['bookings'];
                    $stmt->close();

                    $availableSlots = 10 - $bookingCounts[$slot];
                    if ($availableSlots > 0) {
                        echo "<div class='card time-slot-card' onclick='openForm(\"$selectedDate\", \"$slot\")'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>$slot</h5>";
                        echo "<p class='card-text'>Available Slots: $availableSlots</p>";
                        echo "</div>";
                        echo "</div>";
                    } else {
                        echo "<div class='card time-slot-card bg-light'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>$slot</h5>";
                        echo "<p class='card-text'>Fully Booked</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            }
			
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Function to open the booking form popup
        function openForm(date, timeSlot) {
            document.getElementById('selectedDate').value = date;
            document.getElementById('selectedTimeSlot').value = timeSlot;
            document.getElementById('bookingPopup').style.display = 'block';

            // Hide all other forms (if any)
            var popups = document.getElementsByClassName('popup');
            for (var i = 0; i < popups.length; i++) {
                if (popups[i].id !== 'bookingPopup') {
                    popups[i].style.display = 'none';
                }
            }
        }

        // Function to close the booking form popup
        function closePopup() {
            document.getElementById('bookingPopup').style.display = 'none';
        }
    </script>


		
</body>
</html>

<?php

// Close the database connection
$conn->close();
?>