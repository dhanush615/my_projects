
<?php
// get_bookings.php

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "book";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the date from the query string
$date = $_GET['date'];

// Fetch bookings for the given date
$sql = "SELECT * FROM bookings WHERE date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

$bookings = array();
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}

$stmt->close();

// Return bookings as JSON
header('Content-Type: application/json');
echo json_encode($bookings);

// Close the database connection
$conn->close();
?>