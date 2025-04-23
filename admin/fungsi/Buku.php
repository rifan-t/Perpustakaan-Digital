<?php

class Buku {
        private $conn;
    
        public function __construct($db) {
            $this->conn = $db;
        }
    
        public function getBuku() {
            $query = "SELECT buku.*, kategori.nama_kategori 
                      FROM buku 
                      JOIN kategori ON buku.kategori_id = kategori.kategoriId"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    
        public function tambahBuku($judul, $penulis, $penerbit, $gambar_buku, $kategori, $ebook,$tahun) {
            $query = "INSERT INTO buku (judul_buku, penulis, penerbit, gambar_buku, kategori_id, ebook,tahun_terbit) 
                      VALUES (:judul, :penulis, :penerbit, :gambar_buku, :kategori, :ebook,:tahun)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':judul', $judul);
            $stmt->bindParam(':penulis', $penulis);
            $stmt->bindParam(':penerbit', $penerbit);
            $stmt->bindParam(':gambar_buku', $gambar_buku);
            $stmt->bindParam(':kategori', $kategori);
            $stmt->bindParam(':ebook', $ebook);
            $stmt->bindParam(':tahun', $tahun);
            return $stmt->execute();
        }
    
        public function editBuku($id, $judul, $penulis, $penerbit, $gambar_buku_name, $kategori, $ebook,$tahun) {
            $query = "UPDATE buku SET 
                      judul_buku = :judul, 
                      penulis = :penulis, 
                      penerbit = :penerbit, 
                      gambar_buku = :gambar_buku, 
                      kategori_id = :kategori, 
                      ebook = :ebook, 
                      tahun_terbit = :tahun 
                      WHERE bukuId = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':judul', $judul);
            $stmt->bindParam(':penulis', $penulis);
            $stmt->bindParam(':penerbit', $penerbit);
            $stmt->bindParam(':gambar_buku', $gambar_buku_name);
            $stmt->bindParam(':kategori', $kategori);
            $stmt->bindParam(':ebook', $ebook);
            $stmt->bindParam(':tahun', $tahun);
            return $stmt->execute();
        }
    
        public function hapusBuku($id) {
            $query = "SELECT gambar_buku FROM buku WHERE bukuId = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $file_path = 'gambar_buku/' . $result['gambar_buku'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                $query = "DELETE FROM buku WHERE bukuId = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $id);
                return $stmt->execute();
            } else {
                return false; 

            }

        
        }
    
        public function getBukuById($id) {
            $query = "SELECT * FROM buku WHERE bukuId = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        
        }
    
}




class Kategori {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function tambahKategori($nama_kategori) {
        $sql = "INSERT INTO kategori (nama_kategori) VALUES (:nama_kategori)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nama_kategori", $nama_kategori, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getKategori() {
        $sql = "SELECT * FROM kategori";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getKategoriById($id) {
        $query = "SELECT nama_kategori FROM kategori WHERE kategoriId = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['nama_kategori'] : 'Kategori Tidak Ditemukan';
    }
    
    public function editKategori($kategoriId, $nama_kategori) {
        $sql = "UPDATE kategori SET nama_kategori=:nama_kategori WHERE kategoriId=:kategoriId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nama_kategori", $nama_kategori, PDO::PARAM_STR);
        $stmt->bindParam(":kategoriId", $kategoriId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    

    public function hapusKategori($id) {
        $sql = "DELETE FROM kategori WHERE kategoriId=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
