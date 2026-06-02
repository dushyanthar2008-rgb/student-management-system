<?php
include "config.php";

// Handle form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $room_id = $_POST['room_id'];

    // Assign room to student
    $conn->query("UPDATE students SET room_id=$room_id WHERE id=$student_id");

    // Increase occupied count
    $conn->query("UPDATE rooms SET occupied = occupied + 1 WHERE id=$room_id");

    echo "Room Allotted Successfully";
}

// Fetch students
$students = $conn->query("SELECT * FROM students");

// Fetch available rooms
$rooms = $conn->query("SELECT * FROM rooms WHERE occupied < capacity");
?>

<link rel="stylesheet" href="style.css">

<div class="container">
<h2>Room Allotment</h2>

<form method="post">

<select name="student_id">
<?php while($s = $students->fetch_assoc()) { ?>
<option value="<?php echo $s['id']; ?>">
<?php echo $s['name']; ?>
</option>
<?php } ?>
</select><br><br>

<select name="room_id">
<?php while($r = $rooms->fetch_assoc()) { ?>
<option value="<?php echo $r['id']; ?>">
Room <?php echo $r['id']; ?> (<?php echo $r['type']; ?>)
</option>
<?php } ?>
</select><br><br>

<button>Assign Room</button>

</form>
</div>