<?php
include "config.php";

// Save attendance
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $date = $_POST['date'];

    foreach ($_POST['status'] as $student_id => $status) {

        $conn->query("INSERT INTO attendance (student_id, date, status)
                      VALUES ($student_id, '$date', '$status')");
    }

    echo "<h3>Attendance Saved</h3>";
}

// Fetch students
$students = $conn->query("SELECT * FROM students");
?>

<link rel="stylesheet" href="style.css">
<a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
<h2>Mark Attendance</h2>

<form method="post" class="container">

<input type="date" name="date" required><br><br>

<?php while($s = $students->fetch_assoc()) { ?>

<p>
<?php echo $s['name']; ?>

<select name="status[<?php echo $s['id']; ?>]">
    <option value="Present">Present</option>
    <option value="Absent">Absent</option>
</select>
</p>

<?php } ?>

<button>Submit Attendance</button>

</form>