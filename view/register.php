<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
    <h2>Register</h2>
    <?php
    if (isset($_SESSION['register_error'])) {
        echo "<p style='color:red;'>" . $_SESSION['register_error'] . "</p>";
        unset($_SESSION['register_error']);
    }
    if (isset($_SESSION['register_success'])) {
        echo "<p style='color:green;'>" . $_SESSION['register_success'] . "</p>";
        unset($_SESSION['register_success']);
    }
    ?>
    <form action="index.php?page=register" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="index.php?page=login">Login here</a></p>
    </div>
</body>
</html>
