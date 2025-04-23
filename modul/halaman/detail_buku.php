<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$book_id = $_GET['id'];
$book = new Home($conn);
$detail_buku = $book->getDetailBuku($book_id);
$nama_kate = $book->getKategoriById($detail_buku['kategori_id']);
if (!$detail_buku) {
    header('Location: index.php');
    exit();
}

$related_books = $book->getRelatedBooks($book_id);

$ulasan = $book->getUlasan($book_id);

if (isset($_POST['tambah_ulasan'])) {
    $userId = $data['userId']; 
    $rating = $_POST['rating'];
    $ulasanText = $_POST['ulasan'];
    
    $book->tambahUlasan($userId, $book_id, $ulasanText, $rating);
    echo "<script>alert('Tunggu Ulasan Anda Di Approvw!'); window.location.href='?page=detail_buku&id=$book_id';</script>";
    exit;
}

if (isset($_POST['tambah_koleksi'])) {
    $userId = $data['userId']; 
    $bukuId = $_POST['buku_id'];

    $book->tambahWishlist($userId, $bukuId);

    echo "<script>alert('berhasil Masukkan ke koleksi!'); window.location.href='?page=detail_buku&id=$book_id';</script>";
    exit;
}

?>
    <style>
        .card {
            transition: transform 0.3s;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        .related-book-img {
            height: 180px;
            object-fit: cover;
        }
        .btn-action {
            transition: all 0.3s;
        }
        .btn-action:hover {
            transform: scale(1.05);
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: #0d6efd !important;
        }
        .book-cover {
            max-height: 400px;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .breadcrumb-item a {
            text-decoration: none;
        }
        .book-info {
            border-left: 4px solid #0d6efd;
            padding-left: 15px;
        }
        .book-description {
            line-height: 1.8;
            text-align: justify;
        }
        .rating {
            color: #ffc107;
        }
        .availability-badge {
            font-size: 1rem;
        }
        .tab-content {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-top: none;
            border-radius: 0 0 10px 10px;
        }
        .nav-tabs .nav-link {
            border-radius: 10px 10px 0 0;
        }
        .nav-tabs .nav-link.active {
            font-weight: bold;
            color: #0d6efd;
        }
        footer {
            border-top: 1px solid #dee2e6;
        }
    </style>

<body>
    
    <?php 
        if (isset($_GET['wishlist_success'])) {
            echo "<div class='alert alert-success'>Buku berhasil ditambahkan ke Koleksi!</div>";
        }
        
        ?>
    <main class="container py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?page=home"><i class="fas fa-home"></i> Home</a></li>
                <?php if(isset($detail_buku['kategori'])): ?>
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-tag"></i> <?php echo ($detail_buku['kategori']); ?></a></li>
                <?php endif; ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo ($detail_buku['judul_buku']); ?></li>
            </ol>
        </nav>

        <div class="card mb-5 border-0 shadow">
            <div class="card-body p-4">
                <div class="row">
                    <!-- Gambar Buku -->
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <img src="admin/gambar_buku/<?php echo ($detail_buku['gambar_buku']); ?>" class="book-cover img-fluid mb-3" alt="<?php echo ($detail_buku['judul_buku']); ?>">
                        
                        <div class="d-flex justify-content-center rating mb-3">
                            <?php
                            $averageRating = $book->getAverageRating($book_id); // Assuming this method exists
                            $fullStars = floor($averageRating);
                            $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                            $emptyStars = 5 - $fullStars - $halfStar;

                            for ($i = 0; $i < $fullStars; $i++) {
                                echo '<i class="fas fa-star"></i>';
                            }
                            if ($halfStar) {
                                echo '<i class="fas fa-star-half-alt"></i>';
                            }
                            for ($i = 0; $i < $emptyStars; $i++) {
                                echo '<i class="far fa-star"></i>';
                            }
                            ?>
                            <span class="ms-2 text-dark"><?php echo number_format($averageRating, 1); ?>/5</span>
                        </div>
                        <?php if ($detail_buku['ebook'] == 0): ?>
                            <div class="availability mt-2 mb-4">
                                <span class="badge bg-danger fs-6 availability-badge">
                                    <i class="fas fa-times-circle me-1"></i> Belum Tersedia
                                </span>
                            </div>
                        <?php else: ?>
                        <div class="availability mt-2 mb-4">
                            <span class="badge bg-success fs-6 availability-badge">
                                <i class="fas fa-check-circle me-1"></i> Tersedia
                            </span>
                           
                        </div>
                        <?php endif; ?>
                        
                        <div class="d-grid gap-2">
                        <?php if ($detail_buku['ebook'] == 0): ?>
                                    <button class="btn btn-danger btn-action" disabled>
                                        <i class="fas fa-book-reader me-1"></i>Belum Bisa Dipinjam
                                    </button>
                                    <?php else: ?>
                                        <a onclick="document.getElementById('myForm').submit(); return false;" href="" class="btn btn-primary btn-action">
                                    <i class="fas fa-book-reader me-1"></i> Pinjam Buku
                                </a>
                                <?php endif; ?>
                            <form id="myForm" action="?page=pinjam_buku" method="POST">
                                    <input type="hidden" name="bukuId" value="<?php echo $book_id ?>">
                                    <input type="hidden" name="userId" value="<?php echo $data['userId']; ?>">
                                    
                                </form>
                            <form method="post">
                            <input type="hidden" name="buku_id" value="<?= $book_id; ?>">
                                <button name="tambah_koleksi" class="btn btn-outline-primary btn-action">
                                    <i class="far fa-bookmark me-1"></i> Simpan ke Koleksi
                                </button>

                            </form>
                        </div>
                    </div>
                    
                    <!-- Informasi Buku -->
                    <div class="col-md-8">
                        <h1 class="mb-3"><?php echo ($detail_buku['judul_buku']); ?></h1>
                        
                        <div class="book-info mb-4">
                            <div class="row mb-2">
                                <div class="col-md-3 fw-bold text-muted">Penulis</div>
                                <div class="col-md-9"><?php echo ($detail_buku['penulis']); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 fw-bold text-muted">Penerbit</div>
                                <div class="col-md-9"><?php echo ($detail_buku['penerbit']); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 fw-bold text-muted">Tahun Terbit</div>
                                <div class="col-md-9"><?php echo ($detail_buku['tahun_terbit']); ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 fw-bold text-muted">Kategori</div>
                                <div class="col-md-9">
                                <td> <?php echo $nama_kate ?></td>

                                </div>
                            </div>
                        </div>
                        
                        <!-- Tab Content -->
                        <ul class="nav nav-tabs" id="bookDetailsTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">
                                <i class="fas fa-comment me-1"></i> Ulasan 
                                </button>
                            </li>
                            
                          
                        </ul>
                        <div class="tab-content" id="bookDetailsTabContent">
        <div class="tab-pane fade show active book-description" id="description">
        <?php if (!empty($ulasan)) : ?>
            <?php foreach ($ulasan as $u) : ?>
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <img src="https://ui-avatars.com/api/?name=<?= $u['username'] ?>&background=0D6EFD&color=fff&size=120" width="40" class="rounded-circle" alt="User avatar">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1"><?php echo ($u['username']); ?></h5>
                        </div>
                        <div class="rating mb-2">
                            <?php for ($i = 1; $i <= 5; $i++) {
                                echo $i <= $u['rating'] ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                            } ?>
                        </div>
                        <p><?php echo ($u['ulasan']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php else : ?>
            <p>Belum ada ulasan untuk buku ini</p>
            <?php endif; ?>
            <hr>
            <h5>Tambahkan Ulasan Anda</h5>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <select name="rating" class="form-control">
                        <option value="5">★★★★★</option>
                        <option value="4">★★★★☆</option>
                        <option value="3">★★★☆☆</option>
                        <option value="2">★★☆☆☆</option>
                        <option value="1">★☆☆☆☆</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="reviewText" class="form-label">Ulasan</label>
                    <textarea class="form-control" name="ulasan" id="reviewText" rows="3" placeholder="Bagikan pendapat Anda..."></textarea>
                </div>
                <button type="submit" name="tambah_ulasan" class="btn btn-primary">Kirim Ulasan</button>
            </form>
        </div>
    </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Buku Terkait -->
        <section class="mt-5">
            <h3 class="mb-4"><i class="fas fa-bookmark me-2"></i>Buku Terkait</h3>
            <div class="row">
                <?php if ($related_books && count($related_books) > 0): ?>
                    <?php foreach ($related_books as $related): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <img src="admin/gambar_buku/<?php echo ($related['gambar_buku']); ?>" class="card-img-top related-book-img" alt="<?php echo ($related['judul_buku']); ?>">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 1rem;"><?php echo ($related['judul_buku']); ?></h5>
                                <p class="card-text mb-1"><small class="text-muted"><?php echo ($related['penulis']); ?></small></p>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="?page=detail_buku&id=<?php echo $related['bukuId']; ?>" class="btn btn-outline-primary btn-sm d-block">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h4 class="text-center">Buku dari penulis yang sama tidak ada</h4>
                <?php endif; ?>
            </div>
        </section>
    </main>
    
