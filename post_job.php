<?php

// post_job.php - Employer Job Posting

session_start();
include '../config/config.php';
if (!isset($_SESSION['user_id'])) {
    die("Error: User is not logged in.");
}
$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'employer') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_title = $_POST['job_title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $job_description = $_POST['job_description'];
    $salary = $_POST['salary'];
    $employer_id = $_SESSION['user_id'];

    $sql = "INSERT INTO jobs (job_title,job_description, location, salary,employer_id) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdi", $job_title, $job_description, $location, $salary, $employer_id);


    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Job posted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Post a New Job</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Job Title</label>
                <input type="text" class="form-control" name="job_title" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Company</label>
                <input type="text" class="form-control" name="company" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" class="form-control" name="location" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Job Description</label>
                <textarea class="form-control" name="job_description" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Salary</label>
                <input type="text" class="form-control" name="salary" required>
            </div>
            <button type="submit" class="btn btn-success">Post Job</button>
        </form>
        <a href="../dashboard/employer_dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>
</body>
</html>
