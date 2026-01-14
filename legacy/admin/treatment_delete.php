<?php
session_start();
if (!isset($_SESSION['admin'])) header("Location: login.php");

include "../config/database.php";

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM treatments WHERE id=$id");
$t = mysqli_fetch_assoc($data);

// Hapus file gambar
if ($t['image'] && file_exists("../images/".$t['image'])) {
    unlink("../images/".$t['image']);
}

// Hapus record
mysqli_query($conn, "DELETE FROM treatments WHERE id=$id") or die(mysqli_error($conn));
header("Location: treatment.php");
