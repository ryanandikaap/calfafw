<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | Calfa Hair & Beauty</title>

  <!-- FONT SALON ELEGAN -->
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&display=swap" rel="stylesheet">

  <link rel="icon" href="images/new.png" class="h-20">
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    scroll-behavior: smooth;
    }
  </style>

</head>

<body class="bg-white text-black">

<header class="fixed top-0 left-0 w-full flex items-center justify-between px-6 py-4 bg-black z-30">
  <img src="images/new.png" class="h-9 md:h-10">

  <nav class="hidden md:flex flex-1 justify-center space-x-10 text-xs uppercase text-white">
    <a href="index.php" class="hover:text-gray-300">Home</a>
    <a href="treatment.php" class="hover:text-gray-300">Treatment</a>
    <a href="kursus.php" class="hover:text-gray-300">Kursus</a>
    <a href="about.php" class="text-pink-500">About</a>
    <a href="news.php" class="hover:text-gray-300">News</a>
  </nav>

  <div class="flex items-center space-x-3">
    <button id="burgerBtn" class="md:hidden text-white">
      <svg id="burgerIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

<div id="mobileMenu"
 class="md:hidden fixed top-[64px] left-0 w-full bg-black
 text-white flex flex-col items-center space-y-4
 max-h-0 opacity-0 overflow-hidden z-40 transition-all duration-300">
  <a href="index.php">Home</a>
  <a href="treatment.php">Treatment</a>
  <a href="kursus.php">Kursus</a>
  <a href="about.php" class="text-pink-500">About</a>
  <a href="news.php">News</a>
</div>

<!-- HERO ABOUT -->
<section class="relative">
  <img src="images/salon.jpeg"
       class="w-full h-[400px] object-cover brightness-50">

  <div class="absolute inset-0 flex items-center px-6 md:px-20">
    <h1 class="text-white text-3xl md:text-4xl font-bold">
      About Calfa Hair & Beauty
    </h1>
  </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-20">
  <div class="grid md:grid-cols-2 gap-12 items-center">

    <!-- TEXT CONTENT -->
<div>
  <h2 class="text-3xl md:text-4xl font-semibold mb-6">
    Di Mana Kecantikan Bertemu Kepercayaan Diri
  </h2>

  <p class="text-gray-600 leading-relaxed mb-5">
    Calfa Hair & Beauty adalah salon kecantikan dan perawatan rambut premium
    yang menghadirkan layanan profesional untuk menonjolkan
    kecantikan alami Anda dengan sentuhan modern dan produk berkualitas tinggi.
  </p>

  <p class="text-gray-600 leading-relaxed mb-5">
    Kami percaya bahwa kecantikan bukan hanya tentang penampilan,
    tetapi juga tentang rasa percaya diri dan kenyamanan.
    Dengan tenaga ahli berpengalaman, Calfa Hair & Beauty berkomitmen memberikan
    perawatan personal yang sesuai dengan karakter dan gaya Anda.
  </p>

  <p class="text-gray-600 leading-relaxed">
    Mulai dari penataan rambut, perawatan wajah, nail art,
    hingga perawatan relaksasi, Calfa Hair & Beauty hadir sebagai
    destinasi terpercaya untuk perawatan kecantikan Anda secara menyeluruh.
  </p>
</div>


    <!-- IMAGE -->
    <div class="relative">
      <img src="images/ow.PNG"
           alt="Salon Stylist"
           class="w-full h-[520px] object-cover rounded-2xl shadow-lg">
    </div>

  </div>
</section>


