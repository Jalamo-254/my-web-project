<?php
// Assume bus_id is passed via GET parameter
if(isset($_GET['bus_id'])) {
    $bus_id = $_GET['bus_id'];

    // Query to fetch seat availability for the selected bus
    $sql = "SELECT seat_number, status FROM seats WHERE bus_id = $bus_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generate seat layout dynamically
        echo "<h2>Available Seats</h2>";
        echo "<div class='seat-layout'>";
        while($row = $result->fetch_assoc()) {
            $seat_number = $row['seat_number'];
            $status = $row['status'];

            // Display each seat with appropriate class based on availability
            if ($status == 'available') {
                echo "<div class='seat available' data-seat-number='$seat_number'>$seat_number</div>";
            } else {
                echo "<div class='seat booked' data-seat-number='$seat_number'>$seat_number</div>";
            }
        }  
        echo "</div>";
    } else {
        echo "No seats found for this bus.";
    }
} else {
    echo "Bus ID parameter is missing.";
}
?>
