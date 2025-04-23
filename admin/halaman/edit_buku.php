<?php

$buku = new Buku($conn);
$bukuid=  $buku->getBukuById($_GET['id']);
if (isset($_POST['edit'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $kategori = $_POST['kategori'];
    $ebook = $_POST['ebook'];
    $tahun_terbit = $_POST['tahun_terbit'];

    $buku_lama = $buku->getBukuById($_POST['id']);

    if (isset($_FILES['edit_gambar_buku']) && $_FILES['edit_gambar_buku']['name']) {
        if (!empty($buku_lama['gambar_buku']) && file_exists("gambar_buku/" . $buku_lama['gambar_buku'])) {
            unlink("gambar_buku/" . $buku_lama['gambar_buku']);
        }

        $gambar_buku_name = basename($_FILES["edit_gambar_buku"]["name"]);
        $target_file = "gambar_buku/" . $gambar_buku_name;
        move_uploaded_file($_FILES["edit_gambar_buku"]["tmp_name"], $target_file);
    } else {
        $gambar_buku_name = $buku_lama['gambar_buku']; 
    }

    $buku->editBuku($_POST['id'], $judul, $penulis, $penerbit, $gambar_buku_name, $kategori,$ebook, $tahun_terbit);

    echo "<script>location.href='?page=data_buku';</script>";
exit;

}

?>

<div class="container mt-4">
    <h3>Edit Data Buku</h3>
    <form id="editBookForm" method="post" enctype="multipart/form-data">
        <input type="hidden" id="edit_id" name="id" value="<?= $bukuid['bukuId']; ?>">

        <div class="mb-3">
            <label for="edit_judul" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="edit_judul" name="judul" value="<?= $bukuid['judul_buku']; ?>"
                required>
        </div>

        <div class="mb-3">
            <label for="edit_penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="edit_penulis" name="penulis" value="<?= $bukuid['penulis']; ?>"
                required>
        </div>

        <div class="mb-3">
            <label for="edit_penerbit" class="form-label">Penerbit</label>
            <input type="text" class="form-control" id="edit_penerbit" name="penerbit" value="<?= $bukuid['penerbit']; ?>"
                required>
        </div>

        <div class="mb-3">
            <label for="edit_kategori" class="form-label">Kategori</label>
            <select class="form-select" id="edit_kategori" name="kategori" required>
                <option value="">Pilih Kategori</option>
                <?php
                $kategori = new Kategori($conn);
                $data_kategori = $kategori->getKategori();

                foreach ($data_kategori as $k) {
                    $selected = ($k['kategoriId'] == $bukuid['kategori_id']) ? 'selected' : '';
                    echo '<option value="' . $k['kategoriId'] . '" ' . $selected . '>' . $k['nama_kategori'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="edit_ebook" class="form-label">ebook</label>
            <select class="form-select" id="edit_ebook" name="ebook" required>
                <option value="">Ebook Belum Tersedia</option>
                <?php
                $ebook = new ebook($conn);
                $data_ebook = $ebook->getEbook();

                foreach ($data_ebook as $eb) {
                    $selected = ($eb['id'] == $bukuid['e-book']) ? 'selected' : '';
                    echo '<option value="' . $eb['id'] . '" ' . $selected . '>' . $eb['nama_buku'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="edit_tahun_terbit" class="form-label">Tahun Terbit</label>
            <input type="date" class="form-control" id="edit_tahun_terbit" name="tahun_terbit" 
             min="1900-01-01" max="2025-12-31" 
             value="<?= date('Y-m-d', strtotime($bukuid['tahun_terbit'])); ?>" required>

        </div>

        <div class="mb-3">
            <label for="edit_gambar_buku" class="form-label">Ganti Cover Buku</label>
            <input type="file" class="form-control" id="edit_gambar_buku" name="edit_gambar_buku" accept="image/*">
        </div>

        <div class="d-flex justify-content-end">
            <a href="?page=data_buku" class="btn btn-secondary me-2">Batal</a>
            <button type="submit" name="edit" class="btn btn-info">Update</button>
        </div>
    </form>
</div>
