<?php 
$home = new Home($conn);
$wishlist = $home->getWishlist( $userId);

?>
<div class="container mt-5">
    <h2 class="mb-4">Koleksi Saya</h2>
    <?php if (empty($wishlist)): ?>
        <div class="alert alert-warning">Wishlist Anda masih kosong.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($wishlist as $item): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="admin/gambar_buku/<?= $item['gambar_buku']; ?>" class="card-img-top" alt="Cover Buku">
                        <div class="card-body">     
                            <h5 class="card-title"><?= $item['judul_buku']; ?></h5>
                            <p class="card-text">Penulis: <?= $item['penulis']; ?></p>
                            <p class="card-text">Kategori: <?= $item['nama_kategori']; ?></p>
                            <div class="row">
                                <div class="col-md-8 mt-2">
                                    <a href="?page=detail_buku&id=<?= $item['bukuId']; ?>" class="btn btn-primary">Lihat Detail</a>
                                </div>
                                <div class="col-md-4 float-right">
                                <form method="POST" class="mt-2">
                                <input type="hidden" name="buku_id" value="<?= $item['bukuId']; ?>">
                                <button type="submit" name="hapus_wishlist" class="btn btn-danger">Hapus</button>
                            </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus_wishlist'])) {
    $book = new Home($conn);
    $bukuId = $_POST['buku_id'];
    $book->hapusWishlist($userId, $bukuId);
    echo "<script>alert('Buku berhasil dihapus dari wishlist.')</script>";
    echo "<script>window.location.href='?page=koleksi&removed=1'</script>";
    exit;
}
?>
