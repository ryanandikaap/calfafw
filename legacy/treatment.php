<?php
session_start();
include "config/database.php";

/* =========================
   SEARCH & LIMIT LOGIC
========================= */
$search   = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$where = [];

if ($search) {
  $where[] = "name LIKE '%$search%'";
}

if ($category) {
  $where[] = "category = '$category'";
}

$whereSQL = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$treatments = mysqli_query(
  $conn,
  "SELECT * FROM treatments
   $whereSQL
   ORDER BY id DESC
   LIMIT 6"
);
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Treatment | Calfa Hair & Beauty</title>
  <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="images/new.png" class="h-20">
</head>
<body class="bg-white text-black">

<body class="bg-white text-black">

<header class="fixed top-0 left-0 w-full flex items-center justify-between px-6 py-4 bg-black z-30">
  <img src="images/new.png" class="h-9 md:h-10">

  <nav class="hidden md:flex flex-1 justify-center space-x-10 text-xs uppercase text-white">
    <a href="index.php" class="hover:text-gray-300">Home</a>
    <a href="treatment.php" class="text-pink-500">Treatment</a>
    <a href="kursus.php" class="hover:text-gray-300">Kursus</a>
    <a href="about.php" class="hover:text-gray-300">About</a>
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
  <a href="treatment.php" class="text-pink-500">Treatment</a>
  <a href="kursus.php">Kursus</a>
  <a href="about.php">About</a>
  <a href="news.php">News</a>
</div>

<!-- HERO -->
<section class="relative mt-16">
  <img src="images/salon.jpeg" class="w-full h-[350px] object-cover brightness-50">
  <div class="absolute inset-0 flex items-center px-6 md:px-20 text-white">
    <div>
      <h2 class="text-3xl md:text-4xl font-bold mb-3">Our Signature Treatments</h2>
      <p class="text-gray-200 max-w-md text-sm">
        Experience premium beauty treatments handled by professionals.
      </p>
    </div>
  </div>
</section>


<!-- TREATMENT LIST -->
<section class="py-20 px-6 md:px-20">
  <p class="text-gray-400 uppercase text-sm mb-2">Calfa Hair & Beauty</p>
  <h2 class="text-3xl font-bold mb-6">Beauty & Hair Treatments</h2>

  <!-- SEARCH -->
<form method="GET" class="max-w-md mb-8">
  <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">

  <input
    type="text"
    name="search"
    value="<?= htmlspecialchars($search) ?>"
    placeholder="Cari treatment..."
    class="w-full border px-4 py-3 rounded-lg focus:ring-2 focus:ring-pink-500">
</form>

  <?php if (!$search): ?>
    <p class="text-sm text-gray-500 mb-10">
      Menampilkan beberapa treatment unggulan. Gunakan pencarian untuk melihat semua.
    </p>
  <?php endif; ?>

  <!-- FILTER CATEGORY -->
<div class="flex flex-wrap gap-3 mb-10">
  <a href="treatment.php"
     class="px-5 py-2 rounded-full text-sm
            <?= !$category ? 'bg-pink-600 text-white' : 'border' ?>">
    All
  </a>

  <?php
  $categories = ['Hair','Face','Nail','Spa'];
  foreach ($categories as $cat):
  ?>
    <a href="treatment.php?category=<?= $cat ?>"
       class="px-5 py-2 rounded-full text-sm
              <?= $category == $cat ? 'bg-pink-600 text-white' : 'border hover:bg-gray-100' ?>">
      <?= $cat ?>
    </a>
  <?php endforeach; ?>
</div>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
    <?php while($t = mysqli_fetch_assoc($treatments)) : ?>
      <div class="border rounded-xl p-5 hover:shadow-lg transition">
        <img
          src="uploads/<?= htmlspecialchars($t['image'] ?: 'hairstyling.jpeg') ?>"
          class="w-full h-44 object-cover rounded-md mb-4">

        <h3 class="text-lg font-semibold"><?= htmlspecialchars($t['name']) ?></h3>
        <p class="text-sm text-gray-600"><?= htmlspecialchars($t['description']) ?></p>
        <p class="text-pink-600 font-semibold mt-2">
          Start from Rp <?= number_format($t['price'],0,',','.') ?>
        </p>

        <button
          onclick="openBooking('<?= htmlspecialchars($t['name']) ?>','<?= $t['price'] ?>')"
          class="w-full mt-4 bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md">
          BOOK NOW
        </button>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<!-- BOOKING MODAL -->
