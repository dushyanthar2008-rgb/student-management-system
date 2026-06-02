<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE name='$name' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['user'] = $name;
        header("Location: dashboard.php");
    } else {
        $error = "Invalid login";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">

    <div class="header">
        <h1>🏠 Presidency Hostels</h1>
        <p class="sub-title">Coordinator Login</p>
        <p1>HOSTEL MANAGEMENT SYSTEM</p1>
    </div>

    <marquee style="color:white;">
    Welcome to Hostel Management System - Faculty Login
    </marquee>

    <form method="post">

    <?php if (isset($error)) { ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php } ?>

    <input name="name" placeholder="Username"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button>Login</button>
    </form>

</head>

</html>