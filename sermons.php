
<!DOCTYPE html>
<html>
<head><title>Sermons</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<?php include('header.php'); ?>
<h2>Sermons</h2>
<div class="sermon-list">
<?php
$sermons = json_decode(file_get_contents("sermons_data.json"), true);
$perPage = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $perPage;
$items = array_slice($sermons, $start, $perPage);
foreach ($items as $s) {
  echo "<div>";
  if ($s['video_type'] === 'youtube') {
    echo "<iframe width='300' src='{$s['video_url']}' frameborder='0' allowfullscreen></iframe>";
  } else {
    echo "<video controls width='300'><source src='videos/{$s['filename']}' type='video/mp4'></video>";
  }
  echo "<br><strong>{$s['title']}</strong><br><em>{$s['preacher']}</em> - {$s['date']}</div>";
}
$totalPages = ceil(count($sermons) / $perPage);
echo "<div>Pages: ";
for ($i = 1; $i <= $totalPages; $i++) echo "<a href='?page=$i'>$i</a> ";
echo "</div>";
?>
</div>
</body>
</html>
