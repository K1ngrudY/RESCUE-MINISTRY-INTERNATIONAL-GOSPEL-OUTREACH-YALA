<?php
include 'db.php';
$user = $_POST['user'];
$message = $_POST['message'];
$stmt = $conn->prepare("INSERT INTO chat (user, message) VALUES (?, ?)");
$stmt->bind_param("ss", $user, $message);
$stmt->execute();
?>