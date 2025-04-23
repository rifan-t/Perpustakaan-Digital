    
<?php 
$home = new Home($conn);
$books = $home->getBuku();
                           
?>
    <main class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0"><i class="fas fa-book me-2"></i>Daftar Buku</h2>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach ($books as $book):
                $book_id = $book['bukuId'];
                $averageRating = $home->getAverageRating($book_id); // Assuming this method exists
                $fullStars = floor($averageRating);
                $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                $emptyStars = 5 - $fullStars - $halfStar;

             ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="position-relative">
                            <img src="admin/gambar_buku/<?php echo ($book['gambar_buku']); ?>" class="card-img-top"
                                alt="<?php echo ($book['judul_buku']); ?>">
                            <span class="position-absolute top-0 end-0 badge bg-primary m-2">
                                <i class="fas fa-star me-1"></i><?php echo number_format($averageRating, 1); ?>/5
                            </span>
                            
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo ($book['judul_buku']); ?></h5>
                            <p class="card-text text-muted mb-1"><i class="fas fa-user me-1"></i>
                                <?php echo ($book['penulis']); ?></p>
                            <p class="card-text text-muted mb-1"><i class="fas fa-building me-1"></i>
                                <?php echo ($book['penerbit']); ?></p>
                            <p class="card-text text-muted mb-3"><i class="fas fa-calendar-alt me-1"></i>
                                <?php echo ($book['tahun_terbit']); ?></p>

                            <div class="mt-3">
                                <span class="badge bg-info text-dark mb-2">Pinjam Sekarang!</span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0 pt-0">
                            <div class="d-grid gap-2">
                                <a href="?page=detail_buku&id=<?php echo $book['bukuId']; ?>"
                                    class="btn btn-outline-primary btn-action">
                                    <i class="fas fa-eye me-1"></i> Lihat Detail
                                </a>

                                <?php if ($book['ebook'] == 0): ?>
                                    <button class="btn btn-danger btn-action" disabled>
                                        <i class="fas fa-book-reader me-1"></i>Belum Bisa Dipinjam
                                    </button>
                                <?php else: ?>
                                    <a onclick="document.getElementById('form_<?php echo $book['bukuId']; ?>').submit(); return false;" href="#" class="btn btn-primary btn-action">
                                        <i class="fas fa-book me-1"></i> Pinjam Buku
                                    </a>
                                <?php endif; ?>
                                <form id="form_<?php echo $book['bukuId']; ?>" action="?page=pinjam_buku"
                                    method="POST">
                                    <input type="hidden" name="bukuId" value="<?php echo $book['bukuId']; ?>">
                                    <input type="hidden" name="userId" value="<?php echo $data['userId']; ?>">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


    </main>
