<?php
class Peminjaman {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function tambahPeminjaman($userId, $bukuId) {
        if (empty($userId) || empty($bukuId)) {
            echo "<script>alert('Silahkan Login terlebih dahulu'); window.location.href='?page=home';</script>";
            return;
        }
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM peminjaman WHERE userId = ? AND bukuId = ? AND status_peminjaman = 'Dipinjam'");
        $stmt->execute([$userId, $bukuId]);
    
        if ($stmt->fetchColumn() > 0) {
            echo "<script>alert('Buku Sudah Dipinjam'); window.location.href='?page=riwayat_peminjaman';</script>";
            return; 
        } 
        
        if ($this->cekPinjaman($userId) >= 3) {
            echo "<script>alert('Anda sudah meminjam 3 buku'); window.location.href='?page=riwayat_peminjaman';</script>";
            return;
        }
    
        $sql = $this->conn->prepare("INSERT INTO peminjaman (userId, bukuId, tanggal_pengembalian, status_peminjaman, total_denda) VALUES (?, ?, ?, 'Dipinjam', 0)");
        $sql->execute([$userId, $bukuId, date('Y-m-d', strtotime("+7 days"))]);
    
        echo "<script>alert('Buku Berhasil Dipinjam'); window.location.href='?page=riwayat_peminjaman';</script>";
    }
    

    public function cekPinjaman($userId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM peminjaman WHERE userId = ? AND status_peminjaman = 'Dipinjam'");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    
    public function updateDenda() {
        $sql = "UPDATE peminjaman 
                SET total_denda = 
                    CASE 
                        WHEN NOW() > tanggal_pengembalian THEN DATEDIFF(NOW(), tanggal_pengembalian) * 1000 
                        ELSE 0 
                    END 
                    
                WHERE status_peminjaman = 'Dipinjam'";

        $this->conn->prepare($sql)->execute();
    }

    public function dendaPinjaman($userId) {
        $this->updateDenda(); 

        $sql = "SELECT p.*, b.judul_buku, b.penulis
                FROM peminjaman p
                JOIN buku b ON p.bukuId = b.bukuId
                WHERE p.userId = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   public function getRiwayatPeminjaman($userId) {
    $sql = "SELECT p.*, b.judul_buku, b.penulis, b.gambar_buku
    FROM peminjaman p
    JOIN buku b ON p.bukuId = b.bukuId
    WHERE p.userId = ? AND status_peminjaman = 'Dipinjam'";

$stmt = $this->conn->prepare($sql);
$stmt->execute([$userId]);

return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    public function kembalikanBuku($peminjamanId){
        $stmt = $this->conn->prepare("UPDATE peminjaman SET status_peminjaman = 'Dikembalikan', tanggal_kembali = current_timestamp WHERE peminjamanId = ?");
        return $stmt->execute([$peminjamanId]);
        
    }
    public function getDetailBuku($bukuId) {
        $stmt = $this->conn->prepare("SELECT * FROM buku WHERE bukuId = ?");
        $stmt->execute([$bukuId]);
        return $stmt->fetch();
    }

    public function getDetailUser($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE userId = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }
    public function getDetailPeminjaman() {
        $sql = "SELECT p.*, b.judul_buku, u.username 
                FROM peminjaman p
                JOIN buku b ON p.bukuId = b.bukuId
                JOIN users u ON p.userId = u.userId";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function bayarDenda($peminjamanId) {
        $stmt = $this->conn->prepare("UPDATE peminjaman SET total_denda = 0, status_pembayaran = 'Lunas' WHERE peminjamanId = ?");
        return $stmt->execute([$peminjamanId]);
    }
}
?>
