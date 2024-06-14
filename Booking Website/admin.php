<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Booked Users</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .date-button {
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .booking-list {
            margin-top: 20px;
        }
        .booking-card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background-color: #ffffff;
            padding: 15px;
            border-radius: 10px;
        }
        .booking-card .card-body {
            padding: 10px;
        }
        .booking-card .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #333333;
            margin-bottom: 5px;
        }
        .booking-card .card-text {
            font-size: 14px;
            color: #666666;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Booked Users</h2>
    <div class="btn-group mb-3" role="group" id="dateButtons">
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

        // Generate dates for the next 6 days
        $dates = array();
        for ($i = 0; $i < 6; $i++) {
            $dates[] = date('Y-m-d', strtotime("+$i days"));
        }

        // Display dates as buttons to switch between dates
        foreach ($dates as $date) {
            echo "<button type='button' class='btn btn-secondary date-button' onclick='showBookings(\"$date\")'>" . date('D, M d', strtotime($date)) . "</button>";
        }

        // Additional buttons for dates beyond the initial 6 days
        for ($i = 6; $i < 12; $i++) {
            $date = date('Y-m-d', strtotime("+$i days"));
            echo "<button type='button' class='btn btn-secondary date-button' onclick='showBookings(\"$date\")'>" . date('D, M d', strtotime($date)) . "</button>";
        }
        ?>
    </div>

    <div class="booking-list" id="bookingList">
        <!-- Bookings will be dynamically added here -->
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Function to show bookings for a selected date
    function showBookings(date) {
        fetch(`get_bookings.php?date=${date}`)
            .then(response => response.json())
            .then(data => {
                const bookingList = document.getElementById('bookingList');
                bookingList.innerHTML = '';

                data.forEach(booking => {
                    const card = document.createElement('div');
                    card.className = 'card booking-card';
                    const cardBody = document.createElement('div');
                    cardBody.className = 'card-body';

                    const cardTitle = document.createElement('h5');
                    cardTitle.className = 'card-title';
                    cardTitle.textContent = `${booking.time_slot} on ${booking.date}`;

                    const cardTextName = document.createElement('p');
                    cardTextName.className = 'card-text';
                    cardTextName.textContent = `Name: ${booking.name}`;

                    const cardTextPhone = document.createElement('p');
                    cardTextPhone.className = 'card-text';
                    cardTextPhone.textContent = `Phone: ${booking.phone}`;

                    const cardTextEmail = document.createElement('p');
                    cardTextEmail.className = 'card-text';
                    cardTextEmail.textContent = `Email: ${booking.email}`;

                    cardBody.appendChild(cardTitle);
                    cardBody.appendChild(cardTextName);
                    cardBody.appendChild(cardTextPhone);
                    cardBody.appendChild(cardTextEmail);
                    card.appendChild(cardBody);
                    bookingList.appendChild(card);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }
</script>

</body>
</html>