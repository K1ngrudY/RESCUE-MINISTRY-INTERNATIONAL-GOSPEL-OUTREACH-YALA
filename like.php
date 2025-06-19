<?php
include 'db.php';
$media_id = $_POST['media_id'];
$stmt = $conn->prepare("UPDATE media SET likes = likes + 1 WHERE id = ?");
$stmt->bind_param("i", $media_id);
$stmt->execute();
?>