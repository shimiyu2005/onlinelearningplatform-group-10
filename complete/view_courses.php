<?php
session_start();
include 'db.php';

// Check database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch courses
$result = $conn->query("SELECT * FROM courses");
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Courses</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
    <h2>Available uploads</h2>
    <!-- Logout button/link -->
    <a href="logout.php" style="float: right; margin-top: -40px; padding: 10px; background-color:rgb(138, 131, 130); color: white; text-decoration: none; border-radius: 5px;">Logout</a>
</header>
<div class="courses-list">
<?php
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='course'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        if (!empty($row['video'])) {
            echo "<video width='300' controls src='uploads/" . htmlspecialchars($row['video']) . "'></video><br>";
        }
        if (!empty($row['document'])) {
            echo "<a href='uploads/" . htmlspecialchars($row['document']) . "' download>Download Document</a>";
        }
        echo "<hr></div>";
    }
} else {
    echo "<p>No courses available.</p>";
}
?>
</div>
  color: rgb(250, 194, 9);
</body>
</html>