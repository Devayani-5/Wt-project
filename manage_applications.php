<?php
// manage_applications.php - Employer's Job Applications Management

session_start();
include '../config/config.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'employer') {
    header("Location: ../index.php");
    exit();
}

$employer_id = $_SESSION['user_id'];
$sql = "SELECT applications.id, jobseeker_id, users.name as jobseeker_name, jobs.job_title FROM applications 
        JOIN jobs ON applications.job_id = jobs.id 
        JOIN users ON applications.jobseeker_id = users.id 
        WHERE jobs.employer_id = ? ORDER BY applications.id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employer_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Applications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Manage Applications</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Job Seeker</th>
                    <th>Job Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['jobseeker_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['job_title']); ?></td>
                        <td>
                            <a href="view_jobseeker.php?jobseeker_id=<?php echo $row['jobseeker_id']; ?>" class="btn btn-info">View Profile</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="../dashboard/employer_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</body>
</html>
