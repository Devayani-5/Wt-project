<?php
// jobseeker_dashboard.php - Job Seeker Dashboard

session_start();
include '../config/config.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'jobseeker') {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome, <?php echo $_SESSION['user_name']; ?> (Job Seeker)</h2>
        <a href="../jobs/view_jobs.php" class="btn btn-primary">View Jobs</a>
        <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
