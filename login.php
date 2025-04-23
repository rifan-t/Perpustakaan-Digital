<?php
session_start(); 
require_once 'modul/fungsi/Auth.php';
require_once 'lib/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $auth = new Auth($conn); 
    $auth->login_user($email, $password);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teman Baca</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="assets/img/logo.png" type="image/png" />

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
        <a href="index.php"><h1 class="text-center text-5xl font-bold m-4 text-blue-600 ">👉🏻TemenBaca👈🏻</h1></a>
    </div><center>
    <div class="bg-white rounded-2xl shadow-2xl flex w-full max-w-4xl mt-20 mx-auto overflow-hidden">
        <!-- Left Side - Logo -->
        <div class="w-2/5 bg-gradient-to-br from-blue-600 to-purple-600 text-white rounded-l-2xl p-12 flex flex-col items-center justify-center">
            <div class="text-4xl font-bold mb-4">Welcome Back Mafren!</div>
            <div class="mb-8">
                <i class="fas fa-user-circle text-8xl"></i>
            </div>
            <p class="text-center mb-8">Suka Baca Buku? Gasalahh Pilih Baca Disini </p>
            <a href="registrasi.php" class="border-2 border-white rounded-full px-12 py-2 inline-block font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                Sign Up
            </a>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-3/5 p-12">
            <div class="text-3xl font-bold text-blue-600 mb-8">Login dicini!</div>
            <form class="space-y-6" method="post">
                <div>
                    <label class="text-gray-600 mb-2 block">Email Address</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute text-gray-400 top-3 left-4"></i>
                        <input name="email" type="email" placeholder="Masukkan email camuu" class="pl-12 w-full py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 transition duration-300">
                    </div>
                </div>
                <div>
                    <label class="text-gray-600 mb-2 block">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute text-gray-400 top-3 left-4"></i>
                        <input name="password" type="password" placeholder="masukkin password kamu  " class="pl-12 w-full py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 transition duration-300">
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    
                    <a href="modul/halaman/forgot_password.php" class="text-blue-600 hover:underline">Forgot Password?</a>
                </div>
                <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                    Sign In
                </button>
            </form>
        </div>
    </div>
    </center>
</body>
</html>
