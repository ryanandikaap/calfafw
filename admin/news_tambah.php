<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
require_once __DIR__ . "/../config/database.php";

if (isset($_POST['simpan'])) {
  $title = $_POST['title'];
  $category = $_POST['category'];
  $short_desc = $_POST['short_desc'];
  $content = $_POST['content'];

  $image = $_FILES['image']['name'];
  $tmp   = $_FILES['image']['tmp_name'];

  $folder = "../uploads/news/";
  if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
  }

  move_uploaded_file($tmp, $folder . $image);

  mysqli_query($conn, "INSERT INTO news 
    (title, category, short_desc, content, image)
    VALUES
    ('$title','$category','$short_desc','$content','$image')
  ");

  header("Location: kelola_news.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah News</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

  <!-- ================= SIDEBAR ================= -->
  <aside class="w-64 bg-white p-6 shadow-md">
    <h2 class="text-xl font-bold mb-6">Admin Panel</h2>

    <ul class="space-y-4">
      <li>
        <a href="dashboard.php" class="font-semibold hover:text-pink-500">
          Dashboard
        </a>
      </li>
      <li>
        <a href="treatment.php" class="font-semibold hover:text-pink-500">
          Kelola Treatment
        </a>
      </li>
      <li>
        <a href="kursus.php" class="font-semibold hover:text-pink-500">
          Kelola Kursus
        </a>
      </li>
      <li>
        <a href="kelola_news.php" class="font-semibold hover:text-pink-500">
  Kelola News
</a>

      </li>
      <li>
        <a href="logout.php"
           class="text-red-500 font-semibold hover:underline">
          Logout
        </a>
      </li>
    </ul>
  </aside>

  <!-- ================= CONTENT ================= -->
  <main class="flex-1 p-10">

    <h1 class="text-2xl font-bold mb-6">Tambah News</h1>

    <form method="post" enctype="multipart/form-data"
          class="bg-white p-6 rounded-xl shadow max-w-xl">

      <label class="block mb-2 font-semibold">Judul</label>
      <input type="text" name="title" required
             class="w-full border rounded p-2 mb-4">

      <label class="block mb-2 font-semibold">Kategori</label>
      <select name="category" required>
  <option value="info">Info</option>
  <option value="promo">Promo</option>
</select>


      <label class="block mb-2 font-semibold">Deskripsi Singkat</label>
      <textarea name="short_desc"
                class="w-full border rounded p-2 mb-4"></textarea>

      <label class="block mb-2 font-semibold">Konten</label>
      <textarea name="content"
                class="w-full border rounded p-2 mb-4 h-32"></textarea>

      <label class="block mb-2 font-semibold">Gambar</label>
      <input type="file" name="image" required class="mb-6">

      <div class="flex gap-3">
        <button name="simpan"
                class="bg-pink-600 hover:bg-pink-700
                       text-white px-6 py-2 rounded">
          Simpan
        </button>

        <a href="kelola_news.php"
           class="bg-gray-300 hover:bg-gray-400
                  px-6 py-2 rounded">
          Batal
        </a>
      </div>

    </form>

  </main>

</div>

</body>
</html>
