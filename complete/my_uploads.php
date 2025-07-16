<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'instructor') {
    header('Location: login.php');
    exit();
}

$instructor_id = $_SESSION['user_id'];

// Fetch all uploads for the logged-in instructor
$stmt = $conn->prepare("SELECT * FROM courses WHERE instructor_id = ?");
$stmt->bind_param("i", $instructor_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Uploads</title>
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
        .upload-card {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
<header>
    <h2 style="float:left;">Uploaded Content</h2>
    <form action="logout.php" method="post" style="float:right;">
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</header>

<div class="card">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="upload-card">
                <h3><?= htmlspecialchars($row['title']) ?></h3>
                <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>

                <?php if (!empty($row['video'])): ?>
                    <?php if (file_exists("uploads/" . $row['video'])): ?>
                        <p><strong>Video:</strong> <a href="uploads/<?= urlencode($row['video']) ?>" target="_blank">View Video</a></p>
                    <?php else: ?>
                        <p style="color: red;"><strong>Video file not found:</strong> <?= htmlspecialchars($row['video']) ?></p>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (!empty($row['document'])): ?>
                    <?php if (file_exists("uploads/" . $row['document'])): ?>
                        <p><strong>Document:</strong> <a href="uploads/<?= urlencode($row['document']) ?>" target="_blank">View Document</a></p>
                    <?php else: ?>
                        <p style="color: red;"><strong>Document file not found:</strong> <?= htmlspecialchars($row['document']) ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>You haven't uploaded any courses yet.</p>
    <?php endif; ?>
</div>
</body>
</html>
