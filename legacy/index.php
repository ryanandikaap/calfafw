<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calfa Hair & Beauty</title>

  <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
  <link rel="icon" href="images/new.png" class="h-20">
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    scroll-behavior: smooth;
    }

    .hero-slide {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(50%);
  opacity: 0;
  transition: opacity 1.2s ease-in-out;
}

.hero-slide.active {
  opacity: 1;
}

/* DOT STYLE */
.dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: rgba(255,255,255,0.5);
  cursor: pointer;
  transition: all 0.3s;
}

.dot.active {
  background: white;
  transform: scale(1.3);
}

  </style>
</head>
<!-- DETAIL COURSE MODAL -->
<div id="detailModal"
     class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

  <div class="bg-white rounded-xl w-full max-w-lg p-6 relative
            max-h-[85vh] overflow-y-auto">

    <button onclick="closeDetail()"
            class="absolute top-3 right-4 text-gray-500 text-xl">✕</button>

   <img id="detailImage"
     class="w-full max-h-55 object-contain rounded-lg mb-4 bg-gray-100">


    <h3 id="detailTitle" class="text-2xl font-bold mb-2"></h3>
    <p id="detailDesc" class="text-sm text-gray-600 mb-4"></p>

    <ul id="detailMateri" class="space-y-3 mb-4"></ul>
    <!-- SCHEDULE COURSE -->
<div id="detailScheduleWrapper" class="mt-6">
  <h4 class="font-bold text-lg mb-3 text-gray-800">📅 Jadwal Pembelajaran</h4>
  <ul id="detailSchedule" class="space-y-3"></ul>
</div>



    <p id="detailPrice"
       class="text-pink-600 font-bold text-lg mb-4"></p>

    <button id="detailBookBtn"
      class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md">
      BOOK COURSE
    </button>
  </div>
</div>
<body class="bg-white text-black">

<!-- BOOKING MODAL -->
<div id="bookingModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
  <div class="bg-white rounded-xl w-full max-w-md p-6 relative">
    <button onclick="closeForm()" class="absolute top-3 right-4 text-gray-500 text-xl">✕</button>
    <h3 class="text-2xl font-bold mb-4">Course Booking</h3>
    <form onsubmit="sendToWhatsApp(event)">
      <input type="hidden" id="courseName">
      <input type="hidden" id="coursePrice">

      <div class="mb-4">
        <label class="text-sm">Nama Lengkap</label>
        <input id="name" required placeholder="Masukkan nama lengkap" class="w-full border px-3 py-2 rounded-md">
      </div>

      <div class="mb-4">
        <label class="text-sm">Alamat</label>
        <textarea id="address" required placeholder="Masukkan alamat lengkap" class="w-full border px-3 py-2 rounded-md"></textarea>
      </div>

      <div class="mb-4">
        <label class="text-sm">Umur</label>
        <input id="age" type="number" required placeholder="Contoh: 20" class="w-full border px-3 py-2 rounded-md">
      </div>

      <div class="mb-4">
        <label class="text-sm">Gender</label>
        <select id="gender" required class="w-full border px-3 py-2 rounded-md">
          <option value="">-- Pilih Gender --</option>
          <option value="Wanita">Wanita</option>
          <option value="Pria">Pria</option>
        </select>
      </div>

      <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md">SEND TO WHATSAPP</button>
    </form>
  </div>
</div>

<!-- HERO WRAPPER -->
<div class="relative bg-black h-[600px] md:h-[700px] overflow-hidden">

  <!-- HERO SLIDER -->
  <div class="absolute inset-0">
    <img src="images/cover.jpg" class="hero-slide active">
    <img src="images/salon.jpeg" class="hero-slide">
    <img src="images/sln2.jpeg" class="hero-slide">

    <!-- ARROW LEFT -->
    <button id="prevSlide"
      class="absolute left-5 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60
             text-white p-2 rounded-full z-20">
      ❮
    </button>

    <!-- ARROW RIGHT -->
    <button id="nextSlide"
      class="absolute right-5 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60
             text-white p-2 rounded-full z-20">
      ❯
    </button>

    <!-- DOT INDICATOR -->
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-3 z-20">
      <button class="dot active" data-slide="0"></button>
      <button class="dot" data-slide="1"></button>
      <button class="dot" data-slide="2"></button>
    </div>
  </div>

  <!-- HEADER -->
  <header class="absolute top-0 left-0 w-full flex items-center justify-between px-6 py-4 
