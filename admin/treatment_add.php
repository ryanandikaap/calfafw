<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include "../config/database.php";

if(isset($_POST['simpan'])){
  $name     = $_POST['name'];
$category = $_POST['category'];
$desc     = $_POST['description'];
$price    = $_POST['price'];

    $image = '';
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $image);
    }

    mysqli_query($conn, "
  INSERT INTO treatments (name, category, description, price, image)
  VALUES ('$name','$category','$desc','$price','$image')
") or die(mysqli_error($conn));


    header("Location: treatment.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Treatment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

<h2 class="text-2xl font-bold mb-6">Tambah Treatment</h2>

<form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow w-96">
    <input name="name" placeholder="Nama Treatment" class="w-full border p-3 mb-4 rounded">
    <select name="category" required
  class="w-full border p-3 mb-4 rounded">
  <option value="">-- Pilih Kategori --</option>
  <option value="Hair">Hair</option>
  <option value="Face">Facial</option>
  <option value="Nail">Nail</option>
  <option value="Spa">Spa</option>
</select>

    <textarea name="description" placeholder="Deskripsi" class="w-full border p-3 mb-4 rounded"></textarea>
    <input name="price" placeholder="Harga" class="w-full border p-3 mb-4 rounded">
    <input type="file" name="image" class="w-full mb-4">
    <button name="simpan" class="bg-pink-500 text-white px-4 py-2 rounded">Simpan</button>
</form>

</body>
</html>
