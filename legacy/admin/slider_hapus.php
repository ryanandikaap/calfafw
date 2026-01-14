<?php
include "../config/database.php";

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM sliders WHERE id=$id");
$d = mysqli_fetch_assoc($data);

unlink("../uploads/slider/".$d['image']);
mysqli_query($conn, "DELETE FROM sliders WHERE id=$id");

header("Location: slider.php");
