<?php
// index.php (Main Entry Point for Job Portal)

session_start();
include 'config/config.php';


if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] == 'employer') {
        header("Location: employer_dashboard.php");
    } elseif ($_SESSION['user_role'] == 'jobseeker') {
        header("Location: jobseeker_dashboard.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body style="background-color:rgb(200, 200, 240)">
    <div class="container">
        <h1>Welcome to the Online Job Portal</h1>
        <p><a href="auth/login.php">Login</a> | <a href="auth/register.php">Register</a></p>
    </div>
    <footer>
        <p>&copy; 2025 Job Portal. All rights reserved.</p>
    </footer>
</body>
</html>
