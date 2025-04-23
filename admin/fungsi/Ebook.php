<?php
class Ebook{
    public $conn;
    public function __construct($db) {
        $this->conn = $db;
    }
    public function uploadEbook($nama_buku, $file_path) {

        $query = "INSERT INTO ebooks (nama_buku, file_path) VALUES (:nama, :file_path)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama', $nama_buku);
        $stmt->bindParam(':file_path', $file_path);
        return $stmt->execute();
    }
    public function getEbook() {
        $query = "SELECT * FROM ebooks";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getEbookById($id) {
        $query = "SELECT * FROM ebooks WHERE ebookId = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }


    public function delete($id) {
        $stmt = $this->conn->prepare("SELECT file_path FROM ebooks WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            $file_path = $result['file_path'];
    
            if (file_exists('../' . $file_path)) {
                unlink('../' . $file_path); // Hapus file dari folder
            }
    
            $deleteStmt = $this->conn->prepare("DELETE FROM ebooks WHERE id = ?");
            $deleteStmt->execute([$id]);
    
            return true;
        }
    
        return false;
    }
    
    }
?>