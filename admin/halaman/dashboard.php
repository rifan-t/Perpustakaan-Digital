<!-- Main Content -->
<?php 
$total_buku = $conn->query("SELECT COUNT(*) as total FROM buku")->fetch(PDO::FETCH_ASSOC)['total'];
$pemesanan_aktif = $conn->query("SELECT COUNT(*) as total FROM peminjaman")->fetch(PDO::FETCH_ASSOC)['total'];
$total_user = $conn->query("SELECT COUNT(*) as total FROM users")->fetch(PDO::FETCH_ASSOC)['total'];
?>
<main class="flex-1 p-6 bg-gray-100 min-h-screen">
  <h2 class="text-3xl font-bold text-gray-800 mb-6">📊 Dashboard Admin</h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Card: Total Buku -->
    <div class=" rounded-2xl shadow-md p-6 hover:shadow-xl transition duration-300">
      <div class="flex items-center space-x-4">
        <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
          📚
        </div>
        <div>
          <p class="text-gray-500 text-sm">Total Buku</p>
          <h3 class="text-2xl font-bold text-blue-600"><?= $total_buku ?></h3>
        </div>
      </div>
    </div>

    <!-- Card: Total Peminjaman -->
    <div class=" rounded-2xl shadow-md p-6 hover:shadow-xl transition duration-300">
      <div class="flex items-center space-x-4">
        <div class="bg-green-100 text-green-600 p-3 rounded-full">
          📦
        </div>
        <div>
          <p class="text-gray-500 text-sm">Total Peminjaman</p>
          <h3 class="text-2xl font-bold text-green-600"><?= $pemesanan_aktif ?></h3>
        </div>
      </div>
    </div>

    <!-- Card: Total User -->
    <div class=" rounded-2xl shadow-md p-6 hover:shadow-xl transition duration-300">
      <div class="flex items-center space-x-4">
        <div class="bg-red-100 text-red-600 p-3 rounded-full">
          👤
        </div>
        <div>
          <p class="text-gray-500 text-sm">Total User</p>
          <h3 class="text-2xl font-bold text-red-600"><?= $total_user ?></h3>
        </div>
      </div>
    </div>
  </div>
</main>
