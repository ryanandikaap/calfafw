<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../config/database.php";

/* =========================
   UPLOAD SLIDER
========================= */
if (isset($_POST['upload'])) {

    if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== 0) {
        die("Upload gagal");
    }

    $allowed = ['jpg','jpeg','png','webp'];
    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        die("Format gambar tidak diizinkan");
    }

    // pastikan folder ada
    $folder = '../uploads/slider/';
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $image = uniqid('slider_') . '.' . $ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], $folder . $image);

    mysqli_query($conn,
        "INSERT INTO sliders (image, status, urutan)
         VALUES ('$image', 'aktif', 0)"
    );

    header("Location: slider.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Slider</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white min-h-screen p-6 shadow">
        <h2 class="text-xl font-bold mb-6">Admin Panel</h2>

        <ul class="space-y-4">
            <li><a href="dashboard.php" class="hover:text-pink-500">Dashboard</a></li>
            <li><a href="treatment.php" class="hover:text-pink-500">Kelola Treatment</a></li>
            <li><a href="kursus.php" class="hover:text-pink-500">Kelola Kursus</a></li>
            <li><a href="booking_treatment.php" class="hover:text-pink-500">Booking Treatment</a></li>
            <li><a href="booking_kursus.php" class="hover:text-pink-500">Booking Kursus</a></li>
            <li><a href="slider.php" class="font-semibold text-pink-500">Kelola Slider</a></li>
            <li><a href="logout.php" class="text-red-500 font-semibold">Logout</a></li>
        </ul>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-10">

        <h2 class="text-2xl font-bold mb-6">Kelola Slider Header</h2>

        <!-- FORM UPLOAD -->
        <form method="POST" enctype="multipart/form-data"
              class="bg-white p-6 rounded shadow w-96 mb-10">

            <label class="block mb-2 font-medium">Upload Gambar Slider</label>

            <input type="file" name="foto"
                   accept="image/*"
                   class="w-full border p-3 mb-4 rounded" required>

            <button name="upload"
                    class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded w-full">
                Upload Slider
            </button>
        </form>

        <!-- LIST SLIDER -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl">

            <?php
            $data = mysqli_query($conn,
                "SELECT * FROM sliders ORDER BY id DESC"
            );
            while ($d = mysqli_fetch_assoc($data)) {
            ?>

            <div class="bg-white p-4 rounded shadow">

                <img src="../uploads/slider/<?= htmlspecialchars($d['image']) ?>"
                     class="w-full h-44 object-cover rounded mb-3">

                <div class="flex gap-2">
                    <a href="slider_toggle.php?id=<?= $d['id'] ?>"
                       class="flex-1 text-center
                       <?= $d['status']=='aktif' ? 'bg-green-500' : 'bg-gray-500' ?>
                       text-white py-2 rounded">
                       <?= $d['status']=='aktif' ? 'Aktif' : 'Nonaktif' ?>
                    </a>

                    <a href="slider_hapus.php?id=<?= $d['id'] ?>"
                       onclick="return confirm('Hapus slider ini?')"
                       class="flex-1 text-center bg-red-500 hover:bg-red-600
                              text-white py-2 rounded">
                        Hapus
                    </a>
                </div>

            </div>

            <?php } ?>

        </div>

    </main>

</div>

</body>
</html>
