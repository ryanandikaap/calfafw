<?php
session_start();
include "../config/database.php";

$error = "";

if (isset($_POST['login'])) {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ? AND role = ?");
    $role = 'admin';

    mysqli_stmt_bind_param($stmt, "ss", $email, $role);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $admin = mysqli_fetch_assoc($result);

        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = [
                'id'    => $admin['id'],
                'name'  => $admin['name'],
                'email' => $admin['email'],
                'role'  => $admin['role']
            ];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Akun admin tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<form method="POST" class="bg-white p-8 rounded-xl shadow w-96">
  <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>

  <?php if($error): ?>
    <p class="text-red-500 mb-4 text-sm text-center"><?= $error ?></p>
  <?php endif; ?>

  <input
    type="email"
    name="email"
    placeholder="Email"
    class="w-full border p-3 mb-4 rounded"
    required>

  <input
    type="password"
    name="password"
    placeholder="Password"
    class="w-full border p-3 mb-6 rounded"
    required>

  <button
    name="login"
    class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded font-semibold">
    Login
  </button>
</form>

</body>
</html>