bg-black backdrop-blur-md z-50">

    <!-- LOGO -->
    <img src="images/new.png" class="h-9 md:h-10">

    <!-- NAVBAR DESKTOP -->
    <nav class="hidden md:flex flex-1 justify-center space-x-10 text-xs uppercase text-white">
      <a href="#" class="hover:text-gray-300">Home</a>
      <a href="treatment.php" class="hover:text-gray-300">Treatment</a>
      <a href="kursus.php" class="hover:text-gray-300">Kursus</a>
      <a href="about.php" class="hover:text-gray-300">About</a>
      <a href="news.php" class="hover:text-gray-300">News</a>
    </nav>

    <!-- RIGHT ACTIONS: BURGER + CONTACT -->
    <div class="flex items-center space-x-3">
      <!-- BURGER BUTTON MOBILE -->
      <button id="burgerBtn" class="md:hidden text-white z-40">
        <svg id="burgerIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>

      <!-- CONTACT BUTTON -->
      <a href="https://wa.me/6282224422295" target="_blank"
         class="bg-pink-600 hover:bg-pink-700 text-white text-xs px-4 py-2 md:px-5 md:py-3 rounded-md">
         CONTACT
      </a>
    </div>
  </header>

  <!-- MOBILE MENU -->
 <div id="mobileMenu"
 class="md:hidden fixed top-[64px] left-0 w-full bg-black
 text-white flex flex-col items-center space-y-4
 max-h-0 opacity-0 z-40 transition-all duration-300">


    <a href="#">Home</a>
    <a href="treatment.php">Treatment</a>
    <a href="kursus.php">Kursus</a>
    <a href="about.php">About</a>
    <a href="news.php">News</a>
  </div>

  <!-- HERO TEXT -->
<div class="absolute inset-0 flex flex-col justify-center px-6 md:px-28 text-white">
  <!-- BADGE -->
  <span class="inline-block bg-pink-600 text-xs font-semibold px-4 py-1 rounded-full w-max mb-6">
    CALFA HAIR & BEAUTY
  </span>

  <!-- TITLE -->
  <h1 class="text-3xl md:text-5xl font-bold max-w-2xl leading-tight">
    Cantik, Percaya Diri & Berkelas<br>
    <span class="text-pink-400">di Setiap Sentuhan</span>
  </h1>

  <!-- DIVIDER -->
  <div class="border-b border-pink-400 w-20 my-6"></div>

  <!-- DESCRIPTION -->
  <p class="text-sm md:text-base max-w-md text-gray-200 leading-relaxed">
    Rasakan pengalaman perawatan rambut, wajah, nail art, dan spa eksklusif
    yang ditangani oleh beautician profesional dengan produk premium pilihan.
  </p>
</div>

</div>



<!-- TREATMENT SECTION -->
<section id="treatment" class="py-20 px-6 md:px-20">
  <p class="text-gray-400 uppercase text-sm mb-3">Our Treatments</p>
  <h2 class="text-3xl font-bold mb-14">Signature Beauty Treatments</h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
    <div class="border rounded-xl p-5 hover:shadow-lg transition">
      <img src="images/hrct2.jpeg" class="w-full h-44 object-cover rounded-md mb-4 hover:scale-105 transition">
      <h3 class="text-lg font-semibold">Hair Styling</h3>
      <p class="text-sm text-gray-600">Haircut, coloring, smoothing & hair spa</p>
      <p class="text-pink-600 font-semibold mt-2">Start from Rp 50.000</p>
    </div>
    <div class="border rounded-xl p-5 hover:shadow-lg transition">
      <img src="images/fcial.PNG" class="w-full h-44 object-cover rounded-md mb-4 hover:scale-105 transition">
      <h3 class="text-lg font-semibold">Facial Treatment</h3>
      <p class="text-sm text-gray-600">Brightening, acne care & anti-aging</p>
      <p class="text-pink-600 font-semibold mt-2">Start from Rp 100.000</p>
    </div>
    <div class="border rounded-xl p-5 hover:shadow-lg transition">
      <img src="images/nail.jpg" class="w-full h-44 object-cover rounded-md mb-4 hover:scale-105 transition">
      <h3 class="text-lg font-semibold">Nail & Spa</h3>
      <p class="text-sm text-gray-600">Nail art, manicure, pedicure & body spa</p>
      <p class="text-pink-600 font-semibold mt-2">Start from Rp 80.000</p>
    </div>
  </div>
