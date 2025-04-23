<?php 
class Peminjaman{

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function data_peminjaman() {

        $sql = "SELECT p.*, b.judul_buku, u.username 
                FROM peminjaman p
                JOIN buku b ON p.bukuId = b.bukuId
                JOIN users u ON p.userId = u.userId";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function kembalikanBuku($peminjamanId) {
        $stmt = $this->conn->prepare("UPDATE peminjaman SET status_peminjaman = 'Dikembalikan', tanggal_kembali = current_timestamp WHERE peminjamanId = ?");
        return $stmt->execute([$peminjamanId]);
    }
}

?>