<!-- OWNER & TEAM -->
<section class="py-20 px-6 md:px-20 bg-white">
  <div class="max-w-6xl mx-auto text-center mb-14">
    <h2 class="text-3xl font-bold mb-4">Meet Our Team</h2>
    <p class="text-gray-600">
      Professionals behind Calfa Hair and Beauty
    </p>
  </div>

  <!-- OWNER (SPECIAL SECTION) -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-6xl mx-auto mb-20">

  <!-- OWNER 1 -->
  <div
    class="relative text-center bg-white p-10 rounded-2xl shadow-lg
           hover:-translate-y-2 hover:shadow-2xl transition duration-300">

    <!-- OWNER BADGE -->
    <span
      class="absolute -top-4 left-1/2 -translate-x-1/2
             bg-pink-500 text-white text-xs px-4 py-1 rounded-full tracking-widest">
      OWNER
    </span>

    <!-- IMAGE -->
    <div class="relative inline-block mb-6">
      <div
        class="absolute inset-0 rounded-full bg-gradient-to-tr
               from-pink-400 to-purple-500 blur-lg opacity-40">
      </div>
      <img src="images/ownerlaki.png"
           class="relative w-40 h-40 rounded-full object-cover border-4 border-white shadow-xl">
    </div>

    <!-- TEXT -->
    <h3 class="text-2xl font-bold tracking-wide">Calfa Owner</h3>
    <p class="text-pink-500 text-sm mb-4 uppercase tracking-wider">
      Founder & Creative Director
    </p>
    <p class="text-gray-600 text-sm leading-relaxed">
      Pendiri Calfa Hair and Beauty dengan pengalaman bertahun-tahun di dunia hair styling.
      Mengedepankan teknik profesional dengan hasil rapi, elegan, dan sesuai karakter alami.
    </p>
  </div>

  <!-- OWNER 2 -->
  <div
    class="relative text-center bg-white p-10 rounded-2xl shadow-lg
           hover:-translate-y-2 hover:shadow-2xl transition duration-300">

    <!-- OWNER BADGE -->
    <span
      class="absolute -top-4 left-1/2 -translate-x-1/2
             bg-pink-500 text-white text-xs px-4 py-1 rounded-full tracking-widest">
      OWNER
    </span>

    <!-- IMAGE -->
    <div class="relative inline-block mb-6">
      <div
        class="absolute inset-0 rounded-full bg-gradient-to-tr
               from-pink-400 to-purple-500 blur-lg opacity-40">
      </div>
      <img src="images/ownercal.png"
           class="relative w-40 h-40 rounded-full object-cover border-4 border-white shadow-xl">
    </div>

    <!-- TEXT -->
    <h3 class="text-2xl font-bold tracking-wide">Calfa Owner</h3>
    <p class="text-pink-500 text-sm mb-4 uppercase tracking-wider">
      Founder & Creative Director
    </p>
    <p class="text-gray-600 text-sm leading-relaxed">
      Founder Calfa Hair and Beauty dengan pengalaman panjang di bidang hair & beauty,
      berfokus pada hasil yang elegan, natural, dan premium.
    </p>
  </div>

</div>


  <!-- TEAM / KARYAWAN (3 DI BAWAH) -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 max-w-6xl mx-auto">

    <!-- STAFF 1 -->
    <div class="text-center bg-gray-50 p-8 rounded-xl shadow-md">
      <img src="images/hairstylist1.jpg"
           class="w-40 h-40 mx-auto rounded-full object-cover mb-6 shadow-lg">
      <h3 class="text-xl font-bold">Miar Hair Stylist</h3>
      <p class="text-pink-500 text-sm mb-4">Senior Hair Stylist</p>
      <p class="text-gray-600 text-sm leading-relaxed">
        Berpengalaman dalam potongan rambut modern, pewarnaan,
        dan perawatan rambut dengan pendekatan konsultasi yang detail.
      </p>
    </div>

    <!-- STAFF 2 -->
    <div class="text-center bg-gray-50 p-8 rounded-xl shadow-md">
      <img src="images/1.png"
           class="w-40 h-40 mx-auto rounded-full object-cover mb-6 shadow-lg">
      <h3 class="text-xl font-bold">Ira Hair Stylist</h3>
      <p class="text-pink-500 text-sm mb-4">Professional Hair Stylist</p>
      <p class="text-gray-600 text-sm leading-relaxed">
        Spesialis pewarnaan rambut dan perawatan smoothing.
      </p>
    </div>

    <!-- STAFF 3 -->
    <div class="text-center bg-gray-50 p-8 rounded-xl shadow-md">
      <img src="images/ui.png"
           class="w-40 h-40 mx-auto rounded-full object-cover mb-6 shadow-lg">
      <h3 class="text-xl font-bold">Sari Hair Stylist</h3>
      <p class="text-pink-500 text-sm mb-4">Professional Hair Stylist</p>
      <p class="text-gray-600 text-sm leading-relaxed">
        Ahli potongan rambut modern dengan hasil yang disesuaikan
        dengan karakter setiap klien.
      </p>
    </div>

    <!-- STAFF 4 -->
    <div class="text-center bg-gray-50 p-8 rounded-xl shadow-md">
      <img src="images/putt.png"
           class="w-40 h-40 mx-auto rounded-full object-cover mb-6 shadow-lg">
      <h3 class="text-xl font-bold">Putri Hair Stylist</h3>
      <p class="text-pink-500 text-sm mb-4">Professional Hair Stylist</p>
      <p class="text-gray-600 text-sm leading-relaxed">
        Spesialis styling rambut untuk berbagai acara
        dan perawatan smoothing.
      </p>
    </div>

    <!-- ADMIN 1 -->
    <div class="text-center bg-gray-50 p-8 rounded-xl shadow-md">
      <img src="images/hairstylist2.jpg"
           class="w-40 h-40 mx-auto rounded-full object-cover mb-6 shadow-lg">
      <h3 class="text-xl font-bold">Habibah</h3>
      <p class="text-pink-500 text-sm mb-4">Administrator</p>
      <p class="text-gray-600 text-sm leading-relaxed">
        Mengelola administrasi salon dan memastikan
        operasional berjalan rapi dan profesional.
      </p>
    </div>

    <!-- ADMIN 2 -->
    <div class="text-center bg-gray-50 p-8 rounded-xl shadow-md">
      <img src="images/hairstylist2.jpg"
           class="w-40 h-40 mx-auto rounded-full object-cover mb-6 shadow-lg">
      <h3 class="text-xl font-bold">Fara</h3>
      <p class="text-pink-500 text-sm mb-4">Administrator</p>
      <p class="text-gray-600 text-sm leading-relaxed">
        Bertanggung jawab pada layanan administrasi
        dan kenyamanan pelanggan.
      </p>
    </div>

  </div>
