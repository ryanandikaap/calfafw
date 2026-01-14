<?php
require_once __DIR__ . "/config/database.php";

$cat = $_GET['cat'] ?? 'all';

$sql = "SELECT * FROM news";
if ($cat !== 'all') {
  $sql .= " WHERE category = '$cat'";
}
$sql .= " ORDER BY id DESC";

$news = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News | Calfa Hair & Beauty</title>

  <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
  <link rel="icon" href="images/new.png">
  <script src="https://cdn.tailwindcss.com"></script>

<style>
@keyframes fadeIn {
  from { opacity: 0; }
  to   { opacity: 1; }
}
@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fadeIn {
  animation: fadeIn 1s ease forwards;
}
.animate-slideUp {
  animation: slideUp 1s ease forwards;
}
.delay-100 { animation-delay: .1s; }
.delay-200 { animation-delay: .2s; }
.delay-300 { animation-delay: .3s; }
</style>
</head>

<body class="bg-white text-black">

<!-- ================= HEADER ================= -->
<header class="fixed top-0 left-0 w-full flex items-center justify-between px-6 py-4 
bg-black backdrop-blur-md z-50">

  <img src="images/new.png" class="h-9 md:h-10">

  <nav class="hidden md:flex flex-1 justify-center space-x-10 text-xs uppercase text-white">
    <a href="index.php">Home</a>
    <a href="treatment.php">Treatment</a>
    <a href="kursus.php">Kursus</a>
    <a href="about.php">About</a>
    <a href="news.php" class="text-pink-500">News</a>
  </nav>

  <div class="flex items-center space-x-3">
    <button id="burgerBtn" class="md:hidden text-white">
      <svg id="burgerIcon" class="w-6 h-6" fill="none" stroke="currentColor"
           viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>

    <a href="https://wa.me/6282224422295" target="_blank"
       class="bg-pink-600 hover:bg-pink-700 text-white text-xs px-4 py-2 rounded-md">
      CONTACT
    </a>
  </div>
</header>

<!-- MOBILE MENU -->
<div id="mobileMenu"
 class="md:hidden fixed top-[64px] left-0 w-full bg-black text-white
 flex flex-col items-center space-y-4
 max-h-0 opacity-0 transition-all duration-300 z-40">

  <a href="index.php">Home</a>
  <a href="treatment.php">Treatment</a>
  <a href="kursus.php">Kursus</a>
  <a href="news.php">News</a>
  <a href="about.php">About</a>
</div>

<!-- ================= HERO ================= -->
<section class="relative min-h-[75vh] sm:min-h-[80vh] md:min-h-[90vh]
                flex items-center overflow-hidden">

  <!-- BACKGROUND -->
  <img src="images/calf.png"
       class="absolute inset-0 w-full h-full object-cover">

  <!-- OVERLAY -->
  <div class="absolute inset-0 bg-gradient-to-r
              from-black/80 via-black/60 to-transparent"></div>

  <!-- CONTENT -->
  <div class="relative z-10 w-full">
    <div class="px-6 sm:px-10 md:px-20
                max-w-7xl mx-auto text-white">

      <!-- BADGE -->
      <span class="inline-block mb-4
                   text-[10px] sm:text-xs md:text-sm
                   font-semibold tracking-widest
                   bg-pink-600/90
                   px-4 sm:px-5 py-2
                   rounded-full
                   animate-fadeIn">
        CALFA NEWS
      </span>

      <!-- TITLE -->
      <h1 class="text-3xl sm:text-4xl md:text-6xl
                 font-bold leading-tight
                 max-w-xl md:max-w-3xl
                 animate-slideUp delay-100">
        Promo, Event & Update <br>
        <span class="text-pink-400">Calfa Hair & Beauty</span>
      </h1>

      <!-- DESC -->
      <p class="mt-5 sm:mt-6
                text-gray-200
                max-w-md md:max-w-xl
                text-sm sm:text-base md:text-lg
                animate-slideUp delay-200">
        Temukan informasi terbaru seputar promo eksklusif,
        event kecantikan, serta tips perawatan rambut dari
        Calfa Salon.
      </p>

      <!-- BUTTON -->
      <div class="mt-8 sm:mt-10
                  animate-slideUp delay-300">
        <a href="#news"
           class="inline-flex items-center gap-2
                  bg-pink-600 hover:bg-pink-700
                  text-white
                  px-6 sm:px-8 py-3 sm:py-4
                  rounded-full
                  text-sm sm:text-base
                  font-semibold transition">
          Lihat Berita
          <span class="text-lg">→</span>
        </a>

        <a href="https://wa.me/6282224422295"
         target="_blank"
         class="border border-white
                px-8 py-4 rounded-full font-semibold
                hover:bg-white hover:text-pink-600 transition">
        Booking Sekarang
      </a>
      </div>

    </div>
  </div>

  <!-- SCROLL INDICATOR -->
  <div class="absolute bottom-6 left-1/2 -translate-x-1/2
              text-white animate-bounce">
    <svg class="w-6 h-6 opacity-70" fill="none" stroke="currentColor"
         stroke-width="2" viewBox="0 0 24 24">
      <path d="M19 9l-7 7-7-7" />
    </svg>
  </div>

