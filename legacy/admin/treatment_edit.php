<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include "../config/database.php";

$id = $_GET['id'];
$treatment = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM treatments WHERE id='$id'"));

if(isset($_POST['update'])){
    $name     = $_POST['name'];
    $category = $_POST['category'];
    $desc     = $_POST['description'];
    $price    = $_POST['price'];

    $image = $treatment['image'];
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $image);
    }

    mysqli_query($conn, "
      UPDATE treatments SET 
        name='$name',
        category='$category',
        description='$desc',
        price='$price',
        image='$image'
      WHERE id='$id'
    ") or die(mysqli_error($conn));

    header("Location: treatment.php");
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Treatment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

<h2 class="text-2xl font-bold mb-6">Edit Treatment</h2>

<form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow w-96">
    <input name="name" value="<?= htmlspecialchars($treatment['name']) ?>" placeholder="Nama Treatment" class="w-full border p-3 mb-4 rounded">
    <select name="category" required class="w-full border p-3 mb-4 rounded">
  <option value="">-- Pilih Kategori --</option>
  <option value="Hair" <?= $treatment['category']=='Hair'?'selected':'' ?>>Hair</option>
  <option value="Face" <?= $treatment['category']=='Face'?'selected':'' ?>>Facial</option>
  <option value="Nail" <?= $treatment['category']=='Nail'?'selected':'' ?>>Nail</option>
  <option value="Spa"  <?= $treatment['category']=='Spa'?'selected':'' ?>>Spa</option>
</select>

    <textarea name="description" placeholder="Deskripsi" class="w-full border p-3 mb-4 rounded"><?= htmlspecialchars($treatment['description']) ?></textarea>
    <input name="price" value="<?= $treatment['price'] ?>" placeholder="Harga" class="w-full border p-3 mb-4 rounded">
    <p class="mb-2">Foto Saat Ini:</p>
    <?php if($treatment['image'] && file_exists("../uploads/".$treatment['image'])): ?>
        <img src="../uploads/<?= $treatment['image'] ?>" class="w-40 mb-4 rounded">
    <?php else: ?>
        <p class="mb-4 text-gray-500">Belum ada foto</p>
    <?php endif; ?>
    <input type="file" name="image" class="w-full mb-4">
    <button name="update" class="bg-pink-500 text-white px-4 py-2 rounded">Update</button>
</form>

</body>
</html>
