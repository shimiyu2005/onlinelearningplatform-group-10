<?php
// instructor_dashboard.php

session_start();

// Check if user is logged in and is instructor
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'instructor') {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Instructor Dashboard</title>
<style>
    body {
        margin: 0;
        font-family: 'Arial', sans-serif;
        background-color: #0D1B2A; /* Dark Blue Background */
        color: #FFFFFF; /* White Text */
    }

    header {
        background-color: #1B263B; /* Slightly lighter blue for header */
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
    }

    header h1 {
        margin: 0;
        font-size: 28px;
        color: #FFD700; /* Gold for contrast */
    }

    .container {
        padding: 30px;
        max-width: 1000px;
        margin: auto;
    }

    .welcome {
        font-size: 24px;
        margin-bottom: 20px;
        color: #FFD700;
        text-align: center;
    }

    /* Example menu or options */
    .menu {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .card {
        background-color: #1B263B;
        padding: 20px;
        border-radius: 10px;
        width: 250px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.4);
    }

    .card h2 {
        margin-top: 0;
        font-size: 20px;
        color: #FFD700;
    }

    /* Styling links or buttons inside cards */
    a {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 15px;
        background-color: #256D85; /* Blue accent */
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    a:hover {
        background-color: #3AAFA9;
    }

    /* Footer style */
    footer {
        background-color: #1B263B;
        padding: 15px;
        text-align: center;
        margin-top: 40px;
        font-size: 14px;
        color: #ccc;
    }
</style>
</head>
<body>

<header>
    <h1>Instructor Dashboard</h1>
</header>

<div class="container">
    <div class="welcome">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</div>
    <div class="menu">
        <div class="card">
            <h2>Manage Courses</h2>
            <!-- <a href="create_course.php">Create Course</a> -->
            <a href="upload_course.php">Upload Course</a>
            <a href="my_uploads.php">View uploads</a>
        </div>
       
    </div>
</div>

<footer>
    &copy; <?php echo date("Y"); ?> Your Institution. All rights reserved.
</footer>

</body>
</html>