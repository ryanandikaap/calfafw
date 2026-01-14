<?php
session_start();
include "../config/database.php";

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
  $user = mysqli_fetch_assoc($query);

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user;
    header("Location: ../index.php");
  }
}
?>

<form method="POST">
  <input type="email" name="email" required>
  <input type="password" name="password" required>
  <button name="login">Login</button>
</form>
