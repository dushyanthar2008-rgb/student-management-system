<?php
include "config.php";

// Add complaint
if (isset($_POST['issue'])) {
    $issue = $_POST['issue'];
    $student_id = 1; // for now fixed (later we can use session)

    $conn->query("INSERT INTO complaints (student_id, issue, status)
                  VALUES ($student_id, '$issue', 'Open')");

    echo "<h3>Complaint Added</h3>";
}

// Update status (Resolved)
if (isset($_POST['resolve_id'])) {
    $id = $_POST['resolve_id'];

    $conn->query("UPDATE complaints SET status='Resolved' WHERE id=$id");

    echo "<h3>Marked as Resolved</h3>";
}

// Fetch complaints
$result = $conn->query("
    SELECT c.id, s.name, c.issue, c.status
    FROM complaints c
    JOIN students s ON c.student_id = s.id
");
?>

<link rel="stylesheet" href="style.css">
<a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
<h2>Complaints</h2>

<!-- ADD COMPLAINT -->
<form method="post" class="container">
    <textarea name="issue" placeholder="Write complaint..." required></textarea><br><br>
    <button>Submit Complaint</button>
</form>

<!-- SHOW COMPLAINTS -->
<?php while($row = $result->fetch_assoc()) { ?>

<div class="container">
    <p><b>Name:</b> <?php echo $row['name']; ?></p>
    <p><b>Issue:</b> <?php echo $row['issue']; ?></p>
    <p><b>Status:</b> <?php echo $row['status']; ?></p>

    <?php if ($row['status'] != "Resolved") { ?>
        <form method="post">
            <input type="hidden" name="resolve_id" value="<?php echo $row['id']; ?>">
            <button style="background:green;">Mark as Resolved</button>
        </form>
    <?php } ?>

</div>

<?php } ?>