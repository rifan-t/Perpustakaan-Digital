<?php
class Auth
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login_user($email, $password)
    {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['userId'];
            $_SESSION['data'] = $user;


            if ($user['role_id'] == 1 || $user['role_id'] == 2) {
                echo "<script>alert('Berhasil Login'); location.href= 'admin/index.php';</script>";
            } else {
                echo "<script>alert('Berhasil Login'); location.href=' index.php';</script>";
            }
        } else {
            echo "<script>alert('Email Atau Password Salah');</script>";
        }
    }

    public function registrasi($username, $password, $confirm_password,  $email, $alamat, $role_id)
    {
            if ($password != $confirm_password) {
                echo "<div class='container'><div class='error'>Password dan konfirmasi password tidak sama. Silakan coba lagi.</div></div>";
                exit();
            } else {
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch();
                if ($user) {
                    echo "<div class='container'><div class='error'>Email sudah terdaftar. Silakan coba lagi.</div></div>";
                    exit();
                } else {
                    $stmt = $this->conn->prepare("INSERT INTO users (username, password, email, alamat, role_id) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), $email, $alamat, $role_id]);
                    echo "<script>alert('Berhasil Register'); location.href='login.php';</script>";
                }
            }
    


    }
    public function checkEmailExists($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }
    
    public function resetPassword($email, $newPassword) {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        return $stmt->execute([$hash, $email]);
    }
    
}