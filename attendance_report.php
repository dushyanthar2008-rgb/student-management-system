<?php
include "config.php";

$result = $conn->query("
    SELECT s.name,
           COUNT(CASE WHEN a.status='Present' THEN 1 END) AS present_days,
           COUNT(a.id) AS total_days
    FROM students s
    LEFT JOIN attendance a ON s.id = a.student_id
    GROUP BY s.id
");
?>

<link rel="stylesheet" href="style.css">
<a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
<h2>Attendance Report</h2>

<?php while($row = $result->fetch_assoc()) {

    $percent = ($row['total_days'] > 0)
        ? round(($row['present_days'] / $row['total_days']) * 100)
        : 0;
?>

<div class="container">
    <p><b>Name:</b> <?php echo $row['name']; ?></p>
    <p>Present: <?php echo $row['present_days']; ?></p>
    <p>Total Days: <?php echo $row['total_days']; ?></p>
    <p><b>Attendance:</b> <?php echo $percent; ?>%</p>
</div>

<?php } ?>