<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get students data from the controller
require_once 'config/Database.php';
require_once 'model/StudentModel.php';

$studentModel = new StudentModel($db);
$students = $studentModel->getAllStudents();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Student Management</h2>
    
    <!-- Logout Button -->
    <a href="logout.php">Logout</a>

    <h3>Student List</h3>
    <table border="1">
        <tr>
            <th>Student Name</th>
            <th>Student ID</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?php echo htmlspecialchars($student['student_name']); ?></td>
            <td><?php echo htmlspecialchars($student['student_id']); ?></td>
            <td><?php echo htmlspecialchars($student['email']); ?></td>
            <td>
                <a href="index.php?action=delete&id=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure you want to delete this student?');">
                    Delete
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Add New Student</h3>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="add">
        <input type="text" name="student_name" placeholder="Student Name" required>
        <input type="text" name="student_id" placeholder="Student ID" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Add Student</button>
    </form>
</body>
</html>
