<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kursus | Hair & Beauty</title>

  <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="images/new.png" class="h-20">

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    scroll-behavior: smooth;
    }
  </style>
</head>

<!-- BOOKING MODAL -->
<div id="bookingModal"
     class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

  <div class="bg-white rounded-xl w-full max-w-md p-6 relative">
    <button onclick="closeForm()"
            class="absolute top-3 right-4 text-gray-500 text-xl">✕</button>

    <h3 class="text-2xl font-bold mb-4">Course Booking</h3>

    <form onsubmit="sendToWhatsApp(event)">
      <input type="hidden" id="courseName">
      <input type="hidden" id="coursePrice">

     <!-- NAMA LENGKAP -->
<div class="mb-4">
  <label class="text-sm">Nama Lengkap</label>
  <input id="name" required
         placeholder="Masukkan nama lengkap"
         class="w-full border px-3 py-2 rounded-md">
</div>

<!-- ALAMAT -->
<div class="mb-4">
  <label class="text-sm">Alamat</label>
  <textarea id="address" required
            placeholder="Masukkan alamat lengkap"
            class="w-full border px-3 py-2 rounded-md"></textarea>
</div>

<!-- UMUR -->
<div class="mb-4">
  <label class="text-sm">Umur</label>
  <input id="age" type="number" required
         placeholder="Contoh: 20"
         class="w-full border px-3 py-2 rounded-md">
</div>

<!-- GENDER -->
<div class="mb-4">
  <label class="text-sm">Gender</label>
  <select id="gender" required
          class="w-full border px-3 py-2 rounded-md">
    <option value="">-- Pilih Gender --</option>
    <option value="Wanita">Wanita</option>
    <option value="Pria">Pria</option>
  </select>
</div>

      <button type="submit"
              class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md">
        SEND TO WHATSAPP
      </button>
    </form>
  </div>
</div>

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


<script>
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

  const name    = document.getElementById('name').value;
  const age     = document.getElementById('age').value;
  const address = document.getElementById('address').value;
  const gender  = document.getElementById('gender').value;
  const course  = document.getElementById('courseName').value;
  const price   = document.getElementById('coursePrice').value;

  const message =
