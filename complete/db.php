<?php
// db.php - Database connection script

$host = 'localhost'; // or your database host
$username = 'root'; // replace with your DB username
$password = ''; // replace with your DB password
$dbname = 'online_learning';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>