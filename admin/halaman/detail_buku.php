<?php

$bukus = new Buku($conn);
$kategori = new Kategori($conn);

$buku = $bukus->getBukuById($_GET['detail_id']);
$data_kategori = $kategori->getKategoriById($buku['kategori_id']);
?>
<div class="container mt-5">

    <div class="card-header">
        <h3 class="mb-0">Detail Buku</h3>
    </div>

    <div class="mt-5 p-4">
    <img width="100" src="gambar_buku/<?= $buku['gambar_buku']?>" alt="">
    <h4>Judul Buku: <?= $buku['judul_buku']?></h4>
        <h4>Penulis Buku: <?= $buku['penulis']?></h4>
        <h4>Penerbit Buku: <?= $buku['penerbit']?></h4>
        <h4>Kategori Buku: <?= $data_kategori
                       ?></h4>
        <h4>Tahun Terbit Buku: <?= $buku['judul_buku']?></h4>
    </div>
    <a href="?page=data_buku" class="btn btn-secondary me-2">Kembali</a>

</div>