<?php
// view_applications.php - Job Seeker's Applied Jobs

session_start();
include '../config/config.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'jobseeker') {
    header("Location: ../index.php");
    exit();
}

$jobseeker_id = $_SESSION['user_id'];
$sql = "SELECT jobs.job_title, jobs.company, jobs.location, jobs.salary FROM applications 
        JOIN jobs ON applications.job_id = jobs.id 
        WHERE applications.jobseeker_id = ? ORDER BY applications.id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $jobseeker_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>My Applications</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['job_title']); ?></td>
                        <td><?php echo htmlspecialchars($row['company']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><?php echo htmlspecialchars($row['salary']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="../dashboard/jobseeker_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</body>
</html>
