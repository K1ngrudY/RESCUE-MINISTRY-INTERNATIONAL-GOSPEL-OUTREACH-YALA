
<!DOCTYPE html>
<html>
<head><title>Gallery</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<?php include('header.php'); ?>
<h2>Gallery</h2>
<div class="gallery-grid">
<?php
$data = json_decode(file_get_contents("gallery_data.json"), true);
foreach ($data as $img) {
  echo "<div><img src='images/{$img['filename']}' width='200'><br><strong>{$img['title']}</strong><br>{$img['description']}</div>";
}
?>
</div>
</body>
</html>
