<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../config/database.php";

$data = mysqli_query($conn, "SELECT * FROM treatments ORDER BY id ASC") or die(mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Treatment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white p-6 shadow-md">
        <h2 class="text-xl font-bold mb-6">Admin Panel</h2>
        <ul class="space-y-4">
            <li><a href="dashboard.php" class="font-semibold">Dashboard</a></li>
            <li><a href="treatment.php" class="font-semibold text-pink-500">Kelola Treatment</a></li>
            <li><a href="kelola_news.php" class="font-semibold text-gray-700 hover:text-pink-500">Kelola News</a></li>
            <li><a href="logout.php" class="text-red-500 font-semibold hover:underline">Logout</a></li>
        </ul>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-10">
        <h2 class="text-2xl font-bold mb-6">Data Treatment</h2>

        <a href="treatment_add.php"
           class="bg-pink-500 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-pink-600">
            + Tambah Treatment
        </a>

        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded shadow">
                <thead>
                    <tr class="border-b bg-gray-50">
                        <th class="p-3 text-left">Gambar</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Harga</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($t = mysqli_fetch_assoc($data)) : ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">
                            <?php
                            $imgPath = (!empty($t['image']) && file_exists("../uploads/" . $t['image']))
                                ? "../uploads/" . $t['image']
                                : "../images/hairstyling.jpeg";
                            ?>
                            <img src="<?= htmlspecialchars($imgPath) ?>"
                                 class="w-20 h-20 object-cover rounded">
                        </td>
                        <td class="p-3"><?= htmlspecialchars($t['name']) ?></td>
                        <td class="p-3">Rp <?= number_format($t['price'], 0, ',', '.') ?></td>
                        <td class="p-3">
                            <a href="treatment_edit.php?id=<?= $t['id'] ?>" class="text-blue-500 hover:underline mr-2">Edit</a>
                            <a href="treatment_delete.php?id=<?= $t['id'] ?>"
                               class="text-red-500 hover:underline"
                               onclick="return confirm('Yakin ingin menghapus treatment ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>

</div>

</body>
</html>