</section>

<!-- COURSE SECTION -->
<section class="bg-pink-50 py-20 px-6 md:px-20">
  <p class="text-gray-400 uppercase text-sm mb-3">Our Course</p>
  <h2 class="text-3xl font-bold mb-14">Professional Beauty Course</h2>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
    <div class="bg-white rounded-xl shadow-md overflow-hidden relative">

  <!-- ICON EYE -->
  <button
    onclick="openDetail({
  title: 'Basic Salon GOLD',
  desc: 'Kursus Basic Salon dirancang khusus untuk pemula hingga profesional.',
  image: 'images/POSTER BASIC SAL.png',
  price: '4.999.999',
  rawPrice: '4999999',
  materi: [
   {
    title: '4 Teknik Pewarnaan Rambut',
    desc: 'Freench  Balayage, Hairlight, Peek a Boo, Ombree'
  },
  {
    title: 'Hair Cutting',
    desc: 'Butterfly, Oval, Bob, Flat, segi'
  },
  {
    title: 'Cuci & Styling',
    desc: 'Cuci Rambut, Pijat Kepala, Blow Dry, Catok, Curly'
  },
  {
    title: 'Hair Treatment',
    desc: 'Smoothing Rambut, Keratin Treatment, keriting Rambut, Creambath, Hair Masker, Hair Spa'
  },
  {
    title: 'Yuk Wujudkan Mimpi di Dunia Kecantikan',
    desc: 'Booking Dibawah Yaa'
  }
  ],
  schedule: [
    {
      day: 'Day 1',
      activity: 'Pengenalan alat salon, teori rambut & teknik cuci rambut'
    },
    {
      day: 'Day 2',
      activity: 'Hair cutting basic, sectioning & bentuk wajah'
    },
    {
      day: 'Day 3',
      activity: 'Teknik coloring, hair treatment & smoothing'
    },
    {
      day: 'Day 4',
      activity: 'Praktek model, evaluasi & sertifikat'
    }
  ]
})"


    class="absolute top-3 right-3 bg-white/90 p-2 rounded-full shadow hover:bg-pink-100 z-10">

    <!-- ICON EYE -->
    <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor"
         viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M2.458 12C3.732 7.943 7.523 5 12 5
           c4.478 0 8.268 2.943 9.542 7
           -1.274 4.057-5.064 7-9.542 7
           -4.477 0-8.268-2.943-9.542-7z"/>
    </svg>
  </button>

  <img src="images/ks2.jpeg" class="w-full h-44 object-cover">

  <div class="p-6">
    <h3 class="text-xl font-semibold">BASIC SALON PRO</h3>
    <p class="text-sm text-gray-600 my-3">
      Basic Salon Training Program
    </p>

    <ul class="text-sm text-gray-600 list-disc list-inside mb-4 space-y-1">
      <li>4 Teknik Pewarnaan Rambut</li>
      <li>Hair Cutting</li>
      <li>Cuci & Styling</li>
      <li>Hair Treatment</li>
      <h3 class="text-xs text-green-500">*Selengkapnya Klik Icon Mata*</h3>
    </ul>

    <p class="text-pink-600 font-bold text-lg mb-4">Rp 4.999.999</p>

    <button
      onclick="openForm('Basic Salon','4.999.999')"
      class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md">
      BOOK COURSE
    </button>
  </div>
