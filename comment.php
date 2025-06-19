<?php
include 'db.php';
$media_id = $_POST['media_id'];
$comment = $_POST['comment'];
$stmt = $conn->prepare("INSERT INTO comments (media_id, comment) VALUES (?, ?)");
$stmt->bind_param("is", $media_id, $comment);
$stmt->execute();
?>