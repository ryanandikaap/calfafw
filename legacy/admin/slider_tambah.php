<?php
session_start();
include "../config/database.php";

// (Opsional) proteksi login admin
// if (!isset($_SESSION['admin'])) {
//   header("Location: login.php");
//   exit;
// }

$error = "";

if (isset($_POST['simpan'])) {

  $foto = $_FILES['foto']['name'];
  $tmp  = $_FILES['foto']['tmp_name'];

  $allowed = ['jpg','jpeg','png','webp'];
  $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

  if (!in_array($ext, $allowed)) {
    $error = "Format gambar harus JPG, PNG, atau WEBP";
  } else {

    $namaBaru = time() . '-' . $foto;
    move_uploaded_file($tmp, "../uploads/slider/" . $namaBaru);

    mysqli_query(
      $conn,
      "INSERT INTO sliders (image, status) VALUES ('$namaBaru','aktif')"
    );

    header("Location: slider.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Slider</title>
  <link rel="stylesheet" href="../assets/css/tailwind.css">
</head>
<body class="bg-gray-100 p-10">

<div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow">
  <h2 class="text-xl font-bold mb-4">Tambah Foto Slider</h2>

  <?php if ($error): ?>
    <p class="text-red-500 mb-3"><?= $error ?></p>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="foto" required
      class="mb-4 block w-full border rounded p-2">

    <button name="simpan"
      class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600">
      Simpan
    </button>

    <a href="slider.php"
      class="ml-3 text-gray-500 hover:underline">Kembali</a>
  </form>
</div>

</body>
</html>
