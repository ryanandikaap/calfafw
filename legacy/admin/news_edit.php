<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
require_once __DIR__ . "/../config/database.php";


$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM news WHERE id=$id"));

if (isset($_POST['update'])) {
  $title = $_POST['title'];
  $category = $_POST['category'];
  $short_desc = $_POST['short_desc'];
  $content = $_POST['content'];

  if ($_FILES['image']['name'] != '') {
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "../uploads/news/" . $image);

    mysqli_query($conn, "UPDATE news SET
      title='$title',
      category='$category',
      short_desc='$short_desc',
      content='$content',
      image='$image'
      WHERE id=$id
    ");
  } else {
    mysqli_query($conn, "UPDATE news SET
      title='$title',
      category='$category',
      short_desc='$short_desc',
      content='$content'
      WHERE id=$id
    ");
  }

 header("Location: kelola_news.php");
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit News</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

<h1 class="text-2xl font-bold mb-6">Edit News</h1>

<form method="post" enctype="multipart/form-data"
      class="bg-white p-6 rounded-xl shadow max-w-xl">

  <label>Judul</label>
  <input type="text" name="title"
         value="<?= $data['title']; ?>"
         class="w-full border p-2 mb-4">

<label class="block mb-1 font-semibold">Kategori</label>
<select name="category" class="w-full border p-2 mb-4 rounded" required>
  <option value="info" <?= $data['category']=='info'?'selected':'' ?>>
    Info
  </option>
  <option value="promo" <?= $data['category']=='promo'?'selected':'' ?>>
    Promo
  </option>
</select>


  <label>Deskripsi Singkat</label>
  <textarea name="short_desc"
            class="w-full border p-2 mb-4"><?= $data['short_desc']; ?></textarea>

  <label>Konten</label>
  <textarea name="content"
            class="w-full border p-2 mb-4 h-32"><?= $data['content']; ?></textarea>

  <label>Ganti Gambar</label>
  <input type="file" name="image" class="mb-4">

  <button name="update"
          class="bg-blue-600 text-white px-6 py-2 rounded">
    Update
  </button>
</form>

</body>
</html>
