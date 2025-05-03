<?php
// apply_job.php - Job Application

session_start();
include '../config/config.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'jobseeker') {
    header("Location: ../index.php");
    exit();
}

if (!isset($_GET['job_id'])) {
    die("Invalid job selection.");
}

$job_id = $_GET['job_id'];
$jobseeker_id = $_SESSION['user_id'];

// Check if the user already applied
$check_sql = "SELECT * FROM applications WHERE job_id = ? AND jobseeker_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ii", $job_id, $jobseeker_id);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows > 0) {
    die("<div class='alert alert-warning'>You have already applied for this job.</div>");
}

// Insert application
$sql = "INSERT INTO applications (job_id, jobseeker_id) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $job_id, $jobseeker_id);

if ($stmt->execute()) {
    echo "<div class='alert alert-success'>Application submitted successfully!</div>";
} else {
    echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Job Application</h2>
        <p>Your application has been submitted.</p>
        <a href="../jobs/view_jobs.php" class="btn btn-primary">Back to Job Listings</a>
    </div>
</body>
</html>
