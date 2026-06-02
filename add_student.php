<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO students (name, password, phone, room, attendance)
            VALUES ('$name', '$password', '$phone', 'Not Allotted', 0)";
if ($conn->query($sql)) {

    $student_id = $conn->insert_id;

    // Insert fees automatically
    $conn->query("INSERT INTO fees (student_id, amount, status)
                  VALUES ($student_id, 5000, 'Pending')");

    echo "Student Added Successfully";

} else {
    echo "Error";
}
    }
?>

<link rel="stylesheet" href="style.css">
<a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
<div class="container">
<h2>Add Student</h2>

<form method="post">
    <input name="name" placeholder="Student Name"><br>
    <input name="password" placeholder="Password"><br>
    <input name="phone" placeholder="Phone Number"><br>
    <button>Add Student</button>
</form>
</div>