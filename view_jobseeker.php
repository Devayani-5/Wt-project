<?php
// view_jobseeker.php - Employer views job seeker profile

session_start();
include '../config/config.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'employer') {
    header("Location: ../index.php");
    exit();
}

if (!isset($_GET['jobseeker_id'])) {
    die("Invalid request.");
}

$jobseeker_id = $_GET['jobseeker_id'];
$sql = "SELECT name, email, phone, resume FROM users WHERE id = ? AND role = 'jobseeker'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $jobseeker_id);
$stmt->execute();
$result = $stmt->get_result();
$jobseeker = $result->fetch_assoc();

if (!$jobseeker) {
    die("Job seeker not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Job Seeker Profile</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($jobseeker['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($jobseeker['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($jobseeker['phone']); ?></p>
        <?php if ($jobseeker['resume']): ?>
            <p><strong>Resume:</strong> <a href="../uploads/<?php echo htmlspecialchars($jobseeker['resume']); ?>" target="_blank">Download</a></p>
        <?php endif; ?>
        <a href="manage_applications.php" class="btn btn-secondary">Back to Applications</a>
    </div>
</body>
</html>
