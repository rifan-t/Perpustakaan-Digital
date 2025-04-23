<?php
$ebook = new Ebook($conn);
$ebooks = $ebook->getEbook();
$target_dir = "assets/ebook/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if (isset($_POST['upload'])) {
    $file = $_FILES['pdf_file'];
    $nama_buku = $_POST['nama_buku'];
    $file_name = $file['name'];
    $target_file = $target_dir . $file_name;

    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (empty($nama_buku)) {
        die("Hanya file PDF yang diizinkan.");
    }

    if (move_uploaded_file($file['tmp_name'], '../'. $target_file)) {
        echo "File berhasil diunggah.";

        if ($ebook->uploadEbook($nama_buku, $target_file)) {
            echo "<script>alert('Buku berhasil ditambahkan!'); window.location.href='?page=data_ebook';</script>";
        } else {
            echo "<script>alert('Buku gagal ditambahkan!'); window.location.href='?page=data_ebook';</script>";
        }

    } else {
        echo "Gagal mengunggah file.";
    }
}

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($ebook->delete($id)) {
        echo "<script>alert('E-book berhasil dihapus!'); window.location.href='?page=data_ebook';</script>";
    } else {
        echo "<script>alert('E-book gagal dihapus!'); window.location.href='?page=data_ebook';</script>";
    }
}

?>

<div class="container mt-5">
    <div class="card-header text-dark">
        <h3 class="mb-0">Daftar E-book</h3>
    </div>

    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalId">
        Tambah e-book
    </button>

    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="modalTitleId">Tambah e-book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="buku" class="form-label">Nama buku</label>
                            <input type="text" class="form-control" id="nama_buku" name="nama_buku" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="file" name="pdf_file" accept="application/pdf" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mt-3" name="upload">Upload</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table id="tabel-buku" class="table table-striped table-bordered mt-3" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Buku</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ebooks as $ebook): ?>
                <tr>
                    <td><?php echo $ebook['id']; ?></td>
                    <td><?php echo $ebook['nama_buku']; ?></td>
                    <td><a href="<?php echo $ebook['file_path']; ?>" target="_blank">Lihat File</a></td>
                    <td>

                        <button type="button" class="btn btn-sm btn-danger"
                            onclick="deleteBook(<?= $ebook['id'] ?>)">Hapus </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
</div>

<script>
    function deleteBook(id) {
        if (confirm("Apakah Anda yakin ingin menghapus ebook ini?")) {
            window.location.href = "?page=data_ebook&delete=" + id;
        }
    }
</script>