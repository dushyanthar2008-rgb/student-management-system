<?php
include "config.php";

// Update status (Paid / Pending)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $status = $_POST['status'];

    $conn->query("UPDATE fees SET status='$status' WHERE student_id=$student_id");

    echo "<h3 style='text-align:center;'>Payment Updated</h3>";
}

// Fetch students + fees (IMPORTANT JOIN)
$result = $conn->query("
    SELECT s.id, s.name, 
           IFNULL(f.amount, 0) AS amount, 
           IFNULL(f.status, 'Not Set') AS status
    FROM students s
    LEFT JOIN fees f ON s.id = f.student_id
");
?>

<link rel="stylesheet" href="style.css">
<a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
<h2 style="text-align:center;">All Students Fees</h2>

<?php while($row = $result->fetch_assoc()) { ?>

<div class="container">
    <p><b>Name:</b> <?php echo $row['name']; ?></p>
    <p><b>Amount:</b> ₹<?php echo $row['amount']; ?></p>
    <p><b>Status:</b> <?php echo $row['status']; ?></p>

    <!-- Mark as Paid -->
    <form method="post">
        <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="status" value="Paid">
        <button>Mark as Paid</button>
    </form>

    <!-- Mark as Pending -->
    <form method="post">
        <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="status" value="Pending">
        <button style="background:red;">Mark as Pending</button>
    </form>

</div>

<?php } ?>