<?php
session_start();
include "config.php";

// When user confirms room
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $room_type = $_POST['room_type'];

    // Get available room of that type
    $room = $conn->query("SELECT * FROM rooms 
                          WHERE type='$room_type' AND occupied < capacity 
                          LIMIT 1")->fetch_assoc();

    if ($room) {

        $room_id = $room['id'];

        // Get current user name
        $name = $_SESSION['user'];

        // 🔥 GET STUDENT ID (IMPORTANT FIX)
        $getStudent = $conn->query("SELECT id FROM students WHERE name='$name'")->fetch_assoc();
        $student_id = $getStudent['id'];

        // Update student room
        $conn->query("UPDATE students SET room='$room_id' WHERE id=$student_id");

        // Update room occupancy
        $conn->query("UPDATE rooms SET occupied = occupied + 1 WHERE id=$room_id");

        // Insert allocation record
        $date = date('Y-m-d');

        $conn->query("INSERT INTO allocations (student_id, room_id, date)
                      VALUES ($student_id, $room_id, '$date')");

        echo "<h3>Room Allotted Successfully</h3>";

    } else {
        echo "<h3>No rooms available</h3>";
    }
}

// Fetch rooms
$result = $conn->query("SELECT * FROM rooms");
?>

<link rel="stylesheet" href="style.css">

<a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>

<h2>Room Details</h2>

<?php while($row = $result->fetch_assoc()) { ?>

<form method="post">
<div class="container">

<p>Type: <?php echo $row['type']; ?></p>
<p>Capacity: <?php echo $row['capacity']; ?></p>
<p>Occupied: <?php echo $row['occupied']; ?></p>

<input type="hidden" name="room_type" value="<?php echo $row['type']; ?>">

<button>Select Room</button>

</div>
</form>

<?php } ?>