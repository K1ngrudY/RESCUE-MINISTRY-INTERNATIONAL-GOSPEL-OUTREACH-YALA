<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Media App</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
  <form action="upload.php" method="POST" enctype="multipart/form-data">
    <h3>Upload Video</h3>
    <input type="file" name="video" required>
    <button type="submit">Upload</button>
  </form>
  <h3>Media</h3>
  <?php
  $result = $conn->query("SELECT * FROM media ORDER BY id DESC");
  while ($row = $result->fetch_assoc()):
  ?>
    <div class="media-card">
      <?php if (strpos($row['path'], '.mp4')): ?>
        <video src="<?= $row['path'] ?>" controls></video>
      <?php else: ?>
        <img src="<?= $row['path'] ?>" alt="Media">
      <?php endif; ?>
      <div class="actions">
        <button onclick="likeMedia(<?= $row['id'] ?>)">❤️ Like (<span id="like-<?= $row['id'] ?>"><?= $row['likes'] ?></span>)</button>
      </div>
      <div class="comment-section">
        <input type="text" id="comment-<?= $row['id'] ?>" placeholder="Write a comment...">
        <button onclick="postComment(<?= $row['id'] ?>)">Post</button>
      </div>
    </div>
  <?php endwhile; ?>
  <h3>Live Chat</h3>
  <div class="chat-box" id="chat-box"></div>
  <input type="text" id="chat-user" placeholder="Your name">
  <input type="text" id="chat-msg" placeholder="Message">
  <button onclick="sendChat()">Send</button>
</div>
<script>
function likeMedia(id) {
  fetch('like.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'media_id=' + id
  }).then(() => {
    const likeElem = document.getElementById('like-' + id);
    likeElem.textContent = parseInt(likeElem.textContent) + 1;
  });
}
function postComment(id) {
  const comment = document.getElementById('comment-' + id).value;
  fetch('comment.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `media_id=${id}&comment=${encodeURIComponent(comment)}`
  }).then(() => {
    alert('Comment posted');
  });
}
function sendChat() {
  const user = document.getElementById('chat-user').value;
  const msg = document.getElementById('chat-msg').value;
  fetch('chat.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `user=${encodeURIComponent(user)}&message=${encodeURIComponent(msg)}`
  }).then(() => {
    document.getElementById('chat-msg').value = '';
    loadChat();
  });
}
function loadChat() {
  fetch('get_chat.php')
    .then(res => res.text())
    .then(data => {
      document.getElementById('chat-box').innerHTML = data;
    });
}
setInterval(loadChat, 3000);
window.onload = loadChat;
</script>
</body>
</html>