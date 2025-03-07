<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Students List</title>
</head>
<body>
    <div class="container">
    <h2>Students</h2>
    <div style="text-align: right; margin-bottom: 10px;">
        <a href="logout.php">
            <button style="background-color: red; color: white; border: none; padding: 10px 15px; cursor: pointer;">
                Logout
            </button>
        </a>
    </div>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Student ID</th>
            <th>Action</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?php echo htmlspecialchars($student['id']); ?></td>
            <td><?php echo htmlspecialchars($student['student_name']); ?></td>
            <td><?php echo htmlspecialchars($student['email']); ?></td>
            <td><?php echo htmlspecialchars($student['student_id']); ?></td>
            <td>
                <a href="index.php?page=delete_student&id=<?php echo $student['id']; ?>" style="color: red;">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Add Student</h3>
    <form action="index.php?page=add_student" method="POST">
        <input type="text" name="student_name" placeholder="Student Name" required>
        <input type="email" name="email" placeholder="Student Email" required>
        <button type="submit">Add</button>
    </form>
    </div>
</body>
</html>
