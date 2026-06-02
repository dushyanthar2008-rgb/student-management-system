<?php
include "config.php";

$result = $conn->query("SELECT * FROM rooms WHERE occupied < capacity");
?>
<link rel="stylesheet" href="style.css">
<a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
<h2>Vacant Rooms</h2>

<?php while($row = $result->fetch_assoc()) { ?>

<div class="container">
    <p><b>Room ID:</b> <?php echo $row['id']; ?></p>
    <p><b>Type:</b> <?php echo $row['type']; ?></p>
    <p><b>Available:</b> <?php echo $row['capacity'] - $row['occupied']; ?> beds</p>
</div>

<?php } ?>