</section>


<!-- VISION & MISSION -->
<section class="bg-gray-100 py-20 px-6 md:px-20">
  <div class="grid md:grid-cols-2 gap-12 max-w-6xl mx-auto">

    <div class="bg-white p-8 rounded-xl shadow-md">
      <h3 class="text-xl font-bold mb-4">Our Vision</h3>
      <ul class="text-gray-600 space-y-3 list-disc pl-5">
        <li>Menjadi pilihan utama salon kecantikan untuk memecahkan masalah dan memberikan solusi kecantikan serta memberikan pelayanan yang terbaik kepada pelanggan.</li>
        <li>Menjadikan CALFA SALON sebagai brand owner yang diakui dan dapat menjadi inspirasi.</li>
      <ul>
    </div>

    <div class="bg-white p-8 rounded-xl shadow-md">
      <h3 class="text-xl font-bold mb-4">Our Mission</h3>
      <ul class="text-gray-600 space-y-3 list-disc pl-5">
        <li>Memberikan layanan kecantikan dan perawatan rambut yang berkualitas dengan menggunakan produk-produk yang aman dan sudah ter-approve BPOM.</li>
        <li>Memberikan mutu pelayanan yang berkualitas bagi pelanggan.sx</li>
        <li>Memberikan pelayanan dengan terapis, beautician, dan hairdresser yang berkualitas dan berkompeten di bidangnya.</li>
        <li>Mampu bersaing dengan inovasi teknologi terbaru sesuai dengan perkembangan baik lokal maupun internasional.</li>
        <li>Mampu menjangkau target dengan inovasi metode promosi menggunakan sosial media yang sedang berkembang.</li>
      </ul>
    </div>

  </div>
</section>

<!-- CTA + REVIEW -->
<section class="bg-pink-50 py-20 px-6 md:px-20 text-center">
  <h2 class="text-3xl md:text-4xl font-bold mb-4">
    Ready to Feel Beautiful?
  </h2>

  <p class="text-gray-600 max-w-xl mx-auto mb-10">
    Book your beauty session with our professionals
    or share your experience to help others find us.
  </p>

  <div class="flex flex-col sm:flex-row justify-center gap-4">

    <!-- PRIMARY CTA -->
    <a href="https://wa.me/6282224422295"
       target="_blank"
       class="bg-pink-600 hover:bg-pink-700 text-white
              px-10 py-3 rounded-lg font-semibold transition">
      CONTACT VIA WHATSAPP
    </a>

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



</body>

<script>
/* ===== BURGER MENU ===== */
const burgerBtn  = document.getElementById('burgerBtn');
const burgerIcon = document.getElementById('burgerIcon');
const mobileMenu = document.getElementById('mobileMenu');

burgerBtn.addEventListener('click', () => {
  mobileMenu.classList.toggle('max-h-0');
  mobileMenu.classList.toggle('max-h-screen');
  mobileMenu.classList.toggle('py-4');
  mobileMenu.classList.toggle('opacity-0');
  mobileMenu.classList.toggle('opacity-100');

  if (burgerIcon.innerHTML.includes('M4 6h16')) {
    burgerIcon.innerHTML =
      '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
  } else {
    burgerIcon.innerHTML =
      '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
  }
});
</script>
</html>