</section>


<!-- ================= NEWS LIST ================= -->
<section id="news" class="py-24 px-6 md:px-20 bg-gray-50">
  <div class="max-w-7xl mx-auto">

    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold mb-4">
        Latest News & Promo ✨
      </h2>
      <p class="text-gray-500 max-w-xl mx-auto">
        Update terbaru promo, event, dan informasi eksklusif dari Calfa Hair & Beauty
      </p>
    </div>
<div class="flex justify-center gap-3 mb-14">
  <a href="news.php?cat=all"
     class="px-5 py-2 rounded-full text-sm font-semibold
     <?= $cat=='all'?'bg-black text-white':'border hover:bg-black hover:text-white' ?>">
     Semua
  </a>

  <a href="news.php?cat=info"
     class="px-5 py-2 rounded-full text-sm font-semibold
     <?= $cat=='info'?'bg-pink-600 text-white':'border hover:bg-pink-600 hover:text-white' ?>">
     Info
  </a>

  <a href="news.php?cat=promo"
     class="px-5 py-2 rounded-full text-sm font-semibold
     <?= $cat=='promo'?'bg-pink-600 text-white':'border hover:bg-pink-600 hover:text-white' ?>">
     Promo
  </a>
</div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

      <?php if(mysqli_num_rows($news) > 0): ?>
        <?php while($n = mysqli_fetch_assoc($news)): ?>
          <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

            <img src="uploads/news/<?= htmlspecialchars($n['image']); ?>"
                 class="w-full h-52 object-cover">

            <div class="p-6">
              <span class="text-xs text-pink-600 font-semibold uppercase">
                <?= htmlspecialchars($n['category']); ?>
              </span>

              <p class="text-xs text-gray-400 mt-1">
  <?= date('d M Y', strtotime($n['created_at'])) ?>
</p>

<?php if($n['category'] == 'info'): ?>
  <span class="inline-block mb-2 text-[10px] bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
    INFO SALON
  </span>
<?php endif; ?>



              <h3 class="text-lg font-bold mt-2">
                <?= htmlspecialchars($n['title']); ?>
              </h3>

              <p class="text-gray-500 text-sm mt-3">
                <?= htmlspecialchars($n['short_desc']); ?>
              </p>

              <a href="news-detail.php?id=<?= $n['id']; ?>"
                 class="inline-block mt-5 text-pink-600 font-semibold hover:underline">
                Baca Selengkapnya →
              </a>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="col-span-3 text-center text-gray-400">
          Belum ada berita tersedia.
        </p>
      <?php endif; ?>

    </div>
  </div>
</section>


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

<script>
const burgerBtn = document.getElementById('burgerBtn');
const mobileMenu = document.getElementById('mobileMenu');
const burgerIcon = document.getElementById('burgerIcon');

burgerBtn.addEventListener('click', () => {
  mobileMenu.classList.toggle('max-h-0');
  mobileMenu.classList.toggle('max-h-screen');
  mobileMenu.classList.toggle('opacity-0');
  mobileMenu.classList.toggle('opacity-100');

  burgerIcon.innerHTML = burgerIcon.innerHTML.includes('M4 6h16')
    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>'
    : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
});
</script>

</body>
</html>
