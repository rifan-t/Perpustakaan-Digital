<?php
require_once '../../lib/koneksi.php';
require_once '../../modul/fungsi/Auth.php';

$email = $_GET['email'] ?? null;
if (!$email) {
    header("Location: forgot_password.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password === $confirm) {
        $auth = new Auth($conn);
        $auth->resetPassword($email, $password);
        header("Location: ../../login.php?reset=success");
        exit;
    } else {
        $error = "Password tidak sama.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Reset Password</h2>
        <?php if (!empty($error)): ?>
            <p class="text-red-500 text-center mb-4"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST">
            <label class="block mb-2 text-gray-700">Password Baru</label>
            <input type="password" name="password" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-400">

            <label class="block mb-2 text-gray-700 mt-4">Ulangi Password</label>
            <input type="password" name="confirm" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-400">

            <button type="submit"
                    class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Simpan Password
            </button>
        </form>
    </div>
</body>
</html>
