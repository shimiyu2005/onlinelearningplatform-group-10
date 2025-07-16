<!DOCTYPE html>
<html>
<head><title>Instructor Dashboard</title></head>
<link rel="stylesheet" href="style1.css">
<body>
  <h1>Welcome, Instructor</h1>
  <form action="../../backend/upload_course.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Course Title" required><br>
    <textarea name="description" placeholder="Course Description"></textarea><br>
    <label>Video: <input type="file" name="video"></label><br>
    <label>Document: <input type="file" name="document"></label><br>
    <button type="submit">Upload Course</button>
  </form>
</body>
</html>