</div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden relative">

  <!-- ICON EYE -->
  <button
    onclick="openDetail({
  title: 'Basic Salon Starter',
  desc: 'Kursus Basic Salon dirancang khusus bagi pemula yang ingin mempelajari dasar-dasar dunia kecantikan secara profesional. Dalam kursus ini, peserta akan dibimbing langsung oleh instruktur berpengalaman untuk memahami teknik dasar perawatan rambut, tata rias sederhana, hingga etika pelayanan salon ,Materi disusun secara bertahap, mudah dipahami, dan mengutamakan praktik langsung agar peserta memiliki kepercayaan diri serta keterampilan yang siap diterapkan. Kursus ini sangat cocok bagi Anda yang ingin memulai karier di industri salon, membuka usaha sendiri, atau meningkatkan kemampuan dasar di bidang kecantikan.',
  image: 'images/basic2.png',
  price: '3.000.000',
  rawPrice: '3000000',
  materi: [
  {
    title: '3 Teknik Pewarnaan Rambut',
    desc: 'Coloring Basic, Freench  Balayage, Hairlight'
  },
  {
    title: 'Cuci & Styling',
    desc: 'Cuci Rambut, Pijat Kepala, Blow Dry, Catok, Curly'
  },
  {
    title: 'Hair Treatment',
    desc: 'keriting Rambut, Creambath, Hair Masker, Hair Spa, Hair Loss, Hair Dendruf/Ketombe'
  },
  {
    title: 'Yuk Wujudkan Mimpi di Dunia Kecantikan',
    desc: 'Booking Dibawah Yaa'
  }
]

})"

    class="absolute top-3 right-3 bg-white/90 p-2 rounded-full shadow hover:bg-pink-100 z-10">

    <!-- ICON EYE -->
    <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor"
         viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M2.458 12C3.732 7.943 7.523 5 12 5
           c4.478 0 8.268 2.943 9.542 7
           -1.274 4.057-5.064 7-9.542 7
           -4.477 0-8.268-2.943-9.542-7z"/>
    </svg>
  </button>

  <img src="images/ks.jpeg" class="w-full h-44 object-cover">

  <div class="p-6">
    <h3 class="text-xl font-semibold">BASIC SALON STARTER</h3>
    <p class="text-sm text-gray-600 my-3">
      Basic Salon Training Program
    </p>

    <ul class="text-sm text-gray-600 list-disc list-inside mb-4 space-y-1">
      <li>3 Teknik Pewarnaan Rambut</li>
      <li>Cuci & Styling</li>
      <li>Hair Treatment</li>
      <br>
      <h3 class="text-xs text-green-500">*Selengkapnya Klik Icon Mata*</h3>
    </ul>

    <p class="text-pink-600 font-bold text-lg mb-4">Rp 3.000.000</p>

    <button
      onclick="openForm('Basic Salon','3.000.000')"
      class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md">
      BOOK COURSE
    </button>
  </div>
</div>

   <div class="bg-white rounded-xl shadow-md overflow-hidden relative">

  <!-- ICON EYE -->
  <button
    onclick="openDetail({
  title: 'PRO HAIRCUT',
  desc: 'PRO HAIRCUT adalah program kursus profesional yang dirancang untuk meningkatkan keterampilan potong rambut secara presisi dan modern. Peserta akan mempelajari teknik haircut lanjutan, analisis bentuk wajah, tekstur rambut, serta penyesuaian gaya sesuai karakter klien. Kursus ini menekankan praktik langsung dengan model asli, sehingga peserta siap bekerja di salon profesional maupun membuka usaha sendiri dengan standar kualitas tinggi.',
  image: 'images/cut.png',
  price: '5.000.000',
  rawPrice: '5000000',
  materi: [
  {
    title: 'PRO HAIRCUT',
    desc: 'Oval, Bob, Flat, segi, Layer, Long Layer, Medium Layer, Bob, Pixy'
  }
]

})"

    class="absolute top-3 right-3 bg-white/90 p-2 rounded-full shadow hover:bg-pink-100 z-10">

    <!-- ICON EYE -->
    <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor"
         viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M2.458 12C3.732 7.943 7.523 5 12 5
           c4.478 0 8.268 2.943 9.542 7
           -1.274 4.057-5.064 7-9.542 7
           -4.477 0-8.268-2.943-9.542-7z"/>
    </svg>
  </button>

  <img src="images/cuttdel.jpeg" class="w-full h-44 object-cover">

  <div class="p-6">
    <h3 class="text-xl font-semibold">PRO HAIR CUTTING</h3>
    <p class="text-sm text-gray-600 my-3">
      PROFESIONAL HAIRCUTTING CLASS
    </p>

    <ul class="text-sm text-gray-600 list-disc list-inside mb-4 space-y-1">
      <li>Basic Salon Training Program</li>
      <li>Haircutting Tools & Safety</li>
      <li>Basic Cutting Techniques</li>
      <li>Sectioning & Parting</li>
      <h3 class="text-xs text-green-500">*Selengkapnya Klik Icon Mata*</h3>
    </ul>

    <p class="text-pink-600 font-bold text-lg mb-4">Rp 5.000.000</p>

    <button
      onclick="openForm('Basic Salon','3.000.000')"
      class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md">
      BOOK COURSE
    </button>
  </div>
