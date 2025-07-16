<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

// Connect to your database
$conn = new mysqli('localhost', 'db_user', 'db_password', 'db_name');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch uploaded files
$sql = "SELECT uploads.id, uploads.filename, uploads.upload_date, courses.course_name
        FROM uploads
        JOIN courses ON uploads.course_id = courses.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>View Uploaded Contents</title>
<style>
/* Your internal styles here */
body {
    font-family: Arial, sans-serif;
    background-color: #0D1B2A;
    color: #fff;
    padding: 20px;
}
h1 {
    text-align: center;
    color: #FFD700;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
th, td {
    padding: 10px;
    border: 1px solid #256D85;
    text-align: left;
}
tr:nth-child(even) {
    background-color: #1B263B;
}
a {
    color: #FFD700;
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
<h1>Uploaded Contents</h1>
<table>
<tr>
    <th>File Name</th>
    <th>Course</th>
    <th>Upload Date</th>
</tr>
<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['filename']}</td>
                <td>{$row['course_name']}</td>
                <td>{$row['upload_date']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No uploaded content</td></tr>";
}
$conn->close();
?>
</table>
<!-- <footer>
    &copy; <?php echo date("Y"); ?> Your Institution. All rights reserved.
</footer> -->
</body>
</html>