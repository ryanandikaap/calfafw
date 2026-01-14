<?php
include "../config/database.php";

$name  = $_POST['name'];
$title = $_POST['title'];

$photoName = time() . '_' . $_FILES['photo']['name'];
$path = "../uploads/hairstylists/" . $photoName;

move_uploaded_file($_FILES['photo']['tmp_name'], $path);

mysqli_query($conn, "
  INSERT INTO hairstylists (name, title, photo)
  VALUES ('$name', '$title', '$photoName')
");

header("Location: hairstylist.php");
