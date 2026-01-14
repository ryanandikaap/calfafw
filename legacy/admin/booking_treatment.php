<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../config/database.php";

// Ambil data booking
$data = mysqli_query($conn, "SELECT * FROM booking_treatment ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Booking Treatment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white p-6 shadow-md">
        <h2 class="text-xl font-bold mb-6">Admin Panel</h2>
        <ul class="space-y-4">
            <li><a href="dashboard.php" class="font-semibold hover:text-pink-500">Dashboard</a></li>
            <li><a href="treatment.php" class="font-semibold hover:text-pink-500">Kelola Treatment</a></li>
            <li><a href="kursus.php" class="font-semibold hover:text-pink-500">Kelola Kursus</a></li>
            <li><a href="booking_treatment.php" class="font-semibold text-pink-500">Booking Treatment</a></li>
            <li><a href="booking_kursus.php" class="font-semibold hover:text-pink-500">Booking Kursus</a></li>
            <li><a href="logout.php" class="text-red-500 font-semibold">Logout</a></li>
        </ul>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-10">
        <h2 class="text-2xl font-bold mb-6">Booking Treatment</h2>

        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded shadow text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3 text-left">Customer</th>
                        <th class="p-3 text-left">Treatment</th>
                        <th class="p-3 text-left">Tanggal</th>
                        <th class="p-3 text-left">Jam</th>
                        <th class="p-3 text-left">Bukti DP</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($data) > 0): ?>
                    <?php while($b = mysqli_fetch_assoc($data)) : ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3"><?= htmlspecialchars($b['nama']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($b['treatment']) ?></td>
                            <td class="p-3"><?= $b['tanggal'] ?></td>
                            <td class="p-3"><?= $b['jam'] ?></td>

                            <!-- BUKTI DP -->
                            <td class="p-3">
                                <?php if (!empty($b['bukti_dp'])) : ?>
                                    <a href="../uploads/<?= $b['bukti_dp'] ?>" target="_blank">
                                        <img src="../uploads/<?= $b['bukti_dp'] ?>" class="w-16 rounded shadow">
                                    </a>
                                <?php else : ?>
                                    <span class="text-gray-400 italic">Belum upload</span>
                                <?php endif; ?>
                            </td>

                            <!-- STATUS -->
                            <td class="p-3 font-semibold
                                <?php
                                    switch ($b['status']) {
                                        case 'Menunggu Konfirmasi DP': echo 'text-yellow-500'; break;
                                        case 'DP Diterima': echo 'text-green-600'; break;
                                        case 'Ditolak': echo 'text-red-500'; break;
                                        case 'Selesai': echo 'text-blue-500'; break;
                                        default: echo 'text-gray-500';
                                    }
                                ?>">
                                <?= $b['status'] ?>
                            </td>

                            <!-- AKSI -->
                            <td class="p-3 space-x-2">
                                <?php if ($b['status'] == 'Menunggu Konfirmasi DP'): ?>
                                    <a href="booking_treatment_status.php?id=<?= $b['id'] ?>&status=DP Diterima"
                                       class="bg-green-500 text-white px-2 py-1 rounded text-xs">Terima</a>
                                    <a href="booking_treatment_status.php?id=<?= $b['id'] ?>&status=Ditolak"
                                       class="bg-red-500 text-white px-2 py-1 rounded text-xs">Tolak</a>
                                <?php endif; ?>

                                <a href="booking_treatment_edit.php?id=<?= $b['id'] ?>"
                                   class="text-blue-500 hover:underline text-xs">Edit</a>

                                <a href="booking_treatment_delete.php?id=<?= $b['id'] ?>"
                                   onclick="return confirm('Yakin hapus booking ini?')"
                                   class="text-red-500 hover:underline text-xs">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center p-6 text-gray-400">
                            Belum ada booking treatment
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</div>

</body>
</html>
