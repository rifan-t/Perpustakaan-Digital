<?php

$home = new Home($conn);

$kategoriId = isset($_GET['id']) ? $_GET['id'] : 0;
$kategori = $home->getKategoriById($kategoriId);
$bukuList = $home->getBukuByKategori($kategoriId);

if (!$kategori) {
    die("Kategori tidak ditemukan!");
}
?>

   
<div class="container mt-5">
    <h2 class="fw-bold">Kategori: <?= $kategori ?></h2>
    <a  class="btn btn-outline-dark btn-action mt-5 mb-5" href="?page=kategori">Kembali</a>
    
    <?php if (empty($bukuList)): ?>
        <div class="alert alert-warning">Belum ada buku di kategori ini.</div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
            <?php foreach ($bukuList as $buku): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="admin/gambar_buku/<?= $buku['gambar_buku'] ?>" class="card-img-top" alt="Cover Buku">
                        <div class="card-body">
                            <h5 class="card-title"><?= $buku['judul_buku'] ?></h5>
                            <p class="card-text">Penulis: <?= $buku['penulis'] ?></p>
                            <a href="?page=detail_buku&id=<?= $buku['bukuId'] ?>" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
   