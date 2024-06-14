<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script>function showSlots(date) {
    // Get time slots and booking counts from PHP variables
    var timeSlots = <?php echo json_encode($timeSlots); ?>;
    var bookingCounts = <?php echo json_encode($bookingCounts); ?>;

    var timeSlotsContainer = document.getElementById('timeSlotsContainer');
    timeSlotsContainer.innerHTML = '';

    // Iterate over time slots for the selected date
    timeSlots.forEach(function(slot) {
        var availableSlots = 10 - bookingCounts[date][slot];
        var cardClass = availableSlots > 0 ? 'card time-slot-card' : 'card time-slot-card bg-light';

        var card = document.createElement('div');
        card.className = cardClass;
        if (availableSlots > 0) {
            card.setAttribute('onclick', 'openForm("' + date + '", "' + slot + '")');
        }

        var cardBody = document.createElement('div');
        cardBody.className = 'card-body';

        var cardTitle = document.createElement('h5');
        cardTitle.className = 'card-title';
        cardTitle.textContent = slot;

        var cardText = document.createElement('p');
        cardText.className = 'card-text';
        cardText.textContent = availableSlots > 0 ? 'Available Slots: ' + availableSlots : 'Fully Booked';

        cardBody.appendChild(cardTitle);
        cardBody.appendChild(cardText);
        card.appendChild(cardBody);

        timeSlotsContainer.appendChild(card);

        // Triggering reflow to restart animation
        card.offsetWidth = card.offsetWidth;
        card.classList.add('animate__animated', 'animate__fadeInUp');
        card.addEventListener('animationend', function() {
            card.classList.remove('animate__animated', 'animate__fadeInUp');
        });
    });
}</script><style>.time-slot-card {
    width: calc(50% - 20px); /* Two columns for mobile */
    margin-bottom: 20px;
    cursor: pointer;
    transition: transform 0.3s ease-in-out;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    background-color: #ffffff;
    animation: fadeInUp 1.3s forwards;
    opacity: 0;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(50px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}</style>









   <style>
          body {
            padding: 20px;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .time-slot-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .time-slot-card {
            width: calc(50% - 20px); /* Two columns for mobile */
            margin-bottom: 20px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background-color: #ffffff;
        }
        .time-slot-card:hover {
            transform: translateY(-5px);
        }
        @media (min-width: 576px) {
            .time-slot-card {
                width: calc(25% - 20px); /* Four columns for larger screens */
            }
        }
        .time-slot-card .card-body {
            padding: 20px;
        }
        .time-slot-card .card-title {
            font-size: 20px;
            font-weight: bold;
            color: #333333;
            margin-bottom: 10px;
        }
        .time-slot-card .card-text {
            font-size: 14px;
            color: #666666;
        }
        .time-slot-card.available {
            border: 2px solid #28a745; /* Green border for available slots */
        }
        .time-slot-card.fully-booked {
            border: 2px solid #dc3545; /* Red border for fully booked slots */
        }
        .time-slot-card .card-text.available {
            color: #28a745; /* Green text for available slots */
        }
        .time-slot-card .card-text.fully-booked {
            color: #dc3545; /* Red text for fully booked slots */
        }
        .popup {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            overflow: auto;
        }
        .popup-content {
            background-color: #fefefe;
            margin: 15% auto;
            border-radius: 10px;
            padding: 40px;
            border: 1px solid #888;
            width: 60%;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            position: relative;
        }
		
	
        .popup-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .popup-close:hover,
        .popup-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
		
		 .time-slot-card.available {
        border: 2px solid #28a745; /* Green border for available slots */
    }
    .time-slot-card.fully-booked {
        border: 2px solid #dc3545; /* Red border for fully booked slots */
    }
    .time-slot-card.warning {
        border: 2px solid #ffc107; /* Yellow border for nearing full slots */
    }
    .time-slot-card {
        /* Existing styles... */
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        background-color: #ffffff;
    }
	
	
	
	
    </style>
</head>
<body>
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

// Generate dates for the next 7 days
$dates = array();
for ($i = 0; $i < 6; $i++) {
    $dates[] = date('Y-m-d', strtotime("+$i days"));
}

// Get current booking counts for each time slot and date
$bookingCounts = array();
foreach ($dates as $date) {
    foreach ($timeSlots as $slot) {
        $sql = "SELECT COUNT(*) AS bookings FROM bookings WHERE date = ? AND time_slot = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $date, $slot);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $bookingCounts[$date][$slot] = $row['bookings'];
        $stmt->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure date and time_slot are set in POST request
    if (isset($_POST["date"]) && isset($_POST["time_slot"])) {
        // Get the selected date and time slot
        $selectedDate = $_POST["date"];
        $selectedSlot = $_POST["time_slot"];
        // Get user input data
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];

        // Check if the selected time slot is available
        if (isset($bookingCounts[$selectedDate][$selectedSlot]) && $bookingCounts[$selectedDate][$selectedSlot] < 10) {
            // Save the booking information to the database
            $stmt = $conn->prepare("INSERT INTO bookings (date, time_slot, name, phone, email) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $selectedDate, $selectedSlot, $name, $phone, $email);
            $stmt->execute();
            $stmt->close();
            
            // Update the booking count for the selected slot
            $bookingCounts[$selectedDate][$selectedSlot]++;

            echo "<p class='alert alert-success'>Your booking for $selectedSlot on $selectedDate has been confirmed.</p>";
        } else {
            echo "<p class='alert alert-danger'>Sorry, the selected time slot is not available.</p>";
        }
    } else {
        echo "<p class='alert alert-danger'>Date and time slot are required.</p>";
    }
}
?>

<div class="container">
    <h2 class="mt-5 mb-4">Book now</h2>
   
	<form method="get" action="advance.php">
    <button type="submit" class="btn btn-secondary mt-3">Advance Booking</button>
 <?php
    // Display dates as buttons to switch between dates
    echo "<div class='btn-group mt-3' role='group' id='dateButtons'>";
    foreach ($dates as $date) {
        echo "<button type='button' class='btn btn-secondary' onclick='showSlots(\"$date\")'>" . date('D, M d', strtotime($date)) . "</button>";

   }

    echo "</div>	</br>	 </br>";

    ?>
</form>

   <div class='time-slot-container' id="timeSlotsContainer">
      <?php
$today = date('Y-m-d');
foreach ($timeSlots as $slot) {
    $availableSlots = 10 - $bookingCounts[$today][$slot];
    if ($availableSlots > 5) {
        echo "<div class='card time-slot-card available' onclick='openForm(\"$today\", \"$slot\")'>";
    } else if ($availableSlots > 0) {
        echo "<div class='card time-slot-card warning' onclick='openForm(\"$today\", \"$slot\")'>";
    } else {
        echo "<div class='card time-slot-card fully-booked'>";
    }
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>$slot</h5>";
    echo "<p class='card-text'>";
    if ($availableSlots > 0) {
        echo "Available Slots: $availableSlots";
    } else {
        echo "Fully Booked";
    }
    echo "</p>";
    echo "</div>";
    echo "</div>";
}
?>


   </div>
   
</div>

<!-- Booking Popup -->
<div class="popup" id="bookingPopup">
    <div class="popup-content">
        <span class="popup-close" onclick="closePopup()">&times;</span>
        <h2 class="mt-4 mb-3">Book Now</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" id="selectedDate" name="date">
            <input type="hidden" id="selectedTimeSlot" name="time_slot">
            <div class="form-group">
               
                <input type="text"  placeholder="Enter your Name" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <input type="text"placeholder="Enter your Phonenumber" class="form-control" name="phone" required>
            </div>
            <div class="form-group">
                <input type="email" placeholder="Enter Your Emailid" class="form-control" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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

    // Function to show available time slots for a selected date
    function showSlots(date) {
        // Get time slots and booking counts from PHP variables
        var timeSlots = <?php echo json_encode($timeSlots); ?>;
        var bookingCounts = <?php echo json_encode($bookingCounts); ?>;

        var timeSlotsContainer = document.getElementById('timeSlotsContainer');
        timeSlotsContainer.innerHTML = '';

        // Iterate over time slots for the selected date
        timeSlots.forEach(function(slot) {
            var availableSlots = 10 - bookingCounts[date][slot];
            var cardClass = availableSlots > 0 ? 'card time-slot-card' : 'card time-slot-card bg-light';

            var card = document.createElement('div');
            card.className = cardClass;
            if (availableSlots > 0) {
                card.setAttribute('onclick', 'openForm("' + date + '", "' + slot + '")');
            }

            var cardBody = document.createElement('div');
            cardBody.className = 'card-body';

            var cardTitle = document.createElement('h5');
            cardTitle.className = 'card-title';
            cardTitle.textContent = slot;

            var cardText = document.createElement('p');
            cardText.className = 'card-text';
            cardText.textContent = availableSlots > 0 ? 'Available Slots: ' + availableSlots : 'Fully Booked';

            cardBody.appendChild(cardTitle);
            cardBody.appendChild(cardText);
            card.appendChild(cardBody);

            timeSlotsContainer.appendChild(card);
        });
    }
</script>

<?php
// Close the database connection
$conn->close();
?>