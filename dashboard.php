<?php
session_start();
include "config.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$name = $_SESSION['user'];

// Fetch student data
$sql = "SELECT * FROM students WHERE name='$name'";
$result = $conn->query($sql);
$student = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Welcome <?php echo $student['name']; ?></h2>

<link rel="stylesheet" href="style.css">

<h2 class="welcome">Welcome</h2>

<div class="dashboard">

<div class="row">
    <a href="add_student.php"><div class="card">➕ Add Student</div></a>
    <a href="vacancy.php"><div class="card">📊 Vacancy</div></a>
    <a href="room.php"><div class="card">🏠 Room</div></a>
</div>

<div class="row">
    <a href="attendance.php"><div class="card">📅 Attendance</div></a>
    <a href="attendance_report.php"><div class="card">📈 Report</div></a>
    <a href="food.php"><div class="card">🍽 Food</div></a>
</div>

<div class="row center">
    <a href="fees.php"><div class="card">💰 Fees</div></a>
    <a href="complaint.php"><div class="card">🛠 Complaints</div></a>
</div>

<div class="row center">
    <a href="logout.php"><div class="card logout">🚪 Logout</div></a>
</div>

</div></body>
</html>