<?php
require_once __DIR__ . '/config/database.php';


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = mysqli_query($conn, "SELECT * FROM news WHERE id = $id");
$news = mysqli_fetch_assoc($query);

if (!$news) {
    echo "Berita tidak ditemukan";
    exit;
}
?>

<!-- IMAGE PREVIEW MODAL -->
<div id="imageModal"
     class="fixed inset-0 bg-black/80 hidden
            items-center justify-center z-50">

  <div class="relative max-w-5xl w-full px-6">

    <!-- CLOSE BUTTON -->
    <button onclick="closePreview()"
            class="absolute -top-12 right-0
                   text-white text-3xl
                   hover:text-pink-500">
      ✕
    </button>

    <img src="uploads/news/<?= htmlspecialchars($news['image']); ?>"
         class="w-full max-h-[90vh]
                object-contain
                rounded-xl shadow-lg">
  </div>
</div>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($news['title']); ?> | Calfa Hair & Beauty</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-4xl mx-auto py-20 px-4">

  <div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full border-collapse">

      <!-- HEADER -->
      <tr class="bg-black">
        <td colspan="2" class="px-6 py-5 text-white">
          <h1 class="text-2xl md:text-3xl font-bold">
            <?= htmlspecialchars($news['title']); ?>
          </h1>
          <p class="text-pink-400 text-sm uppercase mt-1">
            <?= htmlspecialchars($news['category']); ?>
          </p>
        </td>
      </tr>

    <tr>
  <td colspan="2" class="p-6 bg-white">

    <div class="relative group">

      <!-- IMAGE -->
      <img src="uploads/news/<?= htmlspecialchars($news['image']); ?>"
           class="w-full h-80 object-cover rounded-xl">

      <!-- OVERLAY CLICKABLE -->
      <div onclick="openPreview()"
           class="absolute inset-0 bg-black/60
                  opacity-0 group-hover:opacity-100
                  flex items-center justify-center
                  cursor-pointer
                  transition
                  z-10">

        <!-- EYE ICON -->
        <svg class="w-14 h-14 text-white hover:scale-110 transition"
             fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 5c-7.6 0-11 7-11 7s3.4 7 11 7 11-7 11-7-3.4-7-11-7Zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm0-6a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
        </svg>

      </div>

    </div>

  </td>
</tr>


      <!-- CONTENT -->
      <tr class="bg-gray-50">
        <td class="px-6 py-6 text-gray-700 leading-relaxed">
          <?= nl2br(htmlspecialchars($news['content'])); ?>
        </td>
      </tr>

      <!-- FOOTER -->
      <tr class="bg-white border-t">
        <td class="px-6 py-4">
          <a href="news.php"
             class="text-pink-600 font-semibold hover:underline">
            ← Kembali ke News
          </a>
        </td>
      </tr>

    </table>

  </div>

</div>

<!-- FOOTER -->
<footer class="bg-black text-white px-6 md:px-20 py-12">
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">

    <!-- LOCATION -->
    <div>
      <img src="images/new.png" class="h-12 md:h-10 mb-3">
      <p>Calfa Beauty Salon</p>
      <p class="text-gray-400 text-sm">Surabaya, Indonesia</p>
    </div>

    <!-- CONTACT -->
    <div>
      <h3 class="font-bold mb-4 text-lg">Contact</h3>
      <p class="mb-2 text-sm">
        WhatsApp:
        <a href="https://wa.me/6282224422295" target="_blank"
           class="text-pink-500 hover:underline">
          +62 822-2442-2295
        </a>
      </p>
      <p class="mb-2 text-sm">
        Email:
        <a href="mailto:calfasalon@gmail.com"
           class="text-pink-500 hover:underline">
          calfasalon@gmail.com
        </a>
      </p>
      <p class="text-sm text-gray-400">Senin-Selasa & Jumat-Minggu, 08:00 – 21:00</p>
      <p class="text-sm text-gray-400">Rabu & Kamis, 10:00 – 20:00</p>
    </div>

    <!-- SOCIAL MEDIA + REVIEW -->
    <div>
      <h3 class="font-bold mb-4 text-lg">Follow Us</h3>

     <!-- SOCIAL ICONS -->
<div class="flex space-x-4 mb-6 text-white">
  <!-- Instagram -->
  <a href="https://www.instagram.com/calfasalonsurabaya/?__pwa=1"
     target="_blank"
     class="hover:text-pink-500 transition">
    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
      <path d="M7.75 2C4.57 2 2 4.57 2 7.75v8.5C2 19.43 4.57 22 7.75 22h8.5C19.43 22 22 19.43 22 16.25v-8.5C22 4.57 19.43 2 16.25 2h-8.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm5.25-.75a1 1 0 1 1 0 2 1 1 0 0 1 0-2ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"/>
    </svg>
  </a>

  <!-- TikTok -->
  <a href="https://www.tiktok.com/@calfasalonsurabaya"
     target="_blank"
     class="hover:text-pink-500 transition">
    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
      <path d="M21 8.3a6.7 6.7 0 0 1-4.3-1.6v7.6a5.5 5.5 0 1 1-5.5-5.5v3a2.5 2.5 0 1 0 2.5 2.5V2h3a6.7 6.7 0 0 0 4.3 4.3v2Z"/>
    </svg>
  </a>
</div>


      <!-- REVIEW BUTTON -->
      <a href="https://search.google.com/local/writereview?placeid=ChIJDcRDgbf_1y0R0YBRAIZTGrs"
         target="_blank"
         class="inline-block border border-pink-600 text-pink-600
                hover:bg-pink-600 hover:text-white
                px-6 py-2 rounded-lg text-sm font-semibold transition">
        ⭐ Leave a Google Review
      </a>
    </div>
  </div>

  <!-- COPYRIGHT -->
  <p class="text-gray-400 text-xs mt-10 text-center">
    © 2025 Calfa Hair & Beauty. All rights reserved.
  </p>
</footer>
</body>

<script>
function openPreview() {
  document.getElementById('imageModal').classList.remove('hidden');
  document.getElementById('imageModal').classList.add('flex');
}

function closePreview() {
  document.getElementById('imageModal').classList.add('hidden');
  document.getElementById('imageModal').classList.remove('flex');
}
</script>

</html>