<div id="bookingModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
  <div class="bg-white rounded-xl w-full max-w-md relative max-h-[90vh] overflow-hidden">
    
    <div class="flex justify-between items-center p-5 border-b">
      <h3 class="text-xl font-bold">Booking Treatment</h3>
      <button onclick="closeBooking()" class="text-gray-500 text-2xl leading-none">✕</button>
    </div>

    <div class="p-5 overflow-y-auto max-h-[75vh]">


      <form onsubmit="sendBooking(event)" enctype="multipart/form-data">
        <input type="hidden" id="treatmentName">
        <input type="hidden" id="treatmentPrice">

        <div class="mb-4">
          <label class="text-sm">Nama Lengkap</label>
          <input id="name" required class="w-full border px-3 py-2 rounded-md">
        </div>

        <div class="mb-4">
          <label class="text-sm">Tanggal Booking</label>
          <input id="date" type="date" required class="w-full border px-3 py-2 rounded-md">
        </div>

        <div class="mb-4">
          <label class="text-sm">Jam Booking</label>
          <input id="time" type="time" required class="w-full border px-3 py-2 rounded-md">
        </div>

        <div class="mb-4">
          <label class="text-sm">Gender</label>
          <select id="gender" required class="w-full border px-3 py-2 rounded-md">
            <option value="">-- Pilih Gender --</option>
            <option value="Wanita">Wanita</option>
            <option value="Pria">Pria</option>
          </select>
        </div>

       <div class="mb-4 relative">
  <label class="text-sm font-medium">Pilih Hairstylist</label>

  <!-- INPUT HIDDEN -->
  <input type="hidden" id="hairstylist" required>

  <!-- DROPDOWN BUTTON -->
  <button type="button"
    onclick="toggleStylist()"
    class="w-full mt-2 border rounded-xl px-4 py-3 flex justify-between items-center">

    <span id="selectedStylist" class="text-gray-400">
      Pilih Hairstylist
    </span>

    <svg class="w-5 h-5 text-gray-500 transition" id="stylistArrow"
         fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 9l-7 7-7-7"/>
    </svg>
  </button>

  <!-- DROPDOWN CONTENT -->
  <div id="stylistDropdown"
       class="hidden absolute z-30 bg-white w-full mt-2 border rounded-xl p-4
              grid grid-cols-2 sm:grid-cols-3 gap-4 max-h-72 overflow-y-auto">

    <!-- STYLIST ITEM -->
    <div onclick="selectStylist(this, 'Calfa Owner')"
      class="stylist-card cursor-pointer text-center hover:bg-pink-50 p-2 rounded-xl">

      <img src="images/owner.jpeg"
           class="w-20 h-20 mx-auto object-cover rounded-full mb-2">
      <p class="text-sm font-semibold">Calfa Owner</p>
      <p class="text-xs text-gray-500">Master Stylist</p>
    </div>

    <div onclick="selectStylist(this, 'Miar Hair Stylist')"
      class="stylist-card cursor-pointer text-center hover:bg-pink-50 p-2 rounded-xl">

      <img src="images/stylist/miar.jpg"
           class="w-20 h-20 mx-auto object-cover rounded-full mb-2">
      <p class="text-sm font-semibold">Miar Hair Stylist</p>
      <p class="text-xs text-gray-500">Senior Stylist</p>
    </div>

    <div onclick="selectStylist(this, 'Putri Hair Stylist')"
      class="stylist-card cursor-pointer text-center hover:bg-pink-50 p-2 rounded-xl">

      <img src="images/putt.png"
           class="w-20 h-20 mx-auto object-cover rounded-full mb-2">
      <p class="text-sm font-semibold">Putri Hair Stylist</p>
      <p class="text-xs text-gray-500">Hair Stylist</p>
    </div>

    <div onclick="selectStylist(this, 'Sari Hair Stylist')"
      class="stylist-card cursor-pointer text-center hover:bg-pink-50 p-2 rounded-xl">

      <img src="images/ui.png"
           class="w-20 h-20 mx-auto object-cover rounded-full mb-2">
      <p class="text-sm font-semibold">Sari Hair Stylist</p>
      <p class="text-xs text-gray-500">Hair Stylist</p>
    </div>

    <div onclick="selectStylist(this, 'Ira Hair Stylist')"
      class="stylist-card cursor-pointer text-center hover:bg-pink-50 p-2 rounded-xl">

      <img src="images/1.png"
           class="w-20 h-20 mx-auto object-cover rounded-full mb-2">
      <p class="text-sm font-semibold">Ira Hair Stylist</p>
      <p class="text-xs text-gray-500">Hair Stylist</p>
    </div>

    <div onclick="selectStylist(this, 'Bebas (Rekomendasi Salon)')"
      class="stylist-card cursor-pointer text-center hover:bg-pink-50 p-2 rounded-xl">

      <div class="w-20 h-20 mx-auto rounded-full bg-pink-100
                  flex items-center justify-center mb-2">
        <span class="text-pink-600 text-2xl">★</span>
      </div>

      <p class="text-sm font-semibold">Bebas</p>
      <p class="text-xs text-gray-500">Rekomendasi Salon</p>
    </div>

  </div>


        </div>

        <div class="mb-4">
          <label class="text-sm">Catatan (opsional)</label>
          <textarea id="note" class="w-full border px-3 py-2 rounded-md"></textarea>
        </div>

        <!-- INFO DP -->
      <div class="mb-5 bg-pink-50 border border-pink-200 text-sm text-pink-700 p-3 rounded-lg">
        ⚠️ <b>Wajib DP minimal Rp100.000</b><br>
        Booking akan diproses setelah anda mengirim upload bukti transfer di WaatSaap Admin<br><br>
        <b>Rekening Transfer:</b><br>
        BCA <b>1234567890</b><br>
        a.n <b>Calfa Salon</b>
      </div>

        <button type="submit"
          class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md">
          BOOK NOW
        </button>
      </form>

    </div>
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


