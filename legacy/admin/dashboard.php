<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
}
include "../config/database.php";

$totalTreatment = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM treatments"));
$totalKursus = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM kursus"));
$bookingTreatment = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM booking_treatment"));
$bookingKursus = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM booking_kursus"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

  <!-- SIDEBAR -->
  <aside class="w-64 bg-white p-6">
    <h2 class="text-xl font-bold mb-6">Admin Panel</h2>

    <ul class="space-y-4">
      <li>
        <a href="dashboard.php" class="font-semibold text-pink-500">
          Dashboard
        </a>
      </li>
      <li><a href="treatment.php">Kelola Treatment</a></li>
      <li><a href="kelola_news.php">Kelola News</a></li>
      <li>
        <a href="logout.php" class="text-red-500">Logout</a>
      </li>
    </ul>
  </aside>

  <!-- CONTENT -->
  <main class="flex-1 p-10">

    <h1 class="text-3xl font-bold mb-8">Dashboard Admin</h1>

    <div class="grid md:grid-cols-4 gap-6">

      <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-500">Total Treatment</p>
        <h2 class="text-2xl font-bold"><?= $totalTreatment ?></h2>
      </div>

      <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-500">Total Kursus</p>
        <h2 class="text-2xl font-bold"><?= $totalKursus ?></h2>
      </div>

      <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-500">Booking Treatment</p>
        <h2 class="text-2xl font-bold"><?= $bookingTreatment ?></h2>
      </div>

      <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-500">Booking Kursus</p>
        <h2 class="text-2xl font-bold"><?= $bookingKursus ?></h2>
      </div>

    </div>

  </main>

</div>

</body>
</html>
