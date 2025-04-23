<?php
$data_peminjaman = new Peminjaman($conn);

?>
<div class="container mt-5">
<div class="card-header text-dark">
        <h3 class="mb-0">Daftar Peminjaman</h3>
    </div>
    <div class="card-body">
    <div class="mb-3">
               <a target="_blank" href="halaman/export_data_excel.php" >
               <i class="bi bi-plus-circle"></i> Export Data
               </a>
        </div>

        <table id="tabel-buku" class="table table-striped table-bordered" style="width:100%">
        <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Buku</th>
                    <th>Tanggal Dipinjam</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Tanggal Kembali</th>
                    <th>Status Peminjaman</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data_p = $data_peminjaman->data_peminjaman();

                foreach ($data_p as $index => $data) {
                    echo '<tr>';
                    echo '<td>' . ($index + 1) . '</td>';
                    echo '<td>' . $data['username'] . '</td>';
                    echo '<td>' . $data['judul_buku'] . '</td>';
                    echo '<td>' .  date('l, F j, Y', strtotime(datetime: $data['tanggal_peminjaman'])) .'</td>';
                    echo '<td>' .  date('l, F j, Y', strtotime(datetime: $data['tanggal_pengembalian'])) .'</td>';
                    echo '<td>' . ($data['tanggal_kembali'] == null ? 'Buku Belum Dikembalikan' : date('l, F j, Y', strtotime($data['tanggal_kembali']))) . '</td>';
                    echo '<td>' . $data['status_peminjaman'] . '</td>';
                    echo '<td>' . "Rp. " . number_format($data['total_denda'], 0, ',', '.' ) . '</td>';
                  
                }
                ?>
            </tbody>
        </table>
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
            window.location.href = "data_buku.php?delete=" + id;
        }
    }

</script>