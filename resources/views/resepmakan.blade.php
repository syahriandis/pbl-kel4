<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Program Makan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" defer></script>
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="bg-[#A0D468] text-white w-64 p-4">
      <div class="flex items-center mb-8">
        <img src="{{ asset('images/logo.jpeg') }}" class="w-20 h-20 rounded-full">

        <div>
          <h1 class="text-2xl font-bold">MetaMeal</h1>
          <p class="italic">Selamat Datang </p>
        </div>
      </div>

      <nav>
        <ul>
          <li class="mb-4 flex items-center hover:bg-white hover:text-[#5F8C2D] rounded-lg p-2 transition duration-200 ease-in-out">
            <i class="fas fa-home mr-2"></i>
            <a href="/beranda" class="text-lg">Beranda</a>
          </li>
          <li class="mb-4 flex items-center bg-white text-[#5F8C2D] rounded-lg p-2 font-semibold shadow-md">
            <a href="{{ route('program-makan.index') }}" class="text-lg">Program Makan</a>
          </li>
          <li class="mb-4 flex items-center hover:bg-white hover:text-[#5F8C2D] rounded-lg p-2 transition duration-200 ease-in-out">
            <i class="fas fa-running mr-2"></i>
            <a href="/programlatihan" class="text-lg">Program Latihan</a>
          </li>
          <li class="mb-4 flex items-center hover:bg-white hover:text-[#5F8C2D] rounded-lg p-2 transition duration-200 ease-in-out">
            <i class="fas fa-chart-line mr-2"></i>
            <a href="/progres" class="text-lg">Laporan Latihan</a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6 bg-[#5F8C2D] p-4 rounded-lg text-white shadow">
        <div class="flex items-center bg-white rounded-full shadow-md p-2 w-full md:w-1/2">
          <i class="fas fa-search text-gray-400 ml-2"></i>
          <input type="text" placeholder="Search..." class="ml-2 w-full border-none focus:outline-none bg-transparent text-black">
        </div>

        <div class="hidden md:flex items-center space-x-4 relative">
          <a href="/notifikasi" class="text-white text-xl hover:text-gray-200">
            <i class="fas fa-bell"></i>
          </a>
          <button onclick="toggleProfile()" class="text-white text-xl focus:outline-none">
            <i class="fas fa-user-circle"></i>
          </button>

          <div id="profilePopup" class="hidden absolute right-0 top-16 w-80 bg-white border border-gray-300 rounded-lg shadow-xl z-50 p-6">
            <div class="text-center">
              <img src="{{ asset('profil.jpeg') }}" class="w-24 h-24 rounded-full mx-auto mb-3 border" alt="Foto Profil">
              <h2 class="text-lg font-bold text-gray-800">Adrian Rizqullah</h2>
              <p class="text-gray-600 mb-2">adrian@gmail.com</p>
              <div class="text-left text-sm text-gray-700 space-y-1 mb-4">
                <p><strong>Umur:</strong> 19 tahun</p>
                <p><strong>Berat:</strong> 57 kg</p>
                <p><strong>Tinggi:</strong> 160 cm</p>
              </div>
              <button class="bg-[#5F8C2D] hover:bg-[#4a7224] text-white px-4 py-2 rounded-full">Ubah Profil</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Content List -->
      <div class="space-y-4">
        @foreach ($programs as $program)
        <div class="bg-gray-200 p-4 rounded-lg shadow-md flex justify-between items-center">
          <div>
            <h2 class="text-xl font-bold">Rivaldo</h2>
            <p class="text-sm font-semibold">{{ $program['tanggal'] }}</p>
            <p class="text-sm">{{ $program['menu'] }}</p>
          </div>
          <button onclick="showMakanDetail('{{ strtolower(explode(' ', $program['menu'])[1]) }}')" class="focus:outline-none">
            <i class="fas fa-arrow-right text-gray-600"></i>
          </button>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="makanModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-xl relative">
      <button onclick="toggleMakanModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
      <div id="makanContent"></div>
      <div class="flex justify-between mt-4">
        <button onclick="toggleMakanModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Kembali</button>
        <button onclick="showMakanNote()" class="bg-green-500 text-white px-4 py-2 rounded">Done</button>
      </div>
      <div id="makanNoteSection" class="mt-4 hidden">
        <label class="block mb-2 font-semibold">Catatan Makan:</label>
        <textarea class="w-full border p-2 rounded mb-2" placeholder="Tulis pendapatmu tentang makanan ini..."></textarea>
        <button onclick="makanSelesai()" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
      </div>
    </div>
  </div>

  <!-- Script -->
  <script>
    function toggleProfile() {
      const popup = document.getElementById("profilePopup");
      popup.classList.toggle("hidden");
    }

    function toggleMakanModal() {
      const modal = document.getElementById("makanModal");
      modal.classList.toggle("hidden");
      document.getElementById("makanNoteSection").classList.add("hidden");
    }

    function showMakanNote() {
      document.getElementById("makanNoteSection").classList.remove("hidden");
    }

    function makanSelesai() {
      const note = document.querySelector('#makanNoteSection textarea').value;
      alert("Program makan selesai!\nCatatan: " + note);
      toggleMakanModal();
    }

    function showMakanDetail(id) {
      const content = {
        ayam: `
          <h3 class="text-2xl font-bold mb-4">🍗 Resep Ayam</h3>
          <ul class="list-disc list-inside">
            <li>500 gram ayam</li>
            <li>3 siung bawang putih</li>
            <li>1 sdt ketumbar</li>
            <li>1 sdt garam</li>
            <li>1 ruas kunyit</li>
            <li>Minyak goreng secukupnya</li>
          </ul>
          <p class="font-semibold">Cara Membuat:</p>
          <ol class="list-decimal list-inside">
            <li>Haluskan bumbu, balurkan ke ayam dan diamkan.</li>
            <li>Rebus ayam sampai air menyusut.</li>
            <li>Goreng dalam minyak panas hingga kecoklatan.</li>
          </ol>
        `,
        ubi: `
          <h3 class="text-2xl font-bold mb-4">🍠 Resep Ubi Goreng</h3>
          <ul class="list-disc list-inside">
            <li>1 buah ubi manis (ungu atau kuning)</li>
            <li>1 sdt minyak zaitun (opsional)</li>
            <li>Sejumput garam (boleh skip)</li>
            <li>Kayu manis bubuk (opsional)</li>
          </ul>
          <p class="font-semibold">Cara Membuat:</p>
          <ol class="list-decimal list-inside">
            <li>Kupas ubi dan potong memanjang atau bulat tipis.</li>
            <li>Rendam dalam air 10-15 menit, tiriskan.</li>
            <li>Baluri dengan minyak zaitun dan garam (jika dipakai).</li>
            <li>Panggang suhu 180°C selama ±25 menit (bisa juga pakai air fryer).</li>
            <li>Taburi kayu manis bila suka.</li>
          </ol>
        `,
        telur: `
          <h3 class="text-2xl font-bold mb-4">🥚 Resep Telur</h3>
          <ul class="list-disc list-inside">
            <li>2 butir telur</li>
            <li>Garam & merica secukupnya</li>
            <li>Daun bawang (opsional)</li>
          </ul>
          <p class="font-semibold">Cara Membuat:</p>
          <ol class="list-decimal list-inside">
            <li>Kocok semua bahan dalam mangkuk.</li>
            <li>Panaskan sedikit minyak, tuang telur.</li>
            <li>Masak sampai matang kedua sisi. Sajikan hangat.</li>
          </ol>
        `
      };

      document.getElementById("makanContent").innerHTML = content[id];
      toggleMakanModal();
    }
  </script>
</body>
</html>
