<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../config/database.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data news
$query = mysqli_query($conn, "SELECT image FROM news WHERE id=$id");
$data  = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data news tidak ditemukan";
    exit;
}

// Hapus gambar jika ada
$imgPath = "../uploads/news/" . $data['image'];
if (!empty($data['image']) && file_exists($imgPath)) {
    unlink($imgPath);
}

// Hapus data dari database
mysqli_query($conn, "DELETE FROM news WHERE id=$id");

// Kembali ke kelola news
header("Location: kelola_news.php");
exit;
