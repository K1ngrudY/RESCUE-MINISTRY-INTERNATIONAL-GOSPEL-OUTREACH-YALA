
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username === "admin" && $password === "faith123") {
        $_SESSION['admin'] = true;
        header("Location: upload.php");
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>
<form method="POST">
  <h2>Admin Login</h2>
  <input type="text" name="username" required placeholder="Username"><br>
  <input type="password" name="password" required placeholder="Password"><br>
  <button type="submit">Login</button>
  <?php if (!empty($error)) echo "<p>$error</p>"; ?>
</form>