<script>
/* ================= BOOKING ================= */
function openBooking(treatment, price) {
  document.getElementById('treatmentName').value = treatment;
  document.getElementById('treatmentPrice').value = price;

  const modal = document.getElementById('bookingModal');
  modal.classList.remove('hidden');
  modal.classList.add('flex');
}

function closeBooking() {
  const modal = document.getElementById('bookingModal');
  modal.classList.add('hidden');
  modal.classList.remove('flex');
}

/* ================= SELECT STYLIST ================= */
function selectStylist(el, name) {
  // simpan ke input hidden
  document.getElementById('hairstylist').value = name;

  // reset semua card
  document.querySelectorAll('.stylist-card').forEach(card => {
    card.classList.remove(
      'border-pink-500',
      'ring-2',
      'ring-pink-400',
      'bg-pink-50'
    );
  });

  // aktifkan card yang dipilih
  el.classList.add(
    'border-pink-500',
    'ring-2',
    'ring-pink-400',
    'bg-pink-50'
  );
}

function sendBooking(e) {
  e.preventDefault();

  const name        = document.getElementById('name').value;
  const date        = document.getElementById('date').value;
  const time        = document.getElementById('time').value;
  const gender      = document.getElementById('gender').value;
  const hairstylist = document.getElementById('hairstylist').value;
  const note        = document.getElementById('note').value;
  const treatment   = document.getElementById('treatmentName').value;
  const price       = document.getElementById('treatmentPrice').value;

  if (!hairstylist) {
    alert('Silakan pilih hairstylist terlebih dahulu');
    return;
  }

  const message = `Halo Calfa Hair & Beauty 👋
Saya ingin melakukan booking treatment:

Nama        : ${name}
Tanggal     : ${date}
Jam         : ${time}
Gender      : ${gender}
Hairstylist : ${hairstylist}
Treatment   : ${treatment}
Harga       : Rp ${price}
Catatan     : ${note || '-'}

Terima kasih 🙏`;

  window.open(
    `https://wa.me/6282224422295?text=${encodeURIComponent(message)}`,
    '_blank'
  );

  closeBooking();
}

/* ================= BURGER MENU (FIX TOTAL) ================= */
document.addEventListener('DOMContentLoaded', () => {
  const burgerBtn  = document.getElementById('burgerBtn');
  const burgerIcon = document.getElementById('burgerIcon');
  const mobileMenu = document.getElementById('mobileMenu');

  if (!burgerBtn || !burgerIcon || !mobileMenu) {
    console.warn('Burger menu element tidak ditemukan');
    return;
  }

  burgerBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('max-h-0');
    mobileMenu.classList.toggle('max-h-screen');
    mobileMenu.classList.toggle('py-4');
    mobileMenu.classList.toggle('opacity-0');
    mobileMenu.classList.toggle('opacity-100');

    burgerIcon.innerHTML = mobileMenu.classList.contains('opacity-100')
      ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M6 18L18 6M6 6l12 12"/>`
      : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16"/>`;
  });
});

function toggleStylist() {
  const drop = document.getElementById('stylistDropdown');
  const arrow = document.getElementById('stylistArrow');

  drop.classList.toggle('hidden');
  arrow.classList.toggle('rotate-180');
}

function selectStylist(el, name) {
  document.getElementById('hairstylist').value = name;
  document.getElementById('selectedStylist').innerText = name;
  document.getElementById('selectedStylist').classList.remove('text-gray-400');
  document.getElementById('selectedStylist').classList.add('text-gray-800');

  document.getElementById('stylistDropdown').classList.add('hidden');
  document.getElementById('stylistArrow').classList.remove('rotate-180');
}
</script>



</body>
</html>
