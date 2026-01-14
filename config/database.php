<?php
// config/database.php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "calfasalon";

// Buat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set charset biar aman
mysqli_set_charset($conn, "utf8mb4");
