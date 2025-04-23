
    <main class="container py-2">
    <h3 class="display-6 fw-bold">Kategori</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
            <?php
            $home = new Home($conn);
            $kategori = $home->getKategori();
            foreach ($kategori as $row) {
            ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['nama_kategori'] ?></h5>
                            <a href="?page=kategoribyid&id=<?= $row['kategoriId']?>" class="btn btn-primary">Lihat Buku dari Kategori</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        
       
    </main>

