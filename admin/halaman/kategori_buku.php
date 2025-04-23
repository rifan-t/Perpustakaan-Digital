<?php

$kategori = new Kategori($conn);

if (isset($_POST['kategori'])) {
    $kategori->tambahKategori($_POST['kategori']);
    echo "<script>location.href='?page=kategori_buku'</script>";
}

if (isset($_POST['kategori_edit'])) {
    $kategori->editKategori($_POST['kategoriId'], $_POST['kategori_edit']);
    echo "<script>location.href='?page=kategori_buku'</script>";
}
if (isset($_GET['delete'])) {
    $kategori->hapusKategori($_GET['delete']);
    echo "<script>location.href='?page=kategori_buku'</script>";
}

?>
<div class="container mt-5">
    <div class="card-header text-dark">
        <h3 class="mb-0">Daftar Buku</h3>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBookModal">
                <i class="bi bi-plus-circle"></i> Tambah Kategori
            </button>
        </div>


        <table id="tabel-buku" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori Buku</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $result = $kategori->getKategori();
                foreach ($result as $index => $kategori_buku) {
                    echo '<tr>';
                    echo '<td>' . ($index + 1) . '</td>';
                    echo '<td>' . $kategori_buku['nama_kategori'] . '</td>';
                    echo '<td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editBookModal" data-id="' . $kategori_buku['kategoriId'] . '">Edit</button>
<button type="button" class="btn btn-sm btn-danger" onclick="deleteKategori(' . $kategori_buku['kategoriId'] . ')">Hapus </button>
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
                <h5 class="modal-title" id="addBookModalLabel">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>x
            <form id="tambah_kategori" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Book Modal -->
<div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editBookModalLabel">Edit Kategori</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="editBookForm" method="post">
                <input type="hidden" id="edit_id" name="kategoriId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="edit_kategori" name="kategori_edit" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var editModal = document.getElementById("editBookModal");
        editModal.addEventListener("show.bs.modal", function (event) {
            var button = event.relatedTarget; // Tombol yang men-trigger modal
            var id = button.getAttribute("data-id");
            var kategori = button.getAttribute("data-kategori");

            // Set data ke dalam input modal
            document.getElementById("edit_id").value = id;
            document.getElementById("edit_kategori").value = kategori;
        });
    });
</script>

<script>
    function setEditData(id, kategori) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_kategori').value = kategori;
    }

    function deleteKategori(id) {
        if (confirm("Apakah Anda yakin ingin menghapus kategori ini?")) {
            window.location.href = "kategori_buku.php?delete=" + id;
        }
    }
</script>