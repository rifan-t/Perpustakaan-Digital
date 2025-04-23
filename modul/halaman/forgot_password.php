<?php
require_once '../../lib/koneksi.php';
require_once '../../modul/fungsi/Auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $auth = new Auth($conn);

    if ($auth->checkEmailExists($email)) {
        // Simulasi link reset dengan query parameter (bisa juga pakai token)
        header("Location: reset_password.php?email=" . urlencode($email));
        exit;
    } else {
        $error = "Email tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Forgot Password</h2>
        <?php if (!empty($error)): ?>
            <p class="text-red-500 text-center mb-4"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST">
            <label class="block mb-2 text-gray-700">Masukkan Email Anda</label>
            <input type="email" name="email" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-400">
            <button type="submit"
                    class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Kirim Link Reset
            </button>
        </form>
        <div class="text-center mt-4">
            <a href="../../login.php" class="text-blue-600 hover:underline">Kembali ke Login</a>
        </div>
    </div>
</body>
</html>
