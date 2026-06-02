<?php
session_start();
include "config.php";

// Get student id
$name = $_SESSION['user'];
$student = $conn->query("SELECT id FROM students WHERE name='$name'")->fetch_assoc();
$student_id = $student['id'];

// When submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST['day'];
    $status = $_POST['status'];

    // Insert or update
    $conn->query("INSERT INTO food_selection (student_id, day, status)
                  VALUES ($student_id, '$day', '$status')");

    echo "<h3>Saved Successfully</h3>";
}

// Fetch menu
$result = $conn->query("SELECT * FROM food_menu");
?>

<link rel="stylesheet" href="style.css">
<a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
<h2>Food Menu</h2>

<?php while($row = $result->fetch_assoc()) { ?>

<form method="post" class="container">

    <p><b><?php echo $row['day']; ?></b></p>
    <p><?php echo $row['menu']; ?></p>

    <input type="hidden" name="day" value="<?php echo $row['day']; ?>">

    <select name="status">
        <option value="Yes">Will Eat</option>
        <option value="No">Not Eat</option>
    </select>

    <button>Save</button>

</form>

<?php } ?>