`Halo Calfa Beauty Salon 👋
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
</script>


<body class="bg-white text-black">

<header class="fixed top-0 left-0 w-full flex items-center justify-between px-6 py-4 bg-black z-30">
  <img src="images/new.png" class="h-9 md:h-10">

  <nav class="hidden md:flex flex-1 justify-center space-x-10 text-xs uppercase text-white">
    <a href="index.php" class="hover:text-gray-300">Home</a>
    <a href="treatment.php" class="hover:text-gray-300">Treatment</a>
    <a href="kursus.php" class="text-pink-500">Kursus</a>
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
  <a href="treatment.php">Treatment</a>
  <a href="kursus.php" class="text-pink-500">Kursus</a>
  <a href="about.php">About</a>
  <a href="news.php">News</a>
</div>

<!-- HERO -->
<section class="relative">
  <img src="images/krsus.png"
       class="w-full h-[350px] object-cover brightness-50">

  <div class="absolute inset-0 flex items-center px-6 md:px-20 text-white">
    <div>
      <h2 class="text-3xl md:text-4xl font-bold mb-3">
        CALFA ACADEMY
      </h2>
      <p class="text-gray-200 max-w-md text-sm">
        Belajar langsung dari mentor berpengalaman & bersertifikat
      </p>
    </div>
  </div>
</section>

<!-- KURSUS LIST -->
<section class="py-20 px-6 md:px-20">
  <p class="text-gray-400 uppercase text-sm mb-3">Calfa Academy</p>
  <h2 class="text-3xl font-bold mb-14">Program Kursus</h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">


    <!-- COURSE CARD -->
<div class="bg-white rounded-xl shadow-md overflow-hidden relative">

  <!-- ICON EYE -->
  <button
    onclick="openDetail({
  title: 'Basic Salon GOLD',
  desc: 'Kursus Basic Salon dirancang khusus bagi pemula yang ingin mempelajari dasar-dasar dunia kecantikan secara profesional. Dalam kursus ini, peserta akan dibimbing langsung oleh instruktur berpengalaman untuk memahami teknik dasar perawatan rambut, tata rias sederhana, hingga etika pelayanan salon ,Materi disusun secara bertahap, mudah dipahami, dan mengutamakan praktik langsung agar peserta memiliki kepercayaan diri serta keterampilan yang siap diterapkan. Kursus ini sangat cocok bagi Anda yang ingin memulai karier di industri salon, membuka usaha sendiri, atau meningkatkan kemampuan dasar di bidang kecantikan.',
  image: 'images/bscgld.jpg',
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
    <h3 class="text-xl font-semibold">BASIC SALON GOLD</h3>
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
      onclick="openForm('Basic Salon Gold','4.999.999')"
      class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md">
      BOOK COURSE
    </button>
  </div>
</div>

   <!-- COURSE CARD 2-->
<div class="bg-white rounded-xl shadow-md overflow-hidden relative">

  <!-- ICON EYE -->
  <button
    onclick="openDetail({
  title: 'Basic Salon Silver',
  desc: 'Kursus Basic Salon dirancang khusus bagi pemula yang ingin mempelajari dasar-dasar dunia kecantikan secara profesional. Dalam kursus ini, peserta akan dibimbing langsung oleh instruktur berpengalaman untuk memahami teknik dasar perawatan rambut, tata rias sederhana, hingga etika pelayanan salon ,Materi disusun secara bertahap, mudah dipahami, dan mengutamakan praktik langsung agar peserta memiliki kepercayaan diri serta keterampilan yang siap diterapkan. Kursus ini sangat cocok bagi Anda yang ingin memulai karier di industri salon, membuka usaha sendiri, atau meningkatkan kemampuan dasar di bidang kecantikan.',
  image: 'images/bscslvr.jpg',
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

  <img src="images/ks.jpeg" class="w-full h-44 object-cover">

  <div class="p-6">
    <h3 class="text-xl font-semibold">BASIC SALON SILVER</h3>
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


    <!-- COURSE CARD 3-->
<div class="bg-white rounded-xl shadow-md overflow-hidden relative">

  <!-- ICON EYE -->
  <button
    onclick="openDetail({
  title: 'PRO HAIRCUT',
  desc: 'PRO HAIRCUT adalah program kursus profesional yang dirancang untuk meningkatkan keterampilan potong rambut secara presisi dan modern. Peserta akan mempelajari teknik haircut lanjutan, analisis bentuk wajah, tekstur rambut, serta penyesuaian gaya sesuai karakter klien. Kursus ini menekankan praktik langsung dengan model asli, sehingga peserta siap bekerja di salon profesional maupun membuka usaha sendiri dengan standar kualitas tinggi.',
  image: 'images/hcut.jpg',
  price: '5.000.000',
  rawPrice: '5000000',
  materi: [
  {
    title: 'PRO HAIRCUT',
    desc: 'Oval, Bob, Flat, segi, Layer, Long Layer, Medium Layer, Bob, Pixy'
  }
],

schedule: [
    {
      day: 'Day 1',
      activity: 'Pengenalan alat salon, teori rambut & teknik cuci rambut'
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
    <!-- COURSE CARD 4-->
<div class="bg-white rounded-xl shadow-md overflow-hidden relative">

  <!-- ICON EYE -->
  <button
    onclick="openDetail({
  title: 'HAIRCOLOR',
  desc: 'Program kursus pewarnaan rambut profesional yang membekali peserta dengan teknik warna modern, pemilihan produk yang tepat, analisis jenis rambut, dan praktik langsung. Peserta akan belajar menciptakan warna rambut sesuai tren, aman untuk rambut, dan siap diterapkan di salon profesional.',
  image: 'images/hclr.jpg',
  price: '5.000.000',
  rawPrice: '5000000',
  materi: [
  {
    title: 'HAIR COLORING',
    desc: 'Airtouch'
  }
],

schedule: [
    {
      day: 'Day 1',
      activity: 'Pengenalan alat salon, teori rambut & teknik cuci rambut'
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

  <img src="images/coloring.jpeg" class="w-full h-44 object-cover">

  <div class="p-6">
    <h3 class="text-xl font-semibold">HAIR COLORING</h3>
    <p class="text-sm text-gray-600 my-3">
      PROFESIONAL HAIR COLORING CLASS
    </p>

    <ul class="text-sm text-gray-600 list-disc list-inside mb-4 space-y-1">
      <li>Color Theory & Consultation</li>
      <li>Hair Analysis & Preparation</li>
      <li>Tools & Safety in Haircoloring</li>
      <li>Base Coloring Techniques</li>
      <h3 class="text-xs text-green-500">*Selengkapnya Klik Icon Mata*</h3>
    </ul>

    <p class="text-pink-600 font-bold text-lg mb-4">Rp 5.000.000</p>

    <button
      onclick="openForm('Hair Color','5.000.000')"
      class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md">
      BOOK COURSE
    </button>
  </div>
</div>
    <!-- COURSE CARD 5-->
<div class="bg-white rounded-xl shadow-md overflow-hidden relative">

  <!-- ICON EYE -->
  <button
    onclick="openDetail({
  title: 'SMOTHING PRO',
  desc: 'Program kursus smoothing rambut profesional yang mengajarkan teknik pelurusan rambut modern tanpa merusak rambut. Peserta akan belajar pemilihan produk, prosedur aman, teknik aplikasi tepat, finishing halus, serta perawatan pasca-proses agar rambut tetap sehat, berkilau, dan mudah diatur.',
  image: 'images/smth.jpg',
  price: '5.000.000',
  rawPrice: '5000000',
  materi: [
  {
    title: 'SMOTHING PRO',
    desc: 'Smoothing Romania'
  }
],

schedule: [
    {
      day: 'Day 1',
      activity: 'Pengenalan alat salon, teori rambut & teknik cuci rambut'
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

  <img src="images/smoth.jpeg" class="w-full h-44 object-cover">

  <div class="p-6">
    <h3 class="text-xl font-semibold">SMOOTHING PRO</h3>
    <p class="text-sm text-gray-600 my-3">
      PROFESIONAL SMOOTHING CLASS
    </p>

    <ul class="text-sm text-gray-600 list-disc list-inside mb-4 space-y-1">
      <li>Hair Analysis & Consultation</li>
      <li>Products & Tools</li>
      <li>Safety & Precaution</li>
      <li>Sectioning & Application Techniques</li>
      <h3 class="text-xs text-green-500">*Selengkapnya Klik Icon Mata*</h3>
    </ul>

    <p class="text-pink-600 font-bold text-lg mb-4">Rp 5.000.000</p>

    <button
      onclick="openForm('Smoothing','5.000.000')"
      class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md">
      BOOK COURSE
    </button>
  </div>
</div>
    <!-- COURSE CARD 6-->
<div class="bg-white rounded-xl shadow-md overflow-hidden relative">

  <!-- ICON EYE -->
  <button
    onclick="openDetail({
  title: 'PRO PERMING',
  desc: 'Program kursus perming profesional yang mengajarkan teknik blow perm modern untuk menciptakan rambut bergelombang atau keriting sesuai tren. Peserta akan belajar pemilihan alat dan produk yang tepat, analisis jenis rambut, teknik pengerjaan yang aman, serta praktik langsung pada model. Setelah kursus, peserta mampu menghasilkan hasil perm yang rapi, natural, dan tahan lama, siap diterapkan di salon profesional.',
  image: 'images/blwprm.jpg',
  price: '5.000.000',
  rawPrice: '5000000',
  materi: [
  {
    title: 'PRO PERMING',
    desc: 'Hair Analysis & Consultation, Products & Tools, Safety & Precaution, Sectioning & Wrapping Techniques, Chemical Application, Thermal / Blow, Drying Techniques, Finishing & Stylin, Aftercare & Maintenance, Practice on Model'
  }
],

schedule: [
    {
      day: 'Day 1',
      activity: 'Pengenalan alat salon, teori rambut & teknik cuci rambut'
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

  <img src="images/bl.PNG" class="w-full h-44 object-cover">

  <div class="p-6">
    <h3 class="text-xl font-semibold">PRO PERMING</h3>
    <p class="text-sm text-gray-600 my-3">
      PROFESIONAL PERMING CLASS
    </p>

    <ul class="text-sm text-gray-600 list-disc list-inside mb-4 space-y-1">
      <li>Hair Analysis & Consultation</li>
      <li>Products & Tools</li>
      <li>Safety & Precaution</li>
      <li>Finishing & Styling</li>
      <h3 class="text-xs text-green-500">*Selengkapnya Klik Icon Mata*</h3>
    </ul>

    <p class="text-pink-600 font-bold text-lg mb-4">Rp 5.000.000</p>

    <button
      onclick="openForm('PRO PERMING','5.000.000')"
      class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md">
      BOOK COURSE
    </button>
  </div>
</div>
  </section>

<!-- CTA -->
<section class="bg-pink-50 py-16 px-6 md:px-20 text-center">
  <h2 class="text-3xl font-bold mb-2">
    Bangun Karier di Dunia Kecantikan
  </h2>
  <p class="text-gray-600 text-sm mb-6">
    Daftar kursus sekarang & mulai perjalanan profesionalmu
  </p>

  <a href="https://wa.me/6282224422295" target="_blank"
     class="bg-pink-600 hover:bg-pink-700 text-white px-8 py-3">
    Konsultasi via WhatsApp
  </a>
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
