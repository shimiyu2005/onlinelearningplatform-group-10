<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'instructor') {
    header('Location: login.php');
    exit();
}

if (!isset($_SESSION['user_id'])) {
    echo "User ID not found in session.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $instructor_id = $_SESSION['user_id'];

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $videoName = null;
    $docName = null;

    if (!empty($_FILES['video']['name'])) {
        $videoFile = $_FILES['video'];
        $videoName = uniqid() . '_' . basename($videoFile['name']);
        $videoPath = $uploadDir . $videoName;

        if (!move_uploaded_file($videoFile['tmp_name'], $videoPath)) {
            echo "<p style='color:red;'>Error uploading video file.</p>";
            $videoName = null;
        }
    }

    if (!empty($_FILES['document']['name'])) {
        $docFile = $_FILES['document'];
        $docName = uniqid() . '_' . basename($docFile['name']);
        $docPath = $uploadDir . $docName;

        if (!move_uploaded_file($docFile['tmp_name'], $docPath)) {
            echo "<p style='color:red;'>Error uploading document file.</p>";
            $docName = null;
        }
    }

    if ($videoName || $docName) {
        $stmt = $conn->prepare("INSERT INTO courses (title, description, video, document, instructor_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $title, $description, $videoName, $docName, $instructor_id);
        if ($stmt->execute()) {
            echo "<p style='color:white;'>Course uploaded successfully!</p>";
        } else {
            echo "<p style='color:red;'>Database error: " . $stmt->error . "</p>";
        }
    } else {
        echo "<p style='color:red;'>Please upload at least a video or document.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Course</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .logout-btn {
            float: right;
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        .logout-btn:hover {
            background-color: #5a6268;
        }
        header {
            overflow: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<header>
    <h2 style="float:left;">Upload New Course</h2>
    <form action="logout.php" method="post" style="float:right;">
        <button type="submit" class="logout-btn">Logout</button>
    </form>
    <div style="margin-top: 20px;">
    <a href="my_uploads.php" class="btn btn-secondary">See All Your Uploads</a>
</div>

</header>

<div class="card">
<form method="post" enctype="multipart/form-data">
    <label>Title</label>
    <input type="text" name="title" required>

    <label>Description</label>
    <textarea name="description" required></textarea>

    <label>Video File (optional)</label>
    <input type="file" name="video" accept="video/*">

    <label>Document File (optional)</label>
    <input type="file" name="document" accept=".pdf,.doc,.docx">

    <button type="submit" class="btn btn-primary">Upload Course</button>
</form>
</div>
</body>
</html>
