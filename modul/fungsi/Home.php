<?php 
class Home{
    private $conn;
    public function __construct($db){
        $this->conn = $db;
    }
    public function getKategoriById($id) {
        $query = "SELECT nama_kategori FROM kategori WHERE kategoriId = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['nama_kategori'] : 'Kategori Tidak Ditemukan';
    }
    public function getKategori() {
        $sql = "SELECT * FROM kategori";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBukuByKategori($kategoriId) {
        $stmt = $this->conn->prepare("SELECT * FROM buku WHERE kategori_id = ?");
        $stmt->execute([$kategoriId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBuku() {
        $query = "SELECT buku.*, kategori.nama_kategori 
                  FROM buku 
                  JOIN kategori ON buku.kategori_id = kategori.kategoriId"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDetailBuku($id){
        $query = "SELECT buku.*, kategori.nama_kategori 
                  FROM buku 
                  JOIN kategori ON buku.kategori_id = kategori.kategoriId
                  WHERE buku.bukuId = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getRelatedBooks($book_id) {
        $query = "SELECT penulis FROM buku WHERE bukuId = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $book_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $penulis = $stmt->fetchColumn();
        if (!$penulis) {
            return [];
        }
        $query = "SELECT * FROM buku 
                  WHERE penulis = :penulis 
                  AND bukuId != :id 
                  LIMIT 4";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':penulis', $penulis, PDO::PARAM_STR);
        $stmt->bindParam(':id', $book_id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        // Mengembalikan hasil
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUlasan($book_id) {
        $stmt = $this->conn->prepare("SELECT u.*, users.username FROM ulasanbuku u JOIN users ON u.userId = users.userId WHERE u.bukuId = ? AND status= 'disetujui' ORDER BY u.ulasanId DESC");
        $stmt->execute([$book_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
public function tambahUlasan($userId, $book_id, $ulasanText, $rating) {
    if ($userId=='-' || empty($book_id)) {
        echo "<script>alert('Silahkan Login terlebih dahulu'); window.location.href='?page=home';</scr  ipt>";
        return;
    }
    if (empty($ulasanText) || empty($rating)) {
        return false; 
    }
    

    $stmt = $this->conn->prepare("INSERT INTO ulasanbuku (userId, bukuId, ulasan, rating, status) VALUES (?, ?, ?, ?, 'menunggu')");
    return $stmt->execute([$userId, $book_id, $ulasanText, $rating]);
}

public function getAverageRating($book_id) {
    $query = "SELECT AVG(rating) as average_rating FROM ulasanbuku WHERE bukuId = ? AND status = 'disetujui'";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$book_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['average_rating'] ?? 0;
}
public function tambahWishlist($userId, $bukuId) {
    $cek = $this->conn->prepare("SELECT * FROM koleksipribadi WHERE userId = ? AND bukuId = ?");
    $cek->execute([$userId, $bukuId]);

    if ($cek->rowCount() == 0) {
        $stmt = $this->conn->prepare("INSERT INTO koleksipribadi (userId, bukuId) VALUES (?, ?)");
        return $stmt->execute([$userId, $bukuId]);
    } else {
        return false; 
    }
}

public function getWishlist($userId) {
    $query = "SELECT buku.*, kategori.nama_kategori 
              FROM koleksipribadi
              JOIN buku ON koleksipribadi.bukuId = buku.bukuId
              JOIN kategori ON buku.kategori_id = kategori.kategoriId
              WHERE koleksipribadi.userId = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function hapusWishlist($userId, $bukuId) {
    $stmt = $this->conn->prepare("DELETE FROM koleksipribadi WHERE userId = ? AND bukuId = ?");
    return $stmt->execute([$userId, $bukuId]);
}


public function getEbookById($id) {
    $query = "SELECT * FROM ebooks WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC); 
}

}
?>