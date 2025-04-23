<?php 
require_once 'modul/fungsi/Auth.php';
require_once 'lib/koneksi.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $alamat = $_POST['alamat'];
    $role_id = 3;

    $auth = new Auth($conn); 
    $auth->registrasi($username,  $password, $confirm_password, $email, $alamat, $role_id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen items-center justify-center">
  <div class="container">
    <a href="index.php"><h1 class="text-center text-5xl font-bold m-4 text-blue-600">👉🏻TemenBaca👈🏻</h1></a>
  </div>
  <center>
    <div class="bg-white rounded-2xl shadow-2xl flex w-full max-w-4xl mt-10 mx-auto overflow-hidden">
      
      <!-- Left Side - Info -->
      <div class="w-2/5 bg-gradient-to-br from-blue-600 to-purple-600 text-white rounded-l-2xl p-12 flex flex-col items-center justify-center">
        <div class="text-3xl font-bold mb-4">Hai, Calon Teman Baru! 📚</div>
        <div class="mb-6">
          <i class="fas fa-user-plus text-8xl"></i>
        </div>
        <p class="text-center mb-8">Gabung bareng TemenBaca, biar waktu bacamu makin asik dan bermakna! ✨</p>
        <a href="login.php" class="border-2 border-white rounded-full px-10 py-2 inline-block font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
          Login
        </a>
      </div>

      <!-- Right Side - Register Form -->
      <div class="w-3/5 p-12">
        <div class="text-3xl font-bold text-blue-600 mb-8">Registrasi Disini!</div>
        <form class="space-y-5" method="post">
          <div>
            <div class="relative">
              <i class="fas fa-user absolute text-gray-400 top-3 left-4"></i>
              <input name="username" type="text" required placeholder="Masukkan nama lengkap" class="pl-12 w-full py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 transition duration-300">
            </div>
          </div>
          <div>
            <div class="relative">
              <i class="fas fa-envelope absolute text-gray-400 top-3 left-4"></i>
              <input name="email" type="email" required placeholder="Masukkan email" class="pl-12 w-full py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 transition duration-300">
            </div>
          </div>
          <div>
            <div class="relative">
              <i class="fas fa-lock absolute text-gray-400 top-3 left-4"></i>
              <input name="password" type="password" required placeholder="Buat password" class="pl-12 w-full py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 transition duration-300">
            </div>
          </div>
          <div>
            <div class="relative">
              <i class="fas fa-lock absolute text-gray-400 top-3 left-4"></i>
              <input name="confirm_password" type="password" required placeholder="Ulangi password" class="pl-12 w-full py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 transition duration-300">
            </div>
          </div>
          <div>
            <div class="relative">
              <i class="fas fa-map-marker-alt absolute text-gray-400 top-3 left-4"></i>
              <input name="alamat" type="text" required placeholder="Masukkan alamat" class="pl-12 w-full py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 transition duration-300">
            </div>
          </div>
          <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
            Daftar Sekarang
          </button>
        </form>
      </div>
    </div>
  </center>
</body>
</html>
