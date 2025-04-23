<?php 

$book = new Peminjaman($conn);
$buku = $book->getRiwayatPeminjaman($userId);
?>

<div class="container mt-5">
    <h2 class="mb-4">Buku Saya</h2>
    <?php if (empty($buku)): ?>
        <div class="alert alert-warning">Anda Belum Pinjam buku.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($buku as $item): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="admin/gambar_buku/<?= $item['gambar_buku']; ?>" class="card-img-top" alt="Cover Buku">
                        <div class="card-body">     
                            <h5 class="card-title"><?= $item['judul_buku']; ?></h5>
                            <p class="card-text">Penulis: <?= $item['penulis']; ?></p>
                                    <a href="?page=detail_buku&id=<?= $item['bukuId']; ?>" class="btn btn-primary">Lihat Detail</a>
                                <a href="modul/halaman/baca_buku.php?id=<?= $item['bukuId']; ?>" class="btn btn-primary"><i class="fas fa-book-open mx-2"></i>Baca</a>
                                </div>
                            
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
        </div>
    <?php endif; ?>
</div>