</div>
</section>

<!-- GALLERY -->
<section id="gallery" class="bg-gray-100 py-20 px-6 md:px-20">
  <h2 class="text-3xl font-bold mb-12">Calfa Hair & Beauty Gallery</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
    <div class="overflow-hidden rounded-xl shadow-md hover:shadow-xl transition">
      <img src="images/sln.jpg" class="w-full h-80 object-cover hover:scale-110 transition duration-700">
    </div>
    <div class="overflow-hidden rounded-xl shadow-md hover:shadow-xl transition">
      <img src="images/sln2.jpeg" class="w-full h-80 object-cover hover:scale-110 transition duration-700">
    </div>
    <div class="overflow-hidden rounded-xl shadow-md hover:shadow-xl transition">
      <img src="images/sln3.jpeg" class="w-full h-80 object-cover hover:scale-110 transition duration-700">
    </div>
  </div>
</section>


<!-- MAPS SECTION -->
<section id="location" class="py-20 px-6 md:px-20">
  <h2 class="text-3xl font-bold mb-6">Our Location</h2>

  <div class="w-full h-96 mb-6">
    <iframe
      class="w-full h-full rounded-xl shadow-md"
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.8486736406185!2d112.6582882746609!3d-7.258057571304993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7ffb78143c40d%3A0xbb1a5386005180d1!2sCalfa%20Salon%20%26%20Wedding%20Surabaya%20%7C%7C%20MUA%20SURABAYA%20%7C%7C%20RIAS%20PENGANTIN!5e0!3m2!1sid!2sid!4v1766648611748!5m2!1sid!2sid"
      style="border:0;"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>

  <!-- BUTTON VISIT MAPS -->
  <a
    href="https://www.google.com/maps/place/Calfa+Salon+%26+Wedding+Surabaya/@-7.2580576,112.6582883,17z"
    target="_blank"
    class="inline-flex items-center gap-2 bg-pink-500 hover:bg-pink-600 text-white font-semibold px-6 py-3 rounded-full shadow-md transition"
  >
    📍 Visit Location
  </a>
</section>


<!-- CTA -->
<section class="bg-pink-50 py-16 px-6 md:px-20 flex flex-col md:flex-row gap-6 justify-between items-start md:items-center">
  <div>
    <h2 class="text-3xl font-bold mb-3">Contact Our Beauty Consultant</h2>
    <p class="text-gray-600 text-sm">Chat directly via WhatsApp for booking & course registration.</p>
  </div>
  <a href="https://wa.me/6282224422295" target="_blank" class="bg-pink-600 hover:bg-pink-700 text-white px-8 py-3 rounded-md">CONTACT VIA WHATSAPP</a>

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
  // BOOKING FORM FUNCTIONS
  function openForm(course, price) {
    document.getElementById('courseName').value = course;
    document.getElementById('coursePrice').value = price;
    document.getElementById('bookingModal').classList.remove('hidden');
    document.getElementById('bookingModal').classList.add('flex');
  }

  function closeForm() {
    document.getElementById('bookingModal').classList.add('hidden');
    document.getElementById('bookingModal').classList.remove('flex');
  }

  function sendToWhatsApp(e) {
    e.preventDefault();
    const name = document.getElementById('name').value;
    const age = document.getElementById('age').value;
    const address = document.getElementById('address').value;
    const gender = document.getElementById('gender').value;
    const course = document.getElementById('courseName').value;
    const price = document.getElementById('coursePrice').value;

    const message = `Halo Calfa Beauty Salon 👋
SAYA TERTARIK DAN INGIN MENGETAHUI LEBIH LANJUT

Berikut data saya:

Nama Lengkap : ${name}
Umur         : ${age} tahun
Gender       : ${gender}
Alamat       : ${address}

Course       : ${course}
Harga        : Rp ${price}`;

    const waUrl = `https://wa.me/6282224422295?text=${encodeURIComponent(message)}`;
    window.open(waUrl, '_blank');
  }

  burgerBtn.addEventListener('click', () => {
  mobileMenu.classList.toggle('max-h-0');
  mobileMenu.classList.toggle('max-h-screen');
  mobileMenu.classList.toggle('py-4');
  mobileMenu.classList.toggle('opacity-100');
  mobileMenu.classList.toggle('opacity-0');

  // Toggle icon
  if (burgerIcon.innerHTML.includes('M4 6h16')) {
    burgerIcon.innerHTML =
      '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
  } else {
    burgerIcon.innerHTML =
      '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
  }
});

