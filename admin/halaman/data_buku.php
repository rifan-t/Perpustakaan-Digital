<?php

$buku = new Buku($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $kategori = $_POST['kategori'];
    $ebook = $_POST['ebook'];
    $tahun_terbit = $_POST['tahun_terbit'];

    $target_dir = "gambar_buku/";
    $gambar_buku = basename($_FILES["gambar_buku"]["name"]);
    $target_file = $target_dir . $gambar_buku;
    move_uploaded_file($_FILES["gambar_buku"]["tmp_name"], $target_file);

    if ($buku->tambahBuku($judul, $penulis, $penerbit, $gambar_buku ,$kategori, $ebook,$tahun_terbit)) {
        echo "<script>alert('Buku berhasil ditambahkan!'); window.location.href='?page=data_buku';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan buku!'); window.history.back();</script>";
    }
}
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($buku->hapusBuku($id)) {
        echo "<script>alert('buku berhasil dihapus!'); window.location.href='?page=data_buku';</script>";
    } else {
        echo "<script>alert('buku gagal dihapus!'); window.location.href='?page=data_buku';</script>";
    }
}

?>
<div class="container mt-5">
    <div class="card-header text-dark">
        <h3 class="mb-0">Daftar Buku</h3>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBookModal">
                <i class="bi bi-plus-circle"></i> Tambah Buku
            </button>
        </div>

        <table id="tabel-buku" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cover Buku</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Kategori</th>
                    <th>E-book</th>
                    <th>Tahun Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $books = $buku->getBuku();

                foreach ($books as $index => $book) {
                    echo '<tr>';
                    echo '<td>' . ($index + 1) . '</td>';
                    echo '<td><img width="100" src="gambar_buku/' . $book['gambar_buku'] .'">  </td>';
                    echo '<td>' . $book['judul_buku'] . '</td>';
                    echo '<td>' . $book['penulis'] . '</td>';
                    echo '<td>' . $book['penerbit'] . '</td>';
                    echo '<td>' . $book['nama_kategori'] . '</td>';
                    echo '<td>' . ($book['ebook'] == 0 ? 'tidak tersedia' : 'tersedia') . '</td>';
                    echo '<td>' . date('D-M-Y', strtotime($book['tahun_terbit'])) . '</td>';
                    echo '<td>
                                    <div class="btn-group" role="group">
                                        <a href="?page=edit_buku&id=' . $book['bukuId'] . '" class="btn btn-sm btn-info">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteBook(' . $book['bukuId'] . ')">Hapus </button>
                                        <a href="?page=detail_buku&detail_id=' . $book['bukuId'] . '" class="btn btn-sm btn-secondary">Detail</a>
                                    </div>
                                  </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<!-- Add Book Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addBookModalLabel">Tambah Buku Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="addBookForm" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" required>
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <?php
                            $kategori = new Kategori($conn);
                            $data_kategori = $kategori->getKategori(); // Ambil semua kategori
                            
                            foreach ($data_kategori as $kat) {
                                echo '<option value="' . $kat['kategoriId'] . '">' . $kat['nama_kategori'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ebook" class="form-label">ebook</label>
                        <select class="form-select" id="ebook" name="ebook" required>
                            <option value="">Pilih ebook</option>
                            <option value="0">ebook belum tersdia</option>
                            <?php
                            $ebook = new ebook($conn);
                            $data_ebook = $ebook->getEbook(); 
                            
                            foreach ($data_ebook as $kat) {
                                echo '<option value="' . $kat['id'] . '">' . $kat['nama_buku'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="date" class="form-control" id="" name="tahun_terbit" 
    min="1900-01-01" max="2025-12-31" required>
                    </div>
                </div>
                <div class="mb-3">
    <label for="gambar_buku" class="form-label">Cover Buku</label>
    <input type="file" class="form-control" id="gambar_buku" name="gambar_buku" accept="image/*" required>
</div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>




<script>
    $(document).ready(function () {
        // Initialize DataTable with search and sorting
        var table = $('#tabel-buku').DataTable({
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json",
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "zeroRecords": "Tidak ditemukan data yang sesuai"
            },
            "searching": true,           // Enable search feature
            "ordering": true,            // Enable sorting
            "columnDefs": [
                { "orderable": false, "targets": 6 }, // Disable sorting on action column
                { "width": "5%", "targets": 0 },
                { "width": "20%", "targets": 1 },
                { "width": "15%", "targets": 2 },
                { "width": "15%", "targets": 3 },
                { "width": "15%", "targets": 4 },
                { "width": "10%", "targets": 5 },
                { "width": "20%", "targets": 6 },
            ],
            "order": [[1, 'asc']], // Default sort by book title
            "dom": '<"top"lf>rt<"bottom"ip><"clear">' // Custom layout for DataTables elements
        });
    });

    function deleteBook(id) {
        if (confirm("Apakah Anda yakin ingin menghapus kategori ini?")) {
            window.location.href = "?page=data_buku&delete=" + id;
        }
    }

</script>