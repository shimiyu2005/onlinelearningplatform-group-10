<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $selectedRole = $_POST['role'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    if (!$stmt) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
            if ($user['role'] === $selectedRole) {
                $_SESSION['user_id'] = $user['id']; // Required for upload_course.php
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] === 'student') {
                    header("Location: student_dashboard.php");
                } elseif ($user['role'] === 'instructor') {
                    header("Location: instructor_dashboard.php");
                } else {
                    header("Location: dashboard.php");
                }
                exit();
            } else {
                $error = "Selected role does not match your account.";
            }
        } else {
            $error = "Invalid credentials.";
        }
    } else {
        $error = "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header><h2>Login</h2></header>
<div class="card">
<form method="post">
    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Role</label>
    <select name="role" required>
        <option value="">Select Role</option>
        <option value="student">Student</option>
        <option value="instructor">Instructor</option>
    </select>

    <button type="submit" class="btn btn-primary">Login</button>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</form>
</div>
<!-- <footer>
    &copy; <?php echo date("Y"); ?> Your Institution. All rights reserved.
</footer> -->
</body>
</html>
