<?php
// view_jobs.php - Job Listings for Job Seekers

session_start();
include '../config/config.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'jobseeker') {
    header("Location: ../index.php");
    exit();
}

//$sql = "SELECT id, job_title, job_description, location, salary FROM jobs";
//$sql = "SELECT job_title, job_description, location, salary, company FROM jobs";
$sql = "SELECT  job_title, company, location, salary, job_description FROM jobs";





$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Jobs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Available Jobs</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['job_title']); ?></td>
                        <td><?php echo htmlspecialchars($row['company']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><?php echo htmlspecialchars($row['job_description']); ?></td>
                        <td><?php echo htmlspecialchars($row['salary']); ?></td>
                        <td><a href="../jobs/apply_job.php" class="btn btn-primary">Apply</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="../dashboard/jobseeker_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</body>
</html>