function openDetail(data) {
  document.getElementById('detailTitle').innerText = data.title;
  document.getElementById('detailDesc').innerText  = data.desc;
  document.getElementById('detailImage').src       = data.image;
  document.getElementById('detailPrice').innerText = data.price;

  /* ===== MATERI ===== */
  const materiEl = document.getElementById('detailMateri');
  materiEl.innerHTML = '';

  if (data.materi && data.materi.length > 0) {
    data.materi.forEach(item => {
      materiEl.innerHTML += `
        <li class="border-l-4 border-pink-500 pl-4">
          <p class="font-semibold text-gray-800">${item.title}</p>
          <p class="text-sm text-gray-600">${item.desc}</p>
        </li>
      `;
    });
  }

  /* ===== SCHEDULE ===== */
  const scheduleEl = document.getElementById('detailSchedule');
  const scheduleWrapper = document.getElementById('detailScheduleWrapper');

  if (scheduleEl && scheduleWrapper) {
    scheduleEl.innerHTML = '';

    if (data.schedule && data.schedule.length > 0) {
      scheduleWrapper.classList.remove('hidden');

      data.schedule.forEach(item => {
        scheduleEl.innerHTML += `
          <li class="border-l-4 border-pink-500 pl-4">
            <p class="font-semibold text-gray-800">${item.day}</p>
            <p class="text-sm text-gray-600">${item.activity}</p>
          </li>
        `;
      });
    } else {
      scheduleWrapper.classList.add('hidden');
    }
  }

  document.getElementById('detailBookBtn').onclick = () => {
    closeDetail();
    openForm(data.title, data.rawPrice);
  };

  document.getElementById('detailModal').classList.remove('hidden');
  document.getElementById('detailModal').classList.add('flex');
}

function closeDetail() {
  document.getElementById('detailModal').classList.add('hidden');
  document.getElementById('detailModal').classList.remove('flex');
}

document.addEventListener('DOMContentLoaded', () => {

  const slides = document.querySelectorAll('.hero-slide');
  const dots   = document.querySelectorAll('.dot');
  const next   = document.getElementById('nextSlide');
  const prev   = document.getElementById('prevSlide');

  let current = 0;
  let autoSlide;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.toggle('active', i === index);
      dots[i].classList.toggle('active', i === index);
    });
    current = index;
  }

  function nextSlide() {
    showSlide((current + 1) % slides.length);
  }

  function prevSlide() {
    showSlide((current - 1 + slides.length) % slides.length);
  }

  next.addEventListener('click', () => {
    nextSlide();
    resetAutoSlide();
  });

  prev.addEventListener('click', () => {
    prevSlide();
    resetAutoSlide();
  });

  dots.forEach(dot => {
    dot.addEventListener('click', () => {
      showSlide(parseInt(dot.dataset.slide));
      resetAutoSlide();
    });
  });

  function startAutoSlide() {
    autoSlide = setInterval(nextSlide, 5000);
  }

  function resetAutoSlide() {
    clearInterval(autoSlide);
    startAutoSlide();
  }

  startAutoSlide();
});
</script>

</body>
</html>
