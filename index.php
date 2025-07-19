<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Vistar Toko - Cetakin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      scroll-behavior: smooth;
    }
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .animate-fade-in-up {
      animation: fadeInUp 0.6s ease-out both;
    }
  </style>
</head>
<body id="top" class="bg-gradient-to-br from-blue-100 via-white to-green-100 min-h-screen flex flex-col">

  <!-- Navbar -->
  <header class="bg-white/80 backdrop-blur-md shadow py-4 sticky top-0 z-50 animate-fade-in-up">
    <div class="mx-auto px-4 lg:px-10 xl:px-20 flex justify-between items-center">
      <a href="#top" class="text-2xl font-bold text-blue-700 hover:opacity-80 transition">Vistar</a>
      <a href="customer.php" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full text-sm font-semibold transition shadow-md hover:scale-105">
        Cetakin Sekarang
      </a>
    </div>
  </header>

  <!-- Konten Utama -->
  <main class="flex-1 mx-auto px-4 lg:px-10 xl:px-20 py-12 w-full max-w-7xl space-y-24">

    <!-- Hero Section -->
    <section class="flex flex-col-reverse md:flex-row gap-12 items-center animate-fade-in-up">
      <!-- Teks -->
      <div class="w-full md:w-1/2 space-y-6">
        <h2 class="text-4xl font-extrabold text-gray-900 leading-snug">Solusi Harianmu Ada di Vistar</h2>
        <p class="text-gray-700 text-lg">
          Nggak cuma belanja — cetak foto, permak baju, sampai isi pulsa? Semua bisa. Vistar Toko hadir jadi pusat layanan lengkap buat kebutuhan warga.
        </p>
        <div class="flex gap-4 mt-4">
          <a href="https://wa.me/6285225576590?text=Halo%20kak,%20saya%20mau%20tanya-tanya%20tentang%20layanan%20Vistar%20Toko" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full font-semibold shadow-md transition hover:scale-105">Hubungi Kami</a>
          <a href="https://maps.app.goo.gl/DNWypXmbksw62NU49" target="_blank" class="bg-white hover:bg-gray-100 text-blue-700 px-6 py-2 rounded-full font-semibold border border-blue-600 transition">Cek Lokasi</a>
        </div>
      </div>

      <!-- Gambar -->
      <div class="relative rounded-2xl overflow-hidden shadow-xl border border-gray-200 group">
        <img src="public/img/gambar_toko.jpeg" alt="Toko Vistar" class="w-full h-64 object-cover group-hover:scale-105 transition duration-300 ease-in-out" />
        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/50 transition duration-300 ease-in-out"></div>
        <div class="absolute inset-0 flex flex-col justify-end p-5 z-10 text-white">
          <h3 class="text-lg font-semibold drop-shadow-md">Toko Vistar: Awal dari Semua Kebutuhan</h3>
          <p class="text-sm drop-shadow-md">Layanan cepat, hasil berkualitas, harga terjangkau. Solusi print dan kebutuhan rumah tangga dalam satu langkah.</p>
        </div>
      </div>
    </section>

    <!-- Section Layanan -->
    <section class="py-16 px-4 sm:px-8 bg-gradient-to-b from-white via-blue-50 to-white rounded-3xl">
      <h3 class="text-3xl font-bold text-center text-gray-800 mb-14">Layanan Kami</h3>
      <div class="grid md:grid-cols-3 gap-10 max-w-6xl mx-auto">
        <!-- Card Template -->
        <div class="bg-white/60 rounded-3xl p-6 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-500 border border-gray-100">
          <div class="overflow-hidden rounded-xl mb-4">
            <img src="public/img/ft.jpeg" class="w-full max-h-[140px] object-cover" />
          </div>
          <h4 class="font-semibold text-xl text-blue-800 mb-3 text-center">Cetak Foto</h4>
          <p class="text-gray-700 text-sm leading-relaxed text-center">Ukuran standar sampai besar. Termasuk pas foto dan momen keluarga.</p>
        </div>

        <div class="bg-white/60 rounded-3xl p-6 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-500 border border-gray-100">
          <div class="overflow-hidden rounded-xl mb-4">
            <img src="public/img/fc.jpeg" class="w-full max-h-[140px] object-cover" />
          </div>
          <h4 class="font-semibold text-xl text-blue-800 mb-3 text-center">Scan, Print, & Fotocopy</h4>
          <p class="text-gray-700 text-sm leading-relaxed text-center">Scan dan cetak dokumen warna maupun hitam putih.</p>
        </div>

        <div class="bg-white/60 rounded-3xl p-6 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-500 border border-gray-100">
          <div class="overflow-hidden rounded-xl mb-4">
            <img src="public/img/jahit.jpeg" class="w-full max-h-[140px] object-cover" />
          </div>
          <h4 class="font-semibold text-xl text-blue-800 mb-3 text-center">Jasa Jahit</h4>
          <p class="text-gray-700 text-sm leading-relaxed text-center">Jahit ulang, Jahit seragam sekolah, permak, dan custom jahitan cepat & rapi.</p>
        </div>

        <div class="bg-white/60 rounded-3xl p-6 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-500 border border-gray-100">
          <div class="overflow-hidden rounded-xl mb-4">
            <img src="public/img/tengah.jpeg" class="w-full max-h-[140px] object-cover" />
          </div>
          <h4 class="font-semibold text-xl text-blue-800 mb-3 text-center">ATK</h4>
          <p class="text-gray-700 text-sm leading-relaxed text-center">Lengkap mulai alat tulis, kertas, hingga sembako harian.</p>
        </div>

        <div class="bg-white/60 rounded-3xl p-6 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-500 border border-gray-100">
          <div class="overflow-hidden rounded-xl mb-4">
            <img src="public/img/dokumentasi.jpeg" class="w-full max-h-[140px] object-cover" />
          </div>
          <h4 class="font-semibold text-xl text-blue-800 mb-3 text-center">Livestream & Dokumentasi</h4>
          <p class="text-gray-700 text-sm leading-relaxed text-center">Wedding, acara keluarga, dan live event. Full coverage & rapi.</p>
        </div>

        <div class="bg-white/60 rounded-3xl p-6 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-500 border border-gray-100">
          <div class="overflow-hidden rounded-xl mb-4">
            <img src="public/img/depan.jpeg" class="w-full max-h-[140px] object-cover" />
          </div>
          <h4 class="font-semibold text-xl text-blue-800 mb-3 text-center">Sembako</h4>
          <p class="text-gray-700 text-sm leading-relaxed text-center">Beras, mie, minyak, dan kebutuhan pokok harian lainnya. Selalu ready stok!</p>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="text-center py-6 text-sm text-gray-500 bg-white/50 border-t border-gray-200 mt-16 animate-fade-in-up">
    &copy; <?= date('Y') ?> Vistar. All rights reserved.
  </footer>

  <script>
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function(e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        window.scrollTo({
          top: target.offsetTop,
          behavior: "smooth"
        });
      }
    });
  });
</script>


</body>
</html>
