<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Student Dashboard</title>
<style>
/* Internal Style for Student Dashboard with Dark Blue Theme */
body {
    margin: 0;
    font-family: 'Arial', sans-serif;
    background-color: #0D1B2A; /* Dark blue background */
    color: #ffffff; /* White text */
}

h1 {
    background-color: #1B263B; /* Slightly lighter dark blue for header */
    padding: 20px;
    margin: 0;
    text-align: center;
    color: #FFD700; /* Gold color for heading */
    font-size: 2em;
}

p {
    text-align: center;
    margin-top: 10px;
    font-size: 1.2em;
}

ul {
    list-style: none;
    padding: 0;
    max-width: 300px;
    margin: 30px auto;
}

li {
    margin-bottom: 15px;
}

li a {
    display: block;
    padding: 15px;
    background-color: #1B263B; /* Darker blue for buttons */
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    transition: background-color 0.3s, transform 0.2s;
}

li a:hover {
    background-color:rgb(235, 163, 9); /* Lighter blue on hover */
    transform: scale(1.02);
}

 footer {
        background-color: #1B263B;
        padding: 15px;
        text-align: center;
        margin-top: 40px;
        font-size: 14px;
        color: #ccc;}
</style>
</head>
<body>
<h1>Student Dashboard</h1>
<p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
<ul>
    <li><a href="view_courses.php">View Uploaded Contents</a></li>
    <!-- <li><a href="kozi.php">View Courses</a></li> -->
    <li><a href="logout.php">Logout</a></li>
</ul>
<!-- <footer>
    &copy; <?php echo date("Y"); ?> Your Institution. All rights reserved.
</footer> -->
</body>
</html>