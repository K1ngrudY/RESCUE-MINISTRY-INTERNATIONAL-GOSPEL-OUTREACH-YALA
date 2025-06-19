<?php
include 'db.php';
$result = $conn->query("SELECT * FROM chat ORDER BY created_at DESC LIMIT 15");
while ($row = $result->fetch_assoc()) {
  echo "<p><strong>{$row['user']}:</strong> {$row['message']}</p>";
}
?>