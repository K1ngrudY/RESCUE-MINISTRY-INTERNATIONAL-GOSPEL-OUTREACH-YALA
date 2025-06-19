
<?php session_start(); if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; } ?>
<h2>Upload to Gallery</h2>
<form action="upload_image.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="galleryImage" accept="image/*" required><br>
  <input type="text" name="title" placeholder="Title"><br>
  <textarea name="description" placeholder="Description"></textarea><br>
  <button type="submit">Upload Image</button>
</form>

<h2>Upload Sermon</h2>
<form action="upload_video.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="sermonVideo" accept="video/*"><br>
  <input type="text" name="title" placeholder="Sermon Title"><br>
  <input type="text" name="preacher" placeholder="Preacher"><br>
  <input type="date" name="date"><br>
  <input type="url" name="youtube" placeholder="YouTube/Vimeo Link (optional)"><br>
  <button type="submit">Upload Sermon</button>
</form>

<p><a href="logout.php">Logout</a></p>
<?php
include 'db.php';
$targetDir = "uploads/";
$fileName = basename($_FILES["video"]["name"]);
$targetFile = $targetDir . $fileName;
if (move_uploaded_file($_FILES["video"]["tmp_name"], $targetFile)) {
    $type = pathinfo($targetFile, PATHINFO_EXTENSION) === 'mp4' ? 'video' : 'image';
    $stmt = $conn->prepare("INSERT INTO media (type, path) VALUES (?, ?)");
    $stmt->bind_param("ss", $type, $targetFile);
    $stmt->execute();
    header("Location: index.php");
} else {
    echo "Upload failed.";
}
?>